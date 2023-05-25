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
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.1.1/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="css/styles.css">
</head>
<body>

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
                            <div class="d-flex head ">
                                <div class="select-box d-flex"></div>
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
                                        <tbody>
                                        <?php
                                        $sql = "SELECT * FROM `user`";
                                        $stmt = $con->prepare($sql);
                                        $stmt->execute();
                                        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

                                        foreach ($rows as $row) {
                                            $id = $row['id'];
                                            $first_name = $row['first_name'];
                                            $last_name = $row['last_name'];
                                            $status = $row['status'];
                                            $role = $row['role'];
                                            ?>

                                            <tr id="tr-<?= $id ?>">
                                                <td class="align-middle">
                                                    <div class="custom-control custom-control-inline custom-checkbox custom-control-nameless m-0 align-top">
                                                        <input type="checkbox" class="custom-control-input select-checkbox check" value="<?= $id ?>"
                                                               id="item-<?= $id ?>">
                                                        <label class="custom-control-label" for="item-<?= $id ?>"></label>
                                                    </div>
                                                </td>
                                                <td class="text-nowrap align-middle"><?= $first_name . ' ' . $last_name ?></td>
                                                <td class="text-nowrap align-middle "><span><?= $roles[$role] ?><span></td>
                                                <td class="text-center align-middle"><i id="status-<?= $id ?>"
                                                                                        class="fa fa-circle circle <?= $status ? 'active' : '' ?>"></i></td>
                                                <td class="text-center align-middle">
                                                    <div class="btn-group align-top">
                                                        <button class="btn btn-sm btn-outline-secondary badge" id="up-btn-<?= $id ?>" type="button"
                                                                data-toggle="modal">Edit
                                                        </button>

                                                        <button class="btn btn-sm btn-outline-secondary badge btn-delete" data-delete-id="<?= $id ?>"
                                                                data-first-name="<?= $first_name ?>" data-last-name="<?= $last_name ?>" type="button"><i class="fa
                                                    fa-trash"></i></button>
                                                    </div>
                                                </td>
                                            </tr>
                                        <?php }; ?>
                                        </tbody>
                                    </table>
                                </div>
                                <div class="d-flex footer ">
                                    <div class="select-box d-flex"></div>
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
                                                    <?php
                                                    foreach ($roles as $key => $role) {
                                                        echo "<option value = $key >$role</option>";
                                                    }
                                                    ?>
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
                        <!--Delete Modal-->
                        <div class="modal fade" id="delete-modal" tabindex="-1" aria-labelledby="delete-modal-title" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="delete-modal-title">Delete Confirmation</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <p class="modal-body-delete"></p>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                                        <button type="button" class="btn btn-danger" id="confirm-delete">Delete</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--Alert Modal-->
                        <div class="modal fade" id="alert-modal" tabindex="-1" role="dialog">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title">Warning</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <p class="modal-body-alert"></p>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
                <script>
                    let addbtn = $('<button>', {
                        class: 'btn btn-sm btn-primary badge add-btn',
                        type: 'button',
                        text: 'Add',
                    }).appendTo('.select-box')

                    let arr = [
                        {val: '', text: '-Please-Select-'},
                        {val: 'set-active', text: 'Set Active'},
                        {val: 'set-not-active', text: 'Set Not Active'},
                        {val: 'set-delete', text: 'Delete'}
                    ];

                    let sel = $('<select>', {
                        class: 'form-control sel',
                    }).appendTo('.select-box');
                    $(arr).each(function () {
                        sel.append($("<option>").attr('value', this.val).text(this.text));
                    });

                    let okbtn = $('<button>', {
                        class: 'btn btn-sm btn-primary badge ok-btn',
                        type: 'button',
                        text: 'OK',
                    }).appendTo('.select-box')


                    $(document).on('click', '.add-btn', function () {
                        userForm('Add User', 'Add')
                        $('#sus-btn').attr('onclick', 'addUser()');
                    })

                    function addUser() {
                        let nameAdd = encodeURIComponent($('#first_name').val());
                        let surnameAdd = encodeURIComponent($('#last_name').val());
                        let statusAdd = $('#status').prop('checked') ? 1 : 0;
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
                            dataType: 'json',
                            success: function (response) {
                                if (response.status === true) {
                                    $('#user-modal').modal('hide');
                                    let newRow = `
                    <tbody>
                        <tr id="tr-${response.user.id}">
                            <td class="align-middle">
                                <div class="custom-control custom-control-inline custom-checkbox custom-control-nameless m-0 align-top">
                                    <input type="checkbox" class="custom-control-input select-checkbox check" value="${response.user.id}" id="item-${response.user.id}">
                                    <label class="custom-control-label" for="item-${response.user.id}"></label>
                                </div>
                            </td>
                            <td class="text-nowrap align-middle"><span>${response.user.first_name} ${response.user.last_name}</span></td>
                            <td class="text-nowrap align-middle"><span>${response.user.role_name}</span></td>
                            <td class="text-center align-middle"><i id="status-${response.user.id}" class="fa fa-circle circle ${response.user.status ? 'active' : ''}"></i></td>
                            <td class="text-center align-middle">
                                <div class="btn-group align-top">
                                    <button class="btn btn-sm btn-outline-secondary badge" id="up-btn-${response.user.id}" type="button" data-toggle="modal">Edit</button>
                                    <button class="btn btn-sm btn-outline-secondary badge btn-delete" data-delete-id="${response.user.id}"
                                    data-first-name="${response.user.first_name}" data-last-name="${response.user.last_name}" type="button"><i class="fa
                                    fa-trash"></i></button>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                `;
                                    $('.table.table-bordered').append(newRow);
                                    $('#all-items').prop('checked', false);
                                } else if (response.status === false && response.error.code === 101) {
                                    $('.modal-msg').html('PLEASE FILL ALL FIELDS');
                                }
                            },
                            error: function (xhr, status, error) {
                                console.log(error);
                            }
                        });
                    }


                    function updateUser(updateId) {
                        let updateFName = encodeURIComponent($('#first_name').val())
                        let updateLName = encodeURIComponent($('#last_name').val())
                        let updateStatus = $('#status').prop('checked') ? 1 : 0;
                        let updateRole = $('#role').val()
                        let hiddenData = $('#hiddenData').val()
                        $.ajax({
                            url: 'forms/update.php', type: "post", data: {
                                updateFName: updateFName,
                                updateLName: updateLName,
                                updateStatus: updateStatus,
                                updateRole: updateRole,
                                hiddenData: hiddenData,
                            },
                            dataType: 'json',
                            success: function (response) {
                                if (response.error !== null && response.error.code !== null) {
                                    switch (response.error.code) {
                                        case 101: {
                                            $('.modal-msg').html('PLEASE FILL ALL FIELDS');
                                            break;
                                        }
                                        case 100: {
                                            $('#user-modal').modal('hide');
                                            let parent = $('#tr-' + updateId)
                                            let sub = parent.children().eq(1)
                                            let user = sub.html()
                                            $('.modal-body-alert').html(user + ' not found');
                                            $('#alert-modal').modal('show');
                                            break;
                                        }
                                    }
                                } else {
                                    $('#user-modal').modal('hide')
                                    let parent = $('#tr-' + updateId)
                                    let sub = parent.children().eq(1)
                                    let subRole = parent.children().eq(2)
                                    sub.html(updateFName + ' ' + updateLName)
                                    subRole.html(response.user.role_name)
                                    if (updateStatus) {
                                        $('#status-' + updateId).addClass('active');
                                    } else {
                                        $('#status-' + updateId).removeClass('active');
                                    }
                                }


                            },
                            error: function (xhr, status, error) {
                                console.log(error);
                            }
                        });

                    }


                    $(document).on('click', '[id^="up-btn-"]', function () {
                        const updateId = $(this).attr('id').split('-')[2];
                        $('#hiddenData').val(updateId);

                        $.ajax({
                            url: 'forms/edit.php',
                            type: 'post',
                            data: {
                                updateId: updateId
                            },
                            dataType: 'json',
                            success: function (userid) {
                                switch (userid.status) {
                                    case true: {
                                        userForm('Update User', 'Update');
                                        $('#first_name').val(userid.user.first_name);
                                        $('#last_name').val(userid.user.last_name);
                                        $('#role').val(userid.user.role);
                                        $('#status').prop('checked', userid.user.status).change();
                                        break;
                                    }
                                    case false: {
                                        let parent = $('#tr-' + updateId)
                                        let sub = parent.children().eq(1)
                                        let user = sub.html()
                                        $('.modal-body-alert').html(user + ' not found');
                                        $('#alert-modal').modal('show');
                                        break;
                                    }
                                }
                            },
                            error: function (xhr, status, error) {
                                console.log(error)
                            }
                        });
                        $('#sus-btn').attr('onclick', 'updateUser(' + updateId + ')');
                    });


                    $(document).ready(function () {
                        $(document).on('click', '.btn-delete', function () {
                            let deleteId = $(this).data('delete-id');
                            let firstName = $(this).data('first-name');
                            let lastName = $(this).data('last-name');

                            showDeleteConfirmation(deleteId, firstName, lastName);
                        });

                        $(document).on('click', '.delete-user', function () {
                            let deleteId = $(this).data('delete-id');
                            deleteConfirmed(deleteId);
                        });
                    });

                    function showDeleteConfirmation(deleteId, firstName, lastName) {
                        $('.modal-body-delete').html('Are you sure you want to delete' + ' ' + firstName + ' ' + lastName);
                        $('#delete-modal').modal('show');
                        $('#confirm-delete').data('delete-id', deleteId);
                        $('#confirm-delete').addClass('delete-user');
                    }

                    function deleteConfirmed(deleteId) {
                        $.ajax({
                            url: "forms/delete.php",
                            type: "post",
                            data: {
                                deleteSend: deleteId
                            },
                            dataType: 'json',
                            success: function (response) {
                                switch (response.status) {
                                    case true: {
                                        $("#tr-" + deleteId).remove();
                                        $('#confirm-delete').removeClass('delete-user');
                                        $('#delete-modal').modal('hide');
                                        break;
                                    }
                                    case false: {
                                        let parent = $('#tr-' + deleteId)
                                        let sub = parent.children().eq(1)
                                        let user = sub.html()
                                        $('#confirm-delete').removeClass('delete-user');
                                        $('#delete-modal').modal('hide');
                                        $('.modal-body-alert').html(user + ' is already deleted');
                                        $('#alert-modal').modal('show');
                                        $("#tr-" + deleteId).remove();
                                        break;
                                    }
                                }
                            }
                        });
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
                        $('#all-items').prop('checked', false);
                        $(document).on('change', '#all-items', function () {
                            if ($(this).prop("checked")) {
                                $('.check').prop("checked", true);
                            } else {
                                $('.check').prop("checked", false);
                            }
                        });

                        $(document).on('change', '.check', function () {
                            if ($('.check:checked').length === $('.check').length) {
                                $("#all-items").prop("checked", true);
                            } else {
                                $("#all-items").prop("checked", false);
                            }
                        });
                    });

                    function selectCheck(numChecked, sel, selectedRows) {
                        if (numChecked.length === 0 && sel !== '') {
                            $('.modal-body-alert').html('Please pick at least one User')
                            $('#alert-modal').modal('show')

                        } else if (numChecked.length !== 0 && sel === '') {
                            $('.modal-body-alert').html('Please choose the option')
                            $('#alert-modal').modal('show')

                        } else if (numChecked.length === 0 && sel === '') {
                            $('.modal-body-alert').html('Please pick at least one User and choose an option');
                            $('#alert-modal').modal('show');
                        } else if (sel === 'set-active') {
                            $.ajax({
                                url: "forms/setUser.php",
                                type: "post",
                                data: {
                                    setActive: selectedRows
                                },
                                dataType: 'json',
                                success: function (response) {
                                    switch (response.status) {
                                        case true: {
                                            selectedRows.forEach(function (select) {
                                                $('#status-' + select).addClass('active')
                                            })
                                            $('.check').prop("checked", false);
                                            $("#all-items").prop("checked", false);
                                            break
                                        }
                                        case false: {
                                            let selected = response.error.errorId
                                            $('.modal-body-alert').html('There are selected Users that doesn\'t exist anymore')
                                            $('#alert-modal').modal('show')
                                            $('.check').prop("checked", false);
                                            $("#all-items").prop("checked", false);
                                            break
                                        }
                                    }

                                }
                            })

                        } else if (sel === 'set-not-active') {
                            $.ajax({
                                url: "forms/setUser.php",
                                type: "post",
                                data: {
                                    setNotActive: selectedRows
                                },
                                dataType: 'json',
                                success: function (response) {
                                    switch (response.status) {
                                        case true: {
                                            selectedRows.forEach(function (select) {
                                                $('#status-' + select).removeClass('active')
                                            })
                                            $('.check').prop("checked", false);
                                            $("#all-items").prop("checked", false);
                                            break
                                        }
                                        case false: {
                                            let selected = response.error.errorId
                                            $('.modal-body-alert').html('There are selected Users that doesn\'t exist anymore')
                                            $('#alert-modal').modal('show')
                                            $('.check').prop("checked", false);
                                            $("#all-items").prop("checked", false);
                                            break
                                        }
                                    }

                                }
                            })

                        } else if (sel === 'set-delete') {
                            $('#delete-modal').modal('show')
                            $('.modal-body-delete').html('Are you sure you want to delete this users?')
                            $('#confirm-delete').addClass('user-set-delete');
                            $(document).off('click', '.user-set-delete').on('click', '.user-set-delete', function () {
                                $.ajax({
                                    url: "forms/setUser.php",
                                    type: "post",
                                    data: {
                                        setDelete: selectedRows
                                    },
                                    dataType: 'json',
                                    success: function (response) {
                                        switch (response.status) {
                                            case true: {
                                                selectedRows.forEach(function (select) {
                                                    $("#tr-" + select).remove();
                                                })
                                                $('.check').prop("checked", false);
                                                $("#all-items").prop("checked", false);
                                                break
                                            }
                                            case false: {
                                                let selected = response.error.errorId
                                                $('.modal-body-alert').html('There are selected Users that already deleted')
                                                $('#alert-modal').modal('show')
                                                selected.forEach(function (select) {
                                                    $("#tr-" + select).remove();
                                                })
                                                $('.check').prop("checked", false);
                                                $("#all-items").prop("checked", false);
                                                break
                                            }
                                        }

                                    }
                                })
                                $('#confirm-delete').removeClass('user-set-delete')
                                $('#delete-modal').modal('hide');
                            });
                        }
                    }


                    $(document).on('click', '.ok-btn', function () {
                        let container = $(this).closest('.select-box').parent();
                        const numChecked = $('.select-checkbox:checked')
                        let sel = container.find('.sel').val();
                        let selectedRows = numChecked.map(function () {
                            return $(this).val();
                        }).get();

                        if (container.hasClass('head')) {
                            selectCheck(numChecked,sel,selectedRows)
                        } else if (container.hasClass('footer')) {
                            selectCheck(numChecked,sel,selectedRows)

                        }


                    });


                    // $(document).on('click', '.ok-2', function () {
                    //     const numChecked = $('.select-checkbox:checked')
                    //     const sel2 = $('.sel-2').val()
                    //     let selectedRows = numChecked.map(function () {
                    //         return $(this).val();
                    //     }).get();
                    //     if (numChecked.length === 0 && sel2 !== '') {
                    //         $('.modal-body-alert').html('Please pick at least one User')
                    //         $('#alert-modal').modal('show')
                    //
                    //     } else if (numChecked.length !== 0 && sel2 === '') {
                    //         $('.modal-body-alert').html('Please choose the option')
                    //         $('#alert-modal').modal('show')
                    //     } else if (numChecked.length === 0 && sel2 === '') {
                    //         $('.modal-body-alert').html('Please pick at least one User and choose an option');
                    //         $('#alert-modal').modal('show');
                    //     } else if (sel2 === 'set-active') {
                    //         $.ajax({
                    //             url: "forms/setUser.php",
                    //             type: "post",
                    //             data: {
                    //                 setActive: selectedRows
                    //             },
                    //             dataType: 'json',
                    //             success: function (response) {
                    //                 switch (response.status) {
                    //                     case true: {
                    //                         selectedRows.forEach(function (select) {
                    //                             $('#status-' + select).addClass('active')
                    //                         })
                    //                         $('.check').prop("checked", false);
                    //                         $("#all-items").prop("checked", false);
                    //                         break
                    //                     }
                    //                     case false: {
                    //                         let selected = response.error.errorId
                    //                         $('.modal-body-alert').html('There are selected Users that doesn\'t exist anymore')
                    //                         $('#alert-modal').modal('show')
                    //                         selected.forEach(function (select) {
                    //                             $("#tr-" + select).remove();
                    //                         })
                    //                         $('.check').prop("checked", false);
                    //                         $("#all-items").prop("checked", false);
                    //                         break
                    //                     }
                    //                 }
                    //             }
                    //         })
                    //
                    //     } else if (sel2 === 'set-not-active') {
                    //         $.ajax({
                    //             url: "forms/setUser.php",
                    //             type: "post",
                    //             data: {
                    //                 setNotActive: selectedRows
                    //             },
                    //             dataType: 'json',
                    //             success: function (response) {
                    //                 switch (response.status) {
                    //                     case true: {
                    //                         selectedRows.forEach(function (select) {
                    //                             $('#status-' + select).removeClass('active')
                    //                         })
                    //                         $('.check').prop("checked", false);
                    //                         $("#all-items").prop("checked", false);
                    //
                    //                         break
                    //                     }
                    //                     case false: {
                    //                         let selected = response.error.errorId
                    //                         $('.modal-body-alert').html('There are selected Users that doesn\'t exist anymore')
                    //                         $('#alert-modal').modal('show')
                    //                         selected.forEach(function (select) {
                    //                             $("#tr-" + select).remove();
                    //                         })
                    //                         $('.check').prop("checked", false);
                    //                         $("#all-items").prop("checked", false);
                    //                         break
                    //                     }
                    //                 }
                    //             }
                    //         })
                    //     } else if (sel2 === 'set-delete') {
                    //         $('#delete-modal').modal('show')
                    //         $('.modal-body-delete').html('Are you sure you want to delete this users?')
                    //         $('#confirm-delete').addClass('user-set-delete');
                    //         $(document).off('click', '.user-set-delete').on('click', '.user-set-delete', function () {
                    //             $.ajax({
                    //                 url: "forms/setUser.php",
                    //                 type: "post",
                    //                 data: {
                    //                     setDelete: selectedRows
                    //                 },
                    //                 dataType: 'json',
                    //                 success: function (response) {
                    //                     switch (response.status) {
                    //                         case true: {
                    //                             selectedRows.forEach(function (select) {
                    //                                 $("#tr-" + select).remove();
                    //                             })
                    //                             $('.check').prop("checked", false);
                    //                             $("#all-items").prop("checked", false);
                    //                             break
                    //                         }
                    //                         case false: {
                    //                             let selected = response.error.errorId
                    //                             $('.modal-body-alert').html('There are selected Users that already deleted')
                    //                             $('#alert-modal').modal('show')
                    //                             selected.forEach(function (select) {
                    //                                 $("#tr-" + select).remove();
                    //                             })
                    //                             $('.check').prop("checked", false);
                    //                             $("#all-items").prop("checked", false);
                    //                             break
                    //                         }
                    //                     }
                    //                 }
                    //             })
                    //             $('#confirm-delete').removeClass('user-set-delete')
                    //             $('#delete-modal').modal('hide');
                    //         });
                    //     }
                    // });
                </script>

</body>
</html>