<?php
include "auth.php";
if(isset($_POST['submit'])){
    $stmt = $sql->prepare("select * from employees where email=?");
    $stmt->bindParam(1, $_POST['email'], PDO::PARAM_STR);
    $stmt->execute();
    $result = $stmt->fetch();
    if($stmt->rowCount()>0){
        $alert = "notify('danger', 'An employee with this email already exists.');";
    }else{
        $options = ['cost' => 11];
        $password = password_hash($_POST['password'], PASSWORD_BCRYPT, $options);
        $query = "INSERT into employees (firstname, lastname, phone, email, password, hr_id) VALUES (?, ?, ?, ?, ?, ?)";
        $stmt = $sql->prepare($query);
        $stmt->bindParam(1, $_POST['firstname'], PDO::PARAM_STR);
        $stmt->bindParam(2, $_POST['lastname'], PDO::PARAM_STR);
        $stmt->bindParam(3, $_POST['phone'], PDO::PARAM_STR);
        $stmt->bindParam(4, $_POST['email'], PDO::PARAM_STR);
        $stmt->bindParam(5, $password, PDO::PARAM_STR);
        $stmt->bindParam(6, $hrid, PDO::PARAM_STR);
        $stmt->execute();
        $alert = "notify('success', 'Employee added successfully.');";
    }
}
?>
<!doctype html>
<html lang="en">

<head>
    <title>
        Add new employee
    </title>
    <?php include "includes/head.php"; ?>
</head>

<body>
    <?php $page=""; include "includes/nav.php"; ?>
    <div class="main-content" id="panel">
        <?php include "includes/header.php"; ?>
        <!-- Topnav -->
        <div class="header bg-primary pb-6">
            <div class="container-fluid">
                <div class="header-body">
                    <div class="row align-items-center py-4">
                        <div class="col-lg-6 col-7">
                            <h6 class="h2 text-white d-inline-block mb-0">Employees</h6>

                        </div>
                        
                    </div>
                </div>
            </div>
        </div>
        <div class="container-fluid mt--6">
            <div class="row">
                <div class="col-8">
                    <div class="card-wrapper">
                        <!-- Custom form validation -->
                        <div class="card">
                            <!-- Card header -->
                            <div class="card-header">
                                <h3 class="mb-0">Add new employee
                                    <span class="float-right">
                                        <a href="employees.php" class="btn btn-primary btn-sm">Go Back</a>
                                    </span>
                                </h3>
                            </div>
                            <!-- Card body -->
                            <div class="card-body">
                                <form class="needs-validation" method="post" enctype="multipart/form-data">
                                    <div class="form-row">
                                        <div class="col-md-6 mb-3">
                                            <label class="form-control-label" for="validationCustom01">First Name*</label>
                                            <input required type="text" class="form-control" name="firstname">
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label class="form-control-label" for="validationCustom01">Last Name*</label>
                                            <input required type="text" class="form-control" name="lastname">
                                        </div>
                                    </div>
                                    
                                    <div class="form-row">
                                       
                                        <div class="col-md-12 mb-3">
                                            <label class="form-control-label" for="validationCustom02">Phone*</label>
                                            <input required type="text" class="form-control" name="phone">
                                        </div>
                                        
                                    </div>
                                    <div class="form-row">
                                        <div class="col-md-6 mb-3">
                                            <label class="form-control-label" for="validationCustom01">Email*</label>
                                            <input required type="email" class="form-control" name="email">
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label class="form-control-label" for="validationCustom01">Password*</label>
                                            <input required type="password" class="form-control" name="password">
                                        </div>
                                    </div>
                                    <button class="btn btn-primary float-right" name="submit" type="submit">Submit</button>
                                </form>
                            </div>
                        </div>
                        <!-- Default browser form validation -->
                    </div>
                </div>
            </div>
            <!-- Footer 
            <?php include 'includes/footer.php'; ?>
            -->
        </div>

    </div>
</body>
<?php include "includes/scripts.php"; ?>
</html>