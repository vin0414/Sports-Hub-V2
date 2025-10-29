<?=view('main/templates/header')?>
<?=view('main/templates/main-template')?>
<div class="page-wrapper">
    <div class="page-body">
        <div class="container-xl">
            <div id='calendar'></div>
        </div>
    </div>
</div>
<?= view('main/templates/footer')?>
<script src='https://cdn.jsdelivr.net/npm/fullcalendar@6.1.15/index.global.min.js'></script>
<script>
<?php $eventData = array();?>
<?php 
    $db = \Config\Database::connect();
    $builder = $db->table('matches as a')
                ->select("a.tournament,a.date,a.time,CONCAT(b.team_name,' VS ',c.team_name)team_name")
                ->join('teams as b','b.team_id=a.team1_id','LEFT')
                ->join('teams as c','c.team_id=a.team2_id','LEFT')
                ->groupBy('a.match_id');
    $event = $builder->get()->getResult();
    foreach($event as $row)
    {
        $tempArray = array( 
            "title" =>$row->team_name,
            "description" =>$row->tournament,
            "start" => $row->date." ".$row->time,
            "end" => $row->date." ".$row->time
        );
        array_push($eventData, $tempArray);
    }
?>
const jsonData = <?php echo json_encode($eventData); ?>;
var calendar = new FullCalendar.Calendar(document.getElementById("calendar"), {
    initialView: "dayGridMonth",
    headerToolbar: {
        start: 'title', // will normally be on the left. if RTL, will be on the right
        center: '',
        end: 'today dayGridMonth listWeek listDay prev,next' // will normally be on the right. if RTL, will be on the left
    },
    buttonText: {
        today: 'Today',
        month: 'Month',
        listWeek: 'Week',
        listDay: 'Day'
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