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
                            <a href="<?=site_url('matches/create')?>"
                                class="btn btn-primary btn-5 d-none d-sm-inline-block">
                                <i class="ti ti-plus"></i>&nbsp;Create
                            </a>
                            <a href="<?=site_url('matches/create')?>" class="btn btn-primary btn-6 d-sm-none btn-icon">
                                <i class="ti ti-plus"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- END PAGE HEADER -->
        <div class="page-body">
            <div class="container-xl">
                <div class="card">
                    <div class="card-body">
                        <div class="card-title"><i class="ti ti-list"></i>&nbsp;Upcoming Matches</div>
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped" id="table">
                                <thead>
                                    <th>Date</th>
                                    <th>Time</th>
                                    <th>Tournament</th>
                                    <th>Bracket</th>
                                    <th>Home</th>
                                    <th>Away</th>
                                    <th>Venue</th>
                                    <th>Status</th>
                                    <th>Remarks</th>
                                    <th>Action</th>
                                </thead>
                                <tbody>
                                    <?php foreach($match as $row):?>
                                    <tr>
                                        <td><?=$row->date ?? 'TBD' ?></td>
                                        <td><?=$row->time ?? 'TBD' ?></td>
                                        <td><?=$row->tournament?></td>
                                        <td><?=$row->match?></td>
                                        <td><?=$row->home?></td>
                                        <td><?=$row->away?></td>
                                        <td><?=$row->location?></td>
                                        <td><?=$row->status ? 'Active' : 'Cancelled'?></td>
                                        <td><?=$row->result?></td>
                                        <td>
                                            <a href="<?=site_url('matches/edit/')?><?=$row->match_id?>"
                                                class="btn btn-primary">
                                                <i class="ti ti-edit"></i>&nbsp;Edit
                                            </a>
                                        </td>
                                    </tr>
                                    <?php endforeach;?>
                                </tbody>
                            </table>
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