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
                            class="icon icon-tabler icons-tabler-outline icon-tabler-users-group">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                            <path d="M10 13a2 2 0 1 0 4 0a2 2 0 0 0 -4 0" />
                            <path d="M8 21v-1a2 2 0 0 1 2 -2h4a2 2 0 0 1 2 2v1" />
                            <path d="M15 5a2 2 0 1 0 4 0a2 2 0 0 0 -4 0" />
                            <path d="M17 10h2a2 2 0 0 1 2 2v1" />
                            <path d="M5 5a2 2 0 1 0 4 0a2 2 0 0 0 -4 0" />
                            <path d="M3 13v-1a2 2 0 0 1 2 -2h2" />
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
                    <div class="card-title"><?=$title?></div>
                    <form class="row g-3" method="POST" enctype="multipart/form-data" id="frmEdit">
                        <?=csrf_field()?>
                        <input type="hidden" name="player_id" value="<?= $player['player_id'] ?>">
                        <div class="col-md-12">
                            <label class="form-label">First Name</label>
                            <input type="text" class="form-control" name="fullname"
                                value="<?= $registration['fullname'] ?>">
                        </div>
                        <div class="col-md-5">
                            <label class="form-label">Email Address</label>
                            <input type="email" class="form-control" name="email" value="<?=$player['email']?>">
                            <div id="email-error" class="error-message text-danger text-sm"></div>
                        </div>
                        <div class="col-md-2">
                            <label class="form-label">Date of Birth</label>
                            <input type="date" class="form-control" name="birth_date"
                                value="<?=$player['date_of_birth']?>">
                            <div id="birth_date-error" class="error-message text-danger text-sm"></div>
                        </div>
                        <div class="col-md-3">
                            <label class="form-label">Position</label>
                            <select class="form-select" name="position">
                                <option value="">Choose</option>
                                <?php foreach($roles as $pos): ?>
                                <option value="<?= $pos['roleID'] ?>"
                                    <?= $player['roleID'] == $pos['roleID'] ? 'selected' : '' ?>>
                                    <?= strtoupper($pos['roleName']) ?></option>
                                <?php endforeach; ?>
                            </select>
                            <div id="position-error" class="error-message text-danger text-sm"></div>
                        </div>
                        <div class="col-lg-2">
                            <label class="form-label">Order</label>
                            <input type="number" class="form-control" name="order" value="<?= $player['order'] ?>">
                            <div id="order-error" class="error-message text-danger text-sm"></div>
                        </div>
                        <div class="col-md-3">
                            <label class="form-label">Jersey Number</label>
                            <input type="number" class="form-control" name="jersey_number"
                                value="<?= $player['jersey_num'] ?>">
                            <div id="jersey_number-error" class="error-message text-danger text-sm"></div>
                        </div>
                        <div class="col-md-3">
                            <label class="form-label">Height (inches)</label>
                            <input type="number" class="form-control" name="height" value="<?= $player['height'] ?>">
                            <div id="height-error" class="error-message text-danger text-sm"></div>
                        </div>
                        <div class="col-md-3">
                            <label class="form-label">Weight (lbs)</label>
                            <input type="number" class="form-control" name="weight" value="<?= $player['weight'] ?>">
                            <div id="weight-error" class="error-message text-danger text-sm"></div>
                        </div>
                        <div class="col-md-3">
                            <label class="form-label">Status</label>
                            <select class="form-select" name="status">
                                <option value="1" <?= $player['status'] == 1 ? 'selected' : '' ?>>ACTIVE</option>
                                <option value="2" <?= $player['status'] == 2 ? 'selected' : '' ?>>INACTIVE</option>
                            </select>
                            <div id="status-error" class="error-message text-danger text-sm"></div>
                        </div>
                        <div class="col-lg-12">
                            <label class="form-label">Image</label>
                            <input type="file" class="form-control" name="image" />
                            <div id="image-error" class="error-message text-danger text-sm"></div>
                        </div>
                        <div class="col-12">
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
$(document).ready(function() {
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
                        title: 'Success',
                        text: "Great! Player information has been updated.",
                        icon: 'success',
                        confirmButtonText: 'OK'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            location.reload();
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
});
</script>
<?= view('main/templates/closing')?>