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
                            <span class="d-none d-sm-inline">
                                <a href="<?=site_url('videos/live-stream')?>" class="btn btn-1">
                                    <i class="ti ti-video"></i>&nbsp;Live Stream
                                </a>
                            </span>
                            <a href="<?=site_url('videos/upload')?>"
                                class="btn btn-primary btn-5 d-none d-sm-inline-block">
                                <i class="ti ti-cloud-upload"></i>&nbsp;Upload
                            </a>
                            <a href="<?=site_url('videos/upload')?>" class="btn btn-primary btn-6 d-sm-none btn-icon">
                                <i class="ti ti-cloud-upload"></i>
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
                <form method="GET" class="row g-3 mb-3" id="frmSearch">
                    <div class="col-lg-2">
                        <select name="sport" class="form-select">
                            <option value="">Filter</option>
                            <?php foreach($sports as $row): ?>
                            <option><?php echo $row['Name'] ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="col-lg-2">
                        <input type="date" class="form-control" name="date" />
                    </div>
                    <div class="col-lg-5">
                        <input type="text" class="form-control" name="keyword" placeholder="Type here..." />
                    </div>
                    <div class="col-lg-2">
                        <button type="submit" class="btn btn-primary">
                            <i class="ti ti-search"></i>&nbsp;Search
                        </button>
                    </div>
                </form>
                <div class="row row-cards">
                    <div class="space-y">
                        <?php if(empty($video)){ ?>
                        <div class="alert alert-warning" role="alert">No video(s) Has Been Added Yet</div>
                        <?php }else { ?>
                        <div class="row row-cards" id="results">
                            <?php foreach($video as $row): ?>
                            <div class="col-sm-6 col-lg-4">
                                <div class="card card-sm">
                                    <a href="<?=site_url('latest/watch/play/')?><?=$row['Token']?>" target="_blank">
                                        <video src="<?=base_url('assets/videos/')?><?=$row['file']?>"
                                            class="card-img-top"></video>
                                    </a>
                                    <div class="card-body">
                                        <div class="d-flex align-items-center">
                                            <span class="avatar avatar-2 me-3 rounded"
                                                style="background-image: url(<?=base_url('assets/images/logo.jpg')?>);"></span>
                                            <div style="width:100%;">
                                                <a href="<?=site_url('latest-videos/watch/')?><?=$row['Token']?>"
                                                    target="_blank">
                                                    <?=substr($row['file_name'],0,40) ?>...
                                                </a><br />
                                                <small><?php echo substr($row['description'],0,50) ?>...</small>
                                                <div class="text-secondary">
                                                    <div class="row g-3">
                                                        <div class="col-lg-6">
                                                            <?=date('M,d Y',strtotime($row['date']))?>
                                                        </div>
                                                        <div class="col-lg-6">
                                                            <a href="<?=site_url('videos/edit/')?><?=$row['Token']?>"
                                                                style="float:right;">
                                                                <i class="ti ti-edit"></i>&nbsp;Edit Video
                                                            </a>
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
<?= view('main/templates/footer')?>
<script>
$('#frmSearch').on('submit', function(e) {
    e.preventDefault();
    let data = $(this).serialize();
    $.ajax({
        url: "<?=site_url('filter-videos')?>",
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