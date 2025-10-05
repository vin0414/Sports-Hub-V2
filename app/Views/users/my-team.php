<?=view('main/templates/header')?>
<?=view('main/templates/main-template')?>
<div class="page-wrapper">
    <div class="page-header d-print-none">
        <div class="container-xl">
            <div class="row g-2 align-items-center">
                <div class="col">
                    <h2 class="page-title">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                            stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                            class="icon icon-tabler icons-tabler-outline icon-tabler-users-group">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                            <path d="M10 13a2 2 0 1 0 4 0a2 2 0 0 0 -4 0" />
                            <path d="M8 21v-1a2 2 0 0 1 2 -2h4a2 2 0 0 1 2 2v1" />
                            <path d="M15 5a2 2 0 1 0 4 0a2 2 0 0 0 -4 0" />
                            <path d="M17 10h2a2 2 0 0 1 2 2v1" />
                            <path d="M5 5a2 2 0 1 0 4 0a2 2 0 0 0 -4 0" />
                            <path d="M3 13v-1a2 2 0 0 1 2 -2h2" />
                        </svg>
                        <?=$team['team_name']?>
                    </h2>
                </div>
            </div>
        </div>
    </div>
    <div class="page-body">
        <div class="container-xl">
            <div class="card">
                <div class="card-header">
                    <ul class="nav nav-tabs card-header-tabs" data-bs-toggle="tabs">
                        <li class="nav-item">
                            <a href="#tabs-list-8" class="nav-link active" data-bs-toggle="tab">
                                <i class="ti ti-list"></i>&nbsp;List of Players
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="#tabs-new-8" class="nav-link" data-bs-toggle="tab">
                                <i class="ti ti-user-plus"></i>&nbsp;Application
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="#tabs-calendar-8" class="nav-link" data-bs-toggle="tab">
                                <i class="ti ti-calendar-plus"></i>&nbsp;Schedules
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="#tabs-matches-8" class="nav-link" data-bs-toggle="tab">
                                <i class="ti ti-calendar"></i>&nbsp;Upcoming Matches
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="#tabs-stats-8" class="nav-link" data-bs-toggle="tab">
                                <i class="ti ti-scoreboard"></i>&nbsp;Team Stats
                            </a>
                        </li>
                    </ul>
                </div>
                <div class="card-body">
                    <div class="tab-content">
                        <div class="tab-pane fade active show" id="tabs-list-8">
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped" id="table1">
                                    <thead>
                                        <th>Jersey #</th>
                                        <th>Name of Players</th>
                                        <th>Role</th>
                                        <th>Height</th>
                                        <th>Weight</th>
                                        <th>Action</th>
                                    </thead>
                                    <tbody id="players"></tbody>
                                </table>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="tabs-new-8">
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped" id="table2">
                                    <thead>
                                        <th>Fullname</th>
                                        <th>Email</th>
                                        <th>Contact #</th>
                                        <th>Age</th>
                                        <th>Address</th>
                                        <th>Action</th>
                                    </thead>
                                    <tbody id="list"></tbody>
                                </table>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="tabs-calendar-8">

                        </div>
                        <div class="tab-pane fade" id="tabs-matches-8">

                        </div>
                        <div class="tab-pane fade" id="tabs-stats-8">

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="modal" id="modal-loading" data-backdrop="static">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-body text-center">
                <div class="mb-2">
                    <dotlottie-wc src="https://lottie.host/ed13f8d5-bc3f-4786-bbb8-36d06a21a6cb/XMPpTra572.lottie"
                        style="width: 100%;height: auto;" autoplay loop></dotlottie-wc>
                </div>
                <div>Loading</div>
            </div>
        </div>
    </div>
</div>
<?= view('main/templates/footer')?>
<script src="https://unpkg.com/@lottiefiles/dotlottie-wc@0.8.1/dist/dotlottie-wc.js" type="module"></script>
<script>
window.addEventListener('DOMContentLoaded', () => {
    players();
    newPlayer();
});

function calculateAge(birthDateString) {
    const birthDate = new Date(birthDateString);
    const today = new Date();

    let age = today.getFullYear() - birthDate.getFullYear();
    const monthDiff = today.getMonth() - birthDate.getMonth();
    const dayDiff = today.getDate() - birthDate.getDate();

    // Adjust if birthday hasn't occurred yet this year
    if (monthDiff < 0 || (monthDiff === 0 && dayDiff < 0)) {
        age--;
    }

    return age;
}

function players() {
    const teamId = <?= json_encode($team['team_id']) ?>;
    fetch('/roster/player-list?teamId=' + teamId)
        .then(response => {
            if (!response.ok) {
                throw new Error('Network response was not ok');
            }
            return response.json();
        })
        .then(data => {
            console.log(data);
            const tbody = document.getElementById('players');
            data.players.forEach(item => {
                const row = document.createElement('tr');
                row.innerHTML = `
                <td>${item.jersey_num}</td>
                <td>${item.Fullname}</td>
                <td>${item.roleName}</td>
                <td>${item.height}</td>
                <td>${item.weight}</td>
                <td>
                    <button type="button" class="btn btn-primary approveTeam" value="${item.player_id}">
                    <i class='ti ti-edit'></i>&nbsp;Edit
                    </button>
                </td>
            `;
                tbody.appendChild(row);
            });

            // Initialize or reinitialize DataTable
            if ($.fn.DataTable.isDataTable('#table1')) {
                $('#table1').DataTable().clear().destroy();
            }
            $('#table1').DataTable();
        })
        .catch(error => console.error('There was a problem with your fetch operation:', error));
}

function newPlayer() {
    const teamId = <?= json_encode($team['team_id']) ?>;
    fetch('/roster/new-players?teamId=' + teamId)
        .then(response => {
            if (!response.ok) {
                throw new Error('Network response was not ok');
            }
            return response.json();
        })
        .then(data => {
            console.log(data);
            const tbody = document.getElementById('list');
            data.list.forEach(item => {
                const row = document.createElement('tr');
                row.innerHTML = `
                <td>${item.fullname}</td>
                <td>${item.email}</td>
                <td>${item.phone}</td>
                <td>${calculateAge(item.birth_date)}</td>
                <td>${item.address}</td>
                <td>
                    <button type="button" class="btn btn-primary recruite" value="${item.player_id}">
                        <i class='ti ti-circle-check'></i>&nbsp;Recruite
                    </button>
                </td>
            `;
                tbody.appendChild(row);
            });

            // Initialize or reinitialize DataTable
            if ($.fn.DataTable.isDataTable('#table2')) {
                $('#table2').DataTable().clear().destroy();
            }
            $('#table2').DataTable();
        })
        .catch(error => console.error('There was a problem with your fetch operation:', error));
}
</script>
<?= view('main/templates/closing')?>