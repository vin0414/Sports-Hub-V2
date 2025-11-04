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
                <h2 class="mb-3 text-center">Premium Streaming Access</h2>
                <p class="text-secondary mb-4">Enjoy uninterrupted, high-quality live sports coverage built for true
                    fans.</p>
                <ul class="list-unstyled space-y">
                    <li class="row g-2">
                        <span class="col-auto"></span>
                        <span class="col">
                            <strong class="d-block">⚡ Ad-Free Live Streaming</strong>
                            <span class="d-block text-secondary">1. Watch every match without interruptions — no ads,
                                pop-ups, or distractions.</span>
                            <span class="d-block text-secondary">2. Smooth, continuous streaming so you never miss a key
                                moment.</span>
                        </span>
                    </li>
                    <li class="row g-2">
                        <span class="col-auto"></span>
                        <span class="col">
                            <strong class="d-block">💎 HD / 4K Quality</strong>
                            <span class="d-block text-secondary">1. Experience games in crystal-clear HD or 4K,
                                depending on your connection and device.</span>
                            <span class="d-block text-secondary">2. Optimized streaming for consistent quality, even
                                during peak match times.</span>
                        </span>
                    </li>
                    <li class="row g-2">
                        <span class="col-auto"></span>
                        <span class="col">
                            <strong class="d-block">📱 Multi-Device Access</strong>
                            <span class="d-block text-secondary">1. Stream on mobile, tablet, desktop, or smart TV —
                                anywhere, anytime.</span>
                            <span class="d-block text-secondary">2. Easily switch between devices during live
                                matches.</span>
                        </span>
                    </li>
                    <li class="row g-2">
                        <span class="col-auto"></span>
                        <span class="col">
                            <strong class="d-block">💬 Live Match Chat</strong>
                            <span class="d-block text-secondary">1. Join the real-time live chat with other fans while
                                watching the match.</span>
                            <span class="d-block text-secondary">2. Share reactions, celebrate goals, and discuss key
                                moments as they happen.</span>
                            <span class="d-block text-secondary">3. Moderated chat to ensure a positive, fan-friendly
                                atmosphere.</span>
                        </span>
                    </li>
                </ul>
                <div class="my-4">
                    <form method="POST" id="frmSubscribe">
                        <?=csrf_field()?>
                        <button type="submit" class="btn btn-primary w-100"> Subscribe Now </button>
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
$('#frmSubscribe').on('submit', function(e) {
    e.preventDefault();
    $.ajax({
        url: '<?=site_url("processing")?>',
        type: 'POST',
        data: $(this).serialize(),
        success: function(response) {
            if (response.success) {
                alert(response.success);
                location.href = '<?=site_url("/")?>';
                // Optionally redirect or update UI
            } else {
                alert('Error: ' + response);
            }
        },
        error: function() {
            alert('An unexpected error occurred. Please try again later.');
        }
    });
});
</script>
<?= view('main/templates/closing')?>