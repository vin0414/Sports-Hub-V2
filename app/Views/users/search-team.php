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
                            class="icon icon-tabler icons-tabler-outline icon-tabler-search">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                            <path d="M10 10m-7 0a7 7 0 1 0 14 0a7 7 0 1 0 -14 0" />
                            <path d="M21 21l-6 -6" />
                        </svg>
                        <?=$title?>
                    </h2>
                </div>
            </div>
        </div>
    </div>
    <div class="page-body">
        <div class="container-xl">
            <div class="row g-3">
                <div class="col-lg-3">
                    <form method="GET" autocomplete="off" novalidate class="sticky-top">
                        <div class="form-label">Sports Category</div>
                        <?php foreach($category as $row): ?>
                        <label class="form-check mb-3">
                            <input type="checkbox" class="form-check-input" name="category[]"
                                value="<?=$row['sportsID']?>"
                                <?= (isset($_GET['category']) && in_array($row['sportsID'], $_GET['category'])) ? 'checked' : '' ?> />
                            <span class="form-check-label"><?=$row['Name']?></span>
                        </label>
                        <?php endforeach;?>
                        <div class="mb-2">
                            <button type="submit" class="btn btn-primary form-control">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                    fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                    stroke-linejoin="round"
                                    class="icon icon-tabler icons-tabler-outline icon-tabler-search">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                    <path d="M10 10m-7 0a7 7 0 1 0 14 0a7 7 0 1 0 -14 0" />
                                    <path d="M21 21l-6 -6" />
                                </svg>
                                Search
                            </button>
                        </div>
                        <div class="mb-1">
                            <button type="reset" class="btn btn-default form-control" onclick="location.href='/search'">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                    fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                    stroke-linejoin="round"
                                    class="icon icon-tabler icons-tabler-outline icon-tabler-zoom-reset">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                    <path d="M21 21l-6 -6" />
                                    <path
                                        d="M3.268 12.043a7.017 7.017 0 0 0 6.634 4.957a7.012 7.012 0 0 0 7.043 -6.131a7 7 0 0 0 -5.314 -7.672a7.021 7.021 0 0 0 -8.241 4.403" />
                                    <path d="M3 4v4h4" />
                                </svg>
                                Reset
                            </button>
                        </div>
                    </form>
                </div>
                <div class="col-lg-9">
                    <div class="space-y">
                        <div class="row g-3">
                            <?php foreach($team as $list): ?>
                            <div class="col-lg-4">
                                <div class="card">
                                    <div class="img-responsive img-responsive-21x9 card-img-top"
                                        style="background-image: url(<?=base_url('assets/images/team/')?>)<?=$list['image']?>)">
                                    </div>
                                    <div class="card-body">
                                        <div class="card-title"><?=$list['team_name']?></div>
                                    </div>
                                </div>
                            </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?= view('main/templates/footer')?>
<?= view('main/templates/closing')?>