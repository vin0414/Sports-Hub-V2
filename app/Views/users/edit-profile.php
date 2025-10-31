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
                            class="icon icon-tabler icons-tabler-outline icon-tabler-user-edit">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                            <path d="M8 7a4 4 0 1 0 8 0a4 4 0 0 0 -8 0" />
                            <path d="M6 21v-2a4 4 0 0 1 4 -4h3.5" />
                            <path d="M18.42 15.61a2.1 2.1 0 0 1 2.97 2.97l-3.39 3.42h-3v-3l3.42 -3.39z" />
                        </svg>
                        <?=$title?>
                    </h2>
                </div>
                <div class="col-auto ms-auto d-print-none">
                    <div class="btn-list">
                        <a href="javascript:history.back()" class="btn btn-primary d-none d-sm-inline-block">
                            <i class="ti ti-arrow-left"></i>
                            Back
                        </a>
                        <a href="javascript:history.back()" class="btn btn-primary d-sm-none btn-icon">
                            <i class="ti ti-arrow-left"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="page-body">
        <div class="container-xl">
            <div class="card">
                <div class="card-body">
                    <div class="card-title">Edit Profile</div>
                    <form method="POST" class="row g-1" id="frmEdit">
                        <?=csrf_field()?>
                        <input type="hidden" name="player_id" value="<?= $player['player_id'] ?>">
                        <div class="col-lg-12">
                            <label class="form-label">Complete Name</label>
                            <p class="form-control"><?=session()->get('user_fullname')?></p>
                        </div>
                        <div class="col-lg-12">
                            <div class="row g-3">
                                <div class="col-lg-3">
                                    <label class="form-label">Date of Birth</label>
                                    <input type="date" class="form-control" name="dob"
                                        value="<?=$player['date_of_birth']?>">
                                    <div id="dob-error" class="error-message text-danger text-sm"></div>
                                </div>
                                <div class="col-lg-3">
                                    <label class="form-label">Email Address</label>
                                    <input type="email" class="form-control" name="email" value="<?=$player['email']?>">
                                    <div id="email-error" class="error-message text-danger text-sm"></div>
                                </div>
                                <div class="col-lg-3">
                                    <label class="form-label">Height</label>
                                    <input type="text" class="form-control" name="height"
                                        value="<?=$player['height']?>">
                                    <div id="height-error" class="error-message text-danger text-sm"></div>
                                </div>
                                <div class="col-lg-3">
                                    <label class="form-label">Weight</label>
                                    <input type="text" class="form-control" name="weight"
                                        value="<?=$player['weight']?>">
                                    <div id="weight-error" class="error-message text-danger text-sm"></div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <label class="form-label">Address</label>
                            <textarea name="address" class="form-control"
                                style="height: 150px;"><?=$player['address']?></textarea>
                            <div id="address-error" class="error-message text-danger text-sm"></div>
                        </div>
                        <div class="col-lg-12 mb-3">
                            <label class="form-label">Image</label>
                            <input type="file" class="form-control" name="image" />
                            <div id="image-error" class="error-message text-danger text-sm"></div>
                        </div>
                        <div class="col-lg-12">
                            <button type="submit" class="btn btn-primary">Save Changes</button>
                        </div>
                    </form>
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
$('#frmEdit').on('submit', function(e) {
    e.preventDefault();
    // Clear previous error messages
    $('.error-message').text('');
    var formData = new FormData(this);
    $('#modal-loading').modal('show');
    $.ajax({
        url: '<?= base_url('roster/players/edit') ?>',
        type: 'POST',
        data: formData,
        contentType: false,
        processData: false,
        success: function(response) {
            $('#modal-loading').modal('hide');
            if (response.success) {
                swal.fire({
                    title: 'Great!',
                    text: "Successfully applied changes.",
                    icon: 'success',
                    confirmButtonText: 'OK'
                }).then((result) => {
                    if (result.isConfirmed) {
                        javascript: history.back();
                    }
                });
            } else {
                var errors = response.error;
                // Iterate over each error and display it under the corresponding input field
                for (var field in errors) {
                    $('#' + field + '-error').html('<p>' + errors[field] +
                        '</p>'); // Show the first error message
                    $('#' + field).addClass(
                        'text-danger'); // Highlight the input field with an error
                }
            }
        },
        error: function(xhr, status, error) {
            $('#modal-loading').modal('hide');
            alert('An error occurred. Please try again.');
        }
    });
});
</script>
<?= view('main/templates/closing')?>