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
var calendar = new FullCalendar.Calendar(document.getElementById("calendar"), {
    initialView: "dayGridMonth",
    headerToolbar: {
        start: 'title', // will normally be on the left. if RTL, will be on the right
        center: '',
        end: 'today prev,next' // will normally be on the right. if RTL, will be on the left
    },
    selectable: true,
    editable: true,
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