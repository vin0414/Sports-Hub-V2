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
                        <h2 class="page-title"><?=$title?> | Add Entry</h2>
                    </div>
                    <div class="col-auto ms-auto d-print-none">
                        <div class="btn-list">
                            <a href="<?=site_url('scoreboard')?>"
                                class="btn btn-primary btn-5 d-none d-sm-inline-block">
                                <i class="ti ti-arrow-left"></i>&nbsp;Back
                            </a>
                            <a href="<?=site_url('scoreboard')?>" class="btn btn-primary btn-6 d-sm-none btn-icon">
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
                <div class="card">
                    <div class="card-body">
                        <form method="POST" class="row g-1" id="form">
                            <?=csrf_field()?>
                            <input type="hidden" name="match" value="<?=$matchID?>">
                            <div class="card-title">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                    fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                    stroke-linejoin="round"
                                    class="icon icon-tabler icons-tabler-outline icon-tabler-scoreboard">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                    <path
                                        d="M3 5m0 2a2 2 0 0 1 2 -2h14a2 2 0 0 1 2 2v10a2 2 0 0 1 -2 2h-14a2 2 0 0 1 -2 -2z" />
                                    <path d="M12 5v2" />
                                    <path d="M12 10v1" />
                                    <path d="M12 14v1" />
                                    <path d="M12 18v1" />
                                    <path d="M7 3v2" />
                                    <path d="M17 3v2" />
                                    <path d="M15 10.5v3a1.5 1.5 0 0 0 3 0v-3a1.5 1.5 0 0 0 -3 0z" />
                                    <path d="M6 9h1.5a1.5 1.5 0 0 1 0 3h-.5h.5a1.5 1.5 0 0 1 0 3h-1.5" />
                                </svg>
                                Player's Scoreboard
                                <button type="submit" class="btn btn-primary" style="float: right;">
                                    <i class="ti ti-device-floppy"></i>&nbsp;Submit
                                </button>
                            </div>
                            <div class="col-lg-12">
                                <h3>Team 1</h3>
                                <div class="table-responsive mb-3">
                                    <table class="table table-bordered table-striped" id="table1">
                                        <thead>
                                            <th></th>
                                            <th>#</th>
                                            <th>Players</th>
                                            <th>Points</th>
                                            <th>Blocks</th>
                                            <th>Assist</th>
                                        </thead>
                                        <tbody>
                                            <?php foreach($team1 as $row): ?>
                                            <tr>
                                                <td>
                                                    <input type="checkbox" name="player[]" value="<?=$row->player_id?>"
                                                        style="width:20px;height:20px;" checked>
                                                    <input type="hidden" name="team[]" value="<?=$row->team_id?>">
                                                    <input type="hidden" name="sports[]" value="<?=$row->sportsID?>">
                                                </td>
                                                <td><?=$row->jersey_num?></td>
                                                <td><?=$row->fullname?></td>
                                                <td><input type="number" class="form-control" name="points[]" /></td>
                                                <td><input type="number" class="form-control" name="blocks[]" /></td>
                                                <td><input type="number" class="form-control" name="assist[]" /></td>
                                            </tr>
                                            <?php endforeach;?>
                                        </tbody>
                                    </table>
                                </div>
                                <hr>
                                <h3>Team 2</h3>
                                <div class="table-responsive mb-3">
                                    <table class="table table-bordered table-striped" id="table2">
                                        <thead>
                                            <th></th>
                                            <th>#</th>
                                            <th>Players</th>
                                            <th>Points</th>
                                            <th>Blocks</th>
                                            <th>Assist</th>
                                        </thead>
                                        <tbody>
                                            <?php foreach($team2 as $row): ?>
                                            <tr>
                                                <td>
                                                    <input type="checkbox" name="player[]" value="<?=$row->player_id?>"
                                                        style="width:20px;height:20px;" checked>
                                                    <input type="hidden" name="team[]" value="<?=$row->team_id?>">
                                                    <input type="hidden" name="sports[]" value="<?=$row->sportsID?>">
                                                </td>
                                                <td><?=$row->jersey_num?></td>
                                                <td><?=$row->fullname?></td>
                                                <td><input type="number" class="form-control" name="points[]" /></td>
                                                <td><input type="number" class="form-control" name="blocks[]" /></td>
                                                <td><input type="number" class="form-control" name="assist[]" /></td>
                                            </tr>
                                            <?php endforeach;?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="modal" id="modal-loading" data-bs-backdrop="static">
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
$('#table1').DataTable();
$('#table2').DataTable();
$('#form').on('submit', function(e) {
    e.preventDefault();
    let data = $(this).serialize();
    $('#modal-loading').modal('show');
    $.ajax({
        url: "<?=site_url('roster/score/save')?>",
        method: "POST",
        data: data,
        success: function(response) {
            $('#modal-loading').modal('hide');
            if (response.success) {
                Swal.fire({
                    title: 'Great!',
                    text: "Successfully submitted",
                    icon: 'success',
                    confirmButtonText: 'Continue'
                }).then((result) => {
                    // Action based on user's choice
                    if (result.isConfirmed) {
                        // Perform some action when "Yes" is clicked
                        location.href = "/scoreboard";
                    }
                });
            } else {
                //alert(response.errors);
                var errors = response.errors;
                for (var key in errors) {
                    Swal.fire({
                        title: "Error",
                        text: errors[key],
                        icon: 'error'
                    });
                }
            }
        }
    });
});
</script>
<?= view('main/templates/closing')?>