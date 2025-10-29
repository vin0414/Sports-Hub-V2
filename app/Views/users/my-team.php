<?=view('main/templates/header')?>
<?=view('main/templates/main-template')?>
<div class="page-wrapper">
    <div class="page-header d-print-none">
        <div class="container-xl">
            <div class="row g-2 align-items-center">
                <div class="col">
                    <h2 class="page-title">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                            stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                            class="icon icon-tabler icons-tabler-outline icon-tabler-users-group">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                            <path d="M10 13a2 2 0 1 0 4 0a2 2 0 0 0 -4 0" />
                            <path d="M8 21v-1a2 2 0 0 1 2 -2h4a2 2 0 0 1 2 2v1" />
                            <path d="M15 5a2 2 0 1 0 4 0a2 2 0 0 0 -4 0" />
                            <path d="M17 10h2a2 2 0 0 1 2 2v1" />
                            <path d="M5 5a2 2 0 1 0 4 0a2 2 0 0 0 -4 0" />
                            <path d="M3 13v-1a2 2 0 0 1 2 -2h2" />
                        </svg>
                        <?=$team['team_name']?>
                    </h2>
                </div>
                <div class="col-auto ms-auto d-print-none">
                    <div class="btn-list">
                        <a href="javascript:void(0);" class="btn btn-primary d-none d-sm-inline-block"
                            data-bs-toggle="modal" data-bs-target="#modal-large">
                            <i class="ti ti-calendar-plus"></i>
                            Create Schedule
                        </a>
                        <a href="javascript:void(0);" class="btn btn-primary d-sm-none btn-icon" data-bs-toggle="modal"
                            data-bs-target="#modal-large" aria-label="Create Schedule">
                            <i class="ti ti-calendar-plus"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="page-body">
        <div class="container-xl">
            <div class="card">
                <div class="card-header">
                    <ul class="nav nav-tabs card-header-tabs" data-bs-toggle="tabs">
                        <li class="nav-item">
                            <a href="#tabs-list-8" class="nav-link active" data-bs-toggle="tab">
                                <i class="ti ti-list"></i>&nbsp;List of Players
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="#tabs-new-8" class="nav-link" data-bs-toggle="tab">
                                <i class="ti ti-user-plus"></i>&nbsp;Application
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="#tabs-calendar-8" class="nav-link" data-bs-toggle="tab">
                                <i class="ti ti-calendar-plus"></i>&nbsp;Schedules
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="#tabs-matches-8" class="nav-link" data-bs-toggle="tab">
                                <i class="ti ti-calendar"></i>&nbsp;Upcoming Matches
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="#tabs-stats-8" class="nav-link" data-bs-toggle="tab">
                                <i class="ti ti-scoreboard"></i>&nbsp;Team Stats
                            </a>
                        </li>
                    </ul>
                </div>
                <div class="card-body">
                    <div class="tab-content">
                        <div class="tab-pane fade active show" id="tabs-list-8">
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped" id="table1">
                                    <thead>
                                        <th>Image</th>
                                        <th>Jersey #</th>
                                        <th>Name of Players</th>
                                        <th>Role</th>
                                        <th>Height</th>
                                        <th>Weight</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </thead>
                                    <tbody id="players"></tbody>
                                </table>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="tabs-new-8">
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped" id="table2">
                                    <thead>
                                        <th>Fullname</th>
                                        <th>Email</th>
                                        <th>Contact #</th>
                                        <th>Age</th>
                                        <th>Address</th>
                                        <th>Action</th>
                                    </thead>
                                    <tbody id="list"></tbody>
                                </table>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="tabs-calendar-8">
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped" id="table3">
                                    <thead>
                                        <th>Date</th>
                                        <th>Time</th>
                                        <th>Location</th>
                                        <th>Category</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </thead>
                                    <tbody id="schedules"></tbody>
                                </table>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="tabs-matches-8">
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped" id="table4">
                                    <thead>
                                        <th>Date</th>
                                        <th>Time</th>
                                        <th>Opponent</th>
                                        <th>Location</th>
                                    </thead>
                                    <tbody id="matches"></tbody>
                                </table>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="tabs-stats-8">
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped" id="table5">
                                    <thead>
                                        <th>Date</th>
                                        <th>Time</th>
                                        <th>Player</th>
                                        <th>Games Played</th>
                                        <th>Location</th>
                                        <th>Points Scored</th>
                                    </thead>
                                    <tbody id="stats"></tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="modal" id="modal-loading" data-backdrop="static">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-body text-center">
                <div class="mb-2">
                    <dotlottie-wc src="https://lottie.host/ed13f8d5-bc3f-4786-bbb8-36d06a21a6cb/XMPpTra572.lottie"
                        style="width: 100%;height: auto;" autoplay loop></dotlottie-wc>
                </div>
                <div>Loading</div>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="modal-large" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-md" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Create Schedule</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form method="POST" id="frmCreate">
                    <?=csrf_field()?>
                    <input type="hidden" name="team_id" value="<?=$team['team_id']?>" />
                    <div class="mb-3">
                        <div class="row g-3">
                            <div class="col-lg-6">
                                <label class="form-label" for="date">Date</label>
                                <input type="date" class="form-control" id="date" name="date" />
                                <div id="date-error" class="error-message text-danger text-sm"></div>
                            </div>
                            <div class="col-lg-6">
                                <label class="form-label" for="time">Time</label>
                                <input type="time" class="form-control" id="time" name="time" />
                                <div id="time-error" class="error-message text-danger text-sm"></div>
                            </div>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label" for="location">Location</label>
                        <input type="text" class="form-control" id="location" name="location" />
                        <div id="location-error" class="error-message text-danger text-sm"></div>
                    </div>
                    <div class="mb-3">
                        <div class="row g-3">
                            <div class="col-lg-6">
                                <label class="form-label">Category</label>
                                <select class="form-select" id="category" name="category">
                                    <option>Practice Game</option>
                                    <option>Try-outs</option>
                                </select>
                                <div id="category-error" class="error-message text-danger text-sm"></div>
                            </div>
                            <div class="col-lg-6">
                                <label class="form-label" for="status">Status</label>
                                <select class="form-select" id="status" name="status">
                                    <option value="1">OPEN</option>
                                    <option value="0">CLOSE</option>
                                </select>
                                <div id="status-error" class="error-message text-danger text-sm"></div>
                            </div>
                        </div>
                    </div>
                    <div class="mb-3">
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="editModal" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-md" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit Schedule</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form method="POST" id="frmEdit">
                    <input type="hidden" name="schedule_id" id="schedule_id" />
                    <div class="mb-3">
                        <div class="row g-3">
                            <div class="col-lg-6">
                                <label class="form-label" for="date">Date</label>
                                <input type="date" class="form-control" id="date" name="edit-date" />
                                <div id="edit-date-error" class="error-message text-danger text-sm"></div>
                            </div>
                            <div class="col-lg-6">
                                <label class="form-label" for="time">Time</label>
                                <input type="time" class="form-control" id="time" name="edit-time" />
                                <div id="edit-time-error" class="error-message text-danger text-sm"></div>
                            </div>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label" for="location">Location</label>
                        <input type="text" class="form-control" id="location" name="edit-location" />
                        <div id="edit-location-error" class="error-message text-danger text-sm"></div>
                    </div>
                    <div class="mb-3">
                        <div class="row g-3">
                            <div class="col-lg-6">
                                <label class="form-label">Category</label>
                                <select class="form-select" id="category" name="edit-category">
                                    <option>Practice Game</option>
                                    <option>Try-outs</option>
                                </select>
                                <div id="edit-category-error" class="error-message text-danger text-sm"></div>
                            </div>
                            <div class="col-lg-6">
                                <label class="form-label" for="status">Status</label>
                                <select class="form-select" id="status" name="edit-status">
                                    <option value="1">OPEN</option>
                                    <option value="0">CLOSE</option>
                                </select>
                                <div id="edit-status-error" class="error-message text-danger text-sm"></div>
                            </div>
                        </div>
                    </div>
                    <div class="mb-3">
                        <button type="submit" class="btn btn-primary">Save Changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<?= view('main/templates/footer')?>
<script src="https://unpkg.com/@lottiefiles/dotlottie-wc@0.8.1/dist/dotlottie-wc.js" type="module"></script>
<script>
let table3;
let table1;
let table2;
let table4;
let table5;

function calculateAge(birthDateString) {
    const birthDate = new Date(birthDateString);
    const today = new Date();

    let age = today.getFullYear() - birthDate.getFullYear();
    const monthDiff = today.getMonth() - birthDate.getMonth();
    const dayDiff = today.getDate() - birthDate.getDate();

    // Adjust if birthday hasn't occurred yet this year
    if (monthDiff < 0 || (monthDiff === 0 && dayDiff < 0)) {
        age--;
    }

    return age;
}
$(document).ready(function() {
    const dateInput = document.getElementById('date');
    const today = new Date().toISOString().split('T')[0]; // Format: YYYY-MM-DD
    dateInput.setAttribute('min', today);
    const baseEditUrl = "<?= site_url('roster/players/edit/') ?>";
    const teamId = <?= json_encode($team['team_id']) ?>;
    table1 = $('#table1').DataTable({
        ajax: {
            url: '/roster/player-list',
            data: {
                teamId: teamId
            },
            dataSrc: 'players'
        },
        columns: [{
                data: 'image',
                render: function(image) {
                    if (image) {
                        return `<img src="/assets/images/players/${image}" alt="Player Image" width="50" height="50" style="object-fit:cover; border-radius:50%;">`;
                    } else {
                        return `<img src="/assets/images/players/default.png" alt="Default Image" width="50" height="50" style="object-fit:cover; border-radius:50%;">`;
                    }
                }
            },
            {
                data: 'jersey_num'
            },
            {
                data: 'Fullname'
            },
            {
                data: 'roleName'
            },
            {
                data: 'height'
            },
            {
                data: 'weight'
            },
            {
                data: 'status',
                render: function(status) {
                    return status == 1 ? 'ACTIVE' : 'INACTIVE';
                }
            },
            {
                data: 'player_id',
                render: function(data, type, row) {
                    const player_status = row.status;
                    const id = row.player_id;

                    let dropdown = `
                        <button type="button" class="btn dropdown-toggle"
                            data-bs-toggle="dropdown" data-bs-auto-close="outside"
                            role="button">
                            <span>Action</span>
                        </button>
                    `;

                    if (player_status == 1) {
                        dropdown += `
                            <div class="dropdown-menu">
                                <a href="${baseEditUrl}${id}" class="dropdown-item">
                                    <i class='ti ti-edit'></i>&nbsp;Edit
                                </a>
                                <button type="button" value="${id}" class="dropdown-item withdraw">
                                    <i class="ti ti-logout-2"></i>&nbsp;Withdraw
                                </button>
                            </div>
                        `;
                    } else {
                        dropdown += `
                            <div class="dropdown-menu">
                                <a href="${baseEditUrl}${id}" class="dropdown-item approveTeam">
                                    <i class='ti ti-edit'></i>&nbsp;Edit
                                </a>
                            </div>
                        `;
                    }

                    return dropdown;

                }
            }
        ]
    });

    table2 = $('#table2').DataTable({
        ajax: {
            url: '/roster/new-players',
            data: {
                teamId: teamId
            },
            dataSrc: 'list'
        },
        columns: [{
                data: 'fullname'
            },
            {
                data: 'email'
            },
            {
                data: 'phone'
            },
            {
                data: 'birth_date',
                render: function(date) {
                    return calculateAge(date);
                }
            },
            {
                data: 'address'
            },
            {
                data: 'player_id',
                render: function(id) {
                    return `
                        <button type="button" class="btn btn-primary recruite" value="${id}">
                            <i class='ti ti-circle-check'></i>&nbsp;Recruite
                        </button>
                    `;
                }
            }
        ]
    });

    table3 = $('#table3').DataTable({
        ajax: {
            url: '/roster/schedules',
            data: {
                teamId: teamId
            },
            dataSrc: 'schedules'
        },
        columns: [{
                data: 'date',
                render: function(date) {
                    return new Date(date).toLocaleDateString('en-US', {
                        year: 'numeric',
                        month: 'long',
                        day: '2-digit'
                    });
                }
            },
            {
                data: 'time'
            },
            {
                data: 'location'
            },
            {
                data: 'category'
            },
            {
                data: 'status',
                render: function(status) {
                    return status == 1 ? 'OPEN' : 'CLOSE';
                }
            },
            {
                data: 'schedule_id',
                render: function(id) {
                    return `
                        <button type="button" class="btn btn-primary editSchedule" value="${id}">
                            <i class='ti ti-edit'></i>&nbsp;Edit
                        </button>
                    `;
                }
            }
        ]
    });

    table4 = $('#table4').DataTable({
        ajax: {
            url: '/roster/matches',
            data: {
                teamId: teamId
            },
            dataSrc: 'matches'
        },
        columns: [{
                data: 'date',
                render: function(date) {
                    return new Date(date).toLocaleDateString('en-US', {
                        year: 'numeric',
                        month: 'long',
                        day: '2-digit'
                    });
                }
            },
            {
                data: 'time'
            },
            {
                data: 'team_name'
            },
            {
                data: 'location'
            }
        ]
    });

    table5 = $('#table5').DataTable({
        ajax: {
            url: '/roster/stats',
            data: {
                teamId: teamId
            },
            dataSrc: 'stats'
        },
        columns: [{
                data: 'date',
                render: function(date) {
                    return new Date(date).toLocaleDateString('en-US', {
                        year: 'numeric',
                        month: 'long',
                        day: '2-digit'
                    });
                }
            },
            {
                data: 'time'
            },
            {
                data: 'fullname'
            },
            {
                data: 'team_name'
            },
            {
                data: 'location'
            },
            {
                data: 'points'
            }
        ]
    });
});

$(document).on('click', '.editSchedule', function() {
    const scheduleId = $(this).val();
    $('#modal-loading').modal('show');
    $.ajax({
        url: '<?=site_url('roster/schedules/fetch')?>',
        method: 'GET',
        data: {
            scheduleId: scheduleId
        },
        success: function(response) {
            $('#modal-loading').modal('hide');
            if (response.schedule) {
                const schedule = response.schedule;
                $('#frmEdit input[name="schedule_id"]').val(schedule.schedule_id);
                $('#frmEdit input[name="edit-date"]').val(schedule.date);
                $('#frmEdit input[name="edit-time"]').val(schedule.time);
                $('#frmEdit input[name="edit-location"]').val(schedule.location);
                $('#frmEdit select[name="edit-category"]').val(schedule.category);
                $('#frmEdit select[name="edit-status"]').val(schedule.status);
                $('#editModal').modal('show');
            } else {
                Swal.fire({
                    title: 'Error!',
                    text: 'Failed to fetch schedule details.',
                    icon: 'error',
                    confirmButtonText: 'OK'
                });
            }
        },
        error: function() {
            $('#modal-loading').modal('hide');
            Swal.fire({
                title: 'Error!',
                text: 'An error occurred while fetching schedule details.',
                icon: 'error',
                confirmButtonText: 'OK'
            });
        }
    });
});

$('#frmEdit').on('submit', function(e) {
    e.preventDefault();
    $('.error-message').html('');
    let data = $(this).serialize();
    $('#editModal').modal('hide');
    $('#modal-loading').modal('show');
    $.ajax({
        url: "<?=site_url('roster/schedules/edit')?>",
        method: "POST",
        data: data,
        success: function(response) {
            $('#modal-loading').modal('hide');
            if (response.success) {
                $('#frmEdit')[0].reset();
                Swal.fire({
                    title: 'Great!',
                    text: "Successfully updated",
                    icon: 'success',
                    confirmButtonText: 'Continue'
                }).then((result) => {
                    // Action based on user's choice
                    if (result.isConfirmed) {
                        // Perform some action when "Yes" is clicked
                        table3.ajax.reload();
                    }
                });
            } else {
                $('#editModal').modal('show');
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

$('#frmCreate').on('submit', function(e) {
    e.preventDefault();
    $('.error-message').html('');
    let data = $(this).serialize();
    $('#modal-large').modal('hide');
    $('#modal-loading').modal('show');
    $.ajax({
        url: "<?=site_url('roster/schedules/create')?>",
        method: "POST",
        data: data,
        success: function(response) {
            $('#modal-loading').modal('hide');
            if (response.success) {
                $('#frmCreate')[0].reset();
                Swal.fire({
                    title: 'Great!',
                    text: "Successfully submitted",
                    icon: 'success',
                    confirmButtonText: 'Continue'
                }).then((result) => {
                    // Action based on user's choice
                    if (result.isConfirmed) {
                        // Perform some action when "Yes" is clicked
                        table3.ajax.reload();
                    }
                });
            } else {
                $('#modal-large').modal('show');
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

$(document).on('click', '.withdraw', function() {
    const playerId = $(this).val();
    Swal.fire({
        title: 'Are you sure?',
        text: "You want to withdraw this player!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, withdraw it!'
    }).then((result) => {
        if (result.isConfirmed) {
            $('#modal-loading').modal('show');
            $.ajax({
                url: '<?=site_url('roster/withdraw')?>',
                method: 'POST',
                data: {
                    player_id: playerId
                },
                success: function(response) {
                    $('#modal-loading').modal('hide');
                    if (response.success) {
                        Swal.fire(
                            'Withdrawn!',
                            'Player has been withdrawn.',
                            'success'
                        );
                        table1.ajax.reload();
                    } else {
                        Swal.fire(
                            'Error!',
                            'Failed to withdraw the player.',
                            'error'
                        );
                    }
                },
                error: function() {
                    $('#modal-loading').modal('hide');
                    Swal.fire(
                        'Error!',
                        'An error occurred while processing your request.',
                        'error'
                    );
                }
            });
        }
    });
});

$(document).on('click', '.recruite', function() {
    const playerId = $(this).val();
    Swal.fire({
        title: 'Are you sure?',
        text: "You want to recruite this player!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, recruite it!'
    }).then((result) => {
        if (result.isConfirmed) {
            $('#modal-loading').modal('show');
            $.ajax({
                url: '<?=site_url('roster/recruite')?>',
                method: 'POST',
                data: {
                    player_id: playerId,
                },
                success: function(response) {
                    $('#modal-loading').modal('hide');
                    if (response.success) {
                        Swal.fire(
                            'Recruited!',
                            'Player has been recruited.',
                            'success'
                        );
                        table2.ajax.reload();
                        table1.ajax.reload();
                    } else {
                        Swal.fire(
                            'Error!',
                            'Failed to recruite the player.',
                            'error'
                        );
                    }
                },
                error: function() {
                    $('#modal-loading').modal('hide');
                    Swal.fire(
                        'Error!',
                        'An error occurred while processing your request.',
                        'error'
                    );
                }
            });
        }
    });
});
</script>
<?= view('main/templates/closing')?>