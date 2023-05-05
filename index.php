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
    <script src="js/userModal.js"></script>
    <script src="js/checkbox.js"></script>
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
                                <button class="btn btn-sm btn-primary badge add-btn" type="button" data-toggle="modal" onclick="ed()">
                                    Add User
                                </button>
                                <select class="form-control option sel-1 " name="option">
                                    <option value="">-Please Select-</option>
                                    <option value="set-active">Set active</option>
                                    <option value="set-not-active">Set not active</option>
                                    <option value="set-delete">Delete</option>
                                </select>
                                <button class=" btn btn-sm btn-primary badge ok-btn">OK</button>
                            </div>
                            <div id="displayDataTable"></div>
                            <div class="d-flex ">
                                <button class="btn btn-sm btn-primary badge add-btn " type="button" data-toggle="modal" onclick="ed()">
                                    Add User
                                </button>
                                <select class="form-control option sel-2 " name="option">
                                    <option value="">-Please Select-</option>
                                    <option value="set-active">Set active</option>
                                    <option value="set-not-active">Set not active</option>
                                    <option value="set-delete">Delete</option>
                                </select>
                                <button class=" btn btn-sm btn-primary badge ok-btn">OK</button>
                            </div>
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
                            <button type="button" class="btn btn-secondary close-modal"  data-dismiss="modal">Close</button>
                            <button type="button" class="btn btn-primary" id="sus-btn"></button>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>


</body>
</html>