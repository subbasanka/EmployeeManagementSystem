<?php 
include "auth.php"; 
?>
<!doctype html>
<html lang="en">

<head>
    <title>Dashboard</title>
    <?php include "includes/head.php"; ?>
</head>

<body>
    <?php $page="index"; $tab=""; include "includes/nav.php"; ?>
    <div class="main-content" id="panel">
        <?php include 'includes/header.php'; ?>
        <div class="header bg-primary pb-6">
            <div class="container-fluid">
                <div class="header-body">
                    <div class="row align-items-center py-4">
                        <div class="col-lg-12">
                            <h6 class="h2 text-white d-inline-block mb-0">
                                Welcome, <?php echo ucwords($employeedata['firstname'].' '.$employeedata['lastname']); ?> (Employee)
                            </h6>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php include "includes/scripts.php"; ?>
</body>
</html>