<?php
ob_start();
session_start();
require_once 'db.php';
if(isset($_SESSION['employee']))
{
    header("location: index.php");
    die(); exit();
}


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
?>
<!doctype html>
<html lang="en">

<head>
    <title>Register</title>
    <?php include 'includes/head.php'; ?>
    <style>
        @media (max-width: 1000px) {
            .header{
                padding-top: 30px;
                padding-bottom: 30px;
            }
        }
    </style>
</head>
<body class="bg-default">
  <!-- Navbar -->
  
  <!-- Main content -->
  <div class="main-content">
    <!-- Header -->
    <div class="header bg-primary py-lg-5 py-lg-5 pt-lg-5">
      <div class="container">
        <div class="header-body text-center mb-7">
          <div class="row justify-content-center">
            <div class="col-xl-5 col-lg-6 col-md-8 px-5">
              
              <h1 class="text-white">Employee Register</h1>
              <p class="text-lead text-white">Please register your new employee account here.</p>
            </div>
          </div>
        </div>
      </div>
      
    </div>
    <!-- Page content -->
    <div class="container mt--8 pb-5">
      <div class="row justify-content-center">
        <div class="col-lg-5 col-md-7">
          <div class="card bg-secondary border-0 mb-0">
            
            <div class="card-body">
              
              <form role="form" method="post">
               <div class="form-group mb-3">
                   <?php if(isset($error)){ echo $error; } ?>
                   <div class="input-group input-group-merge input-group-alternative">
                       <div class="input-group-prepend">
                           <span class="input-group-text"><i class="ni ni-single-02"></i></span>
                       </div>
                       <input required class="form-control" name="firstname" placeholder="First Name" type="text">
                   </div>
               </div>
               <div class="form-group mb-3">
                   <div class="input-group input-group-merge input-group-alternative">
                       <div class="input-group-prepend">
                           <span class="input-group-text"><i class="ni ni-single-02"></i></span>
                       </div>
                       <input required class="form-control" name="lastname" placeholder="Last Name" type="text">
                   </div>
               </div>
                <div class="form-group mb-3">
                 <div class="input-group input-group-merge input-group-alternative">
                    <div class="input-group-prepend">
                      <span class="input-group-text"><i class="ni ni-email-83"></i></span>
                    </div>
                    <input required class="form-control" name="email" placeholder="Email" type="email">
                  </div>
                </div>
                
                <div class="form-group mb-3">
                  <div class="input-group input-group-merge input-group-alternative">
                    <div class="input-group-prepend">
                      <span class="input-group-text"><i class="ni ni-lock-circle-open"></i></span>
                    </div>
                    <input required class="form-control" name="password" placeholder="Password" type="password">
                  </div>
                </div>
                <div class="form-group mb-3">
                  <div class="input-group input-group-merge input-group-alternative">
                    <div class="input-group-prepend">
                      <span class="input-group-text"><i class="ni ni-lock-circle-open"></i></span>
                    </div>
                    <input required class="form-control" name="cpassword" placeholder="Confirm Password" type="password">
                  </div>
                </div>
                
                <div class="text-center mb-0">
                  <button type="submit" name="submit" class="btn btn-primary">Register</button>
                </div>
              </form>
            </div>
          </div>
          <div class="row mt-3">
              <div class="col-6">
                 <a href="login.php" class="text-light"><small>Login to your Account</small></a>
              </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- Argon Scripts -->
  <!-- Core -->
  <script src="assets/vendor/jquery/dist/jquery.min.js"></script>
  <script src="assets/vendor/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
  <script src="assets/vendor/js-cookie/js.cookie.js"></script>
  <script src="assets/vendor/jquery.scrollbar/jquery.scrollbar.min.js"></script>
  <script src="assets/vendor/jquery-scroll-lock/dist/jquery-scrollLock.min.js"></script>
  <!-- Argon JS -->
  <script src="assets/js/argon.js?v=1.2.0"></script>
</body>

</html>