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
                        <?=$title?>
                    </h2>
                </div>
            </div>
        </div>
    </div>
    <div class="page-body">
        <div class="container-xl">
            <div class="card">
                <div class="card-body">
                    <div class="card-title"><?=$title?></div>
                    <form method="POST" class="row g-3" enctype="multipart/form-data" id="frmCreate">
                        <?=csrf_field()?>
                        <div class="col-lg-12">
                            <label class="form-label">Team Name</label>
                            <input type="text" class="form-control" name="team_name" placeholder="Enter text here...">
                            <div id="team_name-error" class="error-message text-danger text-sm"></div>
                        </div>
                        <div class="col-lg-12">
                            <div class="row g-3">
                                <div class="col-lg-3">
                                    <label class="form-label">Type of Sports</label>
                                    <select name="sport" class="form-select">
                                        <option value="">Choose</option>
                                        <?php foreach($category as $row): ?>
                                        <option value="<?=$row['sportsID']?>"><?=$row['Name']?></option>
                                        <?php endforeach;?>
                                    </select>
                                    <div id="sport-error" class="error-message text-danger text-sm"></div>
                                </div>
                                <div class="col-lg-3">
                                    <label class="form-label">Category</label>
                                    <select name="category" class="form-select">
                                        <option value="">Choose</option>
                                        <option value="School">School/University</option>
                                        <option value="Barangay">Barangay/Village</option>
                                    </select>
                                    <div id="category-error" class="error-message text-danger text-sm"></div>
                                </div>
                                <div class="col-lg-6">
                                    <label class="form-label">Name of Organization</label>
                                    <input type="text" class="form-control" name="organization"
                                        placeholder="Enter text here...">
                                    <div id="organization-error" class="error-message text-danger text-sm"></div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <label class="form-label">Name of School/Barangay</label>
                            <textarea name="school_barangay" class="form-control"></textarea>
                            <div id="school_barangay-error" class="error-message text-danger text-sm"></div>
                        </div>
                        <div class="col-lg-12">
                            <h3>Team Staff
                                <button type="button" class="btn btn-primary" style="float:right;" onclick="addStaff()">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                        fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                        stroke-linejoin="round"
                                        class="icon icon-tabler icons-tabler-outline icon-tabler-circle-plus">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                        <path d="M3 12a9 9 0 1 0 18 0a9 9 0 0 0 -18 0" />
                                        <path d="M9 12h6" />
                                        <path d="M12 9v6" />
                                    </svg>
                                    Add Another Staff
                                </button>
                            </h3>
                        </div>
                        <div class="col-lg-12">
                            <div id="staff-container">
                                <div class="staff-form card card-body mb-3" data-index="0">
                                    <div class="row g-3">
                                        <div class="col-lg-12">
                                            <label class="form-label" for="name_0">Complete Name</label>
                                            <input type="text" name="name[]" id="name_0" class="form-control" />
                                            <div id="name_0-error" class="error-message text-danger text-sm">
                                            </div>
                                        </div>
                                        <div class="col-lg-12">
                                            <div class="row g-3">
                                                <div class="col-lg-6">
                                                    <label class="form-label" for="email_0">Email</label>
                                                    <input type="text" name="email[]" id="email_0"
                                                        class="form-control" />
                                                    <div id="email_0-error" class="error-message text-danger text-sm">
                                                    </div>
                                                </div>
                                                <div class="col-lg-6">
                                                    <label class="form-label"
                                                        for="position_0">Position/Designation</label>
                                                    <input type="text" name="position[]" id="position_0"
                                                        class="form-control" />
                                                    <div id="position_0-error"
                                                        class="error-message text-danger text-sm">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-12">
                                            <button type="button" class="btn btn-danger" onclick="removeStaff(this)">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                    viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                    stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                    class="icon icon-tabler icons-tabler-outline icon-tabler-circle-minus">
                                                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                    <path d="M12 12m-9 0a9 9 0 1 0 18 0a9 9 0 1 0 -18 0" />
                                                    <path d="M9 12l6 0" />
                                                </svg>
                                                Remove
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <label class="form-label">Team Logo</label>
                            <input type="file" class="form-control" name="file">
                            <div id="file-error" class="error-message text-danger text-sm"></div>
                        </div>
                        <div class="col-lg-12">
                            <label class="form-check">
                                <input type="checkbox" class="form-check-input" name="agreement" />
                                <span class="form-check-label">I agree to the <a href="/terms-and-conditions"
                                        target="_blank">Terms and Conditions</a> for registering a sports team</span>
                            </label>
                            <div id="agreement-error" class="error-message text-danger text-sm"></div>
                        </div>
                        <div class="col-lg-12">
                            <button type="submit" class="btn btn-primary" id="btnSubmit">Submit to Register</button>
                        </div>
                    </form>
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
<?= view('main/templates/footer')?>
<script src="https://unpkg.com/@lottiefiles/dotlottie-wc@0.8.1/dist/dotlottie-wc.js" type="module"></script>
<script>
let staffIndex = 1;

function addStaff() {
    const container = document.getElementById("staff-container");
    const forms = container.getElementsByClassName("staff-form");
    const lastForm = forms[forms.length - 1];
    const newForm = lastForm.cloneNode(true); // deep clone

    // Update index
    newForm.setAttribute("data-index", staffIndex);

    // Clear and update input fields
    const inputs = newForm.querySelectorAll("input, select, textarea");
    inputs.forEach(input => {
        const baseName = input.name.replace(/\[\]$/, "");
        input.name = `${baseName}[]`;
        input.id = `${baseName}_${staffIndex}`;
        input.value = "";
    });

    // Update labels and error containers
    const labels = newForm.querySelectorAll("label");
    labels.forEach(label => {
        const htmlFor = label.getAttribute("for");
        if (htmlFor) {
            const baseFor = htmlFor.replace(/_\d+$/, "");
            label.setAttribute("for", `${baseFor}_${staffIndex}`);
        }
    });

    const errors = newForm.querySelectorAll(".error-message");
    errors.forEach(error => {
        const baseId = error.id.replace(/_\d+-error$/, "");
        error.id = `${baseId}_${staffIndex}-error`;
        error.innerHTML = "";
    });

    container.appendChild(newForm);
    staffIndex++;
}

function removeStaff(button) {
    const container = document.getElementById("staff-container");
    const form = button.closest(".staff-form");

    if (!form || !container.contains(form)) {
        console.warn("Form not found or not in container.");
        return;
    }

    const totalForms = container.getElementsByClassName("staff-form").length;

    if (totalForms > 1) {
        container.removeChild(form);
    } else {
        Swal.fire({
            title: 'Warning',
            text: "At least one staff entry is required.",
            icon: 'warning',
        });
    }
}

$('#frmCreate').on('submit', function(e) {
    e.preventDefault();
    $('.error-message').html('');
    let data = $(this).serialize();
    $('#modal-loading').modal('show');
    $.ajax({
        url: "<?=site_url('team-registration')?>",
        method: "POST",
        data: new FormData(this),
        contentType: false,
        cache: false,
        processData: false,
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
                        location.reload();
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