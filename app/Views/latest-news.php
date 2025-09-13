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
                            class="icon icon-tabler icons-tabler-outline icon-tabler-news">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                            <path
                                d="M16 6h3a1 1 0 0 1 1 1v11a2 2 0 0 1 -4 0v-13a1 1 0 0 0 -1 -1h-10a1 1 0 0 0 -1 1v12a3 3 0 0 0 3 3h11" />
                            <path d="M8 8l4 0" />
                            <path d="M8 12l4 0" />
                            <path d="M8 16l4 0" />
                        </svg>
                        <?=$title?>
                    </h2>
                </div>
            </div>
        </div>
    </div>
    <div class="page-body">
        <div class="container-xl">
            <div class="row g-3">
                <div class="col-xl-9 col-md-8">
                    <div class="row row-deck g-3 mb-3">
                        <?php foreach($news as $row): ?>
                        <?php  
                        $accountModel = new \App\Models\AccountModel();
                        $account = $accountModel->find($row['accountID']);
                        ?>
                        <div class="col-lg-6">
                            <div class="card">
                                <!-- Photo -->
                                <div class="img-responsive img-responsive-21x9 card-img-top"
                                    style="background-image: url(<?=base_url('assets/images/news/')?><?=$row['image']?>)">
                                </div>
                                <div class="card-body">
                                    <h3 class="card-title">
                                        <a href="<?=site_url('latest-news/stories/')?><?=$row['topic']?>">
                                            <?=$row['topic']?>
                                        </a>
                                    </h3>
                                    <p class="text-secondary">
                                        Published by : <?=$account['Fullname']?> | Date :<?=$row['date']?>
                                    </p>
                                </div>
                            </div>
                        </div>
                        <?php endforeach; ?>
                    </div>
                    <?= $pager->makeLinks($page, $perPage, $total, 'custom_view') ?>
                </div>
                <div class="col-xl-3 col-md-4">
                    <div class="card">
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
                            <?php foreach($headlines as $row):?>
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
                </div>
            </div>
        </div>
    </div>
</div>
<?= view('main/templates/footer')?>
<?= view('main/templates/closing')?>