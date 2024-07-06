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
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">

    <style>
    .bg {
        background: url("img/img1.jpg") no-repeat center center fixed;
        -webkit-background-size: cover;
        -moz-background-size: cover;
        -o-background-size: cover;
        background-size: cover;
    }
    </style>
</head>
<body id="page-top">
    <?php
  include 'header.php';
  ?>
    <div class="bg">

        <div class="row justify-content-center">

            <div class="col-xl-6 col-lg-6 col-md-6">

                <div class="card o-hidden border-0 shadow-lg my-5">
                    <div class="card-body p-0">
                        <div class="container">
                            <section class="">
                                <div class="row d-flex justify-content-center">
                                    <div class="col-lg-12">
                                        <h2 class="fw-bold mb-3">
                                            <center>User Info</center>
                                        </h2>
                                        <br>


                                        <form action="user.php" method="POST">
                                            <!-- 2 column grid layout with text inputs for the first and last names -->
                                            <div class="row">
                                                <div class="col-md-6 mb-4">
                                                    <div class="form-outline">
                                                        <input type="text" class="form-control" name="first_name"
                                                            id="first_name" required >
                                                        <label class="form-label" for="">First name</label>
                                                    </div>
                                                </div>
                                                <div class="col-md-6 mb-4">
                                                    <div class="form-outline">
                                                        <input type="text" class="form-control" name="last_name"
                                                            id="last_name" required >
                                                        <label class="form-label" for="">Last name</label>
                                                    </div>
                                                </div>
                                            </div>


                                            <div class="row">
                                                <div class="col-md-6 mb-4">
                                                    <div class="form-outline">
                                                        <input type="number" class="form-control" name="number"
                                                            id="number" required >
                                                        <label class="form-label" for="">Mobile Number</label>
                                                    </div>
                                                </div>
                                                <div class="col-md-6 mb-4">
                                                    <div class="form-outline">
                                                        <input type="date" class="form-control" name="dob" id="dob" value="<?php echo $today ?>">
                                                        <label class="form-label" for="">Birth Date</label>
                                                    </div>
                                                </div>
                                            </div>


                                            <div class="form-outline mb-4">

                                                <select class="form-control" placeholder="Role" name="roll" id="roll">

                                                    <option value="Admin">Admin</option>
                                                    <option value="Cashier">Cashier</option>
                                                    <option value="ShopKeeper">ShopKeeper</option>
                                                </select>
                                                <label class="form-label" for="">Role</label>
                                            </div>


                                            <div class="form-outline mb-4">
                                                <textarea class="form-control" rows="4" name="address"
                                                    id="address" required></textarea>
                                                <label class="form-label" for="">Address</label>
                                            </div>



                                            <!-- Submit button -->
                                            <button type="submit" class="btn btn-primary btn-block mb-4" name="submit">
                                                Submit
                                            </button>


                                        </form>
                                    </div>
                                </div>
                        </div>
                    </div>
                    </section>
                </div>

            </div>
        </div>

    </div>

    </div>

    </div>
    <!-- /.container-fluid -->

    </div>
    <!-- End of Main Content -->
    </div>

    <?php

if(isset($_POST['submit']))
{
$first_name=$_POST['first_name'];
$last_name=$_POST['last_name'];
$number=$_POST['number'];
$dob=$_POST['dob'];
$roll=$_POST['roll'];
$address=$_POST['address'];
$query="SELECT id FROM user WHERE number='$number'";
$result=$con->query($query);
if($result->num_rows>0){
    echo " <script>
        window.alert('User with mobile number $number already exist');
                </script>";
}
else{
$sql="INSERT INTO `user`( `first_name`, `last_name`, `number`, `dob`, `roll`, `address`) 
VALUES ('$first_name','$last_name','$number','$dob','$roll','$address')";

if($con->query($sql)==true)
{
    echo " <script>
    window.alert('New User Created');
	        </script>";
}
}
}
$con->close();
?>
    <?php
	  include('footer.php'); 

	?>



    <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin-2.min.js"></script>

</body>

</html>