<?php
include_once '../connect.php';

if (isset($_POST['displaySend'])) {

    $table = '
<script src="../js/checkbox.js"></script>
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
                                            <th>Options</th>
                                        </tr>
                                        </thead>';
    $sql = "SELECT * FROM `user`";
    $result = mysqli_query($con, $sql);
    while ($row = mysqli_fetch_assoc($result)) {
        $id = $row['id'];
        $first_name = $row['first_name'];
        $last_name = $row['last_name'];
        $status = $row['status'];
        $role = $row['role'];
        $table .= '
        <tbody>
        <tr>
        <td class="align-middle">
        <div
            class="custom-control custom-control-inline custom-checkbox custom-control-nameless m-0 align-top">
            <input type="checkbox" class="custom-control-input" id="item-' . $id . '">
            <label class="custom-control-label" for="item-' . $id . '"></label>
            </div>
              </td>
                          <td class="text-nowrap align-middle">' . $first_name . ' ' . $last_name . ' </td>
                          <td class="text-nowrap align-middle"><span>' . $role . '</span></td> ';
        if ($row['status'] == 'on') {
            $table .= '<td class="text-center align-middle"><i class="fa fa-circle active-circle"></i></td>';
        } else {
            $table .= '<td class="text-center align-middle"><i class="fa fa-circle .not-active-circle"></i></td>';
        };
        $table .= '<td class="text-center align-middle">
                            <div class="btn-group align-top">
                              <button class="btn btn-sm btn-outline-secondary badge" type="button" data-toggle="modal"
                                data-target="#user-form-modal">Edit</button>
                              <button class="btn btn-sm btn-outline-secondary badge" type="button"><i
                                  class="fa fa-trash"></i></button>
                            </div>
        ';
    };


}
echo $table;