<?php 

if(!isset($_SESSION['doe_uid'])){
    // echo "error 1";
    header('Location: '.ROOT_DOMAIN);
    die();
}

$uid = $_SESSION['doe_uid'];
$token = $_SESSION['doe_token'];

$strSQL = "SELECT * FROM mym_useraccount WHERE UID = '$uid' AND ROLE = '$role' AND ACTIVE_STATUS = 'Y' AND DELETE_STATUS = 'N'";
$resUser = $db->fetch($strSQL, false, false);

$currentUser = null;
if($resUser){
    $currentUser = $resUser;
}else{
    session_destroy();
    // echo "error 2";
    // die();
    header('Location: '.ROOT_DOMAIN);
    die();
}


?>