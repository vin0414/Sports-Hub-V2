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
                            <a href="javascript:void(0);" class="btn btn-primary btn-5 d-none d-sm-inline-block"
                                data-bs-toggle="modal" data-bs-target="#roleModal">
                                <i class="ti ti-plus"></i>&nbsp;Add Role
                            </a>
                            <a href="javascript:void(0);" class="btn btn-primary btn-6 d-sm-none btn-icon"
                                data-bs-toggle="modal" data-bs-target="#roleModal">
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
                <div class="card">
                    <div class="card-header">
                        <ul class="nav nav-tabs card-header-tabs" data-bs-toggle="tabs">
                            <li class="nav-item">
                                <a href="#tabs-home-8" class="nav-link active" data-bs-toggle="tab">
                                    <i class="ti ti-adjustments-pause"></i>&nbsp;User Permissions
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="#tabs-sports-8" class="nav-link" data-bs-toggle="tab">
                                    <i class="ti ti-olympics"></i>&nbsp;Sports
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="#tabs-profile-8" class="nav-link" data-bs-toggle="tab">
                                    <i class="ti ti-user-pin"></i>&nbsp;Player's Role
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="#tabs-achievement-8" class="nav-link" data-bs-toggle="tab">
                                    <i class="ti ti-target-arrow"></i>&nbsp;Achievements
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="#tabs-activity-8" class="nav-link" data-bs-toggle="tab">
                                    <i class="ti ti-clipboard-data"></i>&nbsp;System Logs
                                </a>
                            </li>
                        </ul>
                    </div>
                    <div class="card-body">
                        <div class="tab-content">
                            <div class="tab-pane fade active show" id="tabs-home-8">
                                <div class="table-responsive">
                                    <table class="table table-bordered table-striped" id="user_permission">
                                        <thead>
                                            <th>Role Name</th>
                                            <th>Roster</th>
                                            <th>Events</th>
                                            <th>Matches</th>
                                            <th>Scoreboard</th>
                                            <th>Videos</th>
                                            <th>News</th>
                                            <th>Shops</th>
                                            <th>Maintenance</th>
                                            <th>Action</th>
                                        </thead>
                                        <tbody></tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="tabs-sports-8">
                                <div class="row g-3">
                                    <div class="col-lg-4">
                                        <div class="card">
                                            <div class="card-body">
                                                <form method="POST" class="row g-3" id="frmSports">
                                                    <?=csrf_field()?>
                                                    <div class="col-lg-12">
                                                        <label>Name of Sports</label>
                                                        <input type="text" class="form-control" name="sports"
                                                            required />
                                                        <div id="sports-error"
                                                            class="error-message text-danger text-sm"></div>
                                                    </div>
                                                    <div class="col-lg-12">
                                                        <button type="submit" class="form-control btn btn-primary">
                                                            <i class="ti ti-device-floppy"></i>&nbsp;Save
                                                        </button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-8">
                                        <div class="card">
                                            <div class="card-body">
                                                <div class="table-responsive">
                                                    <table class="table table-vcenter" id="tblsports">
                                                        <thead>
                                                            <th>#</th>
                                                            <th>Name of Sports</th>
                                                            <th>Date</th>
                                                            <th>Action</th>
                                                        </thead>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="tabs-profile-8">
                                <div class="row g-3">
                                    <div class="col-lg-4">
                                        <div class="card">
                                            <div class="card-body">
                                                <form method="POST" class="row g-3" id="frmRole">
                                                    <?=csrf_field()?>
                                                    <div class="col-lg-12">
                                                        <label>Name of Sports</label>
                                                        <select class="form-control" name="sports_name" required>
                                                            <option value="">Choose</option>
                                                            <?php foreach($sports as $row): ?>
                                                            <option value="<?php echo $row['Name'] ?>">
                                                                <?php echo $row['Name'] ?></option>
                                                            <?php endforeach; ?>
                                                        </select>
                                                        <div id="sports_name-error"
                                                            class="error-message text-danger text-sm"></div>
                                                    </div>
                                                    <div class="col-lg-12">
                                                        <label>Player's Role</label>
                                                        <input type="text" class="form-control" name="role" required />
                                                        <div id="role-error" class="error-message text-danger text-sm">
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-12">
                                                        <button type="submit" class="form-control btn btn-primary">
                                                            <i class="ti ti-device-floppy"></i>&nbsp;Save
                                                        </button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-8">
                                        <div class="card">
                                            <div class="card-body">
                                                <div class="table-responsive">
                                                    <table class="table table-vcenter" id="tblrole">
                                                        <thead>
                                                            <th>#</th>
                                                            <th>Player's Role</th>
                                                            <th>Name of Sports</th>
                                                            <th>Date</th>
                                                            <th>Action</th>
                                                        </thead>
                                                        <tbody></tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="tabs-achievement-8">
                                <div class="row g-3">
                                    <div class="col-lg-4">
                                        <div class="card">
                                            <div class="card-body">
                                                <form method="POST" class="row g-3" id="frmAchievement">
                                                    <?=csrf_field() ?>
                                                    <div class="col-lg-12">
                                                        <label>Title of Achievement</label>
                                                        <input type="text" class="form-control" name="title" required />
                                                        <div id="title-error" class="error-message text-danger text-sm">
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-12">
                                                        <label>Type of Achievement</label>
                                                        <select name="type" class="form-select" required>
                                                            <option value="">Choose</option>
                                                            <option>Team</option>
                                                            <option>Player</option>
                                                        </select>
                                                        <div id="type-error" class="error-message text-danger text-sm">
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-12">
                                                        <label>Description</label>
                                                        <textarea name="description" class="form-control"
                                                            required></textarea>
                                                        <div id="description-error"
                                                            class="error-message text-danger text-sm"></div>
                                                    </div>
                                                    <div class="col-lg-12">
                                                        <label>Criteria (Optional)</label>
                                                        <textarea name="criteria" class="form-control"></textarea>
                                                    </div>
                                                    <div class="col-lg-12">
                                                        <button type="submit" class="form-control btn btn-primary">
                                                            <i class="ti ti-device-floppy"></i>&nbsp;Save
                                                        </button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-8">
                                        <div class="card">
                                            <div class="card-body">
                                                <div class="table-responsive">
                                                    <table class="table table-striped table-bordered"
                                                        id="tblachievement">
                                                        <thead>
                                                            <th>Title</th>
                                                            <th>Type</th>
                                                            <th>Description</th>
                                                            <th>Criteria</th>
                                                            <th>Action</th>
                                                        </thead>
                                                        <tbody></tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="tabs-activity-8">
                                <div class="table-responsive">
                                    <table class="table table-striped" id="tbl_logs">
                                        <thead>
                                            <th>Date</th>
                                            <th>Account Information</th>
                                            <th>Activities</th>
                                            <th>Pages</th>
                                        </thead>
                                        <tbody>
                                            <?php foreach($logs as $row): ?>
                                            <tr>
                                                <td><?php echo $row->date ?></t>
                                                <td><?php echo $row->Fullname ?></td>
                                                <td><?php echo $row->activities ?></td>
                                                <td><?php echo $row->page ?></td>
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
        </div>
    </div>
</div>
<?= view('main/templates/footer')?>
<div class="modal modal-blur fade" id="roleModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-md" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">User Permission</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form method="POST" class="row g-3" autocomplete="off" id="form">
                    <?=csrf_field()?>
                    <div class="col-lg-12">
                        <label class="form-label">Name of Role</label>
                        <input type="text" class="form-control" name="role" id="role" required />
                        <div id="role-error" class="error-message text-danger text-sm"></div>
                    </div>
                    <div class="col-lg-6">
                        <label class="form-label">Roster</label>
                        <div class="form-selectgroup-boxes row mb-3">
                            <div class="col-lg-6">
                                <label class="form-selectgroup-item">
                                    <input type="radio" name="roster" value="1" class="form-selectgroup-input"
                                        required />
                                    <span class="form-selectgroup-label d-flex align-items-center p-3">
                                        <span class="me-3">
                                            <span class="form-selectgroup-check"></span>
                                        </span>
                                        <span class="form-selectgroup-label-content">
                                            <span class="form-selectgroup-title strong mb-1">Yes</span>
                                        </span>
                                    </span>
                                </label>
                            </div>
                            <div class="col-lg-6">
                                <label class="form-selectgroup-item">
                                    <input type="radio" name="roster" value="0" class="form-selectgroup-input" />
                                    <span class="form-selectgroup-label d-flex align-items-center p-3">
                                        <span class="me-3">
                                            <span class="form-selectgroup-check"></span>
                                        </span>
                                        <span class="form-selectgroup-label-content">
                                            <span class="form-selectgroup-title strong mb-1">No</span>
                                        </span>
                                    </span>
                                </label>
                            </div>
                        </div>
                        <div id="roster-error" class="error-message text-danger text-sm"></div>
                    </div>
                    <div class="col-lg-6">
                        <label class="form-label">Events</label>
                        <div class="form-selectgroup-boxes row mb-3">
                            <div class="col-lg-6">
                                <label class="form-selectgroup-item">
                                    <input type="radio" name="events" value="1" class="form-selectgroup-input"
                                        required />
                                    <span class="form-selectgroup-label d-flex align-items-center p-3">
                                        <span class="me-3">
                                            <span class="form-selectgroup-check"></span>
                                        </span>
                                        <span class="form-selectgroup-label-content">
                                            <span class="form-selectgroup-title strong mb-1">Yes</span>
                                        </span>
                                    </span>
                                </label>
                            </div>
                            <div class="col-lg-6">
                                <label class="form-selectgroup-item">
                                    <input type="radio" name="events" value="0" class="form-selectgroup-input" />
                                    <span class="form-selectgroup-label d-flex align-items-center p-3">
                                        <span class="me-3">
                                            <span class="form-selectgroup-check"></span>
                                        </span>
                                        <span class="form-selectgroup-label-content">
                                            <span class="form-selectgroup-title strong mb-1">No</span>
                                        </span>
                                    </span>
                                </label>
                            </div>
                        </div>
                        <div id="events-error" class="error-message text-danger text-sm"></div>
                    </div>
                    <div class="col-lg-6">
                        <label class="form-label">Matches</label>
                        <div class="form-selectgroup-boxes row mb-3">
                            <div class="col-lg-6">
                                <label class="form-selectgroup-item">
                                    <input type="radio" name="matches" value="1" class="form-selectgroup-input"
                                        required />
                                    <span class="form-selectgroup-label d-flex align-items-center p-3">
                                        <span class="me-3">
                                            <span class="form-selectgroup-check"></span>
                                        </span>
                                        <span class="form-selectgroup-label-content">
                                            <span class="form-selectgroup-title strong mb-1">Yes</span>
                                        </span>
                                    </span>
                                </label>
                            </div>
                            <div class="col-lg-6">
                                <label class="form-selectgroup-item">
                                    <input type="radio" name="matches" value="0" class="form-selectgroup-input" />
                                    <span class="form-selectgroup-label d-flex align-items-center p-3">
                                        <span class="me-3">
                                            <span class="form-selectgroup-check"></span>
                                        </span>
                                        <span class="form-selectgroup-label-content">
                                            <span class="form-selectgroup-title strong mb-1">No</span>
                                        </span>
                                    </span>
                                </label>
                            </div>
                        </div>
                        <div id="matches-error" class="error-message text-danger text-sm"></div>
                    </div>
                    <div class="col-lg-6">
                        <label class="form-label">Scoreboard</label>
                        <div class="form-selectgroup-boxes row mb-3">
                            <div class="col-lg-6">
                                <label class="form-selectgroup-item">
                                    <input type="radio" name="score" value="1" class="form-selectgroup-input"
                                        required />
                                    <span class="form-selectgroup-label d-flex align-items-center p-3">
                                        <span class="me-3">
                                            <span class="form-selectgroup-check"></span>
                                        </span>
                                        <span class="form-selectgroup-label-content">
                                            <span class="form-selectgroup-title strong mb-1">Yes</span>
                                        </span>
                                    </span>
                                </label>
                            </div>
                            <div class="col-lg-6">
                                <label class="form-selectgroup-item">
                                    <input type="radio" name="score" value="0" class="form-selectgroup-input" />
                                    <span class="form-selectgroup-label d-flex align-items-center p-3">
                                        <span class="me-3">
                                            <span class="form-selectgroup-check"></span>
                                        </span>
                                        <span class="form-selectgroup-label-content">
                                            <span class="form-selectgroup-title strong mb-1">No</span>
                                        </span>
                                    </span>
                                </label>
                            </div>
                        </div>
                        <div id="score-error" class="error-message text-danger text-sm"></div>
                    </div>
                    <div class="col-lg-6">
                        <label class="form-label">Videos</label>
                        <div class="form-selectgroup-boxes row mb-3">
                            <div class="col-lg-6">
                                <label class="form-selectgroup-item">
                                    <input type="radio" name="videos" value="1" class="form-selectgroup-input"
                                        required />
                                    <span class="form-selectgroup-label d-flex align-items-center p-3">
                                        <span class="me-3">
                                            <span class="form-selectgroup-check"></span>
                                        </span>
                                        <span class="form-selectgroup-label-content">
                                            <span class="form-selectgroup-title strong mb-1">Yes</span>
                                        </span>
                                    </span>
                                </label>
                            </div>
                            <div class="col-lg-6">
                                <label class="form-selectgroup-item">
                                    <input type="radio" name="videos" value="0" class="form-selectgroup-input" />
                                    <span class="form-selectgroup-label d-flex align-items-center p-3">
                                        <span class="me-3">
                                            <span class="form-selectgroup-check"></span>
                                        </span>
                                        <span class="form-selectgroup-label-content">
                                            <span class="form-selectgroup-title strong mb-1">No</span>
                                        </span>
                                    </span>
                                </label>
                            </div>
                        </div>
                        <div id="videos-error" class="error-message text-danger text-sm"></div>
                    </div>
                    <div class="col-lg-6">
                        <label class="form-label">News</label>
                        <div class="form-selectgroup-boxes row mb-3">
                            <div class="col-lg-6">
                                <label class="form-selectgroup-item">
                                    <input type="radio" name="news" value="1" class="form-selectgroup-input" required />
                                    <span class="form-selectgroup-label d-flex align-items-center p-3">
                                        <span class="me-3">
                                            <span class="form-selectgroup-check"></span>
                                        </span>
                                        <span class="form-selectgroup-label-content">
                                            <span class="form-selectgroup-title strong mb-1">Yes</span>
                                        </span>
                                    </span>
                                </label>
                            </div>
                            <div class="col-lg-6">
                                <label class="form-selectgroup-item">
                                    <input type="radio" name="news" value="0" class="form-selectgroup-input" />
                                    <span class="form-selectgroup-label d-flex align-items-center p-3">
                                        <span class="me-3">
                                            <span class="form-selectgroup-check"></span>
                                        </span>
                                        <span class="form-selectgroup-label-content">
                                            <span class="form-selectgroup-title strong mb-1">No</span>
                                        </span>
                                    </span>
                                </label>
                            </div>
                        </div>
                        <div id="news-error" class="error-message text-danger text-sm"></div>
                    </div>
                    <div class="col-lg-6">
                        <label class="form-label">Shops</label>
                        <div class="form-selectgroup-boxes row mb-3">
                            <div class="col-lg-6">
                                <label class="form-selectgroup-item">
                                    <input type="radio" name="shops" value="1" class="form-selectgroup-input"
                                        required />
                                    <span class="form-selectgroup-label d-flex align-items-center p-3">
                                        <span class="me-3">
                                            <span class="form-selectgroup-check"></span>
                                        </span>
                                        <span class="form-selectgroup-label-content">
                                            <span class="form-selectgroup-title strong mb-1">Yes</span>
                                        </span>
                                    </span>
                                </label>
                            </div>
                            <div class="col-lg-6">
                                <label class="form-selectgroup-item">
                                    <input type="radio" name="shops" value="0" class="form-selectgroup-input" />
                                    <span class="form-selectgroup-label d-flex align-items-center p-3">
                                        <span class="me-3">
                                            <span class="form-selectgroup-check"></span>
                                        </span>
                                        <span class="form-selectgroup-label-content">
                                            <span class="form-selectgroup-title strong mb-1">No</span>
                                        </span>
                                    </span>
                                </label>
                            </div>
                        </div>
                        <div id="shops-error" class="error-message text-danger text-sm"></div>
                    </div>
                    <div class="col-lg-6">
                        <label class="form-label">Maintenance</label>
                        <div class="form-selectgroup-boxes row mb-3">
                            <div class="col-lg-6">
                                <label class="form-selectgroup-item">
                                    <input type="radio" name="maintenance" value="1" class="form-selectgroup-input"
                                        required />
                                    <span class="form-selectgroup-label d-flex align-items-center p-3">
                                        <span class="me-3">
                                            <span class="form-selectgroup-check"></span>
                                        </span>
                                        <span class="form-selectgroup-label-content">
                                            <span class="form-selectgroup-title strong mb-1">Yes</span>
                                        </span>
                                    </span>
                                </label>
                            </div>
                            <div class="col-lg-6">
                                <label class="form-selectgroup-item">
                                    <input type="radio" name="maintenance" value="0" class="form-selectgroup-input" />
                                    <span class="form-selectgroup-label d-flex align-items-center p-3">
                                        <span class="me-3">
                                            <span class="form-selectgroup-check"></span>
                                        </span>
                                        <span class="form-selectgroup-label-content">
                                            <span class="form-selectgroup-title strong mb-1">No</span>
                                        </span>
                                    </span>
                                </label>
                            </div>
                        </div>
                        <div id="maintenance-error" class="error-message text-danger text-sm"></div>
                    </div>
                    <div class="col-lg-12">
                        <button type="submit" class="form-control btn btn-primary">
                            <i class="ti ti-device-floppy"></i>&nbsp;Save
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<div class="modal modal-blur fade" id="editRoleModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-md" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit User Permission</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form method="POST" class="row g-3" autocomplete="off" id="formEdit">
                    <?=csrf_field()?>
                    <input type="hidden" name="role_id" id="role_id" />
                    <div class="col-lg-12">
                        <label class="form-label">Name of Role</label>
                        <input type="text" class="form-control" name="edit-role" id="edit-role" required />
                        <div id="edit-role-error" class="error-message text-danger text-sm"></div>
                    </div>
                    <div class="col-lg-6">
                        <label class="form-label">Roster</label>
                        <div class="form-selectgroup-boxes row mb-3">
                            <div class="col-lg-6">
                                <label class="form-selectgroup-item">
                                    <input type="radio" name="edit-roster" value="1" class="form-selectgroup-input"
                                        required />
                                    <span class="form-selectgroup-label d-flex align-items-center p-3">
                                        <span class="me-3">
                                            <span class="form-selectgroup-check"></span>
                                        </span>
                                        <span class="form-selectgroup-label-content">
                                            <span class="form-selectgroup-title strong mb-1">Yes</span>
                                        </span>
                                    </span>
                                </label>
                            </div>
                            <div class="col-lg-6">
                                <label class="form-selectgroup-item">
                                    <input type="radio" name="edit-roster" value="0" class="form-selectgroup-input" />
                                    <span class="form-selectgroup-label d-flex align-items-center p-3">
                                        <span class="me-3">
                                            <span class="form-selectgroup-check"></span>
                                        </span>
                                        <span class="form-selectgroup-label-content">
                                            <span class="form-selectgroup-title strong mb-1">No</span>
                                        </span>
                                    </span>
                                </label>
                            </div>
                        </div>
                        <div id="edit-roster-error" class="error-message text-danger text-sm"></div>
                    </div>
                    <div class="col-lg-6">
                        <label class="form-label">Events</label>
                        <div class="form-selectgroup-boxes row mb-3">
                            <div class="col-lg-6">
                                <label class="form-selectgroup-item">
                                    <input type="radio" name="edit-events" value="1" class="form-selectgroup-input"
                                        required />
                                    <span class="form-selectgroup-label d-flex align-items-center p-3">
                                        <span class="me-3">
                                            <span class="form-selectgroup-check"></span>
                                        </span>
                                        <span class="form-selectgroup-label-content">
                                            <span class="form-selectgroup-title strong mb-1">Yes</span>
                                        </span>
                                    </span>
                                </label>
                            </div>
                            <div class="col-lg-6">
                                <label class="form-selectgroup-item">
                                    <input type="radio" name="edit-events" value="0" class="form-selectgroup-input" />
                                    <span class="form-selectgroup-label d-flex align-items-center p-3">
                                        <span class="me-3">
                                            <span class="form-selectgroup-check"></span>
                                        </span>
                                        <span class="form-selectgroup-label-content">
                                            <span class="form-selectgroup-title strong mb-1">No</span>
                                        </span>
                                    </span>
                                </label>
                            </div>
                        </div>
                        <div id="edit-events-error" class="error-message text-danger text-sm"></div>
                    </div>
                    <div class="col-lg-6">
                        <label class="form-label">Matches</label>
                        <div class="form-selectgroup-boxes row mb-3">
                            <div class="col-lg-6">
                                <label class="form-selectgroup-item">
                                    <input type="radio" name="edit-matches" value="1" class="form-selectgroup-input"
                                        required />
                                    <span class="form-selectgroup-label d-flex align-items-center p-3">
                                        <span class="me-3">
                                            <span class="form-selectgroup-check"></span>
                                        </span>
                                        <span class="form-selectgroup-label-content">
                                            <span class="form-selectgroup-title strong mb-1">Yes</span>
                                        </span>
                                    </span>
                                </label>
                            </div>
                            <div class="col-lg-6">
                                <label class="form-selectgroup-item">
                                    <input type="radio" name="edit-matches" value="0" class="form-selectgroup-input" />
                                    <span class="form-selectgroup-label d-flex align-items-center p-3">
                                        <span class="me-3">
                                            <span class="form-selectgroup-check"></span>
                                        </span>
                                        <span class="form-selectgroup-label-content">
                                            <span class="form-selectgroup-title strong mb-1">No</span>
                                        </span>
                                    </span>
                                </label>
                            </div>
                        </div>
                        <div id="edit-matches-error" class="error-message text-danger text-sm"></div>
                    </div>
                    <div class="col-lg-6">
                        <label class="form-label">Scoreboard</label>
                        <div class="form-selectgroup-boxes row mb-3">
                            <div class="col-lg-6">
                                <label class="form-selectgroup-item">
                                    <input type="radio" name="edit-score" value="1" class="form-selectgroup-input"
                                        required />
                                    <span class="form-selectgroup-label d-flex align-items-center p-3">
                                        <span class="me-3">
                                            <span class="form-selectgroup-check"></span>
                                        </span>
                                        <span class="form-selectgroup-label-content">
                                            <span class="form-selectgroup-title strong mb-1">Yes</span>
                                        </span>
                                    </span>
                                </label>
                            </div>
                            <div class="col-lg-6">
                                <label class="form-selectgroup-item">
                                    <input type="radio" name="edit-score" value="0" class="form-selectgroup-input" />
                                    <span class="form-selectgroup-label d-flex align-items-center p-3">
                                        <span class="me-3">
                                            <span class="form-selectgroup-check"></span>
                                        </span>
                                        <span class="form-selectgroup-label-content">
                                            <span class="form-selectgroup-title strong mb-1">No</span>
                                        </span>
                                    </span>
                                </label>
                            </div>
                        </div>
                        <div id="edit-score-error" class="error-message text-danger text-sm"></div>
                    </div>
                    <div class="col-lg-6">
                        <label class="form-label">Videos</label>
                        <div class="form-selectgroup-boxes row mb-3">
                            <div class="col-lg-6">
                                <label class="form-selectgroup-item">
                                    <input type="radio" name="edit-videos" value="1" class="form-selectgroup-input"
                                        required />
                                    <span class="form-selectgroup-label d-flex align-items-center p-3">
                                        <span class="me-3">
                                            <span class="form-selectgroup-check"></span>
                                        </span>
                                        <span class="form-selectgroup-label-content">
                                            <span class="form-selectgroup-title strong mb-1">Yes</span>
                                        </span>
                                    </span>
                                </label>
                            </div>
                            <div class="col-lg-6">
                                <label class="form-selectgroup-item">
                                    <input type="radio" name="edit-videos" value="0" class="form-selectgroup-input" />
                                    <span class="form-selectgroup-label d-flex align-items-center p-3">
                                        <span class="me-3">
                                            <span class="form-selectgroup-check"></span>
                                        </span>
                                        <span class="form-selectgroup-label-content">
                                            <span class="form-selectgroup-title strong mb-1">No</span>
                                        </span>
                                    </span>
                                </label>
                            </div>
                        </div>
                        <div id="edit-videos-error" class="error-message text-danger text-sm"></div>
                    </div>
                    <div class="col-lg-6">
                        <label class="form-label">News</label>
                        <div class="form-selectgroup-boxes row mb-3">
                            <div class="col-lg-6">
                                <label class="form-selectgroup-item">
                                    <input type="radio" name="edit-news" value="1" class="form-selectgroup-input"
                                        required />
                                    <span class="form-selectgroup-label d-flex align-items-center p-3">
                                        <span class="me-3">
                                            <span class="form-selectgroup-check"></span>
                                        </span>
                                        <span class="form-selectgroup-label-content">
                                            <span class="form-selectgroup-title strong mb-1">Yes</span>
                                        </span>
                                    </span>
                                </label>
                            </div>
                            <div class="col-lg-6">
                                <label class="form-selectgroup-item">
                                    <input type="radio" name="edit-news" value="0" class="form-selectgroup-input" />
                                    <span class="form-selectgroup-label d-flex align-items-center p-3">
                                        <span class="me-3">
                                            <span class="form-selectgroup-check"></span>
                                        </span>
                                        <span class="form-selectgroup-label-content">
                                            <span class="form-selectgroup-title strong mb-1">No</span>
                                        </span>
                                    </span>
                                </label>
                            </div>
                        </div>
                        <div id="edit-news-error" class="error-message text-danger text-sm"></div>
                    </div>
                    <div class="col-lg-6">
                        <label class="form-label">Shops</label>
                        <div class="form-selectgroup-boxes row mb-3">
                            <div class="col-lg-6">
                                <label class="form-selectgroup-item">
                                    <input type="radio" name="edit-shops" value="1" class="form-selectgroup-input"
                                        required />
                                    <span class="form-selectgroup-label d-flex align-items-center p-3">
                                        <span class="me-3">
                                            <span class="form-selectgroup-check"></span>
                                        </span>
                                        <span class="form-selectgroup-label-content">
                                            <span class="form-selectgroup-title strong mb-1">Yes</span>
                                        </span>
                                    </span>
                                </label>
                            </div>
                            <div class="col-lg-6">
                                <label class="form-selectgroup-item">
                                    <input type="radio" name="edit-shops" value="0" class="form-selectgroup-input" />
                                    <span class="form-selectgroup-label d-flex align-items-center p-3">
                                        <span class="me-3">
                                            <span class="form-selectgroup-check"></span>
                                        </span>
                                        <span class="form-selectgroup-label-content">
                                            <span class="form-selectgroup-title strong mb-1">No</span>
                                        </span>
                                    </span>
                                </label>
                            </div>
                        </div>
                        <div id="edit-shops-error" class="error-message text-danger text-sm"></div>
                    </div>
                    <div class="col-lg-6">
                        <label class="form-label">Maintenance</label>
                        <div class="form-selectgroup-boxes row mb-3">
                            <div class="col-lg-6">
                                <label class="form-selectgroup-item">
                                    <input type="radio" name="edit-maintenance" value="1" class="form-selectgroup-input"
                                        required />
                                    <span class="form-selectgroup-label d-flex align-items-center p-3">
                                        <span class="me-3">
                                            <span class="form-selectgroup-check"></span>
                                        </span>
                                        <span class="form-selectgroup-label-content">
                                            <span class="form-selectgroup-title strong mb-1">Yes</span>
                                        </span>
                                    </span>
                                </label>
                            </div>
                            <div class="col-lg-6">
                                <label class="form-selectgroup-item">
                                    <input type="radio" name="edit-maintenance" value="0"
                                        class="form-selectgroup-input" />
                                    <span class="form-selectgroup-label d-flex align-items-center p-3">
                                        <span class="me-3">
                                            <span class="form-selectgroup-check"></span>
                                        </span>
                                        <span class="form-selectgroup-label-content">
                                            <span class="form-selectgroup-title strong mb-1">No</span>
                                        </span>
                                    </span>
                                </label>
                            </div>
                        </div>
                        <div id="edit-maintenance-error" class="error-message text-danger text-sm"></div>
                    </div>
                    <div class="col-lg-12">
                        <button type="submit" class="form-control btn btn-primary">
                            <i class="ti ti-device-floppy"></i>&nbsp;Save Changes
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<script>
$('#tbl_logs').DataTable();
let user = $('#user_permission').DataTable({
    "processing": true,
    "serverSide": true,
    "ajax": {
        "url": "<?=site_url('fetch-permission')?>",
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
            "data": "roleName"
        },
        {
            "data": "roster"
        },
        {
            "data": "events"
        },
        {
            "data": "matches"
        },
        {
            "data": "scoreboard"
        },
        {
            "data": "videos"
        },
        {
            "data": "news"
        },
        {
            "data": "shops"
        },
        {
            "data": "maintenance"
        },
        {
            "data": "action"
        }
    ]
});

$(document).on('click', '.edit_permission', function() {
    var val = $(this).val();
    $.ajax({
        url: "<?=site_url('fetch-specific-permission')?>",
        method: "GET",
        data: {
            value: val
        },
        success: function(response) {
            $('#role_id').attr("value", val);
            $('#edit-role').attr("value", response);
            $('#editRoleModal').modal('show');
        }
    });
});

$('#formEdit').on('submit', function(e) {
    e.preventDefault();
    $('.error-message').html('');
    let data = $(this).serialize();
    $.ajax({
        url: "<?=site_url('edit-permission')?>",
        method: "POST",
        data: data,
        success: function(response) {
            if (response.success) {
                $('#formEdit')[0].reset();
                Swal.fire({
                    title: 'Great!',
                    text: "Successfully applied changes",
                    icon: 'success',
                    confirmButtonText: 'Continue'
                }).then((result) => {
                    // Action based on user's choice
                    if (result.isConfirmed) {
                        // Perform some action when "Yes" is clicked
                        user.ajax.reload();
                        $('#editRoleModal').modal('hide');
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

$('#form').on('submit', function(e) {
    e.preventDefault();
    $('.error-message').html('');
    let data = $(this).serialize();
    $.ajax({
        url: "<?=site_url('save-permission')?>",
        method: "POST",
        data: data,
        success: function(response) {
            if (response.success) {
                $('#form')[0].reset();
                Swal.fire({
                    title: 'Great!',
                    text: "Successfully added",
                    icon: 'success',
                    confirmButtonText: 'Continue'
                }).then((result) => {
                    // Action based on user's choice
                    if (result.isConfirmed) {
                        // Perform some action when "Yes" is clicked
                        user.ajax.reload();
                        $('#roleModal').modal('hide');
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

var table = $('#tblachievement').DataTable({
    "processing": true,
    "serverSide": true,
    "ajax": {
        "url": "<?=site_url('fetch-achievement')?>",
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
            "data": "title"
        },
        {
            "data": "type"
        },
        {
            "data": "description"
        },
        {
            "data": "criteria"
        },
        {
            "data": "action"
        }
    ]
});
var role = $('#tblrole').DataTable({
    "processing": true,
    "serverSide": true,
    "ajax": {
        "url": "<?=site_url('fetch-role')?>",
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
            "data": "role"
        },
        {
            "data": "sports"
        },
        {
            "data": "date"
        },
        {
            "data": "action"
        }
    ]
});
var sports = $('#tblsports').DataTable({
    "processing": true,
    "serverSide": true,
    "ajax": {
        "url": "<?=site_url('fetch-sports')?>",
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
            "data": "name"
        },
        {
            "data": "date"
        },
        {
            "data": "action"
        }
    ]
});

$('#frmSports').on('submit', function(e) {
    e.preventDefault();
    $('.error-message').html('');
    let data = $(this).serialize();
    $.ajax({
        url: "<?=site_url('save-sports')?>",
        method: "POST",
        data: data,
        success: function(response) {
            if (response.success) {
                $('#frmSports')[0].reset();
                Swal.fire({
                    title: 'Great!',
                    text: "Successfully added",
                    icon: 'success',
                    confirmButtonText: 'Continue'
                }).then((result) => {
                    // Action based on user's choice
                    if (result.isConfirmed) {
                        // Perform some action when "Yes" is clicked
                        sports.ajax.reload();
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

$('#frmRole').on('submit', function(e) {
    e.preventDefault();
    $('.error-message').html('');
    let data = $(this).serialize();
    $.ajax({
        url: "<?=site_url('save-role')?>",
        method: "POST",
        data: data,
        success: function(response) {
            if (response.success) {
                $('#frmRole')[0].reset();
                Swal.fire({
                    title: 'Great!',
                    text: "Successfully added",
                    icon: 'success',
                    confirmButtonText: 'Continue'
                }).then((result) => {
                    // Action based on user's choice
                    if (result.isConfirmed) {
                        // Perform some action when "Yes" is clicked
                        role.ajax.reload();
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

$('#frmAchievement').on('submit', function(e) {
    e.preventDefault();
    $('.error-message').html('');
    let data = $(this).serialize();
    $.ajax({
        url: "<?=site_url('save-achievement')?>",
        method: "POST",
        data: data,
        success: function(response) {
            if (response.success) {
                $('#frmAchievement')[0].reset();
                Swal.fire({
                    title: 'Great!',
                    text: "Successfully added",
                    icon: 'success',
                    confirmButtonText: 'Continue'
                }).then((result) => {
                    // Action based on user's choice
                    if (result.isConfirmed) {
                        // Perform some action when "Yes" is clicked
                        table.ajax.reload();
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