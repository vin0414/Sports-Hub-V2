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
                            <a href="<?=site_url('events/manage')?>"
                                class="btn btn-primary btn-5 d-none d-sm-inline-block">
                                <i class="ti ti-calendar"></i>&nbsp;Manage Events
                            </a>
                            <a href="<?=site_url('events/manage')?>" class="btn btn-primary btn-6 d-sm-none btn-icon">
                                <i class="ti ti-calendar"></i>
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
                <div id='calendar'></div>
            </div>
        </div>
    </div>
</div>
<?= view('main/templates/footer')?>
<script src='https://cdn.jsdelivr.net/npm/fullcalendar@6.1.15/index.global.min.js'></script>
<script>
<?php $eventData = array();?>
<?php 
        $eventModel = new \App\Models\eventModel();
        $event = $eventModel->WHERE('Status',1)->findAll();
        foreach($event as $row)
        {
            $tempArray = array( "title" =>$row['event_title'],"description" =>$row['event_description'],"start" => $row['start_date'],"end" => $row['end_date']);
            array_push($eventData, $tempArray);
        }
      ?>
const jsonData = <?php echo json_encode($eventData); ?>;
var calendar = new FullCalendar.Calendar(document.getElementById("calendar"), {
    initialView: "dayGridMonth",
    headerToolbar: {
        start: 'title', // will normally be on the left. if RTL, will be on the right
        center: '',
        end: 'today prev,next' // will normally be on the right. if RTL, will be on the left
    },
    selectable: true,
    editable: true,
    events: jsonData,
    views: {
        // Customize the timeGridWeek and timeGridDay views
        timeGridWeek: {
            buttonText: 'Week'
        },
        timeGridDay: {
            buttonText: 'Day'
        },
    }
});

calendar.render();
</script>
<?= view('main/templates/closing')?>