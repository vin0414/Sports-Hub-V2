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
                            <a href="#tabs-calendar-8" class="nav-link" data-bs-toggle="tab">
                                <i class="ti ti-calendar"></i>&nbsp;Schedules
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
                        <div class="tab-pane fade" id="tabs-calendar-8">

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?= view('main/templates/footer')?>
<script>
window.addEventListener('DOMContentLoaded', () => {
    players();
});

function players() {
    const teamId = <?= json_encode($team['team_id']) ?>;
    fetch('/roster/player-list?teamId=${teamId}')
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
                <td><button type="button" class="btn btn-primary approveTeam" value="${item.player_id}">Edit</button></td>
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
</script>
<?= view('main/templates/closing')?>