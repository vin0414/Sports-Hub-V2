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
                            class="icon icon-tabler icons-tabler-outline icon-tabler-template">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                            <path d="M4 4m0 1a1 1 0 0 1 1 -1h14a1 1 0 0 1 1 1v2a1 1 0 0 1 -1 1h-14a1 1 0 0 1 -1 -1z" />
                            <path d="M4 12m0 1a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v6a1 1 0 0 1 -1 1h-4a1 1 0 0 1 -1 -1z" />
                            <path d="M14 12l6 0" />
                            <path d="M14 16l6 0" />
                            <path d="M14 20l6 0" />
                        </svg>
                        Recent Feeds
                    </h2>
                </div>
                <div class="col-auto ms-auto d-print-none">
                    <div class="btn-list">
                        <?php if(empty($register)) :?>
                        <a href="<?=site_url('join')?>" class="btn btn-primary btn-5 d-none d-sm-inline-block">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round"
                                class="icon icon-tabler icons-tabler-outline icon-tabler-world-plus">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                <path d="M20.985 12.518a9 9 0 1 0 -8.45 8.466" />
                                <path d="M3.6 9h16.8" />
                                <path d="M3.6 15h11.4" />
                                <path d="M11.5 3a17 17 0 0 0 0 18" />
                                <path d="M12.5 3a16.998 16.998 0 0 1 2.283 12.157" />
                                <path d="M16 19h6" />
                                <path d="M19 16v6" />
                            </svg>
                            Become a Player or Coach
                        </a>
                        <?php elseif(isset($register)): ?>
                        <?php if($register['application_type']==="Player"): ?>
                        <a class="btn btn-danger" href="<?=site_url('live')?>">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-video">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                <path
                                    d="M15 10l4.553 -2.276a1 1 0 0 1 1.447 .894v6.764a1 1 0 0 1 -1.447 .894l-4.553 -2.276v-4z" />
                                <path
                                    d="M3 6m0 2a2 2 0 0 1 2 -2h8a2 2 0 0 1 2 2v8a2 2 0 0 1 -2 2h-8a2 2 0 0 1 -2 -2z" />
                            </svg>
                            Live
                        </a>
                        <a href="<?=site_url('search')?>" class="btn btn-primary btn-5 d-none d-sm-inline-block">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round"
                                class="icon icon-tabler icons-tabler-outline icon-tabler-search">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                <path d="M10 10m-7 0a7 7 0 1 0 14 0a7 7 0 1 0 -14 0" />
                                <path d="M21 21l-6 -6" />
                            </svg>
                            Join a Team
                        </a>
                        <?php elseif($register['application_type']==="Coach") :?>
                        <a href="<?=site_url('create-a-team')?>" class="btn btn-primary btn-5 d-none d-sm-inline-block">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round"
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
                        <?php endif;?>
                        <?php endif?>
                    </div>
                    <!-- BEGIN MODAL -->
                    <!-- END MODAL -->
                </div>
            </div>
        </div>
    </div>
    <div class="page-body">
        <div class="container-xl">
            <div class="row g-3">
                <div class="col-lg-9">
                    <div class="row row-cards mb-4">
                        <div class="space-y">
                            <?php foreach ($feed as $item): ?>
                            <div class="card mb-3">
                                <?php 
                                $extension = pathinfo($item['media'], PATHINFO_EXTENSION); 
                                if (in_array(strtolower($extension), ['jpg', 'jpeg', 'png', 'gif', 'webp'])){?>
                                <div class="img-responsive img-responsive-21x9 card-img-top"
                                    style="background-image: url(<?=$item['media']?>)">
                                </div>
                                <?php }else{ ?>
                                <video id="video-preview" class="card-img-top" width="100%" height="250px" controls>
                                    <source src="<?=$item['media']?>" type="video/mp4">
                                    <source src="<?=$item['media']?>" type="video/webm">
                                    Your browser does not support the video tag.
                                </video>
                                <?php } ?>
                                <div class="card-body">
                                    <div class="card-title"><?= ucfirst($item['title']) ?></div>
                                    <div><?= $item['content'] ?>...</div>
                                    <a href="<?=$item['link']?>">Read more</a> |
                                    <small class="text-muted"><?= date('M d, Y H:i', $item['timestamp']) ?></small>
                                </div>
                            </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3">
                    <?php if(!empty(session()->get('User'))): ?>
                    <?php if(!empty($register)): ?>
                    <?php if($register['application_type']==="Player"): ?>
                    <?= view('users/roles/player-menu', ['player' => $player]) ?>
                    <?php else: ?>
                    <?= view('users/roles/coach-menu', ['team' => $team]) ?>
                    <?php endif;?>
                    <?php endif;?>
                    <?php endif;?>
                    <div class="card mb-3">
                        <div class="card-header">
                            <div class="card-title">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                    fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                    stroke-linejoin="round"
                                    class="icon icon-tabler icons-tabler-outline icon-tabler-speakerphone">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                    <path d="M18 8a3 3 0 0 1 0 6" />
                                    <path d="M10 8v11a1 1 0 0 1 -1 1h-1a1 1 0 0 1 -1 -1v-5" />
                                    <path
                                        d="M12 8h0l4.524 -3.77a.9 .9 0 0 1 1.476 .692v12.156a.9 .9 0 0 1 -1.476 .692l-4.524 -3.77h-8a1 1 0 0 1 -1 -1v-4a1 1 0 0 1 1 -1h8" />
                                </svg>
                                Headlines
                            </div>
                        </div>
                        <div class="list-group list-group-flush">
                            <?php foreach($recent as $row):?>
                            <div class="list-group-item">
                                <div class="row align-items-center">
                                    <div class="col-auto">
                                        <a href="<?=site_url('latest-news/stories/')?><?=$row['topic']?>">
                                            <span class="avatar avatar-1"
                                                style="background-image: url(<?=base_url('assets/images/news/')?><?=$row['image']?>)">
                                            </span>
                                        </a>
                                    </div>
                                    <div class="col text-truncate">
                                        <a href="<?=site_url('latest-news/stories/')?><?=$row['topic']?>"
                                            class="text-reset d-block"><?=$row['topic']?></a>
                                        <div class="d-block text-secondary text-truncate mt-n1">
                                            <?=$row['news_type']?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-header">
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
                                Upcoming Matches
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
                            <?php foreach($matches as $match): ?>
                            <div class="list-group list-group-flush">
                                <div class="list-group-item">
                                    <div class="row align-items-center">
                                        <div class="col text-truncate">
                                            <a href="<?=site_url('match-details/')?><?=$match->match_id?>"
                                                class="text-reset d-block"><?=$match->team_name?>
                                            </a>
                                            <div class="d-block text-secondary text-truncate mt-n1">
                                                <?=date('M d, Y', strtotime($match->date))?>
                                                &nbsp;|&nbsp; <?=$match->time?><br />
                                                <?=$match->location?>
                                            </div>
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
<?= view('main/templates/footer')?>
<?= view('main/templates/closing')?>