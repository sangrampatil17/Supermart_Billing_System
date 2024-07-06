<?php 
include 'dbconnection.php'; 
ob_start();
session_start();
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
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">
    <!-- Custom styles for this template-->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">
</head>

<body class="bg-gradient-primary">

    <div class="container">
        <!-- Outer Row -->
        <div class="row justify-content-center">

            <div class="col-xl-12 col-lg-12 col-md-9">

                <div class="card o-hidden border-0 shadow-lg my-5">
                    <div class="card-body p-0">
                        <!-- Nested Row within Card Body -->
                        <div class="row">
                            <div class="col-lg-6 d-none d-lg-block bg-login-image"></div>
                            <div class="col-lg-6">
                                <div class="p-5">
                                    <div class="text-center">
                                        <h1 class="h4 text-gray-900 ">SuperMart</h1>
                                        <h6 class=" text-900 mb-4">Employee Login</h6>
                                    </div>
                                    <form class="user" action="" method="POST">
                                        <div class="form-group">
                                            Mobile Number
                                            <input type="number" class="form-control form-control-user"
                                                id="mobile_number" name="mobile_number" placeholder="Mobile Number">
                                        </div>
                                        <div class="form-group">
                                            Password
                                            <input type="password" class="form-control form-control-user" id="password"
                                                name="password" placeholder="Password">
                                        </div>

                                        <input type="submit" name="Login" class="btn btn-primary btn-user btn-block"
                                            value="Login">

                                    </form>


                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </div>

    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin-2.min.js"></script>
    <?php
if(isset($_POST['Login']))
{
  $mobile_number=$_POST['mobile_number'];
  $password=$_POST['password'];
  $query="SELECT * FROM user WHERE number='$mobile_number' AND password='$password'";
  $result=$con->query($query);
  if($result->num_rows>0){
    session_destroy();
    session_start();
    $row=$result->fetch_assoc();
    $employee_id=$row['id'];
    $first_name=$row['first_name'];
    $last_name=$row['last_name'];
    $mobile_number=$row['number'];
    $roll=$row['roll'];
    $_SESSION['first_name']=$first_name;
    $_SESSION['last_name']=$last_name;
    $_SESSION['mobile_number']=$mobile_number;
    $_SESSION['roll']=$roll;
    $_SESSION['employee_id']=$employee_id;
    $_SESSION['status']="Active";
    header('location:index.php');
  }else{
    echo'<script>
    alert("Mobile number or Password is wrong");
    </script>
    ';
  }
  
}
    ?>
</body>

</html>