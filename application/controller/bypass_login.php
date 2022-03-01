<?php 
require('../config/server.inc.php');
require('../config/config.php');
require('../config/database.php'); 

if((!isset($_REQUEST['uid'])) || (!isset($_REQUEST['token']))){
  mysqli_close($conn);
  header('Location: ../html/core/login/');
  die();
}

$db = new Database();
$conn = $db->conn();

require('../config/sendemail.php'); 

$uid = mysqli_real_escape_string($conn, $_REQUEST['uid']);
$token = mysqli_real_escape_string($conn, $_REQUEST['token']);

$_SESSION['doe_uid'] = $uid;
$_SESSION['doe_token'] = $token;
$_SESSION['doe_id'] = session_id();

$strSQL = "SELECT * FROM mym_useraccount WHERE UID = '$uid' LIMIT 1";
$res = $db->fetch($strSQL, false, false);

if($res){
  header('Location: '.ROOT_DOMAIN.'html/core/'.$res['ROLE'].'/');
}else{
  header('Location: ../html/core/login/');
}

$db->close();
die();




?>