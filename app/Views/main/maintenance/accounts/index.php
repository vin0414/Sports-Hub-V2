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
                            <a href="<?=site_url('accounts/create')?>"
                                class="btn btn-primary btn-5 d-none d-sm-inline-block">
                                <i class="ti ti-plus"></i>&nbsp;New Account
                            </a>
                            <a href="<?=site_url('accounts/create')?>" class="btn btn-primary btn-6 d-sm-none btn-icon">
                                <i class="ti ti-plus"></i>
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
                <div class="row row-deck row-cards">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="card-title"><?=$title?></div>
                                <div class="table-responsive">
                                    <table class="table table-bordered table-striped" id="tblaccounts">
                                        <thead>
                                            <th>#</th>
                                            <th>Email</th>
                                            <th>Fullname</th>
                                            <th>System Role</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </thead>
                                        <tbody>

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
var department = $('#tblaccounts').DataTable({
    "processing": true,
    "serverSide": true,
    "ajax": {
        "url": "<?=site_url('fetch-accounts')?>",
        "type": "GET",
        "dataSrc": function(json) {
            // Handle the data if needed
            return json.data;
        },
        "error": function(xhr, error, code) {
            console.error("AJAX Error: " + error);
            alert("Error occurred while loading data.");
        }
    },
    "searching": true,
    "columns": [{
            "data": "id"
        },
        {
            "data": "email"
        },
        {
            "data": "fullname"
        },
        {
            "data": "role"
        },
        {
            "data": "status"
        },
        {
            "data": "action"
        }
    ]
});

$(document).on('click', '.reset', function() {
    Swal.fire({
        title: 'Are you sure?',
        text: "Do you want to reset the password of this account?",
        icon: 'question',
        showCancelButton: true,
        confirmButtonText: 'Continue',
        cancelButtonText: 'No, cancel!',
    }).then((result) => {
        // Action based on user's choice
        if (result.isConfirmed) {
            $.ajax({
                url: "<?=site_url('reset')?>",
                method: "POST",
                data: {
                    value: $(this).val()
                },
                success: function(response) {
                    if (response.success) {
                        Swal.fire({
                            title: 'Great!',
                            text: "Successfully reset the account",
                            icon: 'success',
                        })
                    } else {
                        alert(response);
                    }
                }
            });
        }
    });
});
</script>

<?= view('main/templates/closing')?>