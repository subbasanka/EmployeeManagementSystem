<?php
ob_start();
$status = session_status();

if($status == PHP_SESSION_NONE){
    session_start();
}

else if($status == PHP_SESSION_DISABLED){
    //Sessions are not available
}else if($status == PHP_SESSION_ACTIVE){
    //Destroy current and start new one
    session_destroy();
    session_start();
}

if(!isset($_SESSION['hr'])){
    header('Location: login.php');
    exit();
}else{
    include '../db.php';
    $hrid = $_SESSION['hr'];
    $stmt = $sql->prepare("select * from hr_admins where id=?");
    $stmt->bindParam(1, $hrid, PDO::PARAM_INT);
    $stmt->execute();
    $hrdata = $stmt->fetch();
}
?>