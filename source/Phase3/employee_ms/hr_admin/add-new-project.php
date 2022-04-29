<?php
include "auth.php";
if(isset($_POST['submit'])){
    $createdAt = date('Y-m-d');
    $query = "INSERT into projects (title, description, start_date, due_date, created_at, hr_id) VALUES (?, ?, ?, ?, ?, ?)";
    $stmt = $sql->prepare($query);
    $stmt->bindParam(1, $_POST['title'], PDO::PARAM_STR);
    $stmt->bindParam(2, $_POST['description'], PDO::PARAM_STR);
    $stmt->bindParam(3, $_POST['start_date'], PDO::PARAM_STR);
    $stmt->bindParam(4, $_POST['due_date'], PDO::PARAM_STR);
    $stmt->bindParam(5, $createdAt, PDO::PARAM_STR);
    $stmt->bindParam(6, $hrid, PDO::PARAM_STR);
    $stmt->execute();
    $alert = "notify('success', 'Project added successfully.');";
}
?>
<!doctype html>
<html lang="en">

<head>
    <title>
        Add new project
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
                                <h3 class="mb-0">Add new project
                                    <span class="float-right">
                                        <a href="projects.php" class="btn btn-primary btn-sm">Go Back</a>
                                    </span>
                                </h3>
                            </div>
                            <!-- Card body -->
                            <div class="card-body">
                                <form class="needs-validation" method="post" enctype="multipart/form-data">
                                    <div class="form-row">
                                        <div class="col-md-12 mb-3">
                                            <label class="form-control-label" for="validationCustom01">Project Title*</label>
                                            <input required type="text" class="form-control" name="title">
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label class="form-control-label" for="validationCustom01">Start Date*</label>
                                            <input required type="date" class="form-control" name="start_date">
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label class="form-control-label" for="validationCustom01">Due Date*</label>
                                            <input required type="date" class="form-control" name="due_date">
                                        </div>
                                        <div class="col-md-12 mb-3">
                                            <label class="form-control-label" for="validationCustom01">Description*</label>
                                            <textarea required name="description" class="form-control" id="" cols="30" rows="5"></textarea>
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