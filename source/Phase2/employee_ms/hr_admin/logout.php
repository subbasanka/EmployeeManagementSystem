<?php
    session_start();
    //setcookie("username", '', strtotime( '-5 days' ), '/');
    //setcookie("password", '', strtotime( '-5 days' ), '/');
	//setcookie("PHPSESSID","",time()-3600,"/");
	session_destroy();
    header('location:login.php');
?>