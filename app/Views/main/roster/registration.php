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
                <div class="card">
                    <div class="card-header">
                        <ul class="nav nav-tabs card-header-tabs" data-bs-toggle="tabs">
                            <li class="nav-item">
                                <a href="#tabs-pending-8" class="nav-link active" data-bs-toggle="tab">
                                    <i class="ti ti-file-spark"></i>&nbsp;Pending
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="#tabs-approved-8" class="nav-link" data-bs-toggle="tab">
                                    <i class="ti ti-file-like"></i>&nbsp;Approved
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="#tabs-new-8" class="nav-link" data-bs-toggle="tab">
                                    <i class="ti ti-list"></i>&nbsp;New Teams/Players
                                </a>
                            </li>
                        </ul>
                    </div>
                    <div class="card-body">
                        <div class="tab-content">
                            <div class="tab-pane fade active show" id="tabs-pending-8">
                                <div class="table-responsive">
                                    <table class="table table-bordered table-striped">
                                        <thead>
                                            <th>#</th>
                                            <th>Complete Name</th>
                                            <th>Email</th>
                                            <th>Role</th>
                                            <th>Contact #</th>
                                            <th>Age</th>
                                            <th>Address</th>
                                            <th>Action</th>
                                        </thead>
                                        <tbody id="pending">

                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="tabs-approved-8">
                                <div class="table-responsive">
                                    <table class="table table-bordered table-striped">
                                        <thead>
                                            <th>Complete Name</th>
                                            <th>Email</th>
                                            <th>Role</th>
                                            <th>Contact #</th>
                                            <th>Age</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </thead>
                                        <tbody>

                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="tabs-new-8">

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
fetch('/roster/pending')
    .then(response => {
        if (!response.ok) {
            throw new Error('Network response was not ok');
        }
        return response.json();
    })
    .then(data => {
        const tbody = document.getElementById('pending');
        const row = document.createElement('tr');
        row.innerHTML = `
          <td>${data.register_id}</td>
          <td>${data.fullname}</td>
          <td>${data.email}</td>
          <td>${data.application_type}</td>
          <td>${data.phone}</td>
          <td>${data.birth_date}</td>
          <td>${data.address}</td>
          <td></td>
        `;

        tbody.appendChild(row);
    })
    .catch(error => console.error('There was a problem with your fetch operation:', error));
</script>
<?= view('main/templates/closing')?>