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
                            <a href="<?=site_url('videos')?>" class="btn btn-primary btn-5 d-none d-sm-inline-block">
                                <i class="ti ti-arrow-left"></i>&nbsp;Back
                            </a>
                            <a href="<?=site_url('videos')?>" class="btn btn-primary btn-6 d-sm-none btn-icon">
                                <i class="ti ti-arrow-left"></i>
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
                <div class="row g-3">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="card-title"><?=$title?></div>
                                <form method="POST" class="row g-3" enctype="multipart/form-data" id="frmUpload">
                                    <?=csrf_field()?>
                                    <div class="col-lg-12">
                                        <div class="row g-3">
                                            <div class="col-lg-8">
                                                <div class="row g-2">
                                                    <div class="col-lg-12">
                                                        <label class="form-label">Title</label>
                                                        <input type="text" class="form-control" name="title" required />
                                                        <div id="title-error" class="error-message text-danger text-sm">
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-12">
                                                        <div class="row g-3">
                                                            <div class="col-lg-6">
                                                                <label class="form-label">Category</label>
                                                                <select name="category" class="form-select">
                                                                    <option value="">Choose</option>
                                                                    <?php foreach($sports as $row): ?>
                                                                    <option><?=$row['Name'] ?></option>
                                                                    <?php endforeach; ?>
                                                                </select>
                                                                <div id="category-error"
                                                                    class="error-message text-danger text-sm"></div>
                                                            </div>
                                                            <div class="col-lg-6">
                                                                <label class="form-label">Date</label>
                                                                <input type="date" class="form-control" name="date"
                                                                    required />
                                                                <div id="date-error"
                                                                    class="error-message text-danger text-sm"></div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-12">
                                                        <label class="form-label">Details</label>
                                                        <textarea name="details" class="form-control"
                                                            style="height:150px;" required></textarea>
                                                        <div id="details-error"
                                                            class="error-message text-danger text-sm"></div>
                                                    </div>
                                                    <div class="col-lg-12">
                                                        <label class="form-label">Attach</label>
                                                        <input type="file" id="video-upload" name="file"
                                                            class="form-control" accept="video/*" required />
                                                        <div id="file-error" class="error-message text-danger text-sm">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-4">
                                                <div class="row g-3">
                                                    <div class="col-lg-12">
                                                        <label class="form-label">Video Preview</label>
                                                        <video id="video-preview" width="100%" controls>
                                                            <source id="video-source" type="video/mp4">
                                                            Your browser does not support the video tag.
                                                        </video>
                                                    </div>
                                                    <div class="col-lg-12">
                                                        <div class="row">
                                                            <div class="col-lg-6">
                                                                <label class="form-label">File size</label>
                                                                <input type="text" class="form-control" name="size"
                                                                    id="size" readonly />
                                                            </div>
                                                            <div class="col-lg-6">
                                                                <label class="form-label">Type of File</label>
                                                                <input type="text" class="form-control" name="file_type"
                                                                    id="file_type" readonly />
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <button type="submit" class="btn btn-primary" id="btnSubmit"><i
                                                class="ti ti-device-floppy"></i>&nbsp;Save Video</button>
                                        <button type="button" class="btn btn-primary" id="loading"
                                            style="display:none;">Loading....</button>
                                    </div>
                                </form>
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
document.getElementById('video-upload').addEventListener('change', function(event) {
    const file = event.target.files[0];

    if (file && file.type.startsWith('video')) {
        const videoPreview = document.getElementById('video-preview');
        const videoSource = document.getElementById('video-source');

        const videoUrl = URL.createObjectURL(file);
        videoSource.src = videoUrl;

        // Show the video preview
        videoPreview.style.display = 'block';

        // Load and play the video
        videoPreview.load();
        videoPreview.pause();
        $('#size').attr("value", (file.size / (1024 * 1024)).toFixed(2) + "MB");
        $('#file_type').attr("value", file.type);
    } else {
        alert('Please upload a valid video file.');
    }
});

$('#frmUpload').on('submit', function(e) {
    e.preventDefault();
    $('.error-message').html('');
    var formData = new FormData(this);
    $.ajax({
        url: "<?=site_url('save-video')?>",
        method: "POST",
        data: formData,
        contentType: false,
        cache: false,
        processData: false,
        beforeSend: function() {
            $('#loading').show();
            $('#btnSubmit').hide();
        },
        success: function(response) {
            $('#loading').hide();
            $('#btnSubmit').show();
            if (response.success) {
                $('#frmUpload')[0].reset();
                Swal.fire({
                    title: 'Great!',
                    text: "Successfully uploaded",
                    icon: 'success',
                    confirmButtonText: 'Continue'
                }).then((result) => {
                    // Action based on user's choice
                    if (result.isConfirmed) {
                        // Perform some action when "Yes" is clicked
                        location.href = "<?=base_url('videos')?>";
                    }
                });
            } else {
                var errors = response.error;
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