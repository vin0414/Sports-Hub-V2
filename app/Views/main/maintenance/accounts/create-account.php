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
                            <a href="<?=site_url('accounts')?>" class="btn btn-primary btn-5 d-none d-sm-inline-block">
                                <i class="ti ti-arrow-left"></i>&nbsp;Back
                            </a>
                            <a href="<?=site_url('accounts')?>" class="btn btn-primary btn-6 d-sm-none btn-icon">
                                <i class="ti ti-arrow-left"></i>
                            </a>
                        </div>
                        <!-- BEGIN MODAL -->
                        <!-- END MODAL -->
                    </div>
                </div>
            </div>
        </div>
        <!-- END PAGE HEADER -->
        <div class="page-body">
            <div class="container-xl">
                <div class="row g-3">
                    <div class="col-lg-8">
                        <div class="card">
                            <div class="card-body">
                                <div class="card-title"><?=$title?></div>
                                <form method="POST" class="row g-3" id="frmAccount" autocomplete="OFF">
                                    <?=csrf_field()?>
                                    <div class="col-12">
                                        <label for="">Complete Name</label>
                                        <input type="text" class="form-control" name="fullname" required />
                                        <div id="fullname-error" class="error-message text-danger text-sm"></div>
                                    </div>
                                    <div class="col-12">
                                        <div class="row g-3">
                                            <div class="col-lg-8">
                                                <label for="">Email</label>
                                                <input type="email" class="form-control" name="email" required />
                                                <div id="email-error" class="error-message text-danger text-sm">
                                                </div>
                                            </div>
                                            <div class="col-lg-4">
                                                <label for="">System Role</label>
                                                <select name="role" class="form-select" required>
                                                    <option value="">Choose</option>
                                                    <?php foreach($permission as $row): ?>
                                                    <option value="<?=$row['role']?>"><?=$row['role']?></option>
                                                    <?php endforeach; ?>
                                                </select>
                                                <div id="role-error" class="error-message text-danger text-sm">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <label>Account Status</label>
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
                                    <div class="col-12">
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
                                            Save Account
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="card">
                            <div class="card-header">
                                <div class="card-title">Recently Added</div>
                            </div>
                            <div class="position-relative">
                                <div class="card-table table-responsive">
                                    <table class="table table-vcenter">
                                        <thead>
                                            <th>Fullname</th>
                                            <th>Date</th>
                                        </thead>
                                        <tbody>
                                            <?php foreach($account as $row): ?>
                                            <tr>
                                                <td><?php echo $row['Fullname'] ?></td>
                                                <td><?php echo date('Y-M-d',strtotime($row['DateCreated'])) ?></td>
                                            </tr>
                                            <?php endforeach; ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?= view('main/templates/footer')?>
<script>
$('#frmAccount').on('submit', function(e) {
    e.preventDefault();
    let data = $(this).serialize();
    $.ajax({
        url: "<?=site_url('save-account')?>",
        method: "POST",
        data: data,
        success: function(response) {
            if (response.success) {
                Swal.fire({
                    title: 'Great!',
                    text: "Successfully added",
                    icon: 'success',
                    confirmButtonText: 'Continue'
                }).then((result) => {
                    // Action based on user's choice
                    if (result.isConfirmed) {
                        // Perform some action when "Yes" is clicked
                        location.href = "<?=base_url('accounts')?>";
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
        }
    });
});
</script>
<?= view('main/templates/closing')?>