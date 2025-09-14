<?=view('main/templates/header')?>
<?=view('main/templates/main-template')?>
<?php  
$accountModel = new \App\Models\AccountModel();
$account = $accountModel->find($event['accountID']);
?>
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
                        <?=$event['event_title']?>
                    </h2>
                    <p class="text-secondary">
                        Published by : <?=$account['Fullname']?>&nbsp;|&nbsp;Category : <?=$event['event_type']?>
                    </p>
                </div>
                <div class="col-auto ms-auto d-print-none">
                    <div class="btn-list">
                        <a href="<?=site_url('latest-events')?>" class="btn btn-primary btn-5 d-none d-sm-inline-block">
                            <i class="ti ti-arrow-left"></i>&nbsp;Back
                        </a>
                        <a href="<?=site_url('latest-events')?>" class="btn btn-primary btn-6 d-sm-none btn-icon">
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
                    <div class="card">
                        <div class="card-body">
                            <div class="card-title">Event Description</div>
                            <div><?=$event['event_description']?></div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3">
                    <div class="card">
                        <div class="card-body">
                            <div class="card-title">Event Details</div>
                            <div class="row g-3">
                                <div class="col-lg-12">
                                    <label class="form-label">Location : </label>
                                    <p><?=$event['event_location']?></p>
                                </div>
                                <div class="col-lg-12">
                                    <p><label>Start Date : </label>&nbsp;<?=$event['start_date']?></p>
                                </div>
                                <div class="col-lg-12">
                                    <p><label>End Date : </label>&nbsp;<?=$event['end_date']?></p>
                                </div>
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