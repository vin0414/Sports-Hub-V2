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
                                    <i class="ti ti-list"></i>&nbsp;Teams Application
                                </a>
                            </li>
                        </ul>
                    </div>
                    <div class="card-body">
                        <div class="tab-content">
                            <div class="tab-pane fade active show" id="tabs-pending-8">
                                <div class="table-responsive">
                                    <table class="table table-bordered table-striped" id="table1">
                                        <thead>
                                            <th>#</th>
                                            <th>Complete Name</th>
                                            <th>Email</th>
                                            <th>Account Type</th>
                                            <th>Contact #</th>
                                            <th>Address</th>
                                            <th>File</th>
                                            <th>Action</th>
                                        </thead>
                                        <tbody id="pending">

                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="tabs-approved-8">
                                <div class="table-responsive">
                                    <table class="table table-bordered table-striped" id="table2">
                                        <thead>
                                            <th>Complete Name</th>
                                            <th>Email</th>
                                            <th>Account Type</th>
                                            <th>Contact #</th>
                                            <th>Files</th>
                                        </thead>
                                        <tbody id="approve">

                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="tabs-new-8">
                                <div class="table-responsive">
                                    <table class="table table-bordered table-striped" id="table3">
                                        <thead>
                                            <th>Name of Team</th>
                                            <th>Organization</th>
                                            <th>School/Barangay</th>
                                            <th>Coach</th>
                                            <th>Action</th>
                                        </thead>
                                        <tbody id="team">

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
window.addEventListener('DOMContentLoaded', () => {
    pending();
    approve();
    team();
});

$(document).on('click', '.reject', function() {
    Swal.fire({
        title: 'Are you sure?',
        text: "Do you want to reject this request?",
        icon: 'question',
        showCancelButton: true,
        confirmButtonText: 'Continue',
        cancelButtonText: 'No, cancel!',
    }).then((result) => {
        if (result.isConfirmed) {
            const value = $(this).val();
            $.ajax({
                url: "/roster/reject",
                method: "POST",
                data: {
                    value: value
                },
                success: function(response) {
                    if (response.success) {
                        location.reload();
                    } else {
                        alert(response);
                    }
                }
            });
        }
    });
});

$(document).on('click', '.approve', function() {
    Swal.fire({
        title: 'Are you sure?',
        text: "Do you want to accept this request?",
        icon: 'question',
        showCancelButton: true,
        confirmButtonText: 'Continue',
        cancelButtonText: 'No, cancel!',
    }).then((result) => {
        if (result.isConfirmed) {
            const value = $(this).val();
            $.ajax({
                url: "/roster/confirmation",
                method: "POST",
                data: {
                    value: value
                },
                success: function(response) {
                    if (response.success) {
                        location.reload();
                    } else {
                        alert(response);
                    }
                }
            });
        }
    });
});

$(document).on('click', '.approveTeam', function() {
    Swal.fire({
        title: 'Are you sure?',
        text: "Do you want to continue?",
        icon: 'question',
        showCancelButton: true,
        confirmButtonText: 'Continue',
        cancelButtonText: 'No, cancel!',
    }).then((result) => {
        if (result.isConfirmed) {
            const value = $(this).val();
            $.ajax({
                url: "/roster/verify",
                method: "POST",
                data: {
                    value: value
                },
                success: function(response) {
                    if (response.success) {
                        team();
                    } else {
                        alert(response);
                    }
                }
            });
        }
    });
});

function team() {
    fetch('/roster/team')
        .then(response => {
            if (!response.ok) {
                throw new Error('Network response was not ok');
            }
            return response.json();
        })
        .then(data => {
            const tbody = document.getElementById('team');
            data.team.forEach(item => {
                const row = document.createElement('tr');
                row.innerHTML = `
            <td>${item.team_name}</td>
            <td>${item.organization}</td>
            <td>${item.school_barangay}</td>
            <td>${item.coach_name}</td>
            <td>
                <button type="button" class="btn btn-primary approveTeam" value="${item.team_id}">Accept</button>
            </td>
        `;
                tbody.appendChild(row);
            });

            // Initialize or reinitialize DataTable
            if ($.fn.DataTable.isDataTable('#table3')) {
                $('#table3').DataTable().clear().destroy();
            }
            $('#table3').DataTable();
        })
        .catch(error => console.error('There was a problem with your fetch operation:', error));
}


function approve() {
    fetch('/roster/approve')
        .then(response => {
            if (!response.ok) {
                throw new Error('Network response was not ok');
            }
            return response.json();
        })
        .then(data => {
            const tbody = document.getElementById('approve');
            data.approve.forEach(item => {
                const row = document.createElement('tr');
                row.innerHTML = `
            <td>${item.fullname}</td>
            <td>${item.email}</td>
            <td>${item.application_type}</td>
            <td>${item.phone}</td>
            <td><a href="<?=base_url('assets/files/')?>${item.file}" target="_blank">${item.file}</a></td>
        `;
                tbody.appendChild(row);
            });

            // Initialize or reinitialize DataTable
            if ($.fn.DataTable.isDataTable('#table2')) {
                $('#table2').DataTable().clear().destroy();
            }
            $('#table2').DataTable();
        })
        .catch(error => console.error('There was a problem with your fetch operation:', error));
}

function pending() {
    fetch('/roster/pending')
        .then(response => {
            if (!response.ok) {
                throw new Error('Network response was not ok');
            }
            return response.json();
        })
        .then(data => {
            const tbody = document.getElementById('pending');
            data.pending.forEach(item => {
                const row = document.createElement('tr');
                row.innerHTML = `
            <td>${item.register_id}</td>
            <td>${item.fullname}</td>
            <td>${item.email}</td>
            <td>${item.application_type}</td>
            <td>${item.phone}</td>
            <td>${item.address}</td>
            <td><a href="<?=base_url('assets/files/')?>${item.file}" target="_blank">${item.file}</a></td>
            <td>
                <button type="button" class="btn dropdown-toggle"
                    data-bs-toggle="dropdown" data-bs-auto-close="outside"
                    role="button">
                    <span>Action</span>
                </button>
                <div class="dropdown-menu">
                    <button type="button" class="dropdown-item approve" value="${item.register_id}"><i class="ti ti-check"></i>&nbsp;Accept</button>
                    <button type="button" class="dropdown-item reject" value="${item.register_id}"><i class="ti ti-trash"></i>&nbsp;Reject</button>
                </div
            </td>
        `;
                tbody.appendChild(row);
            });

            // Initialize or reinitialize DataTable
            if ($.fn.DataTable.isDataTable('#table1')) {
                $('#table1').DataTable().clear().destroy();
            }
            $('#table1').DataTable();
        })
        .catch(error => console.error('There was a problem with your fetch operation:', error));
}
</script>
<?= view('main/templates/closing')?>