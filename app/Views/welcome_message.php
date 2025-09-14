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
                            class="icon icon-tabler icons-tabler-outline icon-tabler-home">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                            <path d="M5 12l-2 0l9 -9l9 9l-2 0" />
                            <path d="M5 12v7a2 2 0 0 0 2 2h10a2 2 0 0 0 2 -2v-7" />
                            <path d="M9 21v-6a2 2 0 0 1 2 -2h2a2 2 0 0 1 2 2v6" />
                        </svg>
                        <?=$title?>
                    </h2>
                </div>
                <div class="col-auto ms-auto d-print-none">
                    <div class="btn-list">
                        <a href="" class="btn btn-primary btn-5 d-none d-sm-inline-block">
                            <i class="ti ti-arrow-left"></i>&nbsp;Apply
                        </a>
                        <a href="" class="btn btn-primary btn-6 d-sm-none btn-icon">
                            <i class="ti ti-arrow-left"></i>
                        </a>
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
                    <div class="space-y">

                    </div>
                </div>
                <div class="col-lg-3">
                    <div class="card">
                        <div class="card-header">
                            Upcoming Events
                        </div>
                        <div class="list-group list-group-flush">
                            <?php foreach($recent as $row):?>
                            <div class="list-group-item">
                                <div class="row align-items-center">
                                    <div class="col-auto">
                                        <a href="<?=site_url('latest-events/details/')?><?=$row['event_title']?>">
                                            <span class="avatar avatar-1"
                                                style="background-image: url(<?=base_url('assets/images/logo.jpg')?>)">
                                            </span>
                                        </a>
                                    </div>
                                    <div class="col text-truncate">
                                        <a href="<?=site_url('latest-events/details/')?><?=$row['event_title']?>"
                                            class="text-reset d-block"><?=$row['event_title']?></a>
                                        <div class="d-block text-secondary text-truncate mt-n1">
                                            <?=$row['event_type']?>
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