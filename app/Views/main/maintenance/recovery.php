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
                </div>
            </div>
        </div>
        <!-- END PAGE HEADER -->
        <div class="page-body">
            <div class="container-xl">
                <div class="card">
                    <div class="card-header">
                        <ul class="nav nav-tabs card-header-tabs" data-bs-toggle="tabs">
                            <li class="nav-item">
                                <a href="#tabs-home-8" class="nav-link active" data-bs-toggle="tab">
                                    <i class="ti ti-database"></i>&nbsp;Back-Up and Restore
                                </a>
                            </li>
                        </ul>
                    </div>
                    <div class="card-body">
                        <div class="tab-content">
                            <div class="tab-pane fade active show" id="tabs-home-8">
                                <?php if(!empty(session()->getFlashdata('fail'))) : ?>
                                <div class="alert alert-danger" role="alert">
                                    <?= session()->getFlashdata('fail'); ?>
                                </div>
                                <?php endif; ?>
                                <?php if(!empty(session()->getFlashdata('success'))) : ?>
                                <div class="alert alert-success" role="alert">
                                    <?= session()->getFlashdata('success'); ?>
                                </div>
                                <?php endif; ?>
                                <form method="POST" class="row g-3" enctype="multipart/form-data"
                                    action="<?=base_url('restore')?>">
                                    <div class="col-lg-12">
                                        <span class="form-label">SQL File</span>
                                        <input type="file" class="form-control bg-transparent" name="file" required />
                                    </div>
                                    <div class="col-lg-12">
                                        <button type="submit" class="btn btn-primary">
                                            <i class="ti ti-upload"></i>&nbsp;Upload
                                        </button>
                                        <a href="<?=site_url('download')?>" class="btn btn-secondary">
                                            <i class="ti ti-download"></i>&nbsp;Download
                                        </a>
                                    </div>
                                </form>
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