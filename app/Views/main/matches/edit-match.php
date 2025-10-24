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
                    <div class="col-auto ms-auto d-print-none">
                        <div class="btn-list">
                            <a href="<?=site_url('matches')?>" class="btn btn-primary btn-5 d-none d-sm-inline-block">
                                <i class="ti ti-arrow-left"></i>&nbsp;Back
                            </a>
                            <a href="<?=site_url('matches')?>" class="btn btn-primary btn-6 d-sm-none btn-icon">
                                <i class="ti ti-arrow-left"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- END PAGE HEADER -->
        <div class="page-body">
            <div class="container-xl">
                <div class="row">
                    <div class="col-lg-2"></div>
                    <div class="col-lg-8">
                        <div class="card">
                            <div class="card-body">
                                <div class="card-title">
                                    <i class="ti ti-edit"></i>&nbsp;Edit Match
                                </div>
                                <form method="POST" class="row g-2" id="frmEdit">
                                    <?=csrf_field()?>
                                    <input type="hidden" name="id" value="<?=$match['match_id']?>">
                                    <div class="col-lg-12">
                                        <label class="form-label">Tournament</label>
                                        <p class="form-control"><?=$match['tournament']?></p>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="row g-2">
                                            <div class="col-lg-6">
                                                <label class="form-label">Home</label>
                                                <p class="form-control"><?=$team->home?></p>
                                            </div>
                                            <div class="col-lg-6">
                                                <label class="form-label">Away</label>
                                                <p class="form-control"><?=$team->away?></p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="row g-2">
                                            <div class="col-lg-6">
                                                <label class="form-label">Date</label>
                                                <input type="date" class="form-control" name="date" id="date"
                                                    value="<?=$match['date']?>" />
                                                <div id="date-error" class="error-message text-danger text-sm"></div>
                                            </div>
                                            <div class="col-lg-6">
                                                <label class="form-label">Time</label>
                                                <input type="time" class="form-control" name="time"
                                                    value="<?=$match['time']?>" />
                                                <div id="time-error" class="error-message text-danger text-sm"></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <label class="form-label">Location</label>
                                        <textarea name="location"
                                            class="form-control"><?=$match['location']?></textarea>
                                        <div id="location-error" class="error-message text-danger text-sm"></div>
                                    </div>
                                    <div class="col-12">
                                        <label>Match Status</label>
                                        <div class="form-selectgroup-boxes row mb-3">
                                            <div class="col-lg-6">
                                                <label class="form-selectgroup-item">
                                                    <input type="radio" name="status" value="1"
                                                        class="form-selectgroup-input" checked />
                                                    <span class="form-selectgroup-label d-flex align-items-center p-3">
                                                        <span class="me-3">
                                                            <span class="form-selectgroup-check"></span>
                                                        </span>
                                                        <span class="form-selectgroup-label-content">
                                                            <span
                                                                class="form-selectgroup-title strong mb-1">Active</span>
                                                        </span>
                                                    </span>
                                                </label>
                                            </div>
                                            <div class="col-lg-6">
                                                <label class="form-selectgroup-item">
                                                    <input type="radio" name="status" value="0"
                                                        class="form-selectgroup-input" />
                                                    <span class="form-selectgroup-label d-flex align-items-center p-3">
                                                        <span class="me-3">
                                                            <span class="form-selectgroup-check"></span>
                                                        </span>
                                                        <span class="form-selectgroup-label-content">
                                                            <span
                                                                class="form-selectgroup-title strong mb-1">Inactive</span>
                                                        </span>
                                                    </span>
                                                </label>
                                            </div>
                                        </div>
                                        <div id="status-error" class="error-message text-danger text-sm"></div>
                                    </div>
                                    <div class="col-lg-12">
                                        <button type="submit" class="btn btn-primary">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                                stroke-linecap="round" stroke-linejoin="round"
                                                class="icon icon-tabler icons-tabler-outline icon-tabler-device-floppy">
                                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                <path
                                                    d="M6 4h10l4 4v10a2 2 0 0 1 -2 2h-12a2 2 0 0 1 -2 -2v-12a2 2 0 0 1 2 -2" />
                                                <path d="M12 14m-2 0a2 2 0 1 0 4 0a2 2 0 1 0 -4 0" />
                                                <path d="M14 4l0 4l-6 0l0 -4" />
                                            </svg>
                                            Save Changes
                                        </button>
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
const dateInput = document.getElementById('date');

// Get today's date in YYYY-MM-DD format
const today = new Date();
const yyyy = today.getFullYear();
const mm = String(today.getMonth() + 1).padStart(2, '0'); // Months are 0-based
const dd = String(today.getDate()).padStart(2, '0');
const formattedToday = `${yyyy}-${mm}-${dd}`;

// Set the minimum date to today
dateInput.min = formattedToday;

$('#frmEdit').on('submit', function(e) {
    e.preventDefault();
    $('.error-message').html('');
    let data = $(this).serialize();
    $('#modal-loading').modal('show');
    $.ajax({
        url: "<?=site_url('roster/edit-match')?>",
        method: "POST",
        data: data,
        success: function(response) {
            $('#modal-loading').modal('hide');
            if (response.success) {
                Swal.fire({
                    title: 'Great!',
                    text: "Successfully applied changes",
                    icon: 'success',
                    confirmButtonText: 'Continue'
                }).then((result) => {
                    // Action based on user's choice
                    if (result.isConfirmed) {
                        // Perform some action when "Yes" is clicked
                        location.href = "<?=base_url('matches')?>";
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
<?= view('main/templates/closing')?>