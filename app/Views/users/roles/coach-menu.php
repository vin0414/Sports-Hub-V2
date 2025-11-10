<div class="card mb-3">
    <div class="card-header">
        <div class="card-title">
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
            My Team(s)
        </div>
    </div>
    <div class="list-group list-group-flush">
        <?php if(empty($team)):?>
        <div class="list-group-item">
            <div class="row align-items-center">
                <a href="<?=site_url('create-a-team')?>" class="btn btn-primary btn-5 d-none d-sm-inline-block">
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
                    Create a Team
                </a>
            </div>
        </div>
        <?php else: ?>
        <?php foreach($team as $row): ?>
        <div class="list-group-item">
            <div class="row align-items-center">
                <div class="col-auto">
                    <a href="<?=site_url('my-team/')?><?=$row['team_name']?>">
                        <span class="avatar avatar-1"
                            style="background-image: url(<?=base_url('assets/images/team/')?><?=$row['image']?>)">
                        </span>
                    </a>
                </div>
                <div class="col text-truncate">
                    <a href="<?=site_url('my-team/')?><?=$row['team_name']?>"
                        class="text-reset d-block"><?=$row['team_name']?></a>
                    <div class="d-block text-secondary text-truncate mt-n1">
                        <?=$row['school_barangay']?><br />
                        <?php
                        $status = $row['status'];
                        if ($status == 1) {
                            echo '<small class="badge bg-success text-white">ACTIVE</small>';
                        } elseif ($status == 2) {
                            echo '<small class="badge bg-danger text-white">DECLINED</small>';
                        } else {
                            echo '<small class="badge bg-warning text-white">PENDING</small>';
                        }
                        ?>
                    </div>
                </div>
            </div>
        </div>
        <?php endforeach;?>
        <?php endif;?>
    </div>
</div>