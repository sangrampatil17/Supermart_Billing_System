<?php
include 'dbconnection.php'; 
include 'session.php';

$bill_no=$_GET['bill'];
$query="SELECT * FROM customer_bill WHERE id='$bill_no'";
$result=$con->query($query);
$row=$result->fetch_assoc();
$cid=$row['customer_id'];
$invoice_number=$row['id'];
$billdate=$row['billdate'];
$without_gst=$row['without_gst'];
$amount=$row['amount'];
$user_id=$row['user_id'];
$cash=$row['cash'];
$upi=$row['upi'];
$card=$row['card'];
?>
<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Bootstrap CSS -->
    <title>SuperMart</title>
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">
    <style>
        tbody,
        td,
        tfoot,
        th,
        thead,
        tr {
            border-color: inherit !important;
            border-style: none !important;
            border-width: 0;
        }
    </style>
</head>

<body>
    <div class="container text-center">
        <div class="row text-center">
            <div class="wrapper-header text-center">
                <div class="text-center pb-1">
                    <!-- <img src="img/tekit.png" class="logo" style=" margin-left: unset;"> -->
                </div>
                <h3 class="wrapper-title1 top">Shree Swami Samarth Super Bazar</h3>
                <p class="wrapper-title1">Gadhinglaj</p>
                <h4 class="wrapper-title1">GST IN: ABCDEFGHIJ</h4>
                <h4 class="wrapper-title2">Phone:9975657407</h4>

                <h4 class="wrapper-title1 top"><b>TAX INVOICE</b></h4>
                <div class="row">
                    <table class="table text-start">
                        <thead>
                            <tr class="">
                                <th class="text-start" scope="col" style="text-align: left ! important;">
                                    <h5>Bill No:
                                        <?php echo $bill_no ?>
                                    </h5>
                                </th>
                                <th class="text-start" scope="col" style="text-align: right ! important;">
                                    <h5>Bill Dt:
                                        <?php echo $billdate ?>
                                    </h5>
                                </th>
                            </tr>
                            <tr>
                                <th class="text-start" colspan="2" style="text-align: left ! important;">Cashier Id:
                                    <?php echo $user_id ?>
                                </th>
                            </tr>
                            <thead>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="row">
            <div class="">
                <table class="table text-center">
                    <thead>
                        <tr class="wrapper-title">
                            <th scope="col">HSN</th>
                            <th scope="col">Product</th>
                            <th scope="col">Qty</th>
                            <th scope="col">Rate</th>
                            <th scope="col">NET AMT</th>
                            <th scope="col">GST(%)</th>
                            <th scope="col">AMT</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
          $query="SELECT * FROM customer_bill_details WHERE bill_no='$bill_no'";
          $result=$con->query($query);
          $total_amount=0;
          if($result->num_rows>0){
          while($row=$result->fetch_assoc()){
          $product_id=$row['product_id'];
          $product_name=$row['product_name'];
          $hsn=$row['hsn'];
          $rate=$row['rate'];
          $qty=$row['qty'];
          $amount=$row['amount'];
          $without_gst=$row['without_gst'];
          $gst=$amount-$without_gst;
          $total_amount+=$amount;
          $gst_percentage=$row['gst_percentage'];
          $bill_date=$row['bill_date'];
          
            echo'
            <tr>
            <th scope="row" style="font-size:12px">'.$hsn.'</th>
            <td style="font-size:12px">'.$product_name.'</small></td>  
            <td style="font-size:12px">'.$qty.'</td> 
            <td style="font-size:12px">'.$rate.'</td>
            <td style="font-size:12px">'.$without_gst.'</td> 
            <td style="font-size:12px">'.$gst_percentage.'</td> 
            <td style="font-size:12px">'.$amount.'</td>          
             
          </tr>
            ';
        }
          }
        echo'
            <tr>
            <th style="font-size:12px" colspan="6"><b>Total</b></th>
            <th style="font-size:12px"><b>'.$total_amount.'</b></th>          
             
          </tr>
            ';
          ?>
                    </tbody>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="container text-center">
        <div class="row">

            <hr>
            <h4 class="text-center"><b>*****Amount Recived From Customer*****</b></h4>
            <hr>
            <?php
if($cash>0){
  echo'<p class="text-center" style="width:100%"><b>Cash Payment : '.$cash.'/-</b></p>';
}
if($upi>0){
  echo'<p class="text-center" style="width:100%"><b>UPI Payment : '.$upi.'/-</b></p>';
}
if($card>0){
  echo'<p class="text-center" style="width:100%"><b>Card Payment : '.$card.'/-</b></p>';
}
?>
        </div>
    </div>
    <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin-2.min.js"></script>
    <script>
        function print_screen() {
            window.print();
        }
        $(document).ready(function () {
              print_screen();
              setTimeout(function() { 
                window.location.replace("new_bill.php");
               }, 3000);
        });
    </script>
</body>

</html>