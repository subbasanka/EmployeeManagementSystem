if(isset($_POST['submit'])){
    $stmt = $sql->prepare("select * from employees where email=?");
    $stmt->bindParam(1, $_POST['email'], PDO::PARAM_STR);
    $stmt->execute();
    $result = $stmt->fetch();
    if($stmt->rowCount()>0){
        $error = "<div class='alert alert-danger'>Sorry, this email address already exists.</div>";
    }elseif($_POST['password'] != $_POST['cpassword']){
        $error = "<div class='alert alert-danger'>Password and Confirm Password doesn't match.</div>";
    }else{
        $created_at = date('Y-m-d');
        $options = [ 'cost' => 11];
        $password = password_hash($_POST['password'], PASSWORD_BCRYPT, $options);
        $tutorrole = 'tutor';
        $query = "INSERT into employees (firstname, lastname, email, password, created_at) VALUES (?, ?, ?, ?, ?)";
        $stmt = $sql->prepare($query);
        $stmt->bindParam(1, $_POST['firstname'], PDO::PARAM_STR);
        $stmt->bindParam(2, $_POST['lastname'], PDO::PARAM_STR);
        $stmt->bindParam(3, $_POST['email'], PDO::PARAM_STR);
        $stmt->bindParam(4, $password, PDO::PARAM_STR);
        $stmt->bindParam(5, $created_at, PDO::PARAM_STR);
        $stmt->execute();
        $_SESSION['message'] = "<div class='alert alert-success'>Account created successfully. You can now login to your account.</div>";
        header("location:login.php");
    }
}