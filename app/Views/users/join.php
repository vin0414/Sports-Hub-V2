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
            <div class="card">
                <div class="card-body">
                    <div class="text-center mb-4">
                        <!-- BEGIN NAVBAR LOGO -->
                        <a href="." class="navbar-brand navbar-brand-autodark">
                            <img src="<?=base_url('assets/images/logo.jpg')?>" width="50"
                                style="border-radius: 50px;" />
                        </a>
                        <!-- END NAVBAR LOGO -->
                    </div>
                    <div class="text-center mb-2" style="margin-top:-20px;"><small>Sign up to Join</small></div>
                    <form method="POST" autocomplete="off" enctype="multipart/form-data" id="frmCreate">
                        <?=csrf_field();?>
                        <input type="hidden" name="user" value="<?=session()->get('User')?>" />
                        <div class="mb-3">
                            <label class="form-label">Account Type</label>
                            <div class="form-selectgroup-boxes row mb-3">
                                <div class="col-lg-6">
                                    <label class="form-selectgroup-item">
                                        <input type="radio" name="application" value="Organization"
                                            class="form-selectgroup-input" />
                                        <span class="form-selectgroup-label d-flex align-items-center p-3">
                                            <span class="me-3">
                                                <span class="form-selectgroup-check"></span>
                                            </span>
                                            <span class="form-selectgroup-label-content">
                                                <span class="form-selectgroup-title strong mb-1">Organization</span>
                                            </span>
                                        </span>
                                    </label>
                                </div>
                                <div class="col-lg-6">
                                    <label class="form-selectgroup-item">
                                        <input type="radio" name="application" value="Player"
                                            class="form-selectgroup-input" />
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
                            <div id="application-error" class="error-message text-danger text-sm"></div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Complete Name</label>
                            <p class="form-control"><?=session()->get('user_fullname')?></p>
                        </div>
                        <div id="user-error" class="error-message text-danger text-sm"></div>
                        <div class="mb-3">
                            <div class="row">
                                <div class="col-lg-6">
                                    <label class="form-label">Contact Number</label>
                                    <input type="phone" class="form-control" minlength="11" maxlength="11"
                                        name="phone" />
                                    <div id="phone-error" class="error-message text-danger text-sm"></div>
                                </div>
                                <div class="col-lg-6">
                                    <label class="form-label" id="text">Date of Birth</label>
                                    <input type="date" class="form-control" name="birth_date" />
                                    <div id="birth_date-error" class="error-message text-danger text-sm"></div>
                                </div>
                            </div>
                        </div>
                        <div class="mb-3" id="info1">
                            <div class="row">
                                <div class="col-lg-6">
                                    <label class="form-label">Height</label>
                                    <input type="number" class="form-control" name="height" />
                                    <div id="height-error" class="error-message text-danger text-sm"></div>
                                </div>
                                <div class="col-lg-6">
                                    <label class="form-label">Weight</label>
                                    <input type="number" class="form-control" name="weight" />
                                    <div id="weight-error" class="error-message text-danger text-sm"></div>
                                </div>
                            </div>
                        </div>
                        <div class="mb-3" id="info2">
                            <label class="form-label">Desired Position/Role</label>
                            <input type="text" class="form-control" name="position" />
                            <div id="position-error" class="error-message text-danger text-sm"></div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Complete Address</label>
                            <textarea name="address" class="form-control" style="height: 100px;"></textarea>
                            <div id="address-error" class="error-message text-danger text-sm"></div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Attachment</label>
                            <input type="file" class="form-control" name="file" />
                            <div id="file-error" class="error-message text-danger text-sm"></div>
                        </div>
                        <div class="mb-3">
                            <label class="form-check">
                                <input type="checkbox" class="form-check-input" name="agreement" value="1" />
                                <span class="form-check-label">I agree to the <a href="/terms-and-conditions"
                                        target="_blank">Terms and Conditions</a> for the application</span>
                            </label>
                            <div id="agreement-error" class="error-message text-danger text-sm"></div>
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
    <div class="modal" id="modal-loading" data-backdrop="static">
        <div class="modal-dialog modal-sm">
            <div class="modal-content">
                <div class="modal-body text-center">
                    <div class="mb-2">
                        <dotlottie-wc src="https://lottie.host/ed13f8d5-bc3f-4786-bbb8-36d06a21a6cb/XMPpTra572.lottie"
                            style="width: 100%;height: auto;" autoplay loop></dotlottie-wc>
                    </div>
                    <div>Loading</div>
                </div>
            </div>
        </div>
    </div>
    <?= view('main/templates/footer')?>
    <script src="https://unpkg.com/@lottiefiles/dotlottie-wc@0.8.1/dist/dotlottie-wc.js" type="module"></script>
    <script>
    const checkboxes = document.querySelectorAll('input[name="application"]');

    checkboxes.forEach(checkbox => {
        checkbox.addEventListener('change', () => {
            const selected = [];

            checkboxes.forEach(cb => {
                if (cb.checked) {
                    selected.push(cb.value);
                }
            });
            if (selected.includes("Player")) {
                $('#text').html('Date of Birth');
                document.getElementById('info1').style.display = "block";
                document.getElementById('info2').style.display = "block";
            } else {
                $('#text').html('Date Established');
                document.getElementById('info1').style.display = "none";
                document.getElementById('info2').style.display = "none";
            }

        });
    });
    $('#frmCreate').on('submit', function(e) {
        e.preventDefault();
        $('.error-message').html('');
        let data = $(this).serialize();
        $('#modal-loading').modal('show');
        $.ajax({
            url: "<?=site_url('submit')?>",
            method: "POST",
            data: new FormData(this),
            contentType: false,
            cache: false,
            processData: false,
            success: function(response) {
                $('#modal-loading').modal('hide');
                if (response.success) {
                    $('#frmCreate')[0].reset();
                    Swal.fire({
                        title: 'Great!',
                        text: "Successfully submitted",
                        icon: 'success',
                        confirmButtonText: 'Continue'
                    }).then((result) => {
                        // Action based on user's choice
                        if (result.isConfirmed) {
                            // Perform some action when "Yes" is clicked
                            location.href = "/";
                        }
                    });
                } else {
                    var errors = response.errors;
                    // Iterate over each error and display it under the corresponding input field
                    for (var field in errors) {
                        $('#' + field + '-error').html('<p>' + errors[field] +
                            '</p>'); // Show the first error message
                        $('#' + field).addClass(
                            'text-danger'); // Highlight the input field with an error
                    }
                }
            }
        });
    });
    </script>
</body>

</html>