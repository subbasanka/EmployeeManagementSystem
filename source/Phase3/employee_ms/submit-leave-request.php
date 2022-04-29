<?php
include "auth.php";
if(isset($_POST['submit'])){
    $requestdate = date('Y-m-d');
    $query = "INSERT into leave_requests (leave_start_date, leave_end_date, reason, leave_request_date, employee_id) VALUES (?, ?, ?, ?, ?)";
    $stmt = $sql->prepare($query);
    $stmt->bindParam(1, $_POST['start'], PDO::PARAM_STR);
    $stmt->bindParam(2, $_POST['end'], PDO::PARAM_STR);
    $stmt->bindParam(3, $_POST['reason'], PDO::PARAM_STR);
    $stmt->bindParam(4, $requestdate, PDO::PARAM_STR);
    $stmt->bindParam(5, $employeeid, PDO::PARAM_STR);
    $stmt->execute();
    $alert = "notify('success', 'Leave request submitted successfully.');";
}
?>
<!doctype html>
<html lang="en">

<head>
    <title>
        Submit leave request
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
                            <h6 class="h2 text-white d-inline-block mb-0">Leave Requests</h6>

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
                                <h3 class="mb-0">Submit leave request
                                    <span class="float-right">
                                        <a href="leave-requests.php" class="btn btn-primary btn-sm">Go Back</a>
                                    </span>
                                </h3>
                            </div>
                            <!-- Card body -->
                            <div class="card-body">
                                <form class="needs-validation" method="post" enctype="multipart/form-data">
                                    <div class="form-row">
                                        <div class="col-md-6 mb-3">
                                            <label class="form-control-label" for="validationCustom01">Leave Start*</label>
                                            <input required type="date" class="form-control" name="start">
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label class="form-control-label" for="validationCustom01">Leave End*</label>
                                            <input required type="date" class="form-control" name="end">
                                        </div>
                                        <div class="col-md-12 mb-3">
                                            <label class="form-control-label" for="validationCustom01">Reason*</label>
                                            <textarea required name="reason" class="form-control" id="" cols="30" rows="5"></textarea>
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