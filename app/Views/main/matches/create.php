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
                                <div class="card-title"><?=$title?></div>
                                <form method="POST" class="row g-3" id="frmCreate">
                                    <?=csrf_field()?>
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
                                            </div>
                                            <div class="col-lg-6">
                                                <label class="form-label">Status</label>
                                                <select class="form-select" name="status">
                                                    <option value="All">All Team</option>
                                                    <option value="1">Active</option>
                                                    <option value="0">Inactive</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <label class="form-label">Location/Venue</label>
                                        <textarea name="location" class="form-control"></textarea>
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
<?= view('main/templates/footer')?>
<script>
$('#table').DataTable();
</script>
<?= view('main/templates/closing')?>