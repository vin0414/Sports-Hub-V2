<?=view('main/templates/header')?>
<?=view('main/templates/main-template')?>
<div class="page-wrapper">
    <div class="page-body">
        <div class="container-xl">
            <div class="card">
                <div class="card-body">
                    <div class="card-title">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                            stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                            class="icon icon-tabler icons-tabler-outline icon-tabler-device-landline-phone">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                            <path d="M20 3h-2a2 2 0 0 0 -2 2v14a2 2 0 0 0 2 2h2a2 2 0 0 0 2 -2v-14a2 2 0 0 0 -2 -2z" />
                            <path d="M16 4h-11a3 3 0 0 0 -3 3v10a3 3 0 0 0 3 3h11" />
                            <path d="M12 8h-6v3h6z" />
                            <path d="M12 14v.01" />
                            <path d="M9 14v.01" />
                            <path d="M6 14v.01" />
                            <path d="M12 17v.01" />
                            <path d="M9 17v.01" />
                            <path d="M6 17v.01" />
                        </svg>
                        Contact Us
                    </div>
                    <form class="row g-3" method="POST" id="frmContact">
                        <?=csrf_field()?>
                        <div class="col-lg-12">
                            <div class="row g-3">
                                <div class="col-lg-6">
                                    <label class="form-label">Complete Name</label>
                                    <input type="text" class="form-control" name="fullname" />
                                    <div id="fullname-error" class="error-message text-danger text-sm"></div>
                                </div>
                                <div class="col-lg-6">
                                    <label class="form-label">Email Address</label>
                                    <input type="email" class="form-control" name="email" />
                                    <div id="email-error" class="error-message text-danger text-sm"></div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <label class="form-label">Details</label>
                            <textarea name="details" class="form-control" style="height:300px;"></textarea>
                            <div id="details-error" class="error-message text-danger text-sm"></div>
                        </div>
                        <div class="col-lg-12">
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<?= view('main/templates/footer')?>
<script>
$('#frmContact').on('submit', function(e) {
    e.preventDefault();
    $('.error-message').html('');
    let data = $(this).serialize();
    $.ajax({
        url: "<?=site_url('save-inquiry')?>",
        method: "POST",
        data: data,
        success: function(response) {
            if (response.success) {
                $('#frmCreate')[0].reset();
                Swal.fire({
                    title: 'Great!',
                    text: "Successfully submitted your inquiry. We will get back to you soon.",
                    icon: 'success',
                    confirmButtonText: 'Continue'
                }).then((result) => {
                    // Action based on user's choice
                    if (result.isConfirmed) {
                        location.reload();
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