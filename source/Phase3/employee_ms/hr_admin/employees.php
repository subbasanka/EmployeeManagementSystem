<?php 
include "auth.php";
if(isset($_POST['delete'])){
    $id = $_POST['deleteid'];
    if(empty($id)){ die('Error'); }
    $query = "delete from users where id=?";
    $stmt = $sql->prepare($query);
    $stmt->bindParam(1, $id, PDO::PARAM_INT);
    $stmt->execute();
    
    $query = "delete from payments where user_id=? AND status='unpaid'";
    $stmt = $sql->prepare($query);
    $stmt->bindParam(1, $id, PDO::PARAM_INT);
    $stmt->execute();
    
    $alert = "notify('success', 'Payee removed successfully.');";
}
if(isset($_POST['active'])){
    $leaveid = $_POST['status_id'];
    $query = "update employees set status=1 where id=?";
    $stmt = $sql->prepare($query);
    $stmt->bindParam(1, $leaveid, PDO::PARAM_INT);
    $stmt->execute();
    $alert = "notify('success', 'Employee successfully activated.');";
}
if(isset($_POST['inactivate'])){
    $leaveid = $_POST['status_id'];
    $query = "update employees set status=0 where id=?";
    $stmt = $sql->prepare($query);
    $stmt->bindParam(1, $leaveid, PDO::PARAM_INT);
    $stmt->execute();
    $alert = "notify('success', 'Employee successfully deactivated.');";
}
?>
<!doctype html>
<html lang="en">

<head>
    <title>All Employees</title>
    <?php $page="employees";  include "includes/head.php"; ?>
</head>

<body>
    <?php include 'includes/nav.php'; ?>
    <div class="main-content" id="panel">
        <?php include 'includes/header.php'; ?>
        <div class="header bg-primary pb-6">
            <div class="container-fluid">
                <div class="header-body">
                    <div class="row align-items-center py-4">
                        <div class="col-lg-6">
                            <h6 class="h2 text-white d-inline-block mb-0">Payees</h6>

                        </div>
                        <div class="col-lg-6 text-lg-right">
                            <a href="add-new-employee.php" class="mb-2 btn btn-sm btn-neutral">Add New Employee</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Page content -->
        <div class="container-fluid mt--6">
            <!-- Table -->
            <div class="row">
                <div class="col">
                    <div class="card">
                        <!-- Card header -->
                        <div class="card-header">
                            <h3 class="mb-0">All Employees</h3>
                        </div>
                        <div class="table-responsive py-4">
                            <table class="table align-items-center table-flush" id="datatable-basic">
                                <thead class="thead-light">
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Phone</th>
                                    <th>Employee status</th>
                                    <th>Activate/Deactivate</th>
                                </thead>
                                <tbody>
                                  <?php
                                      $query = "select * from employees where hr_id=?";
                                      $stmt = $sql->prepare($query);
                                      $stmt->bindParam(1, $hrid, PDO::PARAM_INT);
                                      $stmt->execute();
                                      $rows = $stmt->fetchAll();
                                      if($stmt->rowCount()>0){
                                          foreach($rows as $row){
                                            $id = $row['id'];
                                    ?>
                                    <tr>
                                        <td>
                                            <?php echo ucfirst($row['firstname']); ?>
                                            <?php echo ucfirst($row['lastname']); ?>
                                        </td>
                                        <td><?php echo $row['email']; ?></td>
                                        <td><?php echo $row['phone']; ?></td>
                                        <td><?php if($row['status']=='1'){ ?>
                                                <button class="btn btn-sm btn-success">Active</button>
                                            <?php }else { ?>
                                                <button class="btn btn-sm btn-danger">Inactive</button>
                                            <?php } ?>
                                        </td>
                                        <td>
                                            <?php if($row['status']=='1'){ ?>
                                                <form action="" method="post">
                                                    <input type="hidden" name="status_id" value="<?php echo $row['id']; ?>">
                                                    <button class="btn btn-secondary btn-sm" name="inactivate">Deactivate</button>
                                                </form>
                                            <?php } ?>
                                            <?php if($row['status']=='0'){ ?>
                                                <form action="" method="post">
                                                    <input type="hidden" name="status_id" value="<?php echo $row['id']; ?>">
                                                    <button class="btn btn-primary btn-sm" name="active">Activate</button>
                                                </form>
                                            <?php } ?>
                                        </td>
                                        
                                    </tr>
                                    <?php }} ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Footer -->
        </div>
    </div>
    <div class="wrapper">
        <?php //include "includes/footer.php"; ?>
        <form action="" id="deleteform" method="post">
            <input type="hidden" name="deleteid" id="deleteid">
            <input type="hidden" name="delete" value="1">
        </form>
    </div>
</body>
<?php include "includes/scripts.php"; ?>
<script>
    $(".deletebtn").click(function() {
        var id = $(this).attr('data-id');
        $("#deleteid").val(id);
        $("#deleteform").submit();
    });

    $("#deleteform").on('submit', function() {
        if (confirm('Are you sure you want to delete this student?')) {

        } else {
            return false;
        }
    });
</script>
</html>