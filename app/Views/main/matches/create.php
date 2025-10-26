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
                <div class="row g-3">
                    <div class="col-lg-8">
                        <div class="card">
                            <div class="card-body">
                                <div class="card-title">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                        fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                        stroke-linejoin="round"
                                        class="icon icon-tabler icons-tabler-outline icon-tabler-soccer-field">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                        <path d="M12 12m-3 0a3 3 0 1 0 6 0a3 3 0 1 0 -6 0" />
                                        <path d="M3 9h3v6h-3z" />
                                        <path d="M18 9h3v6h-3z" />
                                        <path
                                            d="M3 5m0 2a2 2 0 0 1 2 -2h14a2 2 0 0 1 2 2v10a2 2 0 0 1 -2 2h-14a2 2 0 0 1 -2 -2z" />
                                        <path d="M12 5l0 14" />
                                    </svg>
                                    <?=$title?>
                                </div>
                                <form method="POST" class="row g-3" id="frmCreate">
                                    <?=csrf_field()?>
                                    <div class="col-lg-12">
                                        <label class="form-label">Tournament</label>
                                        <input type="text" class="form-control" name="tournament" />
                                        <div id="tournament-error" class="error-message text-danger text-sm"></div>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="row g-3">
                                            <div class="col-lg-6">
                                                <label class="form-label">Type of Sports</label>
                                                <select name="sports" class="form-select">
                                                    <option value="">Choose</option>
                                                    <?php foreach($sports as $row): ?>
                                                    <option value="<?=$row['sportsID']?>"><?=$row['Name']?></option>
                                                    <?php endforeach;?>
                                                </select>
                                                <div id="sports-error" class="error-message text-danger text-sm"></div>
                                            </div>
                                            <div class="col-lg-6">
                                                <label class="form-label">Team Status</label>
                                                <select class="form-select" name="status">
                                                    <option value="">Choose</option>
                                                    <option value="All">All Team</option>
                                                    <option value="1">Active Teams</option>
                                                    <option value="0">Inactive Teams</option>
                                                </select>
                                                <div id="status-error" class="error-message text-danger text-sm"></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <label class="form-label">Location/Venue</label>
                                        <textarea name="location" class="form-control"></textarea>
                                        <div id="location-error" class="error-message text-danger text-sm"></div>
                                    </div>
                                    <div class="col-lg-12">
                                        <button type="submit" class="btn btn-primary">
                                            Generate
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="card">
                            <div class="card-header">
                                <div class="card-title">
                                    <i class="ti ti-list"></i>&nbsp;Teams
                                </div>
                            </div>
                            <div class="list-group list-group-flush">
                                <?php foreach($team as $row): ?>
                                <div class="list-group-item">
                                    <div class="row align-items-center">
                                        <div class="col-auto">
                                            <a href="<?=site_url('roster/teams/view/')?><?=$row['team_id']?>">
                                                <span class="avatar avatar-1"
                                                    style="background-image: url(<?=base_url('assets/images/team/')?><?=$row['image']?>)">
                                                </span>
                                            </a>
                                        </div>
                                        <div class="col text-truncate">
                                            <a href="<?=site_url('roster/teams/view/')?><?=$row['team_id']?>"
                                                class="text-reset d-block"><?=$row['team_name']?>
                                            </a>
                                            <div class="d-block text-secondary text-truncate mt-n1">
                                                <?=$row['school_barangay']?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <?php endforeach;?>
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
        url: "<?=site_url('roster/create-match')?>",
        method: "POST",
        data: data,
        success: function(response) {
            $('#modal-loading').modal('hide');
            if (response.success) {
                $('#frmCreate')[0].reset();
                Swal.fire({
                    title: 'Great!',
                    text: "Successfully generated matches",
                    icon: 'success',
                    confirmButtonText: 'Continue'
                }).then((result) => {
                    // Action based on user's choice
                    if (result.isConfirmed) {
                        // Perform some action when "Yes" is clicked
                        location.href = "/matches";
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