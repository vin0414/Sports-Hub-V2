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
                <div class="col-lg-4">
                    <div class="card">
                        <div class="card-body">
                            <div class="card-title"><i class="ti ti-user"></i>&nbsp;Personal Information</div>
                            <div class="row g-1">
                                <div class="col-lg-12">
                                    <label class="form-label">Email</label>
                                    <p class="form-control"><?=$player['email']?></p>
                                </div>
                                <div class="col-lg-12">
                                    <div class="row g-1">
                                        <div class="col-lg-6">
                                            <label class="form-label">Date of Birth</label>
                                            <p class="form-control"><?=$player['date_of_birth']?></p>
                                        </div>
                                        <div class="col-lg-6">
                                            <label class="form-label">Gender</label>
                                            <p class="form-control"><?=$player['gender']?></p>
                                        </div>
                                        <div class="col-lg-12">
                                            <label class="form-label">Position</label>
                                            <p class="form-control">
                                                <?=!empty($role['roleName']) ? $role['roleName'] : 'N/A' ?></p>
                                        </div>
                                        <div class="col-lg-4">
                                            <label class="form-label">Jersey No</label>
                                            <p class="form-control"><?=$player['jersey_num']?></p>
                                        </div>
                                        <div class="col-lg-4">
                                            <label class="form-label">Height (cm)</label>
                                            <p class="form-control"><?=$player['height']?></p>
                                        </div>
                                        <div class="col-lg-4">
                                            <label class="form-label">Weight (kg)</label>
                                            <p class="form-control"><?=$player['weight']?></p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-12 mb-3">
                                    <label class="form-label">Address</label>
                                    <textarea class="form-control" style="height: 100px;"
                                        disabled><?=$player['address']?></textarea>
                                </div>
                                <div class="col-lg-12">
                                    <a href="<?=site_url('profile/edit/')?><?=$player['player_id']?>"
                                        class="btn btn-primary">
                                        <i class="ti ti-edit"></i>&nbsp;Edit Profile
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-5">
                    <!-- <div class="card">
                        <div class="card-body">
                            <div id="panorama"></div>
                        </div>
                    </div> -->
                    <center>
                        <img src="<?=site_url('assets/images/players/')?><?=$player['image']?>" alt="profile">
                    </center>
                </div>
                <div class="col-lg-3">
                    <div class="card mb-3">
                        <div class="card-body">
                            <div class="card-title"><i class="ti ti-scoreboard"></i>&nbsp;Team Stats</div>
                            <div class="row g-3">
                                <div class="col-lg-6">
                                    <div class="card">
                                        <div class="card-body">
                                            <div class="card-title">WIN</div>
                                            <h1 class="text-center">
                                                <?php if($stats):?><?=$stats->win ?? 0 ?><?php endif;?></h1>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="card">
                                        <div class="card-body">
                                            <div class="card-title">LOSE</div>
                                            <h1 class="text-center">
                                                <?php if($stats):?><?=$stats->loss ?? 0 ?><?php endif;?></h1>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card mb-3">
                        <div class="card-header">
                            <div class="card-title"><i class="ti ti-scoreboard"></i>&nbsp;Personal Stats</div>
                        </div>
                        <div class="position-relative">
                            <table class="table table-bordered">
                                <tbody>
                                    <?php if(!empty($performance) && is_array($performance)):?>
                                    <?php foreach($performance as $perf):?>
                                    <tr>
                                        <th><?=$perf['stat_type']?></th>
                                        <td class="text-center"><?=$perf['stat_value']?></td>
                                    </tr>
                                    <?php endforeach;?>
                                    <?php else:?>
                                    <tr>
                                        <td colspan="2">No stats available</td>
                                    </tr>
                                    <?php endif;?>
                                </tbody>
                            </table>
                        </div>
                    </div>
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
pannellum.viewer('panorama', {
    "type": "equirectangular",
    "panorama": "<?=base_url('assets/images/players/')?><?=$player['image']?>"
});

function matches() {
    fetch('/roster/matches?teamId=<?=$team['team_id']?>')
        .then(response => {
            if (!response.ok) {
                throw new Error('Network response was not ok');
            }
            return response.json();
        })
        .then(data => {
            const listGroup = document.querySelector('.list-group');
            listGroup.innerHTML = ''; // Clear existing content

            if (!data.matches || data.matches.length === 0) {
                const noMatchItem = document.createElement('div');
                noMatchItem.className = 'list-group-item';
                noMatchItem.textContent = 'No upcoming matches';
                listGroup.appendChild(noMatchItem);
            } else {
                data.matches.forEach(match => {
                    const listItem = document.createElement('div');
                    listItem.className = 'list-group-item';

                    const row = document.createElement('div');
                    row.className = 'row';

                    const col = document.createElement('div');
                    col.className = 'col';

                    const dateTime = document.createElement('div');
                    dateTime.className = 'text-muted';
                    dateTime.textContent = `${match.date ?? 'TBD'} at ${match.time ?? 'TBD'}`;

                    const teamName = document.createElement('div');
                    teamName.className = 'fw-bold';
                    teamName.textContent = match.team_name;

                    const venue = document.createElement('div');
                    venue.className = 'text-muted';
                    venue.textContent = `Venue: ${match.location}`;

                    col.append(dateTime, teamName, venue);
                    row.appendChild(col);
                    listItem.appendChild(row);
                    listGroup.appendChild(listItem);
                });
            }
        })
        .catch(error => console.error('There was a problem with your fetch operation:', error));
}
</script>
<?= view('main/templates/closing')?>