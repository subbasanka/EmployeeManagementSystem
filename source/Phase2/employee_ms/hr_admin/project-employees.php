<?php
include "auth.php";
if(isset($_GET['id'])){
    $projectid = $_GET['id'];
    $query = "select * from projects where id = ?";
    $stmt = $sql->prepare($query);
    $stmt->bindParam(1, $projectid, PDO::PARAM_INT);
    $stmt->execute();
    $project = $stmt->fetch();
}

if(isset($_POST['submit'])){
    $stmt = $sql->prepare("select * from employee_project where employee_id = ? AND project_id = ?");
    $stmt->bindParam(1, $_POST['employee'], PDO::PARAM_INT);
    $stmt->bindParam(2, $projectid, PDO::PARAM_INT);
    $stmt->execute();
    if($stmt->rowCount()>0){
        $alert = "notify('danger', 'This employee already assigned.');";
    }else{
        $query = "INSERT into employee_project (employee_id, project_id) VALUES (?, ?)";
        $stmt = $sql->prepare($query);
        $stmt->bindParam(1, $_POST['employee'], PDO::PARAM_INT);
        $stmt->bindParam(2, $projectid, PDO::PARAM_INT);
        $stmt->execute();
        $alert = "notify('success', 'Employee assigned successfully.');";
    }
}


if(isset($_POST['unassign'])){
    $query = "delete from employee_project where employee_id = ? AND project_id=?";
    $stmt = $sql->prepare($query);
    $stmt->bindParam(1, $_POST['employee_id'], PDO::PARAM_INT);
    $stmt->bindParam(2, $projectid, PDO::PARAM_INT);
    $stmt->execute();
    $alert = "notify('success', 'Employee unassigned successfully.');";
}



?>
<!doctype html>
<html lang="en">

<head>
    <title>
        Project Employees
    </title>
    <?php include "includes/head.php"; ?>
</head>

<body>
    <?php $page=""; $tab=""; include "includes/nav.php"; ?>
    <div class="main-content" id="panel">
        <?php include "includes/header.php"; ?>
        <!-- Topnav -->
        <div class="header bg-primary pb-6">
            <div class="container-fluid">
                <div class="header-body">
                    <div class="row align-items-center py-4">
                        <div class="col-lg-6 col-7">
                            <h6 class="h2 text-white d-inline-block mb-0">Projects</h6>
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
                                <h3 class="mb-0">Assign Employees to "<?php echo $project['title']; ?>"
                                    <span class="float-right">
                                        <a href="projects.php" class="btn btn-primary btn-sm">Go back</a>
                                    </span>

                                </h3>
                            </div>
                            <!-- Card body -->
                            <div class="card-body">
                                <form class="needs-validation" method="post" enctype="multipart/form-data">
                                    <div class="form-row">
                                       <div class="col-md-12 mb-3">
                                           <label for="" class="form-control-label">Select Employee</label>
                                           <select class="form-control" name="employee" required>
                                                <option value="">Select</option>
                                                <?php
                                                    $query = "select * from employees where hr_id=?";
                                                    $stmt = $sql->prepare($query);
                                                    $stmt->bindParam(1, $hrid, PDO::PARAM_STR);
                                                    $stmt->execute();
                                                    $rows = $stmt->fetchAll();
                                                    foreach($rows as $row){
                                                        $id = $row['id'];
                                                ?>
                                                <option value="<?php echo $id; ?>"><?php echo ucfirst($row['firstname'].' '.$row['lastname']); ?></option>
                                                <?php } ?>
                                           </select>
                                       </div>
                                        
                                    </div>
                                    <button id="submitbtn" class="btn btn-primary" name="submit" type="submit">Submit</button>
                                </form>
                            </div>
                        </div>
                        <!-- Default browser form validation -->
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-8">
                    <div class="card">
                        <!-- Card header -->
                        <div class="card-header">
                            <h3 class="mb-0">Assigned Employees</h3>
                        </div>
                        <div class="table-responsive py-4">
                            <table class="table align-items-center table-flush" id="datatable-basic">
                                <thead class="thead-light">
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Action</th>
                                </thead>
                                <tbody>
                                    <?php
                                       $query = "select a.id, b.id as employee_id, b.firstname, b.lastname, b.email from employee_project as a left join employees as b on a.employee_id=b.id where a.project_id= ?";
                                       $stmt = $sql->prepare($query);
                                       $stmt->bindParam(1, $projectid, PDO::PARAM_INT);
                                       $stmt->execute();
                                       $rows = $stmt->fetchAll();
                                       foreach($rows as $row){      
                                            $id = $row['id'];
                                    ?>
                                    <tr>
                                        <td ><?php echo $row['firstname'].' '.$row['lastname']; ?></td>
                                        <td ><?php echo $row['email']; ?></td>
                                        <td>
                                            <form action="" method="post" onsubmit="return confirm('Are you sure want to unassign this employee?')">
                                                <input type="hidden" name="employee_id" value="<?php echo $row['employee_id']; ?>">
                                                <button class="btn btn-danger btn-sm" name="unassign">Unassign</button>
                                            </form>
                                            
                                        </td>
                                    </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
                        </div>
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
