<?php
$html='<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Payslip</title>
    <style>
        @font-face {
            font-family: SourceSansPro;
            src: url(SourceSansPro-Regular.ttf);
        }

        .clearfix:after {
            content: "";
            display: table;
            clear: both;
        }

        a {
            color: #0087C3;
            text-decoration: none;
        }

        body {
            width:100%;
            position: relative;
            margin: 0 auto;
            color: #555555;
            background: #FFFFFF;
            font-family: Arial, sans-serif;
            font-size: 14px;
            font-family: SourceSansPro;
        }

        header {
            padding: 10px 0;
            margin-bottom: 20px;
            border-bottom: 1px solid #AAAAAA;
        }

        #logo {
            float: left;
            
        }

        #logo img {
            width:80px;
        }

        #company {
            display:inline-block;
            text-align:right;
        }


        #details {
            margin-bottom: 50px;
        }

        #client {
            padding-left: 6px;
            border-left: 6px solid #0087C3;
            float: left;
        }

        #client .to {
            color: #777777;
        }

        h2.name {
            font-size: 1.4em;
            font-weight: normal;
            margin: 0;
        }

        #invoice {
            display: inline-block;
            text-align: right;
        }

        #invoice h1 {
            color: #0087C3;
            
            font-weight: normal;
            
        }

        #invoice .date {
            font-size: 1.1em;
            color: #777777;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            border-spacing: 0;
            margin-bottom: 20px;
        }

        table th,
        table td {
            padding: 20px;
            background: #EEEEEE;
            text-align: left;
            border-bottom: 1px solid #FFFFFF;
        }

        table th {
            white-space: nowrap;
            font-weight: normal;
        }



        table td h3 {
            color: #57B223;
            font-size: 1.2em;
            font-weight: normal;
            margin: 0 0 0.2em 0;
        }

        table .no {
            color: #FFFFFF;
            font-size: 1.6em;
            background: #57B223;
        }



        table .unit {
            background: #DDDDDD;
        }

        table .qty {}

        table .total {
            background: #57B223;
            color: #FFFFFF;
        }

        table td.unit,
        table td.qty,
        table td.total {
            font-size: 1.2em;
        }

        table tbody tr:last-child td {
            border: none;
        }

        table tfoot td {
            padding: 10px 20px;
            background: #FFFFFF;
            border-bottom: none;
            font-size: 1.2em;
            white-space: nowrap;
            border-top: 1px solid #AAAAAA;
        }

        table tfoot tr:first-child td {
            border-top: none;
        }

        table tfoot tr:last-child td {
            color: #57B223;
            font-size: 1.4em;
            border-top: 1px solid #57B223;

        }

        table tfoot tr td:first-child {
            border: none;
        }

        #thanks {
            font-size: 2em;
            margin-bottom: 50px;
        }

        #notices {
            padding-left: 6px;
            border-left: 6px solid #0087C3;
        }

        #notices .notice {
            font-size: 1.2em;
        }

        footer {
            color: #777777;
            width: 100%;
            height: 30px;
            position: absolute;
            bottom: 0;
            border-top: 1px solid #AAAAAA;
            padding: 8px 0;

        }
    </style>
</head>

<body>
    <header class="clearfix">
        <!--<div id="logo">
            <img src="images/logo.png">
        </div>-->
        <div id="company">
            <h2 class="name">Pseudo Mavericks</h2>
            <div>Denton, TX 76201, US</div>
            <div>(123) 456-7890</div>
            <div><a href="mailto:hr1admin@pseudomavericksems.com">hr1admin@pseudomavericksems.com</a></div>
        </div>
    </header>
    <main>
        <div id="details" class="clearfix">
            <div id="client">
                <div class="to">Employee:</div>
                <h2 class="name">'.ucfirst($employeedata['firstname']).' '.ucfirst($employeedata['lastname']).'</h2>
                <div class="address">'.$employeedata['phone'].'</div>
                <div class="email"><a href="'.$employeedata['email'].'">'.$employeedata['email'].'</a></div>
            </div>
            <div id="invoice">
                <h1>PAYSLIP</h1>
                <div class="date">Payslip Date: '.date('m/d/Y').'</div>
                <div class="date">Due Date: '.date('m/d/Y', strtotime('+1 week')).'</div>
            </div>
        </div>
        <table border="0" cellspacing="0" cellpadding="0">
            <thead>
                <tr>

                    <th class="desc">MONTH</th>
                    <th class="unit">YEAR</th>
                    <th class="qty">HOURS</th>
                    <th class="total">TOTAL</th>
                </tr>
            </thead>
            <tbody>
                <tr>

                    <td class="desc">
                        <h3>'.ucfirst($_POST['month']).'</h3>
                    </td>
                    <td class="desc">
                        <h3>'.$_POST['year'].'</h3>
                    </td>
                    <td class="desc">
                        <h3>'.$totalhours.'</h3>
                    </td>
                    <td class="total">$'.number_format($subtotal, 2).'</td>
                </tr>

            </tbody>
            <tfoot>
                <tr>
                    <td></td>
                    <td colspan="2">SUBTOTAL</td>
                    <td>$'.number_format($subtotal, 2).'</td>
                </tr>
                <tr>
                    <td></td>
                    <td colspan="2">TAX 15%</td>
                    <td>$'.number_format($tax, 2).'</td>
                </tr>
                <tr>
                    <td></td>
                    <td colspan="2">NET SALARY</td>
                    <td>$'.number_format($total, 2).'</td>
                </tr>
            </tfoot>
        </table>
    </main>
    <footer>
        Payslip was generated on a computer and is valid without the signature and seal.
    </footer>
</body>

</html>';