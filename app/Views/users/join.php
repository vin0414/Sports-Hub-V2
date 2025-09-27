<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <link rel="apple-touch-icon" href="<?=base_url('assets/images/logo.jpg')?>">
    <link rel="shortcut icon" type="image/x-icon" href="<?=base_url('assets/images/logo.jpg')?>">
    <title>Digital Sports Hub - <?=$title?></title>
    <!-- BEGIN GLOBAL MANDATORY STYLES -->
    <link href="<?=base_url('assets/css/tabler.min.css')?>" rel="stylesheet" />
    <!-- END GLOBAL MANDATORY STYLES -->
    <!-- BEGIN DEMO STYLES -->
    <link href="<?=base_url('assets/css/demo.min.css')?>" rel="stylesheet" />
    <!-- END DEMO STYLES -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@tabler/icons-webfont@latest/dist/tabler-icons.min.css" />
    <!-- BEGIN CUSTOM FONT -->
    <style>
    @import url("https://rsms.me/inter/inter.css");
    </style>
    <!-- END CUSTOM FONT -->
</head>

<body>
    <!-- BEGIN DEMO THEME SCRIPT -->
    <script src="<?=base_url('assets/js/demo-theme.min.js')?>"></script>
    <!-- END DEMO THEME SCRIPT -->
    <div class="page page-center">
        <div class="container container-tight py-4">
            <div class="card card-md">
                <div class="card-body">
                    <div class="text-center mb-4">
                        <!-- BEGIN NAVBAR LOGO -->
                        <a href="." class="navbar-brand navbar-brand-autodark">
                            <img src="<?=base_url('assets/images/logo.jpg')?>" width="50"
                                style="border-radius: 50px;" />
                        </a>
                        <!-- END NAVBAR LOGO -->
                    </div>
                    <h4 class="text-center">Become a Player or Coach</h4>
                    <div class="text-center mb-2" style="margin-top:-20px;"><small>Sign up to Join</small></div>
                    <?php if(!empty(session()->getFlashdata('success'))) : ?>
                    <div class="alert alert-important alert-success alert-dismissible" role="alert">
                        <?= session()->getFlashdata('success'); ?>
                    </div>
                    <?php endif; ?>
                    <?php if(!empty(session()->getFlashdata('fail'))) : ?>
                    <div class="alert alert-important alert-danger alert-dismissible" role="alert">
                        <?= session()->getFlashdata('fail'); ?>
                    </div>
                    <?php endif; ?>
                    <form action="<?=base_url('submit')?>" method="POST" autocomplete="off" novalidate>
                        <?=csrf_field();?>
                        <input type="hidden" name="user" value="<?=session()->get('User')?>" />
                        <div class="mb-3">
                            <label class="form-label">Complete Name</label>
                            <p class="form-control"><?=session()->get('fullname')?></p>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Email address</label>
                            <p class="form-control"><?=session()->get('email')?></p>
                        </div>
                        <div class="text-danger">
                            <small><?= $validation->getError('user'); ?></small>
                        </div>
                        <div class="mb-3">
                            <div class="row">
                                <div class="col-lg-6">
                                    <label class="form-label">Contact Number</label>
                                    <input type="phone" class="form-control" minlength="11" maxlength="11"
                                        name="phone" />
                                    <div class="text-danger">
                                        <small><?= $validation->getError('phone'); ?></small>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <label class="form-label">Birth Date</label>
                                    <input type="date" class="form-control" name="birth_date" />
                                    <div class="text-danger">
                                        <small><?= $validation->getError('birth_date'); ?></small>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Complete Address</label>
                            <textarea name="address" class="form-control" style="height: 100px;"></textarea>
                            <div class="text-danger">
                                <small><?= $validation->getError('address'); ?></small>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Role</label>
                            <div class="form-selectgroup-boxes row mb-3">
                                <div class="col-lg-6">
                                    <label class="form-selectgroup-item">
                                        <input type="radio" name="application" value="Coach"
                                            class="form-selectgroup-input" required />
                                        <span class="form-selectgroup-label d-flex align-items-center p-3">
                                            <span class="me-3">
                                                <span class="form-selectgroup-check"></span>
                                            </span>
                                            <span class="form-selectgroup-label-content">
                                                <span class="form-selectgroup-title strong mb-1">Coach</span>
                                            </span>
                                        </span>
                                    </label>
                                </div>
                                <div class="col-lg-6">
                                    <label class="form-selectgroup-item">
                                        <input type="radio" name="application" value="Player"
                                            class="form-selectgroup-input" required />
                                        <span class="form-selectgroup-label d-flex align-items-center p-3">
                                            <span class="me-3">
                                                <span class="form-selectgroup-check"></span>
                                            </span>
                                            <span class="form-selectgroup-label-content">
                                                <span class="form-selectgroup-title strong mb-1">Player</span>
                                            </span>
                                        </span>
                                    </label>
                                </div>
                            </div>
                            <div class="text-danger">
                                <small><?= $validation->getError('application'); ?></small>
                            </div>
                        </div>
                        <div class="form-footer">
                            <button type="submit" class="btn btn-primary w-100">Submit Application</button>
                        </div>
                    </form>
                </div>
            </div>
            <div class="text-center text-secondary mt-3">
                <a href="<?=base_url('/')?>" tabindex="-1">Back to Home</a>
            </div>
        </div>
    </div>
    <!-- BEGIN GLOBAL MANDATORY SCRIPTS -->
    <script src="<?=base_url('assets/js/tabler.min.js')?>" defer></script>
    <!-- END GLOBAL MANDATORY SCRIPTS -->
    <!-- BEGIN DEMO SCRIPTS -->
    <script src="<?=base_url('assets/js/demo.min.js')?>" defer></script>
    <!-- END DEMO SCRIPTS -->
</body>

</html>