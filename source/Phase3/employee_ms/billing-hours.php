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
?>
<!doctype html>
<html lang="en">

<head>
    <title>Billing Hours</title>
    <?php $page="billing-hours";  include "includes/head.php"; ?>
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
                            <h6 class="h2 text-white d-inline-block mb-0">Employees</h6>

                        </div>
                        <div class="col-lg-6 text-lg-right">
                            <a href="submit-billing-hours.php" class="mb-2 btn btn-sm btn-neutral">Submit Billing Hours</a>
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
                            <h3 class="mb-0">Billing Hours</h3>
                        </div>
                        <div class="table-responsive py-4">
                            <table class="table align-items-center table-flush" id="datatable-basic">
                                <thead class="thead-light">
                                    <th>Hours</th>
                                    <th>Month</th>
                                    <th>Year</th>
                                    <th>Status</th>
                                </thead>
                                <tbody>
                                  <?php
                                      $query = "select * from billing_hours where employee_id=?";
                                      $stmt = $sql->prepare($query);
                                      $stmt->bindParam(1, $employeeid, PDO::PARAM_INT);
                                      $stmt->execute();
                                      $rows = $stmt->fetchAll();
                                      if($stmt->rowCount()>0){
                                          foreach($rows as $row){
                                            $id = $row['id'];
                                    ?>
                                    <tr>
                                        <td>
                                            <?php echo $row['hours']; ?>
                                        </td>
                                        <td><?php echo ucfirst($row['month']); ?></td>
                                        <td><?php echo $row['year']; ?></td>
                                        <td>
                                            <?php if($row['status']=='0'){ ?>
                                            <button class="btn btn-sm btn-warning">Pending</button>
                                            <?php }elseif($row['status']=='1'){ ?>
                                            <button class="btn btn-sm btn-success">Accepted</button>
                                            <?php }else{ ?>
                                            <button class="btn btn-sm btn-danger">Rejected</button>
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
</body>
<?php include "includes/scripts.php"; ?>
</html>