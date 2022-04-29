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