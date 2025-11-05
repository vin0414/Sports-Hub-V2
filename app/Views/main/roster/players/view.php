<?= view('main/templates/header')?>
<div class="page">
    <!--  BEGIN SIDEBAR  -->
    <?= view('main/templates/sidebar')?>
    <!--  END SIDEBAR  -->
    <!-- BEGIN NAVBAR  -->
    <?= view('main/templates/navbar')?>
    <!-- END NAVBAR  -->
    <div class="page-wrapper">
        <!-- BEGIN PAGE HEADER -->
        <div class="page-header d-print-none">
            <div class="container-xl">
                <div class="row g-2 align-items-center">
                    <div class="col">
                        <!-- Page pre-title -->
                        <div class="page-pretitle">Digital Sports Hub</div>
                        <h2 class="page-title"><?=$title?></h2>
                    </div>
                    <!-- Page title actions -->
                    <div class="col-auto ms-auto d-print-none">
                        <div class="btn-list">
                            <button class="btn btn-default add"><i class="ti ti-plus"></i>&nbsp;Add</button>
                            <a href="javascript:history.back();" class="btn btn-primary btn-5 d-none d-sm-inline-block">
                                <i class="ti ti-arrow-left"></i>&nbsp;Back
                            </a>
                            <a href="javascript:history.back();" class="btn btn-primary btn-6 d-sm-none btn-icon">
                                <i class="ti ti-arrow-left"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- END PAGE HEADER -->
        <div class="page-body">
            <div class="container-xl">
                <div class="row g-3">
                    <div class="col-lg-3">
                        <div class="card">
                            <div class="card-body">
                                <div class="card-title">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                        fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                        stroke-linejoin="round"
                                        class="icon icon-tabler icons-tabler-outline icon-tabler-user-square">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                        <path d="M9 10a3 3 0 1 0 6 0a3 3 0 0 0 -6 0" />
                                        <path d="M6 21v-1a4 4 0 0 1 4 -4h4a4 4 0 0 1 4 4v1" />
                                        <path
                                            d="M3 5a2 2 0 0 1 2 -2h14a2 2 0 0 1 2 2v14a2 2 0 0 1 -2 2h-14a2 2 0 0 1 -2 -2v-14z" />
                                    </svg>
                                    Information
                                </div>
                                <div class="row g-1">
                                    <div class="col-lg-12">
                                        <label class="form-label"><small>Complete Name</small></label>
                                        <h3 class="form-control"><?=$info['fullname']?></h3>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="row g-2">
                                            <div class="col-lg-3">
                                                <label class="form-label"><small>Age</small></label>
                                                <?php
                                                    $birthDate = new DateTime($info['birth_date']);
                                                    $today = new DateTime(); // current date
                                                    $age = $today->diff($birthDate)->y;
                                                ?>
                                                <h3 class="form-control"><?=$age?></h3>
                                            </div>
                                            <div class="col-lg-3">
                                                <label class="form-label"><small>Jersey #</small></label>
                                                <h3 class="form-control"><?=$player['jersey_num']?></h3>
                                            </div>
                                            <div class="col-lg-6">
                                                <label class="form-label"><small>Position</small></label>
                                                <h3 class="form-control">
                                                    <?=!empty($role['roleName']) ? $role['roleName'] : 'N/A' ?></h3>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="row g-2">
                                            <div class="col-lg-6">
                                                <label class="form-label"><small>Height</small></label>
                                                <h3 class="form-control"><?=$player['height']?>cm</h3>
                                            </div>
                                            <div class="col-lg-6">
                                                <label class="form-label"><small>Weight</small></label>
                                                <h3 class="form-control"><?=$player['weight']?>kg(s)</h3>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-5">
                        <center>
                            <img src="<?=site_url('assets/images/players/')?><?=$player['image']?>" alt="profile">
                        </center>
                    </div>
                    <div class="col-lg-4">
                        <div class="card">
                            <div class="card-body">
                                <div class="card-title">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                        fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                        stroke-linejoin="round"
                                        class="icon icon-tabler icons-tabler-outline icon-tabler-chart-radar">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                        <path d="M12 3l9.5 7l-3.5 11h-12l-3.5 -11z" />
                                        <path d="M12 7.5l5.5 4l-2.5 5.5h-6.5l-2 -5.5z" />
                                        <path d="M2.5 10l9.5 3l9.5 -3" />
                                        <path d="M12 3v10l6 8" />
                                        <path d="M6 21l6 -8" />
                                    </svg>
                                    Personal Stats
                                </div>
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
                    </div>
                </div>
                <div class="card">
                    <div class="card-body">
                        <div class="card-title">Match Performance</div>
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped" id="score">
                                <thead>
                                    <th>Match</th>
                                    <th>Result</th>
                                    <th>Points</th>
                                    <th>Blocks</th>
                                    <th>Assist</th>
                                    <th>Others</th>
                                </thead>
                                <tbody>
                                    <?php foreach($points as $row): ?>
                                    <tr>
                                        <td><?=$row->home?> VS <?=$row->away?></td>
                                        <td><?=$row->result?></td>
                                        <td><?=$row->points?></td>
                                        <td><?=$row->blocks?></td>
                                        <td><?=$row->assist?></td>
                                        <td><?=$row->others?></td>
                                    </tr>
                                    <?php endforeach;?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal modal-blur fade" id="statsModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-md" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Player Stats</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form method="POST" class="row g-3" id="frmStat">
                    <?=csrf_field()?>
                    <input type="hidden" name="player" id="player_1" value="<?=$player['player_id']?>" />
                    <input type="hidden" name="team" value="<?=$player['team_id']?>" />
                    <div class="col-lg-12">
                        <label class="form-label">Match</label>
                        <select name="match" class="form-select">
                            <option value="">Choose</option>
                            <?php foreach($matches as $row): ?>
                            <option value="<?=$row->match_id?>"><?=$row->home?> VS <?=$row->away?></option>
                            <?php endforeach;?>
                        </select>
                        <div id="match-error" class="error-message text-danger text-sm"></div>
                    </div>
                    <div class="col-lg-12">
                        <div class="row g-3">
                            <div class="col-lg-6">
                                <label class="form-label">Stats</label>
                                <select name="stat" class="form-select">
                                    <option value="">Choose</option>
                                    <option value="PTS">Points</option>
                                    <option value="BLK">Blocks</option>
                                    <option value="REB">Rebounds</option>
                                    <option value="AST">Assists</option>
                                    <option value="STL">Steals</option>
                                    <option value="TO">Turnovers</option>
                                    <option value="K">Kills</option>
                                    <option value="DIG">Digs</option>
                                    <option value="SA">Service Aces</option>
                                    <option value="G">Goals</option>
                                    <option value="T">Tackles</option>
                                    <option value="SOG">Shots On Goal</option>
                                    <option value="S">Smaches</option>
                                    <option value="DS">Drop Shots</option>
                                    <option value="A">Aces</option>
                                    <option value="SE">Service Errors</option>
                                </select>
                                <div id="stat-error" class="error-message text-danger text-sm"></div>
                            </div>
                            <div class="col-lg-6">
                                <label class="form-label">Value</label>
                                <input type="number" class="form-control" name="points" min="0" />
                                <div id="points-error" class="error-message text-danger text-sm"></div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <button type="submit" class="btn btn-primary form-control">
                            <i class="ti ti-device-floppy"></i>&nbsp;Save
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<?= view('main/templates/footer')?>
<script>
$('#score').DataTable();
$(document).on('click', '.add', function() {
    $('#statsModal').modal('show');
});
$('#frmStat').on('submit', function(e) {
    e.preventDefault();
    $('.error-message').html('');
    let data = $(this).serialize();
    $.ajax({
        url: "<?=site_url('roster/score/save')?>",
        method: "POST",
        data: data,
        success: function(response) {
            if (response.success) {
                $('#frmStat')[0].reset();
                Swal.fire({
                    title: 'Great!',
                    text: "Successfully added",
                    icon: 'success',
                    confirmButtonText: 'Continue'
                }).then((result) => {
                    // Action based on user's choice
                    if (result.isConfirmed) {
                        // Perform some action when "Yes" is clicked
                        location.reload();
                    }
                });
            } else {
                var errors = response.errors;
                // Iterate over each error and display it under the corresponding input field
                for (var field in errors) {
                    $('#' + field + '-error').html('<p>' + errors[field] +
                        '</p>'); // Show the first error message
                    $('#' + field).addClass(
                        'text-danger'); // Highlight the input field with an error
                }
            }
        }
    });
});
</script>
<?= view('main/templates/closing')?>