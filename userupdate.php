<?php 
include 'dbconnection.php'; 
include 'session.php';
$id=$_GET['id'];
 
$query="SELECT * FROM `user` WHERE id='$id'";

$result=$con->query($query);
 if($result->num_rows>0)
 {
    while($row=$result->fetch_assoc()){
        $first_name=$row['first_name'];
        $last_name=$row['last_name'];
        $number=$row['number'];
        $dob=$row['dob'];
        $roll=$row['roll'];
        $address=$row['address'];
       
    } 
}  
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


.bg{ 
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
    
   
                <!-- Begin Page Content -->
                  <!-- Outer Row -->


                  <div class="bg">                

        <div class="row justify-content-center">

            <div class="col-xl-6 col-lg-6 col-md-6"> 

                <div class="card o-hidden border-0 shadow-lg my-5">
                    <div class="card-body p-0">


                      <div class="container">
                   
                        <section class="">


                                <div class="row d-flex justify-content-center">
                                  <div class="col-lg-12">
                                    <h2 class="fw-bold mb-3"><center>User Info</center></h2>
                                    <br>


                                    <form action="" method="POST">
                                      <!-- 2 column grid layout with text inputs for the first and last names -->
                                      <div class="row">
                                         <div class="col-md-6 mb-4">
                                          <div class="form-outline">
                                            <input type="text" class="form-control" name="first_name" value="<?php echo "$first_name" ?>" id="first_name"   />
                                            <label class="form-label" for="">First name</label>
                                          </div>
                                         </div>
                                         <div class="col-md-6 mb-4">
                                          <div class="form-outline">
                                            <input type="text" class="form-control" name="last_name" value="<?php echo "$last_name" ?>" id="last_name"  />
                                            <label class="form-label" for="">Last name</label>
                                          </div>
                                         </div>
                                      </div>
                          

                                      <div class="row">
                                        <div class="col-md-6 mb-4">
                                         <div class="form-outline">
                                           <input type="number"  class="form-control"name="number"  value="<?php echo "$number" ?>" id="number"  />
                                           <label class="form-label" for="">Mobile Number</label>
                                         </div>
                                        </div>
                                        <div class="col-md-6 mb-4">
                                         <div class="form-outline">
                                           <input type="date" class="form-control" name="dob" value="<?php echo "$dob" ?>" id="dob" />
                                           <label class="form-label" for="">Birth Date</label>
                                         </div>
                                        </div>
                                     </div>

                                     
                                      <div class="form-outline mb-4">
                                        <select  class="form-control"  placeholder="Role" name="roll"  id="roll" >
                                            <option value="">Role</option>

                                            <option value="Admin" 
                                            <?php
                                             if("$roll" =='Admin') 
                                             {
                                                echo"selected";
                                             }
                                             ?>
                                             >
                                             Admin</option>

                                            <option value="Cashier"
                                            <?php
                                             if("$roll" =='Cashier') 
                                             {
                                                echo"selected";
                                             }
                                             ?>
                                            >Cashier</option>

                                            <option value="ShopKeeper"
                                            <?php
                                             if("$roll" =='ShopKeeper') 
                                             {
                                                echo"selected";
                                             }
                                             ?>
                                            >ShopKeeper</option>
                                        </select>
                
                                      </div>
                          
                                     
                                      <div class="form-outline mb-4">
                                        <textarea class="form-control"  rows="4" name="address"  id="address" ><?php echo "$address" ?></textarea>
                                        <label class="form-label" for="">Address</label>
                                      </div>
                          
                                    
                          
                                      <!-- Submit button -->
                                      <button type="submit" class="btn btn-primary btn-block mb-4" name="update">
                                       Update
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

<?php

if(isset($_POST['update']))
{
    $first_name=$_POST['first_name'];
    $last_name=$_POST['last_name'];
    $number=$_POST['number'];
    $dob=$_POST['dob'];
    $roll=$_POST['roll'];
    $address=$_POST['address'];
   

  $query = "UPDATE `user` SET `first_name`='$first_name',`last_name`='$last_name',`number`='$number',`dob`='$dob',`roll`='$roll',`address`='$address'
            WHERE `id`='$id'";
    
     $data=mysqli_query($con,$query);

     if($data)
     {
        echo "
        <script>
        alert('Record Updated');
       window.location.replace('usertb.php');
     </script>
     ";
     }
     else
     {
      echo "
        <script>
        alert('Failed to Update Record');
        window.location.replace('usertb.php');
     </script>
     ";
       
     }
     
}
?>




