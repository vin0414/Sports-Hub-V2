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
                            <a href="<?=site_url('roster/teams')?>"
                                class="btn btn-primary btn-5 d-none d-sm-inline-block">
                                <i class="ti ti-arrow-left"></i>&nbsp;Back
                            </a>
                            <a href="<?=site_url('roster/teams')?>" class="btn btn-primary btn-6 d-sm-none btn-icon">
                                <i class="ti ti-arrow-left"></i>
                            </a>
                        </div>
                        <!-- BEGIN MODAL -->
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
                                <div class="card-title">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                        fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                        stroke-linejoin="round"
                                        class="icon icon-tabler icons-tabler-outline icon-tabler-table-column">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                        <path
                                            d="M3 5a2 2 0 0 1 2 -2h14a2 2 0 0 1 2 2v14a2 2 0 0 1 -2 2h-14a2 2 0 0 1 -2 -2v-14z" />
                                        <path d="M10 10h11" />
                                        <path d="M10 3v18" />
                                        <path d="M9 3l-6 6" />
                                        <path d="M10 7l-7 7" />
                                        <path d="M10 12l-7 7" />
                                        <path d="M10 17l-4 4" />
                                    </svg>
                                    Team Information
                                </div>
                                <div class="row g-1">
                                    <div class="col-lg-12">
                                        <div class="row g-3">
                                            <div class="col-lg-1">
                                                <img src="<?=site_url('assets/images/team/')?><?=$team['image']?>"
                                                    style="width:50px;border:1px solid #000000;border-radius:10px 10px;" />
                                            </div>
                                            <div class="col-lg-6">
                                                <div><?=$team['team_name']?></div>
                                                <small><?=$sports['Name']?></small>
                                            </div>
                                            <div class="col-lg-5">
                                                <div class="row g-1">
                                                    <?php foreach($staff as $row):?>
                                                    <div class="col-lg-12">
                                                        <?=$row['position']?> : <?=$row['name']?>
                                                    </div>
                                                    <?php endforeach;?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <label class="form-label">School/University/Barangay</label>
                                        <p class="form-control"><?=$team['school_barangay']?></p>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="row g-3">
                                            <div class="col-lg-6">
                                                <label class="form-label">Organization</label>
                                                <p class="form-control"><?=$team['organization']?></p>
                                            </div>
                                            <div class="col-lg-6">
                                                <label class="form-label">Owner</label>
                                                <p class="form-control"><?=$team['coordinator']?></p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <ul class="nav nav-tabs" data-bs-toggle="tabs">
                                            <li class="nav-item">
                                                <a href="#tabs-home-8" class="nav-link active" data-bs-toggle="tab">
                                                    <i class="ti ti-list"></i>&nbsp;List of Players
                                                </a>
                                            </li>
                                        </ul>
                                        <div class="tab-content">
                                            <div class="tab-pane fade active show" id="tabs-home-8">
                                                <br />
                                                <div class="table-responsive">
                                                    <table class="table table-bordered table-striped">
                                                        <thead>
                                                            <th>#</th>
                                                            <th>Image</th>
                                                            <th>Name of Player</th>
                                                            <th>Position</th>
                                                            <th>Height</th>
                                                            <th>Weight</th>
                                                            <th>Action</th>
                                                        </thead>
                                                        <tbody>
                                                            <?php if(empty($player)): ?>
                                                            <tr>
                                                                <td colspan="7">No Player(s) found</td>
                                                            </tr>
                                                            <?php else: ?>
                                                            <?php foreach($player as $row): ?>
                                                            <?php 
                                                            $roleModel = new \App\Models\roleModel();
                                                            $role = $roleModel->where('roleID',$row['roleID'])->first();
                                                            //name
                                                            $model = new \App\Models\registerModel();
                                                            $user = $model->where('email',$row['email'])->first();
                                                            ?>
                                                            <tr>
                                                                <td><?=$row['jersey_num']?></td>
                                                                <td><img src="<?=site_url('assets/images/players/')?><?=$row['image']?>"
                                                                        style="width:30px;border:1px solid #000000;border-radius:10px 10px;" />
                                                                </td>
                                                                <td><?=$user['fullname']?></td>
                                                                <td><?=!empty($role['roleName']) ? $role['roleName'] : 'N/A' ?>
                                                                </td>
                                                                <td><?=$row['height']?>cm</td>
                                                                <td><?=$row['weight']?>kgs</td>
                                                                <td>
                                                                    <a href="<?=site_url('roster/players/view/')?><?=$row['player_id']?>"
                                                                        class="btn btn-primary">
                                                                        <i class="ti ti-search"></i>&nbsp;View
                                                                    </a>
                                                                </td>
                                                            </tr>
                                                            <?php endforeach; ?>
                                                            <?php endif;?>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="card mb-3">
                            <div class="card-body">
                                <div class="card-title">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                        fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                        stroke-linejoin="round"
                                        class="icon icon-tabler icons-tabler-outline icon-tabler-report-analytics">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                        <path
                                            d="M9 5h-2a2 2 0 0 0 -2 2v12a2 2 0 0 0 2 2h10a2 2 0 0 0 2 -2v-12a2 2 0 0 0 -2 -2h-2" />
                                        <path
                                            d="M9 3m0 2a2 2 0 0 1 2 -2h2a2 2 0 0 1 2 2v0a2 2 0 0 1 -2 2h-2a2 2 0 0 1 -2 -2z" />
                                        <path d="M9 17v-5" />
                                        <path d="M12 17v-1" />
                                        <path d="M15 17v-3" />
                                    </svg>
                                    Stats
                                </div>
                                <div class="table-responsive">
                                    <table class="table table-bordered table-striped">
                                        <thead>
                                            <th>Wins</th>
                                            <th>Loss</th>
                                            <th>Draws</th>
                                        </thead>
                                        <tbody>
                                            <?php if(empty($stats)):?>
                                            <tr>
                                                <td class="text-center" colspan="3">No Stat(s) found</td>
                                            </tr>
                                            <?php else: ?>
                                            <tr>
                                                <td class="text-center"><?=$stats->wins?></td>
                                                <td class="text-center"><?=$stats->loss?></td>
                                                <td class="text-center"><?=$stats->draw?></td>
                                            </tr>
                                            <?php endif;?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-header">
                                <div class="card-title">
                                    <i class="ti ti-calendar"></i>&nbsp;Upcoming Matches
                                </div>
                            </div>
                            <div class="list-group list-group-flush">
                                <?php if(empty($matches)): ?>
                                <div class="list-group-item">
                                    <div class="text-center text-muted py-3">
                                        No upcoming matches scheduled.
                                    </div>
                                </div>
                                <?php else: ?>
                                <?php foreach($matches as $match):?>
                                <div class="list-group-item">
                                    <div class="row align-items-center">
                                        <div class="col text-truncate">
                                            <a href="<?=site_url('match-details/')?><?=$match->match_id?>"
                                                class="text-reset d-block"><?=$match->team_name?>
                                            </a>
                                            <div class="d-block text-secondary text-truncate mt-n1">
                                                <?=date('M d, Y', strtotime($match->date)) ?? 'TBD' ?>
                                                &nbsp;|&nbsp; <?=$match->time ?? 'TBD' ?><br />
                                                <?=$match->location?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <?php endforeach; ?>
                                <?php endif;?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?= view('main/templates/footer')?>
<?= view('main/templates/closing')?>