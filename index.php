<?php
include_once 'connect.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Users System</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"
            integrity="sha256-oP6HI9z1XaZNBrJURtCoUT5SUnxFr8s3BzRl+cbzUq8=" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@4.1.1/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.1.1/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="css/styles.css">
</head>
<body>
<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet">
<link href="css/styles.css" rel="stylesheet">
<div class="container">
    <div class="row flex-lg-nowrap">
        <div class="col">
            <div class="row flex-lg-nowrap">
                <div class="col mb-3">
                    <div class="e-panel card">
                        <div class="card-body">
                            <div class="card-title">
                                <h6 class="mr-2"><span>Users</span></h6>
                            </div>
                            <div class="d-flex ">
                                <button class="btn btn-sm btn-primary badge add-btn" type="button" data-toggle="modal" onclick="displayAdd()">
                                    Add
                                </button>
                                <select class="form-control option sel-1 " name="option">
                                    <option value="">-Please Select-</option>
                                    <option value="set-active">1.Set active</option>
                                    <option value="set-not-active">2.Set not active</option>
                                    <option value="set-delete">3.Delete</option>
                                </select>
                                <button class=" btn btn-sm btn-primary badge ok-1">OK</button>
                            </div>

                            <div class="e-table">
                                <div class="table-responsive table-lg mt-3">
                                    <table class="table table-bordered">
                                        <thead>
                                        <tr>
                                            <th class="align-top">
                                                <div
                                                        class="custom-control custom-control-inline custom-checkbox custom-control-nameless m-0">
                                                    <input type="checkbox" class="custom-control-input" id="all-items">
                                                    <label class="custom-control-label" for="all-items"></label>
                                                </div>
                                            </th>
                                            <th class="max-width">Name</th>
                                            <th class="sortable">Role</th>
                                            <th>Status</th>
                                            <th>Actions</th>
                                        </tr>
                                        </thead>
                                        <?php
                                        $sql = "SELECT * FROM `user`";
                                        $result = mysqli_query($con, $sql);
                                        while ($row = mysqli_fetch_assoc($result)) {
                                        $id = $row['id'];
                                        $first_name = $row['first_name'];
                                        $last_name = $row['last_name'];
                                        $status = $row['status'];
                                        $role = $row['role'];
                                        ?>
                                        <tbody>
                                        <tr id="tr-<?= $id ?>">
                                            <td class="align-middle">
                                                <div class="custom-control custom-control-inline custom-checkbox custom-control-nameless m-0 align-top">
                                                    <input type="checkbox" class="custom-control-input select-checkbox check" value="<?= $id ?>"
                                                           id="item-<?= $id ?>">
                                                    <label class="custom-control-label" for="item-<?= $id ?>"></label>
                                                </div>
                                            </td>
                                            <td class="text-nowrap align-middle name-<?= $id ?>"><?= $first_name . ' ' . $last_name ?></td>
                                            <td class="text-nowrap align-middle role-<?= $id ?>"><span><?= $role ?><span></td>
                                            <?php
                                            if ($row['status'] == 'on') {
                                                echo '<td class="text-center align-middle"><i id="status-' . $id . '"  class="fa fa-circle  circle active"></i></td>';
                                            } else {
                                                echo '<td  class="text-center align-middle "><i id="status-' . $id . '" class="fa fa-circle status-' . $id . ' circle"></i></td>';
                                            };
                                            ?>
                                            <td class="text-center align-middle">
                                                <div class="btn-group align-top">
                                                    <button class="btn btn-sm btn-outline-secondary badge" id="up-btn-<?= $id ?>" type="button"
                                                            data-toggle="modal"
                                                            onclick="ed(<?= $id ?>)">Edit
                                                    </button>

                                                    <button class="btn btn-sm btn-outline-secondary badge" onclick="deleteUser(<?= $id ?>)" type="button"><i
                                                                class="fa fa-trash"></i></button>
                                                </div>
                                                <?php
                                                };
                                                ?>
                                            </td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </div>
                                <div class="d-flex ">
                                    <button class="btn btn-sm btn-primary badge add-btn " type="button" data-toggle="modal" onclick="displayAdd()">Add</button>
                                    <select class="form-control option sel-2 " name="option">
                                        <option value="">-Please Select-</option>
                                        <option value="set-active">1.Set active</option>
                                        <option value="set-not-active">2.Set not active</option>
                                        <option value="set-delete">3.Delete</option>
                                    </select>
                                    <button class=" btn btn-sm btn-primary badge ok-2">OK</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- User Modal Form  -->

                    <div class="modal fade" id="user-modal" tabindex="-1" aria-labelledby="user-form-modal"
                         aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="modal-title"></h5>
                                    <button type="button" class="close close-modal" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <form id="modal-form">
                                        <div class="form-group">
                                            <label for="first_name">First name</label>
                                            <input type="text" class="form-control" id="first_name">
                                        </div>
                                        <div class="form-group">
                                            <label for="last_name">Last name</label>
                                            <input type="text" class="form-control" id="last_name">
                                        </div>
                                        <div class="form-group">
                                            <label for="status" class="toogle-label">Status</label>
                                            <label class="switch">
                                                <input type="checkbox" class="form-control switch" id="status">
                                                <span class="slider round"></span>
                                            </label>
                                        </div>
                                        <div class="form-group">
                                            <label for="role" class="role-lable">Role</label>
                                            <select class="form-control" name="role" id="role">
                                                <option value="">-Please Select-</option>
                                                <option value="Admin">Admin</option>
                                                <option value="User">User</option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <p class="modal-msg"></p>
                                        </div>
                                    </form>
                                </div>
                                <div class="modal-footer">
                                    <input type="hidden" id="hiddenData">
                                    <button type="button" class="btn btn-secondary close-modal" data-dismiss="modal">Close</button>
                                    <button type="button" class="btn btn-primary" id="sus-btn"></button>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <script>
                function ed(updateId) {
                    userForm('Update User', 'Update');
                    editUser(updateId);
                    $('#sus-btn').attr('onclick', 'updateUser(' + updateId + ')');
                }

                function displayAdd() {
                    userForm('Add User', 'Add')
                    $('#sus-btn').attr('onclick', 'addUser()');
                }

                function addUser() {
                    let nameAdd = $('#first_name').val();
                    let surnameAdd = $('#last_name').val();
                    let statusAdd = $('#status').prop('checked') ? 'on' : 'off';
                    let roleAdd = $('#role').val();


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
                            let response = JSON.parse(data);
                            if (response.status === true) {
                                $('#user-modal').modal('hide');
                                let newRow = `
                    <tbody>
                        <tr id="tr-${response.user.id}" ">
                            <td class="align-middle">
                                <div class="custom-control custom-control-inline custom-checkbox custom-control-nameless m-0 align-top">
                                    <input type="checkbox" class="custom-control-input select-checkbox check" value="${response.user.id}" id="item-${response
                                    .user.id}">
                                    <label class="custom-control-label" for="item-${response.user.id}"></label>
                                </div>
                            </td>
                            <td class="text-nowrap align-middle name-${response.user.id}">${response.user.first_name} ${response.user.last_name}</td>
                            <td class="text-nowrap align-middle role-${response.user.id}"><span>${response.user.role}</span></td>
                            <td  class="text-center align-middle"><i id="status-${response.user.id}" class="fa fa-circle  circle ${response.user.status === 'on' ?
                                    'active' :
                                    ''}"></i></td>
                            <td class="text-center align-middle">
                                <div class="btn-group align-top">
                                    <button class="btn btn-sm btn-outline-secondary badge" id="up-btn-${response.user.id}" type="button" data-toggle="modal" onclick="ed(${response.user.id})">Edit</button>
                                    <button class="btn btn-sm btn-outline-secondary badge" onclick="deleteUser(${response.user.id})" type="button"><i class="fa fa-trash"></i></button>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                `;
                                $('.table.table-bordered').append(newRow);
                            } else if (response.status === false && response.error.code === 100) {
                                $('.modal-msg').html('PLEASE FILL ALL FIELDS');
                            }
                        }
                    });
                }


                function updateUser(updateId) {
                    let updateFName = $('#first_name').val()
                    let updateLName = $('#last_name').val()
                    let updateStatus = $('#status').prop('checked') ? 'on' : 'off';
                    let updateRole = $('#role').val()
                    let hiddenData = $('#hiddenData').val()
                    $.ajax({
                        url: 'forms/update.php', type: "post", data: {
                            updateFName: updateFName, updateLName: updateLName, updateStatus: updateStatus, updateRole: updateRole, hiddenData: hiddenData,
                        }, success: function (data, status) {
                            let response = JSON.parse(data)
                            if (response.status === true) {
                                $('#user-modal').modal('hide')
                                $('.name-' + updateId).html(updateFName + ' ' + updateLName)
                                $('.role-' + updateId).html(updateRole)
                                if (updateStatus === 'on') {
                                    $('#status-' + updateId).addClass('active')
                                } else {
                                    $('#status-' + updateId).removeClass('active')
                                }

                            } else if (response.status === false && response.error.code === 100) {
                                $('.modal-msg').html('PLEASE FILL ALL FIELDS')
                            }
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
                            $('#first_name').val(userid.user.first_name);
                            $('#last_name').val(userid.user.last_name);
                            $('#role').val(userid.user.role);
                            $('#status').prop('checked', userid.user.status === 'on').change();
                        }
                    });

                }

                function deleteUser(deleteId) {
                    if (confirm("CONFIRM DELETE")) {
                        $.ajax({
                            url: "forms/delete.php",
                            type: "post",
                            data: {
                                deleteSend: deleteId
                            },
                            success: function (data, status) {
                                $("#tr-" + deleteId).remove();
                            }
                        });
                    }
                }


                function clearFields() {
                    $('#first_name').val('');
                    $('#last_name').val('');
                    $('#role').val('');
                }

                function userForm(title, btn) {
                    hideWarn()
                    clearFields()
                    $('#modal-title').text(title)
                    $('#sus-btn').text(btn)
                    $("#user-modal").modal("show");


                }

                function hideWarn() {
                    $('.modal-msg').html('')
                }

                $(document).ready(function () {

                    let allItems = $("#all-items");

                    function updateCheck() {

                    }

                    // let itemCheckboxes = $(".check");

                    allItems.change(function () {
                        if ($(this).prop("checked")) {
                            $('.check').prop("checked", true);
                        } else {
                            $('.check').prop("checked", false);
                        }
                    });

                    $('.check').change(function () {
                        if ($('.check').filter(":checked").length === $('.check').length) {
                            allItems.prop("checked", true);
                        } else {
                            allItems.prop("checked", false);
                        }
                    });
                });

                $(document).on('click', '.ok-1', function () {
                    const numChecked = $('.select-checkbox:checked')
                    const sel1 = $('.sel-1').val()
                    let selectedRows = numChecked.map(function () {
                        return $(this).val();
                    }).get();

                    if (numChecked.length === 0 && sel1 !== '') {
                        alert('Please pick at least one user');

                    } else if (numChecked.length !== 0 && sel1 === '') {
                        alert('Please choose the option');

                    } else if (sel1 === 'set-active') {
                        $.ajax({
                            url: "forms/setUser.php",
                            type: "post",
                            data: {
                                setActive: selectedRows
                            },
                            success: function (data, status) {
                                selectedRows.forEach(function (select) {
                                    $('#status-' + select).addClass('active')
                                })
                                $('.check').prop("checked", false);
                                $("#all-items").prop("checked", false);
                            }
                        })

                    } else if (sel1 === 'set-not-active') {
                        $.ajax({
                            url: "forms/setUser.php",
                            type: "post",
                            data: {
                                setNotActive: selectedRows
                            },
                            success: function (data, status) {
                                selectedRows.forEach(function (select) {
                                    $('#status-' + select).removeClass('active')
                                })
                                $('.check').prop("checked", false);
                                $("#all-items").prop("checked", false);
                            }
                        })

                    } else if (sel1 === 'set-delete') {
                        if (confirm("CONFIRM DELETE")) {
                            $.ajax({
                                url: "forms/setUser.php",
                                type: "post",
                                data: {
                                    setDelete: selectedRows
                                },
                                success: function (data, status) {
                                    selectedRows.forEach(function (select) {
                                        $("#tr-" + select).remove();
                                    })
                                    $('.check').prop("checked", false);
                                    $("#all-items").prop("checked", false);
                                }
                            })
                        }
                    }
                });
                $(document).on('click', '.ok-2', function () {
                    const numChecked = $('.select-checkbox:checked')
                    const sel = $('.sel-2').val()
                    let selectedRows = numChecked.map(function () {
                        return $(this).val();
                    }).get();

                    if (numChecked.length === 0 && sel !== '') {
                        alert('Please pick at least one user');

                    } else if (numChecked.length !== 0 && sel === '') {
                        alert('Please choose the option');

                    } else if (sel === 'set-active') {
                        $.ajax({
                            url: "forms/setUser.php",
                            type: "post",
                            data: {
                                setActive: selectedRows
                            },
                            success: function (data, status) {
                                selectedRows.forEach(function (select) {
                                    $('#status-' + select).addClass('active')
                                })
                                $('.check').prop("checked", false);
                                $("#all-items").prop("checked", false);
                            }
                        })

                    } else if (sel === 'set-not-active') {
                        $.ajax({
                            url: "forms/setUser.php",
                            type: "post",
                            data: {
                                setNotActive: selectedRows
                            },
                            success: function (data, status) {
                                selectedRows.forEach(function (select) {
                                    $('#status-' + select).removeClass('active')
                                })
                                $('.check').prop("checked", false);
                                $("#all-items").prop("checked", false);
                            }
                        })

                    } else if (sel === 'set-delete') {
                        if (confirm("CONFIRM DELETE")) {
                            $.ajax({
                                url: "forms/setUser.php",
                                type: "post",
                                data: {
                                    setDelete: selectedRows
                                },
                                success: function (data, status) {
                                    selectedRows.forEach(function (select) {
                                        $("#tr-" + select).remove();
                                    })
                                    $('.check').prop("checked", false);
                                    $("#all-items").prop("checked", false);
                                }
                            })
                        }
                    }
                });
            </script>

</body>
</html>