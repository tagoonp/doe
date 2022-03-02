<?php 
require('../config/server.inc.php');
require('../config/config.php');
require('../config/database.php'); 

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$db = new Database();
$conn = $db->conn();

require('../config/sendemail.php'); 

if(!isset($_REQUEST['stage'])){
  mysqli_close($conn);
  die();
}

$stage = mysqli_real_escape_string($conn, $_REQUEST['stage']);

if($stage == 'check_available_sis'){
    if(
        (!isset($_REQUEST['role'])) ||
        (!isset($_REQUEST['uid'])) ||
        (!isset($_REQUEST['username'])) ||
        (!isset($_REQUEST['email']))
      ){
        $return['status'] = 'Fail';
        $return['error_message'] = 'Error x1001';
        echo json_encode($return);
        mysqli_close($conn);
        die();
    }
    $uid = mysqli_real_escape_string($conn, $_POST['uid']);
    $role = mysqli_real_escape_string($conn, $_POST['role']);
    

    $prefix = mysqli_real_escape_string($conn, $_POST['prefix']);
    $fname = mysqli_real_escape_string($conn, $_POST['fname']);
    $mname = mysqli_real_escape_string($conn, $_POST['mname']);
    $lname = mysqli_real_escape_string($conn, $_POST['lname']);
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $targe_role = mysqli_real_escape_string($conn, $_POST['targe_role']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);
    $password = base64_encode($password);

    $strSQL = "SELECT * FROM mym_useraccount WHERE (EMAIL = '$email' OR USERNAME = '$username') AND DELETE_STATUS = 'N'";
    $res = $db->fetch($strSQL, true, true);
    if(($res) && ($res['count'] > 0)){
        $return['status'] = 'Fail';
    }else{
        $target_uid = base64_encode(generateRandomString(8).date('Y'));

        $return['uid'] = $target_uid;

        $strSQL = "INSERT INTO mym_useraccount 
                  (
                    `UID`, `USERNAME`, `PREFIX`, `FNAME`, `MNAME`, 
                    `LNAME`, `PID`, `EMAIL`, `PASSWORD`, `ACTIVE_STATUS`, 
                    `DELETE_STATUS`, `UDATETIME`, `ROLE`, `SIS`
                  )
                  VALUES
                  (
                    '$target_uid', '$username', '$prefix', '$fname', '$mname', 
                    '$lname', '$username', '$email', '$password', 'Y', 
                    'N', '$datetime', 'common', '1'
                  )
                  ";
        $resInsert = $db->insert($strSQL, false);
        if($resInsert){
            $return['status'] = 'Available';
        }else{
            $return['status'] = 'Fail';
            $return['message'] = $strSQL;
        }
    }
    echo json_encode($return);
    mysqli_close($conn);
    die();
}

if($stage == 'update_user_info'){
    if(
        (!isset($_REQUEST['role'])) ||
        (!isset($_REQUEST['uid'])) ||
        (!isset($_REQUEST['target_uid']))
      ){
        $return['status'] = 'Fail';
        $return['error_message'] = 'Error x1001';
        echo json_encode($return);
        mysqli_close($conn);
        die();
    }
    $uid = mysqli_real_escape_string($conn, $_POST['uid']);
    $role = mysqli_real_escape_string($conn, $_POST['role']);
    $target_uid = mysqli_real_escape_string($conn, $_POST['target_uid']);

    $prefix = mysqli_real_escape_string($conn, $_POST['prefix']);
    $fname = mysqli_real_escape_string($conn, $_POST['fname']);
    $mname = mysqli_real_escape_string($conn, $_POST['mname']);
    $lname = mysqli_real_escape_string($conn, $_POST['lname']);
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $targe_role = mysqli_real_escape_string($conn, $_POST['targe_role']);
    $position = mysqli_real_escape_string($conn, $_POST['position']);

    $strSQL = "UPDATE mym_useraccount 
               SET 
               USERNAME = '$username', 
               PREFIX = '$prefix', 
               FNAME = '$fname', 
               MNAME = '$mname', 
               LNAME = '$lname', 
               POSITION = '$position', 
               PID = '$username'
               WHERE UID = '$target_uid' 
               ";
    $db->execute($strSQL);
    $return['status'] = 'Success';

    echo json_encode($return);
    mysqli_close($conn);
    die();
}

if($stage == 'remove_sis_role'){
    if(
        (!isset($_REQUEST['role'])) ||
        (!isset($_REQUEST['uid'])) ||
        (!isset($_REQUEST['target_uid']))
      ){
        $return['status'] = 'Fail';
        $return['error_message'] = 'Error x1001';
        echo json_encode($return);
        mysqli_close($conn);
        die();
    }

    $uid = mysqli_real_escape_string($conn, $_POST['uid']);
    $role = mysqli_real_escape_string($conn, $_POST['role']);
    $target_uid = mysqli_real_escape_string($conn, $_POST['target_uid']);

    $strSQL = "UPDATE mym_useraccount SET SIS = '0' WHERE uid = '$target_uid'";
    $db->execute($strSQL);
    mysqli_close($conn);
    die();
}

if($stage == 'toggle_app'){
    if(
        (!isset($_REQUEST['system'])) ||
        (!isset($_REQUEST['uid'])) ||
        (!isset($_REQUEST['cstage']))
      ){
        $return['status'] = 'Fail';
        $return['error_message'] = 'Error x1001';
        echo json_encode($return);
        mysqli_close($conn);
        die();
    }
    $uid = mysqli_real_escape_string($conn, $_POST['uid']);
    $system = mysqli_real_escape_string($conn, $_POST['system']);
    $cstage = mysqli_real_escape_string($conn, $_POST['cstage']);

    $strSQL = "SELECT $system FROM mym_useraccount WHERE UID = '$uid'";
    $res = $db->fetch($strSQL, false, false);

    if($res){

        if($system == 'ACTIVE_STATUS'){
            $new = 'N';
            if($res[$system] != 'Y'){
                $new = 'Y';
            }
            $strSQL = "UPDATE mym_useraccount SET $system = '$new' WHERE UID = '$uid'";
            $db->execute($strSQL);

            $return['status'] = 'Success';
            $return['info'] = $strSQL;
        }else{
            $new = '0';
            if($res[$system] != '1'){
                $new = '1';
            }
            $strSQL = "UPDATE mym_useraccount SET $system = '$new' WHERE UID = '$uid'";
            $db->execute($strSQL);

            $return['status'] = 'Success';
            $return['info'] = $strSQL;
        }
        
    }else{
        $return['status'] = 'Fail';
        $return['error_message'] = 'User not found';
    }
    echo json_encode($return);
    mysqli_close($conn);
    die();
}