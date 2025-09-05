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
                            <a href="<?=site_url('videos')?>" class="btn btn-primary btn-5 d-none d-sm-inline-block">
                                <i class="ti ti-arrow-left"></i>&nbsp;Back
                            </a>
                            <a href="<?=site_url('videos')?>" class="btn btn-primary btn-6 d-sm-none btn-icon">
                                <i class="ti ti-arrow-left"></i>
                            </a>
                        </div>
                        <!-- BEGIN MODAL -->
                        <!-- END MODAL -->
                    </div>
                </div>
            </div>
        </div>
        <!-- END PAGE HEADER -->
        <div class="page-body">
            <div class="container-xl">
                <div class="row g-3">
                    <div class="col-lg-8">
                        <div class="card">
                            <div class="card-body">
                                <div class="card-title"><?=$title?></div>
                                <div class="row g-2">
                                    <div class="col-lg-12">
                                        <iframe
                                            src="https://player.livepush.io/live/<?=!empty($code['code']) ? $code['code'] : ''?>"
                                            width="100%" height="480" allowFullScreen="1" frameBorder="0"></iframe>
                                    </div>
                                    <!-- <div class="col-lg-12">
                                            <button type="button" id="start" class="btn btn-primary"
                                                onclick="start(this)">
                                                <i class="ti ti-player-play"></i>&nbsp;Start
                                            </button>
                                            <button type="button" class="btn btn-primary" id="stopStream"
                                                onclick="stopStream()" disabled>
                                                <i class="ti ti-player-stop"></i>&nbsp;Stop
                                            </button>
                                            <button type="button" class="btn btn-danger" id="stream"
                                                onclick="stream(this)" disabled>
                                                <i class="ti ti-building-broadcast-tower"></i>&nbsp;Live
                                            </button>
                                        </div> -->
                                    <div class="col-lg-12">
                                        <label class="form-label">Enter the Code</label>
                                    </div>
                                    <div class="col-lg-12">
                                        <form class="row g-3" method="POST" action="<?=site_url('save-code')?>">
                                            <div class="col-lg-10">
                                                <input type="text" name="code" class="form-control"
                                                    value="<?=!empty($code['code']) ? $code['code'] : ''?>" />
                                            </div>
                                            <div class="col-lg-2">
                                                <button type="submit" class="btn btn-primary form-control">Save</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="card">
                            <div class="card-header">
                                <div class="card-title">Upcoming Match</div>
                            </div>
                            <div class="position-relative">
                                <?php if(empty($match)): ?>
                                <div style="padding:5px;margin:5px;">No Incoming Match(es) Yet</div>
                                <?php else : ?>
                                <?php if($match): ?>
                                <?php
                                            $teamModel = new \App\Models\teamModel();
                                            $team1 = $teamModel->WHERE('team_id',$match['team1_id'])->first();
                                            $team2 = $teamModel->WHERE('team_id',$match['team2_id'])->first();
                                            ?>
                                <div class="row" style="margin:10px;padding:10px;">
                                    <div class="col-lg-5">
                                        <span style="font-size: 1.2rem;">
                                            <center><?=$team1['team_name']?></center>
                                        </span>
                                    </div>
                                    <div class="col-lg-2">
                                        <p class="text-center bg-danger text-white">VS</p>
                                    </div>
                                    <div class="col-lg-5">
                                        <span style="font-size: 1.2rem;">
                                            <center><?=$team2['team_name']?></center>
                                        </span>
                                    </div>
                                    <center><small><?=date('M d, Y',strtotime($match['date']))?> |
                                            <?=date('h:i A',strtotime($match['time']))?> |
                                            <?php echo $match['location'] ?></small></center>
                                </div>
                                <?php endif; ?>
                                <?php endif; ?>
                            </div>
                        </div>
                        <br />
                        <div class="card">
                            <div class="card-header">
                                <div class="card-title">Current Match</div>
                            </div>
                            <div class="position-relative">
                                <?php if(empty($game)): ?>
                                <div style="padding:5px;margin:5px;">No Current Match(es) Yet</div>
                                <?php else : ?>
                                <?php
                                    $teamModel = new \App\Models\teamModel();
                                    $team1 = $teamModel->WHERE('team_id',$game['team1_id'])->first();
                                    $team2 = $teamModel->WHERE('team_id',$game['team2_id'])->first();      
                                    ?>
                                <div class="row">
                                    <div class="col-lg-5">
                                        <span style="font-size: 1.0rem;">
                                            <center><?=$team1['team_name']?></center>
                                        </span>
                                        <h1 class="text-center" id="home">0</h1>
                                    </div>
                                    <div class="col-lg-2">
                                        <p class="text-center bg-danger text-white">VS</p>
                                    </div>
                                    <div class="col-lg-5">
                                        <span style="font-size: 1.0rem;">
                                            <center><?=$team2['team_name']?></center>
                                        </span>
                                        <h1 class="text-center" id="guest">0</h1>
                                    </div>
                                </div>
                                <hr />
                                <div class="row g-3">
                                    <div class="col-lg-12">
                                        <div class="row g-1">
                                            <div class="col-lg-6">
                                                <button type="button" class="btn btn-primary add_team1"
                                                    value="<?=$team1['team_id']?>"><i
                                                        class="ti ti-plus"></i>&nbsp;Add</button>
                                                <button type="button" class="btn btn-danger minus_team1"
                                                    value="<?=$team1['team_id']?>"><i
                                                        class="ti ti-minus"></i>&nbsp;Minus</button>
                                            </div>
                                            <div class="col-lg-6">
                                                <button type="button" class="btn btn-primary add_team2"
                                                    value="<?=$team2['team_id']?>"><i
                                                        class="ti ti-plus"></i>&nbsp;Add</button>
                                                <button type="button" class="btn btn-danger minus_team2"
                                                    value="<?=$team2['team_id']?>"><i
                                                        class="ti ti-minus"></i>&nbsp;Minus</button>
                                            </div>
                                        </div>
                                    </div>
                                    <?php if($game['status']==1): ?>
                                    <div class="col-lg-12">
                                        <button type="button" class="form-control btn btn-primary endGame"
                                            value="<?=$game['match_id']?>">
                                            <i class="ti ti-square-rounded-x"></i>&nbsp;End Game
                                        </button>
                                    </div>
                                    <?php endif; ?>
                                </div>
                                <?php endif; ?>
                            </div>
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
    guest();
    home();
});
$(document).on('click', '.endGame', function() {
    Swal.fire({
        title: "Are you sure?",
        text: "Do you want to end this match?",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Yes!"
    }).then((result) => {
        if (result.isConfirmed) {
            stopStream();
            let match = <?= isset($game['match_id']) ? $game['match_id'] : 0; ?>;
            $.ajax({
                url: "<?=site_url('end-game')?>",
                method: "POST",
                data: {
                    match: match
                },
                success: function(response) {
                    if (response.success) {
                        location.reload();
                    } else {
                        Swal.fire({
                            title: 'Warning!',
                            text: response,
                            icon: 'warning'
                        });
                    }
                }
            });
        }
    });
});

function guest() {
    let match = <?= isset($game['match_id']) ? $game['match_id'] : 0; ?>;
    let team = <?= isset($game['team2_id']) ? $game['team2_id'] : 0; ?>;
    $.ajax({
        url: "<?=site_url('team2-score')?>",
        method: "GET",
        data: {
            match: match,
            team: team
        },
        success: function(response) {
            $('#guest').html(response);
        }
    });
}

function home() {
    let match = <?= isset($game['match_id']) ? $game['match_id'] : 0; ?>;
    let team = <?= isset($game['team1_id']) ? $game['team1_id'] : 0; ?>;
    $.ajax({
        url: "<?=site_url('team1-score')?>",
        method: "GET",
        data: {
            match: match,
            team: team
        },
        success: function(response) {
            $('#home').html(response);
        }
    });
}
//team 1
$(document).on('click', '.add_team1', function() {
    let match = <?= isset($game['match_id']) ? $game['match_id'] : 0; ?>;
    $.ajax({
        url: "<?=site_url('add-score-team-1')?>",
        method: "POST",
        data: {
            match: match,
            team: $(this).val()
        },
        success: function(response) {
            if (response.success) {
                home();
            } else {
                Swal.fire({
                    title: 'Warning!',
                    text: response,
                    icon: 'warning'
                });
            }
        }
    });
});
$(document).on('click', '.minus_team1', function() {
    let match = <?= isset($game['match_id']) ? $game['match_id'] : 0; ?>;
    $.ajax({
        url: "<?=site_url('minus-score-team-1')?>",
        method: "POST",
        data: {
            match: match,
            team: $(this).val()
        },
        success: function(response) {
            if (response.success) {
                home();
            } else {
                Swal.fire({
                    title: 'Warning!',
                    text: response,
                    icon: 'warning'
                });
            }
        }
    });
});
//team 2
$(document).on('click', '.add_team2', function() {
    let match = <?= isset($game['match_id']) ? $game['match_id'] : 0; ?>;
    $.ajax({
        url: "<?=site_url('add-score-team-2')?>",
        method: "POST",
        data: {
            match: match,
            team: $(this).val()
        },
        success: function(response) {
            if (response.success) {
                guest();
            } else {
                Swal.fire({
                    title: 'Warning!',
                    text: response,
                    icon: 'warning'
                });
            }
        }
    });
});
$(document).on('click', '.minus_team2', function() {
    let match = <?= isset($game['match_id']) ? $game['match_id'] : 0; ?>;
    $.ajax({
        url: "<?=site_url('minus-score-team-2')?>",
        method: "POST",
        data: {
            match: match,
            team: $(this).val()
        },
        success: function(response) {
            if (response.success) {
                guest();
            } else {
                Swal.fire({
                    title: 'Warning!',
                    text: response,
                    icon: 'warning'
                });
            }
        }
    });
});
</script>
<?= view('main/templates/closing')?>