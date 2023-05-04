$(document).ready(function () {
    displayData();
})

function displayData() {
    let displayData = "true"
    $.ajax({
        url: "forms/display.php", type: "post", data: {
            displaySend: displayData
        }, success: function (data, status) {
            $('#displayDataTable').html(data)
            console.log({
                status: true, error: null, table: data
            })
        }, error: function (data, status) {
            console.log({
                status: false, error: {
                    code: 404, message: 'Not Found'
                }
            })
        }

    });
}

function ed(updateId) {
    $(document).on('click', '.add-btn', function () {
        userForm('Add User', 'Add')
        $('#sus-btn').attr('onclick', 'addUser()')
        // console.log({
        //     status: true, error: null, formBtn: 'add-btn', id: updateId
        // })
    });

    $(document).on('click', '#up-btn-' + updateId, function () {
        userForm('Update User', 'Update');
        editUser(updateId);
        $('#sus-btn').attr('onclick', 'updateUser()');
        // console.log({
        //     status: true, error: null, formBtn: 'update-btn', id: updateId
        // })
    });
}

function addUser() {
    let nameAdd = $('#first_name').val()
    let surnameAdd = $('#last_name').val()
    let statusAdd = $('#status').prop('checked') ? 'on' : 'off';
    let roleAdd = $('#role').val()

    if (nameAdd === '' || surnameAdd === '' || statusAdd === '' || roleAdd === '') {
        alert('Fill all field')
    }
    $.ajax({
        url: "forms/addUser.php", type: "post", data: {
            first_name: nameAdd, last_name: surnameAdd, status: statusAdd, role: roleAdd,
        }, success: function (data, status) {
            $('#user-modal').modal('hide')
            displayData()
            clearFields()
            let a = JSON.parse(data)
            switch (a.status) {
                case 200: {
                    console.log({
                        status: true, error: null, user: {
                            first_name: nameAdd, last_name: surnameAdd, status: statusAdd, role: roleAdd
                        }
                    })
                    break;
                }
                case 500: {
                    console.log({
                        status: false, error: {
                            code: 500, message: 'User not added'
                        }
                    })
                    break;
                }
                case 422: {
                    console.log({
                        status: false, error: {
                            code: 422, message: 'Fill all field'
                        },
                    })
                    break;
                }
            }
        }, error: function (data, status) {
            console.log({
                status: false, error: {
                    code: 404, message: 'Not Found'
                }
            })
        }
    })
}

function updateUser() {
    let updateFName = $('#first_name').val()
    let updateLName = $('#last_name').val()
    let updateStatus = $('#status').prop('checked') ? 'on' : 'off';
    let updateRole = $('#role').val()
    let hiddenData = $('#hiddenData').val()
    if (updateFName === '' || updateLName === '' || updateStatus === '' || updateRole === '') {
        alert('Fill all field')
    }
    $.ajax({
        url: 'forms/update.php', type: "post", data: {
            updateFName: updateFName, updateLName: updateLName, updateStatus: updateStatus, updateRole: updateRole, hiddenData: hiddenData,
        }, success: function (data, status) {
            $('#user-modal').modal('hide')
            displayData();
            clearFields()
            let u = JSON.parse(data)
            switch (u.status) {
                case 200: {
                    console.log({
                        status: true, error: null, updateUser: {
                            id: hiddenData, first_name: updateFName, last_name: updateLName, status: updateStatus, role: updateRole

                        }
                    })
                    break;
                }
                case 500: {
                    console.log({
                        status: false, error: {
                            code: 500, message: 'Internal Server Error'
                        }
                    })
                    break;
                }
                case 422: {
                    console.log({
                        status: false, error: {
                            code: 422, message: 'Fill all field'
                        },
                    })
                }

            }
        }, error: function (data, status) {
            console.log({
                status: false, error: {
                    code: 404, message: 'Not Found'
                }
            })
        }
    });

}

function editUser(updateId) {
    $('#hiddenData').val(updateId)
    $.ajax({
        url: 'forms/edit.php', type: "post", data: {
            updateId: updateId
        }, success: function (data, status) {
            let userid = JSON.parse(data)
            $('#first_name').val(userid.first_name);
            $('#last_name').val(userid.last_name);
            $('#role').val(userid.role);
            $('#status').prop('checked', userid.status === 'on').change();
            switch (userid.response) {
                case 200: {
                    console.log({
                        status: true, error: null, currentUser: {
                            id: updateId, first_name: userid.first_name, last_name: userid.last_name, role: userid.role, status: userid.status
                        }
                    })
                    break;
                }
                case 500: {
                    console.log({
                        status: false, error: {
                            code: 500, message: 'User not displayed correctly'
                        }
                    })
                }
            }
        }, error: function (data, status) {
            console.log({
                status: false, error: {
                    code: 404, message: 'Not Found'
                }
            })
        }
    });

}

function deleteUser(deleteId) {
    if (confirm("CONFIRM DELETE")) {
        $.ajax({
            url: "forms/delete.php", type: "post", data: {
                deleteSend: deleteId
            }, success: function (data, status) {
                displayData();
                let d = JSON.parse(data)
                switch (d.status) {
                    case 200: {
                        console.log({
                            status: true, error: null, id: deleteId, confirm: 'deleted'
                        })
                        break;
                    }
                    case 500 : {
                        console.log({
                            status: false, error: {
                                code: 500, message: 'Internal Server Error'
                            }
                        })
                        break;
                    }
                }
            }

        })
    }
}

function clearFields() {
    $('#first_name').val('');
    $('#last_name').val('');
    $('#role').val('');
    // console.log({
    //     status: true, error: null, fields: {
    //         first_name: $('#first_name').val(), last_name: $('#last_name').val(), role: $('#role').val(),
    //
    //     }
    // })
}

function userForm(title, btn) {
    $('#modal-title').text(title)
    $('#sus-btn').text(btn)
    $("#user-modal").modal("show");
    // console.log({
    //     status: true, error: null, displayForm: 'displayed'
    // })

}



