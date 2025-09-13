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
                        <?=$story['topic']?>
                    </h2>
                </div>
                <div class="col-auto ms-auto d-print-none">
                    <div class="btn-list">
                        <a href="<?=site_url('latest-news')?>" class="btn btn-primary btn-5 d-none d-sm-inline-block">
                            <i class="ti ti-arrow-left"></i>&nbsp;Back
                        </a>
                        <a href="<?=site_url('latest-news')?>" class="btn btn-primary btn-6 d-sm-none btn-icon">
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
            <div class="row g-1">
                <?php  
                $accountModel = new \App\Models\AccountModel();
                $account = $accountModel->find($story['accountID']);
                ?>
                <div class="col-lg-12">
                    <div class="card">
                        <!-- Photo -->
                        <div class="img-responsive img-responsive-21x9 card-img-top"
                            style="background-image: url(<?=base_url('assets/images/news/')?><?=$story['image']?>)">
                        </div>
                        <div class="card-body">
                            <p class="text-secondary">
                                Published by : <?=$account['Fullname']?>&nbsp;|&nbsp;Category : <?=$story['news_type']?>
                            </p>
                            <div><?=$story['details']?></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?= view('main/templates/footer')?>
<?= view('main/templates/closing')?>