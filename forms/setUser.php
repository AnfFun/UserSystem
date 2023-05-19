<?php
include_once '../connect.php';

$response = array();
$r = array();

if (isset($_POST['setNotActive'])) {
    $ids = $_POST['setNotActive'];
    $ids = array_filter($ids, 'is_numeric');

    $userExists = true;
    foreach ($ids as $user_id) {
        $sql = "SELECT * FROM `user` WHERE `id` = $user_id";
        $result = mysqli_query($con, $sql);
        if (mysqli_num_rows($result) == 0) {
            $r[] = $user_id;
            $userExists = false;
            break;
        }
    }

    if ($userExists) {
        $status = 0;
        $ids = implode(',', $ids);
        $sql = "
        UPDATE `user`
        SET
            status = '$status'
        WHERE id IN ($ids)
        ";
        $result = mysqli_query($con, $sql);
        if ($result) {
            $response['status'] = true;
            $response['error'] = null;
            $response['users'] = [
                'id' => $ids
            ];
        } else {
            $response['status'] = false ;
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
            'message' => "Users with id:$rs not found",
            'errorId' => $r
        ];
    }

    header('Content-Type: application/json');
    echo json_encode($response);
}

if (isset($_POST['setActive'])) {
    $ids = $_POST['setActive'];
    $ids = array_filter($ids, 'is_numeric');


    $userExists = true;
    foreach ($ids as $user_id) {
        $sql = "SELECT * FROM `user` WHERE `id` = $user_id";
        $result = mysqli_query($con, $sql);
        if (mysqli_num_rows($result) == 0) {
            $r[] = $user_id;
            $userExists = false;
        }
    }

    if ($userExists) {
        $status = 1;
        $ids = implode(',', $ids);
        $sql = "
        UPDATE `user`
        SET
            status = '$status'
        WHERE id IN ($ids)
        ";
        $result = mysqli_query($con, $sql);
        if ($result) {
            $response['status'] = true;
            $response['error'] = null;
            $response['users'] = [
                'id' => $ids
            ];
        } else {
            $response['status'] = false ;
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
            'message' => "Users with id:$rs not found",
            'errorId' => $r
        ];
    }

    header('Content-Type: application/json');
    echo json_encode($response);
}

if (isset($_POST['setDelete'])) {
    $ids = $_POST['setDelete'];
    $ids = array_filter($ids, 'is_numeric');


    $userExists = true;
    foreach ($ids as $user_id) {
        $sql = "SELECT * FROM `user` WHERE `id` = $user_id";
        $result = mysqli_query($con, $sql);
        if (mysqli_num_rows($result) == 0) {
            $r[] = $user_id;
            $userExists = false;
        }
    }

    if ($userExists) {
        $ids = implode(',', $ids);
        $sql = "
        DELETE FROM `user`
        WHERE id IN ($ids)
        ";
        $result = mysqli_query($con, $sql);
        if ($result) {
            $response['status'] = true;
            $response['error'] = null;
            $response['users'] = [
                'id' => $ids
            ];
        } else {
            $response['status'] = false ;
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
            'message' => "Users with id:$rs not found",
            'errorId' => $r
        ];
    }

    header('Content-Type: application/json');
    echo json_encode($response);
}
?>
