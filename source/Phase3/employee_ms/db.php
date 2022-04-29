<?php
function connect() {
    $username = 'pseurzez_amar';
    $password = 'Amar@1234';
    $mysqlhost = 'localhost';
    $dbname = 'pseurzez_employee_ms';
    $pdo = new PDO('mysql:host='.$mysqlhost.';dbname='.$dbname.';charset=utf8', $username, $password);
    if($pdo){
        //make errors throw exceptions
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $pdo;
    }else{
        die("Could not create PDO connection.");
    }
}

$sql = connect();

$pay_per_hour = 20;
$tax_percentage = 15;

?>