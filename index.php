<?php 
include 'dbconnection.php'; 
include 'session.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Super Mart</title>

    <!-- Custom fonts for this template-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">
</head>

<body id="page-top">

  <?php
  include 'header.php';
  ?> 
<?php
$todays_sale=$monthly_sale=$todays_purchase=$monthly_purchase=0;
$today1=strtotime($today);
$month=date("m",$today1);
$year=date("Y",$today1);
$query="SELECT SUM(amount) AS todays_sale FROM customer_bill WHERE billdate='$today'";
$result=$con->query($query);
if($result->num_rows>0){
    $row=$result->fetch_assoc();
    $todays_sale=round($row['todays_sale'],2);
}
$query="SELECT SUM(amount) AS monthly_sale FROM customer_bill WHERE YEAR(billdate) = $year AND MONTH(billdate) = $month";
$result=$con->query($query);
if($result->num_rows>0){
    $row=$result->fetch_assoc();
    $monthly_sale=round($row['monthly_sale'],2);
}
$query="SELECT SUM(amount) AS todays_purchase FROM purchase_bill WHERE billdate='$today'";
$result=$con->query($query);
if($result->num_rows>0){
    $row=$result->fetch_assoc();
    $todays_purchase=round($row['todays_purchase'],2);
}
$today1=strtotime($today);
$month=date("m",$today1);
$year=date("Y",$today1);
$query="SELECT SUM(amount) AS monthly_purchase FROM purchase_bill WHERE YEAR(billdate) = $year AND MONTH(billdate) = $month";
$result=$con->query($query);
if($result->num_rows>0){
    $row=$result->fetch_assoc();
    $monthly_purchase=round($row['monthly_purchase'],2);
}
?>    

                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <div class="d-sm-flex align-items-center justify-content-between mb-2 mt-2">
                        <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
                        
                    </div>

                    <!-- Content Row -->
                    <div class="row">

                        <!-- Earnings (Monthly) Card Example -->
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-primary shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                              Todays Sale</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800"><i class="fas fa-inr"></i> <?php echo $todays_sale ?></div>
                                        </div>
                                        <div class="col-auto">
                                           
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Earnings (Monthly) Card Example -->
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-success shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                                This Month Sell</div>
                                                <div class="h5 mb-0 font-weight-bold text-gray-800"><i class="fas fa-inr"></i> <?php echo $monthly_sale ?></div>
                                        </div>
                                        <div class="col-auto">
                                            
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Earnings (Monthly) Card Example -->
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-info shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Todays purchase
                                            </div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800"><i class="fas fa-inr"></i> <?php echo $todays_purchase ?></div>
                                        </div>
                                        <div class="col-auto">
                                            
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Pending Requests Card Example -->
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-warning shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                               This Month Purchase</div>
                                               <div class="h5 mb-0 font-weight-bold text-gray-800"><i class="fas fa-inr"></i> <?php echo $monthly_purchase ?></div>
                                        </div>
                                        <div class="col-auto">
                                            
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php
include 'footer.php';
?>
    <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin-2.min.js"></script>

    <!-- Page level plugins -->
    <script src="vendor/chart.js/Chart.min.js"></script>

    <!-- Page level custom scripts -->
    <script src="js/demo/chart-area-demo.js"></script>
    <script src="js/demo/chart-pie-demo.js"></script>

</body>

</html>