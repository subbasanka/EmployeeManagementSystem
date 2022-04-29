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
        $db_status = $row['status'];
        if($db_status != 1) {
            $msg = "<div class='alert alert-danger'>User is not active</div>";
        }
        else if($_email == $db_email && password_verify($_password, $db_password) && $db_status ==1){
            $_SESSION['employee'] = $row['id'];
            ob_start();
            header('location:index.php');
            exit();
        }else {
            $msg = "<div class='alert alert-danger'>Email or Password is incorrect</div>";
        }
    }else {
        $msg = "<div class='alert alert-danger'>Email or Password is incorrect</div>";
    }
}

?>
<!doctype html>
<html lang="en">

<head>
    <title>Login</title>
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
              
              <h1 class="text-white">Employee Login</h1>
              <p class="text-lead text-white">Please login with your credentials below.</p>
            </div>
          </div>
        </div>
      </div>
      
    </div>
    <!-- Page content -->
    <div class="container mt--8">
      <div class="row justify-content-center">
        <div class="col-lg-5 col-md-7">
          <div class="card bg-secondary border-0 mb-0">
            
            <div class="card-body">
              <form role="form" method="post">
                <div class="form-group mb-3">
                 <?php if(isset($msg)){ echo $msg; } ?>
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
                
                <div class="text-center mb-0">
                  <button type="submit" name="submit" class="btn btn-primary">Sign in</button>
                </div>
              </form>
            </div>
          </div>
          <div class="row mt-3">
              <div class="col-6">
                 <a href="hr_admin/" class="text-light"><small>HR Login</small></a>
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