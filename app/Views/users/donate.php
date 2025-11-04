<?=view('main/templates/header')?>
<div class="page page-center">
    <div class="container container-tight py-4">
        <div class="text-center mb-4">
            <!-- BEGIN NAVBAR LOGO -->
            <a href="." aria-label="Tabler" class="navbar-brand navbar-brand-autodark">
                <img src="<?=base_url('assets/images/logo.jpg')?>" width="50" style="border-radius: 50px;" />
            </a><!-- END NAVBAR LOGO -->
        </div>
        <div class="card card-md">
            <div class="card-body">
                <h2 class="mb-3 text-center">Donate Now</h2>
                <div class="my-4">
                    <img src="<?=base_url('assets/images/qrcode.png')?>" class="mb-3" alt="Digital Sports Hub">
                    <form method="POST" class="row g-3" id="frmDonate">
                        <?=csrf_field()?>
                        <div class="col-lg-12">
                            <input type="text" class="form-control" name="reference"
                                placeholder="Enter Donation Reference" />
                        </div>
                        <div class="col-lg-12">
                            <input type="number" class="form-control" name="amount" placeholder="Enter Amount" />
                        </div>
                        <div class="col-lg-12">
                            <button type="submit" class="btn btn-primary w-100"> Submit </button>
                        </div>
                    </form>
                </div>
                <p class="text-secondary">If you need additional information please feel free to <a href="#">contact
                        us</a>.</p>
            </div>
        </div>
    </div>
</div>
<?= view('main/templates/footer')?>
<script>
$('#frmDonate').on('submit', function(e) {
    e.preventDefault();
    $.ajax({
        url: '<?=site_url("send-donation")?>',
        type: 'POST',
        data: $(this).serialize(),
        success: function(response) {
            if (response.success) {
                alert(response.success);
                location.href = '<?=site_url("/")?>';
                // Optionally redirect or update UI
            } else {
                alert('Error: ' + response.errors);
            }
        },
        error: function() {
            alert('An unexpected error occurred. Please try again later.');
        }
    });
});
</script>
<?= view('main/templates/closing')?>