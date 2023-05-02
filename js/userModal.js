$(document).ready(function () {
    displayData();
})

function userForm(title, btn) {
    $('#modal-title').text(title)
    $('#sus-btn').text(btn)
    $("#user-modal").modal("show");

}

function ed(updateId) {
    $(document).on('click', '#add-btn', function () {
        userForm('Add User', 'Add')
        $('#sus-btn').attr('onclick', 'addUser()')
        $(document).on('click', '#sus')
    });
    $(document).on('click', '#up-btn-' + updateId, function () {
        userForm('Update User', 'Update');
        editUser(updateId);
        $('#sus-btn').attr('onclick', 'updateUser()');
    });
}

function clearFields() {
    $('#first_name').val('');
    $('#last_name').val('');
    $('#role').val('');


}

function addUser() {


    let nameAdd = $('#first_name').val()
    let surnameAdd = $('#last_name').val()
    let statusAdd = $('#status').prop('checked') ? 'on' : 'off';
    let roleAdd = $('#role').val()

    $.ajax({
        url: "forms/addUser.php",
        type: "post",
        data: {
            first_name: nameAdd,
            last_name: surnameAdd,
            status: statusAdd,
            role: roleAdd,
        },
        success: function (data, status) {
            $('#user-modal').modal('hide')
            displayData();
            clearFields()

        },
        error: function (data, status) {
            console.log(status)
        }
    });

}

function updateUser() {
    let updateFName = $('#first_name').val()
    let updateLName = $('#last_name').val()
    let updateStatus = $('#status').prop('checked') ? 'on' : 'off';
    let updateRole = $('#role').val()
    let hiddenData = $('#hiddenData').val()
    $.ajax({
        url: 'forms/edit.php',
        type: "post",
        data: {
            updateFName: updateFName,
            updateLName: updateLName,
            updateStatus: updateStatus,
            updateRole: updateRole,
            hiddenData: hiddenData,
        },
        success: function (data, status) {
            $('#user-modal').modal('hide')
            displayData();
            clearFields()
        },
        error: function (data, status) {
            console.log(status)
        }
    });

}

function editUser(updateId) {
    $('#hiddenData').val(updateId)
    $.ajax({
        url: 'forms/edit.php',
        type: "post",
        data: {
            updateId: updateId
        },
        success: function (data, status) {
            let userid = JSON.parse(data)
            $('#first_name').val(userid.first_name);
            $('#last_name').val(userid.last_name);
            $('#role').val(userid.role);
            $('#status').prop('checked', userid.status === 'on').change();


        },
        error: function (data, status) {
            console.log(status)
        }
    });

}

function deleteUser(deleteId) {
    if (confirm("CONFIRM DELETE?")) {
        $.ajax({
            url: "forms/delete.php",
            type: "post",
            data: {
                deleteSend: deleteId
            },
            success: function (data, status) {
                displayData();
            }

        })
    }
}

function displayData() {
    let displayData = "true"
    $.ajax({
        url: "forms/display.php",
        type: "post",
        data: {
            displaySend: displayData
        },
        success: function (data, status) {
            $('#displayDataTable').html(data)
        }
    });
}


