let educations = $('#educations').DataTable(
    {
        "processing": true,
        "serverSide": true,
        "ajax": {
            "url": window.location.origin + "/fetch-education-data",
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
        "columns": [{
            "data": "level"
        },
        {
            "data": "from"
        },
        {
            "data": "to"
        },
        {
            "data": "action"
        }
        ]
    }
);
let trainings = $('#trainings').DataTable(
    {
        "processing": true,
        "serverSide": true,
        "ajax": {
            "url": window.location.origin + "/fetch-training-data",
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
        "columns": [{
            "data": "level"
        },
        {
            "data": "from"
        },
        {
            "data": "to"
        },
        {
            "data": "action"
        }
        ]
    }
);
let experience = $('#experiences').DataTable(
    {
        "processing": true,
        "serverSide": true,
        "ajax": {
            "url": window.location.origin + "/fetch-experience-data",
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
        "columns": [{
            "data": "level"
        },
        {
            "data": "from"
        },
        {
            "data": "to"
        },
        {
            "data": "action"
        }
        ]
    }
);

$(document).on('click', '.editEducation', function () {
    $.ajax({
        url: window.location.origin + "/fetch-edit-education",
        method: "GET",
        data: { value: $(this).val() },
        dataType: "JSON",
        success: function (response) {
            $('#education_id').attr("value", response.id);
            $('#edit_level').attr("value", response.level);
            $('#edit_from').attr("value", response.from);
            $('#edit_to').attr("value", response.to);
            $('#editEducationModal').modal('show');
        }
    });
});

$(document).on('click', '.editTraining', function () {
    $.ajax({
        url: window.location.origin + "/fetch-edit-training",
        method: "GET",
        data: { value: $(this).val() },
        dataType: "JSON",
        success: function (response) {
            $('#training_id').attr("value", response.id);
            $('#edit_training_level').attr("value", response.level);
            $('#edit_from_training').attr("value", response.from);
            $('#edit_to_training').attr("value", response.to);
            $('#editTrainingModal').modal('show');
        }
    });
});

$(document).on('click', '.editExperience', function () {
    $.ajax({
        url: window.location.origin + "/fetch-edit-experience",
        method: "GET",
        data: { value: $(this).val() },
        dataType: "JSON",
        success: function (response) {
            $('#experience_id').attr("value", response.id);
            $('#edit_experience_level').attr("value", response.level);
            $('#edit_f_experience').attr("value", response.from);
            $('#edit_t_experience').attr("value", response.to);
            $('#editExperienceModal').modal('show');
        }
    });
});