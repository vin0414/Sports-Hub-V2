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
                            <a href="<?=site_url('news/create')?>"
                                class="btn btn-primary btn-5 d-none d-sm-inline-block">
                                <!-- Download SVG icon from http://tabler.io/icons/icon/plus -->
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                    fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                    stroke-linejoin="round"
                                    class="icon icon-tabler icons-tabler-outline icon-tabler-brand-telegram">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                    <path d="M15 10l-4 4l6 6l4 -16l-18 7l4 2l2 6l3 -4" />
                                </svg>
                                New Article
                            </a>
                            <a href="<?=site_url('news/create')?>" class="btn btn-primary btn-6 d-sm-none btn-icon">
                                <!-- Download SVG icon from http://tabler.io/icons/icon/plus -->
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                    fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                    stroke-linejoin="round"
                                    class="icon icon-tabler icons-tabler-outline icon-tabler-brand-telegram">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                    <path d="M15 10l-4 4l6 6l4 -16l-18 7l4 2l2 6l3 -4" />
                                </svg>
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
                <div class="row row-cards">
                    <div class="col-lg-12">
                        <form method="GET" class="row g-3" id="frmSearch">
                            <div class="col-lg-2">
                                <input type="date" class="form-control" name="date" />
                            </div>
                            <div class="col-lg-2">
                                <select class="form-select" name="type">
                                    <option value="">Filter</option>
                                    <option value="1">Published</option>
                                    <option value="3">Draft</option>
                                    <option value="2">Archive</option>
                                </select>
                            </div>
                            <div class="col-lg-2">
                                <button type="submit" class="btn btn-primary">
                                    <i class="ti ti-search"></i>&nbsp;Search
                                </button>
                            </div>
                        </form>
                        <br />
                        <div class="row row-cards">
                            <div class="space-y">
                                <?php if(empty($news)){ ?>
                                <div class="alert alert-warning" role="alert">No Post(s) Has Been Added Yet</div>
                                <?php }else { ?>
                                <div class="row row-cards" id="results">
                                    <?php foreach($news as $row): ?>
                                    <div class="col-sm-6 col-lg-3">
                                        <div class="card card-sm">
                                            <a href="<?=site_url('news/topic/')?><?=$row['topic'] ?>">
                                                <img src="<?=base_url('assets/images/news/')?><?=$row['image']?>"
                                                    class="card-img-top" style="width: 100%; height: 200px;" />
                                            </a>
                                            <div class="card-body">
                                                <div class="d-flex align-items-center">
                                                    <span class="avatar avatar-2 me-3 rounded"
                                                        style="background-image: url(<?=base_url('assets/images/avatar.jpg')?>);"></span>
                                                    <div style="width:100%;">
                                                        <a href="javascript:void(0);">
                                                            <?=substr($row['topic'],0,50) ?>...
                                                        </a>
                                                        <div class="text-secondary">
                                                            <div class="row g-3">
                                                                <div class="col-lg-6">
                                                                    <?=date('M,d Y',strtotime($row['date']))?>
                                                                </div>
                                                                <div class="col-lg-6">
                                                                    <?php if($row['status']==1): ?>
                                                                    <a href="<?=site_url('news/edit')?>/<?=$row['topic'] ?>"
                                                                        style="float:right;margin-left:10px;"><i
                                                                            class="ti ti-edit"></i>&nbsp;Edit</a>
                                                                    <span class="badge bg-primary text-white"
                                                                        style="float:right;">Published</span>
                                                                    <?php elseif($row['status']==3): ?>
                                                                    <a href="<?=site_url('news/edit')?>/<?=$row['topic'] ?>"
                                                                        style="float:right;margin-left:10px;"><i
                                                                            class="ti ti-edit"></i>&nbsp;Edit</a>
                                                                    <span class="badge bg-secondary text-white"
                                                                        style="float:right;">Draft</span>
                                                                    <?php else : ?>
                                                                    <a href="<?=site_url('news/edit')?>/<?=$row['topic'] ?>"
                                                                        style="float:right;margin-left:10px;"><i
                                                                            class="ti ti-edit"></i>&nbsp;Edit</a>
                                                                    <span class="badge bg-danger text-white"
                                                                        style="float:right;">Archive</span>
                                                                    <?php endif; ?>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <?php endforeach; ?>
                                </div>
                                <?php } ?>
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
$('#frmSearch').on('submit', function(e) {
    e.preventDefault();
    let data = $(this).serialize();
    $.ajax({
        url: "<?=site_url('filter-news')?>",
        method: "GET",
        data: data,
        success: function(response) {
            if (response === "") {
                Swal.fire({
                    title: 'Sorry!',
                    text: "No Record(s) found. Please try again",
                    icon: 'warning',
                });
            } else {
                $('#results').html(response);
            }
        }
    });
});
</script>
<?= view('main/templates/closing')?>