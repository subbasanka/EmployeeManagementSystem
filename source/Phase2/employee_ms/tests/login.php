if(isset($_POST['submit'])){
    $_email = $_POST['email'];
    $_password = $_POST['password'];
    $stmt = $sql->prepare("select * from employees where email = ?");
    $stmt->bindParam(1, $_email, PDO::PARAM_STR);
    $stmt->execute();
    $row = $stmt->fetch();
    $total = $stmt->rowCount();
    if($total>0){
        $db_email = $row['email'];
        $db_password = $row['password'];
        if($_email == $db_email && password_verify($_password, $db_password)){
            $_SESSION['employee'] = $row['id'];
            ob_start();
            header('location:index.php');
            exit();
        }else {
            $error = "<div class='alert alert-danger'>Email or Password is incorrect</div>";
        }
    }else {
        $error = "<div class='alert alert-danger'>Email or Password is incorrect</div>";
    }
}