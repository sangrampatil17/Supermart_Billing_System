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

    <title>purchase_bill</title>

    <!-- Custom fonts for this template -->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">

    <!-- Custom styles for this page -->
    <link href="vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">

</head>

<body id="page-top">

   <?php
    include 'header.php';
    ?>
    
                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                   <div class="card-body">
                                    
                         <!-- Date -->
                         <form  method="POST">
                            <div class="row">
                            <div class=" col-lg-4 col-6">
                            <label>From</label>
                            <input class="form-control" type="date" name="from_date" value="<?php 
                            if(isset($_POST['Search'])){
                                echo $_POST['from_date'];
                            }
                            else{
                                echo $today;
                                } 
                            ?>">
                        </div>
                        <div class=" col-lg-4 col-6">
                            <label>to</label>
                            <input class="form-control" type="date" name="to_date" value="<?php 
                            if(isset($_POST['Search'])){
                                echo $_POST['to_date'];
                            }
                            else{
                                echo $today;
                                } 
                            ?>">
                        </div>
                                <div class=" col-lg-4 col-6"><br>
                               
                                <input type="submit" name="Search" class="btn btn-primary mt-2"  value="Search"> 
                                </div>
                            </div>
                         
                      

                   
                         </form>
   
                        <br><br>     
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                        <th>Cash Amount</th>
                                            <th>UPI Amount</th>
                                            <th>Card Amount</th>
                                            <th>Sale Amount</th>
                        
                                          
                                        </tr>
                                    </thead>

 <?php
if(isset($_POST['Search']))
{
$from_date=$_POST['from_date'];
$to_date=$_POST['to_date'];
$query ="SELECT SUM(cash )AS cash ,SUM(upi)AS upi, SUM(card)AS card  FROM `purchase_bill` WHERE billdate BETWEEN '$from_date' AND '$to_date' ";
 $result = mysqli_query($con,$query);
 if(mysqli_num_rows($result)>0)
 {
    while($row=mysqli_fetch_assoc($result))
    {
        $cash=$row['cash'];
        $upi=$row['upi'];
        $card=$row['card'];
        $sale=$cash+$upi+$card;
        echo"
        <tr>
        <th>$cash</th>
        <th>$upi</th>
        <th>$card</th>
        <th>$sale</th>
        </tr>
     	
        ";

    }
 }
 else
 {
    echo"No record found";
 }
 $con->close();
}
?>

                                    <tfoot>

                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->
 
         <?php
          include 'footer.php'
          ?>

    <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin-2.min.js"></script>

    <!-- Page level plugins -->
    <script src="vendor/datatables/jquery.dataTables.min.js"></script>
    <script src="vendor/datatables/dataTables.bootstrap4.min.js"></script>

    <!-- Page level custom scripts -->
    <script src="js/demo/datatables-demo.js"></script>

</body>

</html>