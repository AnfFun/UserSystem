<?php
include_once '../connect.php';

$response = [];

function checkUserExists($con, $user_id)
{
    $sql = "SELECT * FROM `user` WHERE `id` = $user_id";
    $result = mysqli_query($con, $sql);
    return mysqli_num_rows($result) > 0;
}

function updateUserStatus($con, $ids, $status)
{
    $ids = implode(',', $ids);
    $sql = "UPDATE `user` SET status = '$status' WHERE id IN ($ids)";
    $result = mysqli_query($con, $sql);
    return $result;
}

function deleteUser($con, $ids)
{
    $ids = implode(',', $ids);
    $sql = "DELETE FROM `user` WHERE id IN ($ids)";
    $result = mysqli_query($con, $sql);
    return $result;
}

if (isset($_POST['setNotActive'])) {
    $ids = array_filter($_POST['setNotActive'], 'is_numeric');
    $userExists = true;
    $r = [];

    foreach ($ids as $user_id) {
        if (!checkUserExists($con, $user_id)) {
            $r[] = $user_id;
            $userExists = false;
        }
    }

    if ($userExists) {
        $status = 0;
        if (updateUserStatus($con, $ids, $status)) {
            $response['status'] = true;
            $response['error'] = null;
            $response['users'] = [
                'id' => implode(',', $ids)
            ];
        } else {
            $response['status'] = false;
            $response['error'] = [
                'code' => 500,
                'message' => 'Status not changed'
            ];
        }
    } else {
        $rs = implode(',', $r);
        $response['status'] = false;
        $response['error'] = [
            'code' => 100,
            'message' => "Users with id: $rs not found",
            'errorId' => $r
        ];
    }
}

if (isset($_POST['setActive'])) {
    $ids = array_filter($_POST['setActive'], 'is_numeric');
    $userExists = true;
    $r = [];

    foreach ($ids as $user_id) {
        if (!checkUserExists($con, $user_id)) {
            $r[] = $user_id;
            $userExists = false;
        }
    }

    if ($userExists) {
        $status = 1;
        if (updateUserStatus($con, $ids, $status)) {
            $response['status'] = true;
            $response['error'] = null;
            $response['users'] = [
                'id' => implode(',', $ids)
            ];
        } else {
            $response['status'] = false;
            $response['error'] = [
                'code' => 500,
                'message' => 'Status not changed'
            ];
        }
    } else {
        $rs = implode(',', $r);
        $response['status'] = false;
        $response['error'] = [
            'code' => 100,
            'message' => "Users with id: $rs not found",
            'errorId' => $r
        ];
    }
}

if (isset($_POST['setDelete'])) {
    $ids = array_filter($_POST['setDelete'], 'is_numeric');
    $userExists = true;
    $r = [];

    foreach ($ids as $user_id) {
        if (!checkUserExists($con, $user_id)) {
            $r[] = $user_id;
            $userExists = false;
        }
    }

    if ($userExists) {
        if (deleteUser($con, $ids)) {
            $response['status'] = true;
            $response['error'] = null;
            $response['users'] = [
                'id' => implode(',', $ids)
            ];
        } else {
            $response['status'] = false;
            $response['error'] = [
                'code' => 500,
                'message' => 'Users not deleted'
            ];
        }
    } else {
        $rs = implode(',', $r);
        $response['status'] = false;
        $response['error'] = [
            'code' => 100,
            'message' => "Users with id: $rs not found",
            'errorId' => $r
        ];
    }
}

header('Content-Type: application/json');
echo json_encode($response);
?>
