<?php 
include "auth.php";
if(isset($_POST['accept'])){
    $billingid = $_POST['billing_id'];
    $query = "update billing_hours set status=1 where id=?";
    $stmt = $sql->prepare($query);
    $stmt->bindParam(1, $billingid, PDO::PARAM_INT);
    $stmt->execute();
    $alert = "notify('success', 'Billing hours accepted successfully.');";
}

if(isset($_POST['reject'])){
    $billingid = $_POST['billing_id'];
    $query = "update billing_hours set status=2 where id=?";
    $stmt = $sql->prepare($query);
    $stmt->bindParam(1, $billingid, PDO::PARAM_INT);
    $stmt->execute();
    $alert = "notify('success', 'Billing hours rejected successfully.');";
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
                                    <th>Employee</th>
                                    <th>Hours</th>
                                    <th>Month</th>
                                    <th>Year</th>
                                    <th>Status</th>
                                    <th>Actions</th>
                                </thead>
                                <tbody>
                                  <?php
                                      $query = "select a.*, b.firstname, b.lastname from billing_hours as a left join employees as b on a.employee_id=b.id where b.hr_id=?";
                                      $stmt = $sql->prepare($query);
                                      $stmt->bindParam(1, $hrid, PDO::PARAM_INT);
                                      $stmt->execute();
                                      $rows = $stmt->fetchAll();
                                      if($stmt->rowCount()>0){
                                          foreach($rows as $row){
                                            $id = $row['id'];
                                    ?>
                                    <tr>
                                        <td><?php echo $row['firstname'].' '.$row['lastname']; ?></td>
                                        <td><?php echo $row['hours']; ?></td>
                                        <td><?php echo ucfirst($row['month']); ?></td>
                                        <td><?php echo $row['year']; ?></td>
                                        <td>
                                            <?php if($row['status']=='0'){ ?>
                                            <button class="btn btn-sm btn-warning">Pending</button>
                                            <?php }elseif($row['status']=='1'){ ?>
                                            <button class="btn btn-sm btn-success">Accepted</button>
                                            <?php }elseif($row['status']=='2'){ ?>
                                            <button class="btn btn-sm btn-danger">Rejected</button>
                                            <?php } ?>
                                        </td>
                                        <td style="display:flex">
                                            <?php if($row['status']=='0'){ ?>
                                            <form action="" method="post" class="mr-2" onsubmit="return confirm('Are you sure want to accept this?')">
                                                <input type="hidden" name="billing_id" value="<?php echo $row['id']; ?>">
                                                <button class="btn btn-primary btn-sm" name="accept">Accept</button>
                                            </form>
                                            <form action="" method="post" onsubmit="return confirm('Are you sure want to reject this?')">
                                                <input type="hidden" name="billing_id" value="<?php echo $row['id']; ?>">
                                                <button class="btn btn-danger btn-sm" name="reject">Reject</button>
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
</body>
<?php include "includes/scripts.php"; ?>
</html>