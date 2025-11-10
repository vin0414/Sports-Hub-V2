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
                </div>
            </div>
        </div>
        <!-- END PAGE HEADER -->
        <div class="page-body">
            <div class="container-xl">
                <div class="card">
                    <div class="card-body">
                        <div class="card-title">Scoreboard</div>
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped" id="table">
                                <thead>
                                    <th>Date</th>
                                    <th>Time</th>
                                    <th>Match</th>
                                    <th>Action</th>
                                </thead>
                                <tbody>
                                    <?php foreach($match as $row): ?>
                                    <tr>
                                        <td><?=date('F d, Y', strtotime($row->date))?></td>
                                        <td><?=date('h:i:s a',strtotime($row->time))?></td>
                                        <td><?=$row->home ?> [<?=($row->team1_score) ? $row->team1_score : 0 ?>] VS
                                            <?=$row->away?>
                                            [<?=($row->team2_score) ? $row->team2_score : 0 ?>]</td>
                                        <td>
                                            <a href="<?=site_url('scoreboard/add/')?><?=$row->match_id?>"
                                                class="btn btn-primary">
                                                <i class="ti ti-arrow-right"></i>&nbsp;Proceed
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