<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <link rel="apple-touch-icon" href="<?=base_url('assets/images/logo.jpg')?>">
    <link rel="shortcut icon" type="image/x-icon" href="<?=base_url('assets/images/logo.jpg')?>">
    <title>Digital Sports Hub - Forgot Password</title>
    <!-- BEGIN GLOBAL MANDATORY STYLES -->
    <link href="<?=base_url('assets/css/tabler.min.css')?>" rel="stylesheet" />
    <!-- END GLOBAL MANDATORY STYLES -->
    <!-- BEGIN DEMO STYLES -->
    <link href="<?=base_url('assets/css/demo.min.css')?>" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@tabler/icons-webfont@latest/dist/tabler-icons.min.css" />
    <!-- END DEMO STYLES -->
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
            <form class="card card-md" method="get" autocomplete="off" novalidate>
                <div class="card-body">
                    <h2 class="card-title card-title-lg text-center mb-4">Account Verification</h2>
                    <div class="alert alert-important alert-success alert-dismissible" role="alert">
                        <div class="alert-icon">
                            <!-- Download SVG icon from http://tabler.io/icons/icon/check -->
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round" class="icon alert-icon icon-2">
                                <path d="M5 12l5 5l10 -10" />
                            </svg>
                        </div>
                        <div>Your account has been created!</div>
                    </div>
                    <p class="my-4 text-center">
                        To get all the good stuff, please activate your account.
                        You can do this using the activation link we have emailed to your inbox. If you have
                        not received it please check your spam folder or use the button below to resend
                        the activation link.
                    </p>
                </div>
            </form>
            <div class="text-center text-secondary mt-3">It may take a minute to receive your code. Haven't received it?
                <a href="<?=site_url('resend/')?><?=$token?>">Resend a new code.</a>
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