<?=view('main/templates/header')?>
<?=view('main/templates/main-template')?>
<div class="page-wrapper">
    <div class="page-header d-print-none">
        <div class="container-xl">
            <div class="row g-2 align-items-center">
                <div class="col">
                    <h2 class="page-title">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                            fill="currentColor" class="icon icon-tabler icons-tabler-filled icon-tabler-calendar-event">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                            <path
                                d="M16 2a1 1 0 0 1 .993 .883l.007 .117v1h1a3 3 0 0 1 2.995 2.824l.005 .176v12a3 3 0 0 1 -2.824 2.995l-.176 .005h-12a3 3 0 0 1 -2.995 -2.824l-.005 -.176v-12a3 3 0 0 1 2.824 -2.995l.176 -.005h1v-1a1 1 0 0 1 1.993 -.117l.007 .117v1h6v-1a1 1 0 0 1 1 -1m3 7h-14v9.625c0 .705 .386 1.286 .883 1.366l.117 .009h12c.513 0 .936 -.53 .993 -1.215l.007 -.16z" />
                            <path d="M8 14h2v2h-2z" />
                        </svg>
                        <?=$title?>
                    </h2>
                </div>
            </div>
        </div>
    </div>
    <div class="page-body">
        <div class="container-xl">
            <div class="row row-deck mb-3">
                <?php foreach($events as $row): ?>
                <?php  
                $accountModel = new \App\Models\AccountModel();
                $account = $accountModel->find($row['accountID']);
                ?>
                <div class="col-lg-4">
                    <div class="card">
                        <div class="img-responsive img-responsive-21x9 card-img-top"
                            style="background-image: url(<?=base_url('assets/images/logo.jpg')?>)">
                        </div>
                        <div class="card-body">
                            <h3 class="card-title">
                                <a href="<?=site_url('latest-events/details/')?><?=$row['event_title']?>">
                                    <?=$row['event_title']?>
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
    </div>
</div>
<?= view('main/templates/footer')?>
<?= view('main/templates/closing')?>