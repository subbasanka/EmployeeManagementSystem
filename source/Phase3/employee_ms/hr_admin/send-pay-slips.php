<?php
include "auth.php";
require_once '../includes/dompdf/autoload.php';
require '../includes/mailer/src/Exception.php';
require '../includes/mailer/src/PHPMailer.php';
require '../includes/mailer/src/SMTP.php';
use Dompdf\Dompdf;
use Dompdf\Options;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
if(isset($_POST['submit'])){
    $query = "select * from employees where hr_id=?";
    $stmt = $sql->prepare($query);
    $stmt->bindParam(1, $hrid, PDO::PARAM_INT);
    $stmt->execute();
    $employees = $stmt->fetchAll();
    if($stmt->rowCount()>0){
        foreach($employees as $employeedata){
            $query = "select * from billing_hours where month=? AND year=? AND employee_id=? AND status=1";
            $stmt = $sql->prepare($query);
            $stmt->bindParam(1, $_POST['month'], PDO::PARAM_INT);
            $stmt->bindParam(2, $_POST['year'], PDO::PARAM_INT);
            $stmt->bindParam(3, $employeedata['id'], PDO::PARAM_INT);
            $stmt->execute();
            $rows = $stmt->fetchAll();
            $totalhours = 0;
            foreach($rows as $row){
                $totalhours+=$row['hours'];
            }

            if($totalhours>0){
                $subtotal = $totalhours*$pay_per_hour;
                $tax = ($subtotal*$tax_percentage)/100;
                $total = $subtotal-$tax;

                include '../slip_template.php';
                $options = new Options();
                $options->set('isRemoteEnabled', true);
                $dompdf = new Dompdf($options);
                $dompdf->loadHtml($html);
                $dompdf->set_option('isHtml5ParserEnabled', true);
                $dompdf->set_option('isRemoteEnabled', true);

                $dompdf->set_option('defaultFont', 'Courier');
                $dompdf->render();
                $pdfString = $dompdf->output();
                $message = "<h1 style='background:green;color:white;padding:30px'>You have received a payslip.</h1>";
                $mail = new PHPMailer(true);

                try {
                    $mail->IsSMTP();
                    $mail->SMTPDebug   = 0;
                    $mail->Host        = "pseudomavericksems.xyz";
                    $mail->Port        = 587;
                    $mail->SMTPAuth    = TRUE;
                    $mail->SMTPSecure  = "tls";
                    $mail->Username    = 'hr1admin@pseudomavericksems.xyz';
                    $mail->Password    = 'ww,2$vX0!%n]';

                    $mail->IsHTML(true);
                    $mail->addAddress($employeedata['email'], '');
                    $mail->From        = 'hr1admin@pseudomavericksems.xyz';
                    $mail->FromName    = 'Employee MS';
                    $mail->Subject     = 'Employee MS';
                    $mail->Body        = $message;
                    $mail->addStringAttachment($pdfString, 'payslip.pdf');
                    $mail->AltBody     = 'This is the body in plain text for non-HTML mail clients';
                    $mail->WordWrap    = 50; 
                    $mail->send();
                } catch (Exception $e) {
                    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
                }
            }
        }
    }
    $alert = "notify('success', 'Payslips sent successfully.');";
}
?>
<!doctype html>
<html lang="en">

<head>
    <title>
        Send Pay Slips
    </title>
    <?php include "includes/head.php"; ?>
</head>

<body>
    <?php $page="send-pay-slips"; include "includes/nav.php"; ?>
    <div class="main-content" id="panel">
        <?php include "includes/header.php"; ?>
        <!-- Topnav -->
        <div class="header bg-primary pb-6">
            <div class="container-fluid">
                <div class="header-body">
                    <div class="row align-items-center py-4">
                        <div class="col-lg-6 col-7">
                            <h6 class="h2 text-white d-inline-block mb-0">Payslips</h6>

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
                                <h3 class="mb-0">Send Pay Slips</h3>
                            </div>
                            <!-- Card body -->
                            <div class="card-body">
                                <form class="needs-validation" method="post" enctype="multipart/form-data">
                                    <div class="form-row">
                                        
                                        <div class="col-md-6 mb-3">
                                            <label class="form-control-label" for="validationCustom01">Month*</label>
                                            <select required name="month" class="form-control" id="">
                                                <option value=''>--Select Month--</option>
                                                <option value='january'>January</option>
                                                <option value='february'>February</option>
                                                <option value='march'>March</option>
                                                <option value='april'>April</option>
                                                <option value='may'>May</option>
                                                <option value='june'>June</option>
                                                <option value='july'>July</option>
                                                <option value='august'>August</option>
                                                <option value='september'>September</option>
                                                <option value='october'>October</option>
                                                <option value='november'>November</option>
                                                <option value='december'>December</option>
                                            </select>
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label class="form-control-label" for="validationCustom01">Year*</label>
                                            <select required name="year" class="form-control" id="">
                                                <option value=''>--Select Year--</option>
                                                <option value="2022">2022</option>
                                                <option value="2021">2021</option>
                                            </select>
                                        </div>
                                    </div>
                                    <button class="btn btn-primary float-right" name="submit" type="submit">Send</button>
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
