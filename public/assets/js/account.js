var accounts = $('#tblaccount').DataTable({
    "processing": true,
    "serverSide": true,
    "ajax": {
        "url": window.location.origin + "/fetch-account",
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
        "data": "id"
    },
    {
        "data": "fullname"
    },
    {
        "data": "email"
    },
    {
        "data": "role"
    },
    {
        "data": "status"
    },
    {
        "data": "verify"
    },
    {
        "data": "action"
    }
    ]
});

