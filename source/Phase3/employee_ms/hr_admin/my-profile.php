<?php
include "auth.php";

if(isset($_POST['update'])){
    $stmt = $sql->prepare("select * from hr_admins where email=? AND id!=?");
    $stmt->bindParam(1, $_POST['email'], PDO::PARAM_STR);
    $stmt->bindParam(2, $hrid, PDO::PARAM_STR);
    $stmt->execute();
    $result = $stmt->fetch();
    if($stmt->rowCount()>0){
        $alert = "notify('danger', 'This email already exists.');";
    }else{
      
        $query = "UPDATE hr_admins set firstname=?, lastname=?, phone=?, email=? where id=?";
        $stmt = $sql->prepare($query);
        $stmt->bindParam(1, $_POST['firstname'], PDO::PARAM_STR);
        $stmt->bindParam(2, $_POST['lastname'], PDO::PARAM_STR);
        $stmt->bindParam(3, $_POST['phone'], PDO::PARAM_STR);
        $stmt->bindParam(4, $_POST['email'], PDO::PARAM_STR);
        $stmt->bindParam(5, $hrid, PDO::PARAM_INT);
        $stmt->execute();
        
        $alert = "notify('success', 'Updated successfully.');";
    }
}

if(isset($_POST['updatepassword'])){
    if($_POST['password']==$_POST['cpassword']){
        $options = [ 'cost' => 11];
        $password = password_hash($_POST['password'], PASSWORD_BCRYPT, $options);
        $query = "UPDATE hr_admins set password=? where id=?";
        $stmt = $sql->prepare($query);
        $stmt->bindParam(1, $password, PDO::PARAM_STR);
        $stmt->bindParam(2, $hrid, PDO::PARAM_INT);
        $stmt->execute();
        $alert = "notify('success', 'Password updated successfully.');";
    }else{
        $alert = "notify('danger', 'Password and Confirm Password doesn\'t match.');";
    }
}

$query = "select * from hr_admins where id = ?";
$stmt = $sql->prepare($query);
$stmt->bindParam(1, $hrid, PDO::PARAM_INT);
$stmt->execute();
$hr = $stmt->fetch();

?>
<!doctype html>
<html lang="en">

<head>
    <title>
        Profile
    </title>
    <?php include "includes/head.php"; ?>
</head>

<body>
    <?php $page="profile"; $tab=""; include "includes/nav.php"; ?>
    <div class="main-content" id="panel">
        <?php include "includes/header.php"; ?>
        <!-- Topnav -->
        <div class="header bg-primary pb-6">
            <div class="container-fluid">
                <div class="header-body">
                    <div class="row align-items-center py-4">
                        <div class="col-lg-6 col-7">
                            <h6 class="h2 text-white d-inline-block mb-0">Profile</h6>

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
                                <h3 class="mb-0">Update Profile</h3>
                            </div>
                            <!-- Card body -->
                            <div class="card-body">
                                <form class="needs-validation" method="post" enctype="multipart/form-data">
                                    <div class="form-row">
                                        <div class="col-md-6 mb-3">
                                            <label class="form-control-label" for="validationCustom01" >First Name*</label>
                                            <input required type="text" class="form-control" name="firstname" readonly value="<?php echo $hr['firstname']; ?>">
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label class="form-control-label" for="validationCustom01">Last Name*</label>
                                            <input required type="text" class="form-control" name="lastname" readonly value="<?php echo $hr['lastname']; ?>">
                                        </div>
                                        
                                    </div>
                                    
                                    <div class="form-row">
                                       <div class="col-md-6 mb-3">
                                            <label class="form-control-label" for="validationCustom02">Phone</label>
                                            <input type="text" class="form-control" name="phone" value="<?php echo $hr['phone']; ?>">
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label class="form-control-label" for="validationCustom01">Email*</label>
                                            <input required type="email" class="form-control" name="email" value="<?php echo $hr['email']; ?>">
                                        </div>
                                        
                                    </div>
                                    <button class="btn btn-primary" name="update" type="submit">Update</button>
                                </form>
                                
                                
                                
                            </div>
                        </div>                        
                        <div class="card">
                            <!-- Card header -->
                            <div class="card-header">
                                <h3 class="mb-0">Change Password</h3>
                            </div>
                            <!-- Card body -->
                            <div class="card-body">
                               <form class="needs-validation" method="post" enctype="multipart/form-data">
                                    <div class="form-row">
                                        <div class="col-md-12 mb-3">
                                            <label class="form-control-label" for="validationCustom01">Password*</label>
                                            <input required type="password" class="form-control" name="password" value="">
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="col-md-12 mb-3">
                                            <label class="form-control-label" for="validationCustom01">Confirm Password*</label>
                                            <input required type="password" class="form-control" name="cpassword" value="">
                                        </div>
                                    </div>
                                    
                                    <button class="btn btn-primary" name="updatepassword" type="submit">Update</button>
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