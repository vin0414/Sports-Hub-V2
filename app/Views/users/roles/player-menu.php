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
        <?php if(empty($player)):?>
        <div class="list-group-item">
            <div class="row align-items-center">
                <a href="<?=site_url('search')?>" class="btn btn-primary btn-5 d-none d-sm-inline-block">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                        stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                        class="icon icon-tabler icons-tabler-outline icon-tabler-search">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                        <path d="M10 10m-7 0a7 7 0 1 0 14 0a7 7 0 1 0 -14 0" />
                        <path d="M21 21l-6 -6" />
                    </svg>
                    Join a Team
                </a>
            </div>
        </div>
        <?php else: ?>
        <?php foreach($player as $row): ?>
        <div class="list-group-item">
            <div class="row align-items-center">
                <div class="col-auto">
                    <a href="<?=site_url('me/')?><?=$row->team_name?>">
                        <span class="avatar avatar-1"
                            style="background-image: url(<?=base_url('assets/images/team/')?><?=$row->image?>)">
                        </span>
                    </a>
                </div>
                <div class="col text-truncate">
                    <a href="<?=site_url('me/')?><?=$row->team_name?>"
                        class="text-reset d-block"><?=$row->team_name?></a>
                    <div class="d-block text-secondary text-truncate mt-n1">
                        <?=$row->school_barangay?>
                    </div>
                </div>
            </div>
        </div>
        <?php endforeach;?>
        <?php endif;?>
    </div>
</div>
<div class="card mb-3">
    <div class="card-header">
        <div class="card-title">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="currentColor"
                class="icon icon-tabler icons-tabler-filled icon-tabler-calendar-event">
                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                <path
                    d="M16 2a1 1 0 0 1 .993 .883l.007 .117v1h1a3 3 0 0 1 2.995 2.824l.005 .176v12a3 3 0 0 1 -2.824 2.995l-.176 .005h-12a3 3 0 0 1 -2.995 -2.824l-.005 -.176v-12a3 3 0 0 1 2.824 -2.995l.176 -.005h1v-1a1 1 0 0 1 1.993 -.117l.007 .117v1h6v-1a1 1 0 0 1 1 -1m3 7h-14v9.625c0 .705 .386 1.286 .883 1.366l.117 .009h12c.513 0 .936 -.53 .993 -1.215l.007 -.16z" />
                <path d="M8 14h2v2h-2z" />
            </svg>
            My Training(s)
        </div>
    </div>
    <div class="list-group list-group-flush">
        <?php if(empty($schedules)):?>
        <div class="list-group-item">
            <div class="row align-items-center">
                <a href="<?=site_url('search')?>" class="btn btn-primary btn-5 d-none d-sm-inline-block">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                        stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                        class="icon icon-tabler icons-tabler-outline icon-tabler-search">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                        <path d="M10 10m-7 0a7 7 0 1 0 14 0a7 7 0 1 0 -14 0" />
                        <path d="M21 21l-6 -6" />
                    </svg>
                    No Tryout Games
                </a>
            </div>
        </div>
        <?php else : ?>
        <?php foreach($schedules as $row): ?>
        <div class="list-group-item">
            <div class="row align-items-center">
                <div class="col-auto">
                    <a href="<?=site_url('training/')?><?=$row->schedule_id?>">
                        <span class="avatar avatar-1"
                            style="background-image: url(<?=base_url('assets/images/tryout.png')?>)">
                        </span>
                    </a>
                </div>
                <div class="col text-truncate">
                    <a href="<?=site_url('training/')?><?=$row->schedule_id?>"
                        class="text-reset d-block"><?=$row->location?></a>
                    <div class="d-block text-secondary text-truncate mt-n1">
                        <?=$row->date?> | <?=$row->time?>
                    </div>
                </div>
            </div>
        </div>
        <?php endforeach;?>
        <?php endif;?>
    </div>
</div>