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
                            <a href="<?=site_url('events')?>" class="btn btn-default">
                                <i class="ti ti-arrow-left"></i>&nbsp;Back
                            </a>
                            <a href="<?=site_url('events/create')?>"
                                class="btn btn-primary btn-5 d-none d-sm-inline-block">
                                <i class="ti ti-calendar-plus"></i>&nbsp;Create Event
                            </a>
                            <a href="<?=site_url('events/create')?>" class="btn btn-primary btn-6 d-sm-none btn-icon">
                                <i class="ti ti-calendar-plus"></i>
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
                        <div class="card-title">
                            <i class="ti ti-calendar"></i>&nbsp;Manage Events
                        </div>
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped" id="table">
                                <thead>
                                    <th>Event</th>
                                    <th>Details</th>
                                    <th>Location</th>
                                    <th>From</th>
                                    <th>To</th>
                                    <th>Action</th>
                                </thead>
                                <tbody>
                                    <?php foreach($events as $row): ?>
                                    <tr>
                                        <td><?=$row['event_title']?></td>
                                        <td><?=substr($row['event_description'],0,200)?>...</td>
                                        <td><?=$row['event_location']?></td>
                                        <td><?=date('F d, Y',strtotime($row['start_date']))?></td>
                                        <td><?=date('F d, Y',strtotime($row['end_date']))?></td>
                                        <td>
                                            <a href="<?=site_url('events/edit/')?><?=$row['event_id']?>"
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