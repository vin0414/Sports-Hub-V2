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
                        <?=$title?>
                    </h2>
                </div>
                <div class="col-auto ms-auto d-print-none">
                    <div class="btn-list">
                        <a href="javascript:history.back()" class="btn btn-primary d-none d-sm-inline-block">
                            <i class="ti ti-arrow-left"></i>
                            Back
                        </a>
                        <a href="javascript:history.back()" class="btn btn-primary d-sm-none btn-icon">
                            <i class="ti ti-arrow-left"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="page-body">
        <div class="container-xl">
            <div class="row g-3">
                <div class="col-lg-6">
                    <div class="card">
                        <div class="card-body">
                            <div class="card-title"><i class="ti ti-user"></i>&nbsp;Personal Information</div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3">
                    <div class="card mb-3">
                        <div class="card-body">
                            <div class="card-title"><i class="ti ti-scoreboard"></i>&nbsp;Team Stats</div>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-body">
                            <div class="card-title"><i class="ti ti-scoreboard"></i>&nbsp;Personal Stats</div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3">
                    <div class="card">
                        <div class="card-header">
                            <div class="card-title"><i class="ti ti-calendar"></i>&nbsp;Upcoming Matches</div>
                        </div>
                        <div class="list-group list-group-flush">

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?= view('main/templates/footer')?>
<script>
$(document).ready(function() {
    // Custom JS can be added here
    matches();
});

function matches() {
    fetch('/roster/matches?team_id=<?=$team['team_id']?>')
        .then(response => {
            if (!response.ok) {
                throw new Error('Network response was not ok');
            }
            return response.json();
        })
        .then(data => {
            console.log(data);
        })
        .catch(error => console.error('There was a problem with your fetch operation:', error));
}
</script>
<?= view('main/templates/closing')?>