$('#tbl_log').DataTable();
let grades = $('#tblgrade').DataTable({
    "processing": true,
    "serverSide": true,
    "ajax": {
        "url": window.location.origin + "/fetch-salary-grades",
        "type": "GET",
        "dataSrc": function (json) {
            // Handle the data if needed
            return json.data;
        },
        "error": function (xhr, error, code) {
            console.error("AJAX Error: " + error);
            alert("Error occurred while loading data.");
        }
    },
    "searching": true,
    "columns": [
        {
            "data": "category"
        },
        {
            "data": "code"
        }
    ]
});
var role = $('#tblrole').DataTable({
    "processing": true,
    "serverSide": true,
    "ajax": {
        "url": window.location.origin + "/fetch-role",
        "type": "GET",
        "dataSrc": function (json) {
            // Handle the data if needed
            return json.data;
        },
        "error": function (xhr, error, code) {
            console.error("AJAX Error: " + error);
            alert("Error occurred while loading data.");
        }
    },
    "searching": true,
    "columns": [
        {
            "data": "role"
        },
        {
            "data": "points"
        },
        {
            "data": "setting"
        },
        {
            "data": "posting"
        },
        {
            "data": "users"
        },
        {
            "data": "tracking"
        },
        {
            "data": "report"
        },
        {
            "data": "action"
        }
    ]
});

var courses = $('#tblcourses').DataTable({
    "processing": true,
    "serverSide": true,
    "ajax": {
        "url": window.location.origin + "/fetch-courses",
        "type": "GET",
        "dataSrc": function (json) {
            // Handle the data if needed
            return json.data;
        },
        "error": function (xhr, error, code) {
            console.error("AJAX Error: " + error);
            alert("Error occurred while loading data.");
        }
    },
    "searching": true,
    "columns": [
        {
            "data": "course"
        },
        {
            "data": "action"
        }
    ]
});

var office = $('#tblinstitution').DataTable({
    "processing": true,
    "serverSide": true,
    "ajax": {
        "url": window.location.origin + "/fetch-office",
        "type": "GET",
        "dataSrc": function (json) {
            // Handle the data if needed
            return json.data;
        },
        "error": function (xhr, error, code) {
            console.error("AJAX Error: " + error);
            alert("Error occurred while loading data.");
        }
    },
    "searching": true,
    "columns": [
        {
            "data": "office"
        },
        {
            "data": "code"
        },
        {
            "data": "action"
        }
    ]
});

let app = $('#tblapplication').DataTable({
    "processing": true,
    "serverSide": true,
    "ajax": {
        "url": window.location.origin + "/fetch-app",
        "type": "GET",
        "dataSrc": function (json) {
            // Handle the data if needed
            return json.data;
        },
        "error": function (xhr, error, code) {
            console.error("AJAX Error: " + error);
            alert("Error occurred while loading data.");
        }
    },
    "searching": true,
    "columns": [
        {
            "data": "title"
        },
        {
            "data": "code"
        },
        {
            "data": "action"
        }
    ]
});

let type_office = $('#tbl_type').DataTable({
    "processing": true,
    "serverSide": true,
    "ajax": {
        "url": window.location.origin + "/fetch-types",
        "type": "GET",
        "dataSrc": function (json) {
            // Handle the data if needed
            return json.data;
        },
        "error": function (xhr, error, code) {
            console.error("AJAX Error: " + error);
            alert("Error occurred while loading data.");
        }
    },
    "searching": true,
    "columns": [
        {
            "data": "title"
        },
        {
            "data": "code"
        },
        {
            "data": "action"
        }
    ]
});

let list = $('#tblcompetence').DataTable({
    "processing": true,
    "serverSide": true,
    "ajax": {
        "url": window.location.origin + "/fetch-competence",
        "type": "GET",
        "dataSrc": function (json) {
            // Handle the data if needed
            return json.data;
        },
        "error": function (xhr, error, code) {
            console.error("AJAX Error: " + error);
            alert("Error occurred while loading data.");
        }
    },
    "searching": true,
    "columns": [
        {
            "data": "title"
        },
        {
            "data": "date"
        },
        {
            "data": "action"
        }
    ]
});
//fetching data using json
$(document).on('click', '.editRole', function () {
    $.ajax({
        url: window.location.origin + "/fetch-edit-role",
        method: "GET",
        data: { value: $(this).val() },
        dataType: "JSON",
        success: function (response) {
            $('#role_id').attr("value", response.id);
            $('#role').attr("value", response.role);
            $('#editRoleModal').modal('show');
        }
    });
});

$(document).on('click', '.editCourse', function () {
    $.ajax({
        url: window.location.origin + "/fetch-edit-course",
        method: "GET",
        data: { value: $(this).val() },
        dataType: "JSON",
        success: function (response) {
            $('#course_id').attr("value", response.id);
            $('#course').attr("value", response.name);
            $('#editCourseModal').modal('show');
        }
    });
});

$(document).on('click', '.editOffice', function () {
    $.ajax({
        url: window.location.origin + "/fetch-edit-office",
        method: "GET",
        data: { value: $(this).val() },
        dataType: "JSON",
        success: function (response) {
            $('#office_id').attr("value", response.id);
            $('#office').attr("value", response.school);
            $('#code').attr("value", response.code);
            function selectOptionByValue(value) {
                const selectElement = document.getElementById('type_office');
                [...selectElement.options].forEach(option => {
                    if (option.value == value) {
                        option.selected = true;
                    } else {
                        option.selected = false;
                    }
                });
            }
            selectOptionByValue(response.academic);
            $('#editOfficeModal').modal('show');
        }
    });
});

$(document).on('click', '.editCompetence', function () {
    $.ajax({
        url: window.location.origin + "/fetch-edit-competence",
        method: "GET",
        data: { value: $(this).val() },
        dataType: "JSON",
        success: function (response) {
            $('#competence_id').attr("value", response.id);
            $('#title').attr("value", response.name);
            $('#editCompetenceModal').modal('show');
        }
    });
});

$(document).on('click', '.editApp', function () {
    $.ajax({
        url: window.location.origin + "/edit-category",
        method: "GET",
        data: { value: $(this).val() },
        dataType: "JSON",
        success: function (response) {
            $('#category_id').attr("value", response.id);
            $('#category').attr("value", response.title);
            $('#cat_code').attr("value", response.code);
            $('#editCategoryModal').modal('show');
        }
    });
});

$(document).on('click', '.editType', function () {
    $.ajax({
        url: window.location.origin + "/edit-types",
        method: "GET",
        data: { value: $(this).val() },
        dataType: "JSON",
        success: function (response) {
            $('#office_number').attr("value", response.id);
            $('#office_name').attr("value", response.name);
            $('#office_code').attr("value", response.code);
            $('#editOfficeTypeModal').modal('show');
        }
    });
});
