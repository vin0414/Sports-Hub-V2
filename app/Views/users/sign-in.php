<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <link rel="apple-touch-icon" href="<?=base_url('assets/images/logo.jpg')?>">
    <link rel="shortcut icon" type="image/x-icon" href="<?=base_url('assets/images/logo.jpg')?>">
    <title>Digital Sports Hub - Login</title>
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
            <div class="text-center mb-4">
                <!-- BEGIN NAVBAR LOGO -->
                <a href="." class="navbar-brand navbar-brand-autodark">
                    <img src="<?=base_url('assets/images/logo.jpg')?>" width="50" style="border-radius: 50px;" />
                </a>
                <!-- END NAVBAR LOGO -->
            </div>
            <div class="card card-md">
                <div class="card-body">
                    <h2 class="h2 text-center mb-4">Login to your account</h2>
                    <?php if(!empty(session()->getFlashdata('fail'))) : ?>
                    <div class="alert alert-important alert-danger alert-dismissible" role="alert">
                        <?= session()->getFlashdata('fail'); ?>
                    </div>
                    <?php endif; ?>
                    <form action="<?=base_url('checkUser')?>" method="POST" autocomplete="off" novalidate>
                        <?=csrf_field();?>
                        <div class="mb-3">
                            <label class="form-label">Email address</label>
                            <input type="email" class="form-control" name="email" placeholder="your@email.com"
                                value="<?=set_value('email')?>" autocomplete="off" />
                            <div class="text-danger">
                                <small><?= $validation->getError('email'); ?></small>
                            </div>
                        </div>
                        <div class="mb-2">
                            <label class="form-label">
                                Password
                            </label>
                            <div class="input-group input-group-flat">
                                <input type="password" class="form-control" id="password" name="password" minlength="8"
                                    maxlength="16" placeholder="Your password" autocomplete="off" />
                                <span class="input-group-text">
                                    <a href="javascript:void(0);" onclick="toggle()" class="link-secondary"
                                        title="Show password" data-bs-toggle="tooltip">
                                        <i id="icon" class="ti ti-eye-closed"></i>
                                    </a>
                                </span>
                            </div>
                            <div class="text-danger">
                                <small><?= $validation->getError('password'); ?></small>
                            </div>
                        </div>
                        <div class="mb-2">
                            <label class="form-check">
                                <input type="checkbox" class="form-check-input" />
                                <span class="form-check-label">Remember me on this device</span>
                            </label>
                        </div>
                        <div class="form-footer">
                            <button type="submit" class="btn btn-primary w-100">Sign in</button>
                        </div>
                    </form>
                    <div class="text-center text-secondary mt-3">
                        Don't have an account? Sign-up <a href="<?=site_url('sign-up')?>" tabindex="-1">here</a>
                    </div>
                </div>
            </div>
            <div class="text-center text-secondary mt-3">Forgot password? <a href="<?=base_url('reset-password')?>"
                    tabindex="-1">Click here</a></div>
        </div>
    </div>
    <!-- BEGIN GLOBAL MANDATORY SCRIPTS -->
    <script src="<?=base_url('assets/js/tabler.min.js')?>" defer></script>
    <!-- END GLOBAL MANDATORY SCRIPTS -->
    <!-- BEGIN DEMO SCRIPTS -->
    <script src="<?=base_url('assets/js/demo.min.js')?>" defer></script>
    <!-- END DEMO SCRIPTS -->
    <script>
    function toggle() {
        var x = document.getElementById("password");
        if (x.type === "password") {
            x.type = "text";
            let elem = document.getElementById('icon');
            elem.classList.remove("ti-eye-closed");
            elem.classList.add("ti-eye");
        } else {
            x.type = "password";
            let elem = document.getElementById('icon');
            elem.classList.remove("ti-eye");
            elem.classList.add("ti-eye-closed");
        }
    }
    </script>
</body>

</html>