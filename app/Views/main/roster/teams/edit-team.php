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
                            <a href="javascript:history.back();" class="btn btn-primary btn-5 d-none d-sm-inline-block">
                                <i class="ti ti-arrow-left"></i>&nbsp;Back
                            </a>
                            <a href="javascript:history.back();" class="btn btn-primary btn-6 d-sm-none btn-icon">
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
                <div class="row g-3">
                    <div class="col-lg-3"></div>
                    <div class="col-lg-6">
                        <div class="card">
                            <div class="card-body">
                                <div class="card-title">Edit Team</div>
                                <form method="POST" class="row g-3" enctype="multipart/form-data" id="frmCreate">
                                    <?=csrf_field()?>
                                    <input type="hidden" name="id" value="<?=$team['team_id']?>">
                                    <div class="col-lg-12">
                                        <label class="form-label">Team Name</label>
                                        <input type="text" class="form-control" name="team_name"
                                            placeholder="Enter text here..." value="<?=$team['team_name']?>">
                                        <div id="team_name-error" class="error-message text-danger text-sm"></div>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="row g-3">
                                            <div class="col-lg-4">
                                                <label class="form-label">Sports Category</label>
                                                <select name="category" class="form-select">
                                                    <option value="">Choose</option>
                                                    <?php foreach($category as $row): ?>
                                                    <option value="<?=$row['sportsID']?>"
                                                        <?= ($team['sportsID'] == $row['sportsID']) ? 'selected' : '' ?>>
                                                        <?=$row['Name']?></option>
                                                    <?php endforeach;?>
                                                </select>
                                                <div id="category-error" class="error-message text-danger text-sm">
                                                </div>
                                            </div>
                                            <div class="col-lg-8">
                                                <label class="form-label">Name of Organization</label>
                                                <input type="text" class="form-control" name="organization"
                                                    placeholder="Enter text here..." value="<?=$team['organization']?>">
                                                <div id="organization-error" class="error-message text-danger text-sm">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <label class="form-label">Name of School/Barangay</label>
                                        <textarea name="school_barangay"
                                            class="form-control"><?=$team['school_barangay']?></textarea>
                                        <div id="school_barangay-error" class="error-message text-danger text-sm"></div>
                                    </div>
                                    <div class="col-12">
                                        <label>Status</label>
                                        <div class="form-selectgroup-boxes row">
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
                                        <label class="form-label">Team Logo</label>
                                        <input type="file" class="form-control" name="file">
                                        <div id="file-error" class="error-message text-danger text-sm"></div>
                                    </div>
                                    <div class="col-lg-12">
                                        <button type="submit" class="btn btn-primary" id="btnSubmit">
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
$('#frmCreate').on('submit', function(e) {
    e.preventDefault();
    $('.error-message').html('');
    let data = $(this).serialize();
    $('#modal-loading').modal('show');
    $.ajax({
        url: "<?=site_url('roster/edit-team')?>",
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
                    text: "Successfully applied changes",
                    icon: 'success',
                    confirmButtonText: 'Continue'
                }).then((result) => {
                    // Action based on user's choice
                    if (result.isConfirmed) {
                        // Perform some action when "Yes" is clicked
                        location.href = "/roster/teams";
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