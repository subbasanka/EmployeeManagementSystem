<?php 
include "auth.php";
?>
<!doctype html>
<html lang="en">

<head>
    <title>All Projects</title>
    <?php $page="projects";  include "includes/head.php"; ?>
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
                            <h6 class="h2 text-white d-inline-block mb-0">Projects</h6>

                        </div>
                        <div class="col-lg-6 text-lg-right">
                            <a href="add-new-project.php" class="mb-2 btn btn-sm btn-neutral">Add New Project</a>
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
                            <h3 class="mb-0">All Projects</h3>
                        </div>
                        <div class="table-responsive py-4">
                            <table class="table align-items-center table-flush" id="datatable-basic">
                                <thead class="thead-light">
                                    <th>Title/Description</th>
                                    <th>Start Date</th>
                                    <th>Due Date</th>
                                    <th>Created at</th>
                                    <th>Action</th>
                                </thead>
                                <tbody>
                                  <?php
                                      $query = "select * from projects where hr_id=?";
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
                                            <?php echo ucwords($row['title']); ?><br>
                                            <small><?php echo $row['description']; ?></small>
                                        </td>
                                        <td><?php echo $row['start_date']; ?></td>
                                        <td><?php echo $row['due_date']; ?></td>
                                        <td><?php echo $row['created_at']; ?></td>
                                        <td>
                                            <a class="btn btn-primary btn-sm" href="project-employees.php?id=<?php echo $row['id']; ?>">Assign Employees</a>
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