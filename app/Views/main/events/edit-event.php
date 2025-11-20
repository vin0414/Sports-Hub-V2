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
                                <i class="ti ti-arrow-left"></i>&nbsp;Back
                            </a>
                            <a href="<?=site_url('events/manage')?>" class="btn btn-primary btn-6 d-sm-none btn-icon">
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
                <div class="card">
                    <div class="card-body">
                        <div class="card-title">New Event</div>
                        <form method="POST" class="row g-3" id="frmEvent">
                            <?=csrf_field()?>
                            <input type="hidden" name="id" value="<?=$event['event_id']?>">
                            <div class="col-lg-12">
                                <label class="form-label">Event Title</label>
                                <input type="text" class="form-control" name="event_title"
                                    value="<?=$event['event_title']?>" />
                                <div id="event_title-error" class="error-message text-danger text-sm"></div>
                            </div>
                            <div class="col-lg-12">
                                <label class="form-label">Description</label>
                                <div id="editor" class="form-control" style="height:200px;">
                                    <?=$event['event_description']?></div>
                                <div id="details-error" class="error-message text-danger text-sm">
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <label class="form-label">Location</label>
                                <textarea class="form-control"
                                    name="event_location"><?=$event['event_location']?></textarea>
                                <div id="event_location-error" class="error-message text-danger text-sm">
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="row g-3">
                                    <div class="col-lg-2">
                                        <label class="form-label">Event Type</label>
                                        <select name="event_type" class="form-select">
                                            <option value="">Choose</option>
                                            <option <?=($event['event_type']=='Competition') ? 'selected': '' ?>>
                                                Competition</option>
                                            <option <?=($event['event_type']=='Practice Game') ? 'selected': '' ?>>
                                                Practice Game</option>
                                            <option <?=($event['event_type']=='Friendly Match') ? 'selected': '' ?>>
                                                Friendly Match
                                            </option>
                                        </select>
                                        <div id="event_type-error" class="error-message text-danger text-sm"></div>
                                    </div>
                                    <div class="col-lg-2">
                                        <label class="form-label">Registration</label>
                                        <select name="event_status" class="form-select">
                                            <option value="">Choose</option>
                                            <option value="1">OPEN</option>
                                            <option value="0">CLOSE</option>
                                        </select>
                                        <div id="event_status-error" class="error-message text-danger text-sm"></div>
                                    </div>
                                    <div class="col-lg-2">
                                        <label class="form-label">Sports</label>
                                        <select name="sports" class="form-select">
                                            <option value="">Choose</option>
                                            <?php foreach($sports as $row): ?>
                                            <option value="<?=$row['sportsID']?>"
                                                <?=($event['sportsID']==$row['sportsID']) ? 'selected': '' ?>>
                                                <?=$row['Name']?></option>
                                            <?php endforeach; ?>
                                        </select>
                                        <div id="sports-error" class="error-message text-danger text-sm">
                                        </div>
                                    </div>
                                    <div class="col-lg-3">
                                        <label class="form-label">From</label>
                                        <input type="datetime-local" class="form-control" name="from_date"
                                            value="<?=$event['start_date']?>" />
                                        <div id="from_date-error" class="error-message text-danger text-sm">
                                        </div>
                                    </div>
                                    <div class="col-lg-3">
                                        <label class="form-label">To</label>
                                        <input type="datetime-local" class="form-control" name="to_date"
                                            value="<?=$event['end_date']?>" />
                                        <div id="to_date-error" class="error-message text-danger text-sm">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <button type="submit" class="btn btn-primary">
                                    <i class="ti ti-send-2"></i>&nbsp;Save Changes
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?= view('main/templates/footer')?>
<script>
const quill = new Quill('#editor', {
    theme: 'snow'
});
$('#frmEvent').on('submit', function(e) {
    e.preventDefault();
    $('.error-message').html('');
    var details = document.querySelector('.ql-editor').innerHTML;
    $('#frmEvent').append("<textarea name='details' style='display:none;'>" + details + "</textarea>");
    let data = $(this).serialize();
    $.ajax({
        url: "<?=site_url('edit-event')?>",
        method: "POST",
        data: new FormData(this),
        contentType: false,
        cache: false,
        processData: false,
        success: function(response) {
            if (response.success) {
                $('#frmEvent')[0].reset();
                Swal.fire({
                    title: 'Great!',
                    text: "Successfully applied changes",
                    icon: 'success',
                    confirmButtonText: 'Continue'
                }).then((result) => {
                    // Action based on user's choice
                    if (result.isConfirmed) {
                        // Perform some action when "Yes" is clicked
                        location.href = "<?=base_url('events/manage')?>";
                    }
                });
            } else {
                var errors = response.errors;
                // Iterate over each error and display it under the corresponding input field
                for (var field in errors) {
                    $('#' + field + '-error').html('<p>' + errors[field] +
                        '</p>'); // Show the first error message
                    $('#' + field).addClass(
                        'text-danger'); // Highlight the input field with an error
                }
            }
        }
    });
});
</script>
<?= view('main/templates/closing')?>