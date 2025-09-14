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
                            class="icon icon-tabler icons-tabler-outline icon-tabler-brand-parsinta">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                            <path d="M12 3a9 9 0 1 0 9 9" />
                            <path d="M21 12a9 9 0 0 0 -9 -9" opacity=".5" />
                            <path d="M10 9v6l5 -3z" />
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
                <?php foreach($videos as $row): ?>
                <?php  
                $accountModel = new \App\Models\AccountModel();
                $account = $accountModel->find($row['accountID']);
                ?>
                <div class="col-lg-3">
                    <div class="card">
                        <!-- Photo -->
                        <video id="video-preview" class="card-img-top" width="100%" height="250px" controls>
                            <source src="<?=base_url('assets/videos/')?><?=$row['file']?>" type="video/mp4">
                            <source src="<?=base_url('assets/videos/')?><?=$row['file']?>" type="video/webm">
                            Your browser does not support the video tag.
                        </video>
                        <div class="card-body">
                            <h3 class="card-title">
                                <a href="<?=site_url('latest-videos/watch/')?><?=$row['Token']?>">
                                    <?=$row['file_name']?>
                                </a>
                            </h3>
                            <p class="text-secondary">
                                <span class="badge bg-primary text-white"><?=$row['sportName']?></span><br />
                                Uploaded by : <?=$account['Fullname']?><br />
                                Date Upload : <?=$row['date']?>
                            </p>
                        </div>
                    </div>
                </div>
                <?php endforeach;?>
            </div>
            <?= $pager->makeLinks($page, $perPage, $total, 'custom_view') ?>
        </div>
    </div>
</div>
<?= view('main/templates/footer')?>
<?= view('main/templates/closing')?>