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
                            class="icon icon-tabler icons-tabler-outline icon-tabler-brand-parsinta">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                            <path d="M12 3a9 9 0 1 0 9 9" />
                            <path d="M21 12a9 9 0 0 0 -9 -9" opacity=".5" />
                            <path d="M10 9v6l5 -3z" />
                        </svg>
                        <?=$title?>
                    </h2>
                </div>
                <div class="col-auto ms-auto d-print-none">
                    <div class="btn-list">
                        <a href="<?=site_url('/')?>" class="btn btn-primary btn-5 d-none d-sm-inline-block">
                            <i class="ti ti-arrow-left"></i>&nbsp;Back
                        </a>
                        <a href="<?=site_url('/')?>" class="btn btn-primary btn-6 d-sm-none btn-icon">
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
            <div class="row g-3">
                <div class="col-lg-9">
                    <div class="card">
                        <div class="card-body">
                            <iframe
                                src="https://player.livepush.io/live/<?=!empty($code['code']) ? $code['code'] : ''?>"
                                width="100%" height="450px" allowFullScreen="1" frameBorder="0">
                            </iframe>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3">
                    <div class="card">
                        <div class="card-header">
                            <div class="card-title">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                    fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                    stroke-linejoin="round"
                                    class="icon icon-tabler icons-tabler-outline icon-tabler-scoreboard">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                    <path
                                        d="M3 5m0 2a2 2 0 0 1 2 -2h14a2 2 0 0 1 2 2v10a2 2 0 0 1 -2 2h-14a2 2 0 0 1 -2 -2z" />
                                    <path d="M12 5v2" />
                                    <path d="M12 10v1" />
                                    <path d="M12 14v1" />
                                    <path d="M12 18v1" />
                                    <path d="M7 3v2" />
                                    <path d="M17 3v2" />
                                    <path d="M15 10.5v3a1.5 1.5 0 0 0 3 0v-3a1.5 1.5 0 0 0 -3 0z" />
                                    <path d="M6 9h1.5a1.5 1.5 0 0 1 0 3h-.5h.5a1.5 1.5 0 0 1 0 3h-1.5" />
                                </svg>
                                Match Today
                            </div>
                        </div>
                        <div class="list-group list-group-flush">
                            <?php if(empty($matches)): ?>
                            <div class="list-group-item">
                                <div class="text-center text-muted py-3">
                                    No upcoming matches scheduled.
                                </div>
                            </div>
                            <?php else: ?>
                            <?php foreach($matches as $match): ?>
                            <div class="list-group list-group-flush">
                                <div class="list-group-item">
                                    <div class="row align-items-center">
                                        <div class="col text-truncate">
                                            <a href="<?=site_url('match-details/')?><?=$match->match_id?>"
                                                class="text-reset d-block"><?=$match->team_name?>
                                            </a>
                                            <div class="d-block text-secondary text-truncate mt-n1">
                                                <?=date('M d, Y', strtotime($match->date))?>
                                                &nbsp;|&nbsp; <?=$match->time?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <?php endforeach; ?>
                            <?php endif;?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?= view('main/templates/footer')?>
<script id="cid0020000421680977710" data-cfasync="false" async src="//st.chatango.com/js/gz/emb.js"
    style="width: 200px;height: 300px;">
{
    "handle": "digitalsportshub",
    "arch": "js",
    "styles": {
        "a": "3366ff",
        "b": 100,
        "c": "000000",
        "d": "000000",
        "k": "3366ff",
        "l": "3366ff",
        "m": "3366ff",
        "p": "10",
        "q": "3366ff",
        "r": 100,
        "pos": "br",
        "cv": 1,
        "cvbg": "3366ff",
        "cvw": 200,
        "cvh": 30,
        "ticker": 1,
        "fwtickm": 1
    }
}
</script>
<?= view('main/templates/closing')?>