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
                </div>
            </div>
        </div>
        <!-- END PAGE HEADER -->
        <div class="page-body">
            <div class="container-xl">
                <div class="row row-cards">
                    <div class="col-lg-2">
                        <div class="card">
                            <div class="card-body">
                                <div class="card-title"><i class="ti ti-users"></i>&nbsp;Total Users</div>
                                <h1 class="text-center"><?=$total?></h1>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-2">
                        <div class="card">
                            <div class="card-body">
                                <div class="card-title"><i class="ti ti-play-handball"></i>&nbsp;Players</div>
                                <h1 class="text-center"><?=$player?></h1>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-2">
                        <div class="card">
                            <div class="card-body">
                                <div class="card-title"><i class="ti ti-users-group"></i>&nbsp;Teams</div>
                                <h1 class="text-center"><?=$team?></h1>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-2">
                        <div class="card">
                            <div class="card-body">
                                <div class="card-title"><i class="ti ti-calendar"></i>&nbsp;Events</div>
                                <h1 class="text-center"><?=$total_event?></h1>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-2">
                        <div class="card">
                            <div class="card-body">
                                <div class="card-title"><i class="ti ti-brand-youtube"></i>&nbsp;Videos</div>
                                <h1 class="text-center"><?=$video?></h1>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-2">
                        <div class="card">
                            <div class="card-body">
                                <div class="card-title"><i class="ti ti-building-store"></i>&nbsp;Shops</div>
                                <h1 class="text-center"><?=$shop?></h1>
                            </div>
                        </div>
                    </div>
                </div>
                <br />
                <div class="row row-cards">
                    <div class="col-lg-9">
                        <div class="row g-3">
                            <div class="col-lg-12">
                                <div class="row row-cards row-deck">
                                    <div class="col-lg-6">
                                        <div class="card">
                                            <div class="card-body">
                                                <div class="card-title"><i class="ti ti-live-view"></i>&nbsp;Daily Views
                                                </div>
                                                <div id="viewChart"></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="card">
                                            <div class="card-body">
                                                <div class="card-title"><i class="ti ti-trending-up"></i>&nbsp;Viewers
                                                    Trend</div>
                                                <div id="videoChart"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="card-title"><i class="ti ti-cast"></i>&nbsp;Live/Video Streaming
                                        </div>
                                        <div class="table-responsive">
                                            <table class="table table-striped table-bordered" id="tbl_trend">
                                                <thead>
                                                    <th>Filename</th>
                                                    <th>Total Views</th>
                                                    <th>Ave. Duration</th>
                                                </thead>
                                                <tbody>
                                                    <?php foreach($trends as $row): ?>
                                                    <tr>
                                                        <td><?=$row->file_name?></td>
                                                        <td><?=$row->total?></td>
                                                        <td><?=$row->ave_total?></td>
                                                    </tr>
                                                    <?php endforeach; ?>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <div class="card">
                            <div class="card-header">
                                <div class="card-title"><i class="ti ti-calendar-week"></i>&nbsp;Incoming Events
                                </div>
                            </div>
                            <div class="position-relative">
                                <div class="card-table table-responsive">
                                    <table class="table table-vcenter">
                                        <tbody>
                                            <?php if(empty($event)){ ?>
                                            <tr>
                                                <td>
                                                    <center><span>No Event(s) found</span></center>
                                                </td>
                                            </tr>
                                            <?php }else { ?>
                                            <?php foreach($event as $row): ?>
                                            <tr>
                                                <td>
                                                    <b><?php echo $row['event_title'] ?></b><br />
                                                    <small><?php echo substr($row['event_description'],0,50) ?>...</small>
                                                </td>
                                            </tr>
                                            <?php endforeach; ?>
                                            <?php } ?>
                                        </tbody>
                                    </table>
                                </div>
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
$('#tbl_trend').DataTable();
google.charts.setOnLoadCallback(viewCharts);
google.charts.setOnLoadCallback(videoCharts);

function viewCharts() {
    var data = google.visualization.arrayToDataTable([
        ["Date", "Total"],
        <?php 
                    foreach ($views as $row){
                        echo "['".$row->date."',".$row->total."],";
                    }
                    ?>
    ]);

    var options = {
        title: '',
        legend: {
            position: 'bottom'
        },
        backgroundColor: {
            fill: 'transparent'
        },
    };
    /* Instantiate and draw the chart.*/
    var chart = new google.visualization.LineChart(document.getElementById('viewChart'));
    chart.draw(data, options);
}

function videoCharts() {
    var data = google.visualization.arrayToDataTable([
        ["Title", "Total"],
        <?php 
                    foreach ($video_view as $row){
                        echo "['".$row->file_name."',".$row->total."],";
                    }
                    ?>
    ]);

    var options = {
        title: '',
        legend: {
            position: 'bottom'
        },
        backgroundColor: {
            fill: 'transparent'
        },
    };
    /* Instantiate and draw the chart.*/
    var chart = new google.visualization.ColumnChart(document.getElementById('videoChart'));
    chart.draw(data, options);
}
</script>
<?= view('main/templates/closing')?>