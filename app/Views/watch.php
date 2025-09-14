<?=view('main/templates/header')?>
<?=view('main/templates/main-template')?>
<?php  
$accountModel = new \App\Models\AccountModel();
$account = $accountModel->find($video['accountID']);
?>
<div class="page-wrapper">
    <div class="page-header d-print-none">
        <div class="container-xl">
            <div class="row g-2 align-items-center">
                <div class="col">
                    <h2 class="page-title">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                            stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                            class="icon icon-tabler icons-tabler-outline icon-tabler-brand-parsinta">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                            <path d="M12 3a9 9 0 1 0 9 9" />
                            <path d="M21 12a9 9 0 0 0 -9 -9" opacity=".5" />
                            <path d="M10 9v6l5 -3z" />
                        </svg>
                        <?=$video['file_name']?>
                    </h2>
                    <p class="text-secondary">
                        Uploaded by : <?=$account['Fullname']?>&nbsp;|&nbsp;Category : <?=$video['sportName']?>
                    </p>
                </div>
                <div class="col-auto ms-auto d-print-none">
                    <div class="btn-list">
                        <a href="<?=site_url('latest-videos')?>" class="btn btn-primary btn-5 d-none d-sm-inline-block">
                            <i class="ti ti-arrow-left"></i>&nbsp;Back
                        </a>
                        <a href="<?=site_url('latest-videos')?>" class="btn btn-primary btn-6 d-sm-none btn-icon">
                            <i class="ti ti-arrow-left"></i>
                        </a>
                    </div>
                    <!-- BEGIN MODAL -->
                    <!-- END MODAL -->
                </div>
            </div>
        </div>
    </div>
    <div class="page-body">
        <div class="container-xl">
            <div class="row g-1">
                <div class="col-lg-12">
                    <div class="card">
                        <!-- Photo -->
                        <video id="video-preview" class="card-img-top" width="100%" height="100%" controls>
                            <source src="<?=base_url('assets/videos/')?><?=$video['file']?>" type="video/mp4">
                            <source src="<?=base_url('assets/videos/')?><?=$video['file']?>" type="video/webm">
                            Your browser does not support the video tag.
                        </video>
                        <div class="card-body">
                            <h3 class="card-title">
                                <a href="<?=site_url('latest-videos/watch/')?><?=$video['Token']?>">
                                    <?=$video['file_name']?>
                                </a>
                            </h3>
                            <p class="text-secondary">
                                <?=$video['description']?>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?= view('main/templates/footer')?>
<script>
let video = document.getElementById("video-preview");
let totalWatched = 0;
let lastTime = 0;
document.getElementById('video-preview').addEventListener('play', function() {
    fetch('<?=site_url('incrementViews')?>/<?= $video['video_id'] ?>', {
        method: 'POST',
        headers: {
            'X-Requested-With': 'XMLHttpRequest'
        }
    });
    lastTime = video.currentTime;
}, {
    once: true
});

video.addEventListener("pause", () => {
    totalWatched += video.currentTime - lastTime;
    sendWatchedTime(totalWatched);
});

video.addEventListener("ended", () => {
    totalWatched += video.duration - lastTime;
    sendWatchedTime(totalWatched);
});

function sendWatchedTime(secondsWatched) {
    fetch("<?= site_url('save_watch_time'); ?>", {
        method: "POST",
        headers: {
            "Content-Type": "application/json"
        },
        body: JSON.stringify({
            video_id: <?=$video['video_id']?>,
            watched_seconds: Math.floor(secondsWatched)
        })
    });
}
</script>
<?= view('main/templates/closing')?>