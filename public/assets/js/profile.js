function addRow() {
    var table = document.getElementById("tblchildren");
    var x = table.rows.length + 1;
    var row = table.insertRow(0);
    var cell1 = row.insertCell(0);
    var cell2 = row.insertCell(1);
    var cell3 = row.insertCell(2);
    cell1.innerHTML =
        "<input type='text' class='form-control' placeholder='Enter name' id='children_name' name='children_name[]'/>";
    cell2.innerHTML = "<input type='date' class='form-control' id='children_dob' name='children_dob[]'/>";
    cell3.innerHTML =
        "<button type='button' class='btn btn-danger btnDelete'><span class='ti ti-trash'></span></button>";
}
$("#tblchildren").on('click', '.btnDelete', function () {
    $(this).closest('tr').remove();
});

function addLicenseRow() {
    var table = document.getElementById("tbl_license");
    var row = table.insertRow(0);
    var cell1 = row.insertCell(0);
    var cell2 = row.insertCell(1);
    var cell3 = row.insertCell(2);
    var cell4 = row.insertCell(3);
    var cell5 = row.insertCell(4);
    var cell6 = row.insertCell(5);
    var cell7 = row.insertCell(6);
    cell1.innerHTML = "<input type='text' class='form-control' name='license_name[]'/>";
    cell2.innerHTML = "<input type='text' class='form-control' name='license_rate[]'/>";
    cell3.innerHTML = "<input type='text' class='form-control' name='license_date[]' placeholder='YYYY-MM-DD'/>";
    cell4.innerHTML = "<input type='text' class='form-control' name='license_location[]'/>";
    cell5.innerHTML = "<input type='text' class='form-control' name='license_number[]'/>";
    cell6.innerHTML = "<input type='text' class='form-control' name='license_validity[]' placeholder='YYYY-MM-DD'/>";
    cell7.innerHTML =
        "<button type='button' class='btn btn-danger btnRemove'><span class='ti ti-trash'></span></button>";
}

$("#tbl_license").on('click', '.btnRemove', function () {
    $(this).closest('tr').remove();
});

function addExperienceRow() {
    var table = document.getElementById("tblexperience");
    var row = table.insertRow(0);
    var cell1 = row.insertCell(0);
    var cell2 = row.insertCell(1);
    var cell3 = row.insertCell(2);
    var cell4 = row.insertCell(3);
    var cell5 = row.insertCell(4);
    var cell6 = row.insertCell(5);
    var cell7 = row.insertCell(6);
    var cell8 = row.insertCell(7);
    var cell9 = row.insertCell(8);
    cell1.innerHTML =
        "<input type='text' class='form-control' name='from[]' placeholder='YYYY-MM-DD'/>";
    cell2.innerHTML =
        "<input type='text' class='form-control' name='to[]' placeholder='YYYY-MM-DD'/>";
    cell3.innerHTML =
        "<input type='text' class='form-control' name='position[]'/>";
    cell4.innerHTML =
        "<input type='text' class='form-control' name='company[]'/>";
    cell5.innerHTML =
        "<input type='text' class='form-control' name='salary[]'/>";
    cell6.innerHTML =
        "<input type='text' class='form-control' name='job_grade[]'/>";
    cell7.innerHTML =
        "<input type='text' class='form-control' name='job_status[]'/>";
    cell8.innerHTML =
        "<input type='text' class='form-control' name='is_government[]'/>";
    cell9.innerHTML =
        "<button type='button' class='btn btn-danger btn_delete'><span class='ti ti-trash'></span></button>";
}


$("#tblexperience").on('click', '.btn_delete', function () {
    $(this).closest('tr').remove();
});

function addOrganizationRow() {
    var table = document.getElementById("tbl_organization");
    var row = table.insertRow(0);
    var cell1 = row.insertCell(0);
    var cell2 = row.insertCell(1);
    var cell3 = row.insertCell(2);
    var cell4 = row.insertCell(3);
    var cell5 = row.insertCell(4);
    var cell6 = row.insertCell(5);
    cell1.innerHTML =
        "<input type='text' class='form-control' name='organization[]'/>";
    cell2.innerHTML =
        "<input type='text' class='form-control' name='org_from[]' placeholder='YYYY-MM-DD'/>";
    cell3.innerHTML =
        "<input type='text' class='form-control' name='org_to[]' placeholder='YYYY-MM-DD'/>";
    cell4.innerHTML =
        "<input type='text' class='form-control' name='org_hours[]'/>";
    cell5.innerHTML =
        "<input type='text' class='form-control' name='org_position[]'/>";
    cell6.innerHTML =
        "<button type='button' class='btn btn-danger btn_remove'><span class='ti ti-trash'></span></button>";
}

$("#tbl_organization").on('click', '.btn_remove', function () {
    $(this).closest('tr').remove();
});

function addTrainingRow() {
    var table = document.getElementById("tbl_training");
    var row = table.insertRow(0);
    var cell1 = row.insertCell(0);
    var cell2 = row.insertCell(1);
    var cell3 = row.insertCell(2);
    var cell4 = row.insertCell(3);
    var cell5 = row.insertCell(4);
    var cell6 = row.insertCell(5);
    var cell7 = row.insertCell(6);
    cell1.innerHTML =
        "<input type='text' class='form-control' name='training_name[]'/>";
    cell2.innerHTML =
        "<input type='text' class='form-control' name='training_from[]' placeholder='YYYY-MM-DD'/>";
    cell3.innerHTML =
        "<input type='text' class='form-control' name='training_to[]' placeholder='YYYY-MM-DD'/>";
    cell4.innerHTML =
        "<input type='text' class='form-control' name='training_hours[]'/>";
    cell5.innerHTML =
        "<input type='text' class='form-control' name='training_type[]'/>";
    cell6.innerHTML =
        "<input type='text' class='form-control' name='training_conducted[]'/>";
    cell7.innerHTML =
        "<button type='button' class='btn btn-danger btn_remove_training'><span class='ti ti-trash'></span></button>";
}

$("#tbl_training").on('click', '.btn_remove_training', function () {
    $(this).closest('tr').remove();
});

$("#tbl_skills").on('click', '.remove_skills', function () {
    $(this).closest('tr').remove();
});

$("#tbl_recognition").on('click', '.remove_recognition', function () {
    $(this).closest('tr').remove();
});

$("#tbl_membership").on('click', '.remove_membership', function () {
    $(this).closest('tr').remove();
});

$("#tblreference").on('click', '.removeRow', function () {
    $(this).closest('tr').remove();
});

function addReferenceRow() {
    var table = document.getElementById("tblreference");
    var row = table.insertRow(0);
    var cell1 = row.insertCell(0);
    var cell2 = row.insertCell(1);
    var cell3 = row.insertCell(2);
    var cell4 = row.insertCell(3);
    cell1.innerHTML =
        "<input type='text' class='form-control' name='ref_name[]'/>";
    cell2.innerHTML =
        "<input type='text' class='form-control' name='ref_address[]'/>";
    cell3.innerHTML =
        "<input type='text' class='form-control' name='ref_phone[]' minlength='11' maxlength='11'/>";
    cell4.innerHTML =
        "<button type='button' class='btn btn-danger removeRow'><span class='ti ti-trash'></span></button>";
}

function addSkillRow() {
    var table = document.getElementById("tbl_skills");
    var row = table.insertRow(0);
    var cell1 = row.insertCell(0);
    var cell2 = row.insertCell(1);
    cell1.innerHTML =
        "<input type='text' class='form-control' name='skills[]'/>";
    cell2.innerHTML =
        "<button type='button' class='btn btn-danger remove_skills'><span class='ti ti-trash'></span></button>";
}

function addRecognitionRow() {
    var table = document.getElementById("tbl_recognition");
    var row = table.insertRow(0);
    var cell1 = row.insertCell(0);
    var cell2 = row.insertCell(1);
    cell1.innerHTML =
        "<input type='text' class='form-control' name='recognition[]'/>";
    cell2.innerHTML =
        "<button type='button' class='btn btn-danger remove_recognition'><span class='ti ti-trash'></span></button>";
}

function addMembershipRow() {
    var table = document.getElementById("tbl_membership");
    var row = table.insertRow(0);
    var cell1 = row.insertCell(0);
    var cell2 = row.insertCell(1);
    cell1.innerHTML =
        "<input type='text' class='form-control' name='membership[]'/>";
    cell2.innerHTML =
        "<button type='button' class='btn btn-danger remove_membership'><span class='ti ti-trash'></span></button>";
}

$('input[name="citizenship"]').change(function () {
    let val = $('input[name="citizenship"]:checked').val();
    if (val === "Filipino") {
        $('input[name="citizenship_type"]').prop('checked', false).removeAttr('checked');
        $('#country').prop("selectedIndex", 0);
    }
});

// document.addEventListener("DOMContentLoaded", function() {
//     var el;
//     window.TomSelect &&
//         new TomSelect((el = document.getElementById("country")), {
//             copyClassesToDropdown: false,
//             dropdownParent: "body",
//             controlInput: "<input>",
//             render: {
//                 item: function(data, escape) {
//                     if (data.customProperties) {
//                         return '<div><span class="dropdown-item-indicator">' + data
//                             .customProperties + "</span>" + escape(data.text) + "</div>";
//                     }
//                     return "<div>" + escape(data.text) + "</div>";
//                 },
//                 option: function(data, escape) {
//                     if (data.customProperties) {
//                         return '<div><span class="dropdown-item-indicator">' + data
//                             .customProperties + "</span>" + escape(data.text) + "</div>";
//                     }
//                     return "<div>" + escape(data.text) + "</div>";
//                 },
//             },
//         });
// });

