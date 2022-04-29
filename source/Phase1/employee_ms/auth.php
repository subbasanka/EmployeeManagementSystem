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

if(!isset($_SESSION['employee'])){
    header('Location: login.php');
    exit();
}else{
    include 'db.php';
    $employeeid = $_SESSION['employee'];
    $stmt = $sql->prepare("select * from employees where id=?");
    $stmt->bindParam(1, $employeeid, PDO::PARAM_INT);
    $stmt->execute();
    $employeedata = $stmt->fetch();
}
?>