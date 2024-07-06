<?php 
include 'dbconnection.php'; 
include 'session.php';
$id=$_GET['id'];

$query="SELECT * FROM `vender` WHERE id='$id'";

$result=$con->query($query);

 if($result->num_rows>0){
    while($row=$result->fetch_assoc()){
        $firm_name=$row['firm_name'];
        $contact_name=$row['contact_name'];
        $gst=$row['gst'];
        $number=$row['number'];
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

 
   
    
    <!-- Background image -->
    <style>


        .bg{ 
          background: url("img/img2.jpg") no-repeat center center fixed; 
          -webkit-background-size: cover;
          -moz-background-size: cover;
          -o-background-size: cover;
          background-size: cover;
        }
        </style>
           
   


</head>

<body  id="page-top">
  
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
                                  <div class="col-lg-7">
                                    <h2 class="fw-bold mb-3"><center>Vender Info</center></h2>
                                    <br>
                                    
                                    <form action="" method="POST">

                                      <!-- 2 column grid layout with text inputs for the first and last names -->
                                      <div class="row">
                                         <div class="col-md-6 mb-4">
                                          <div class="form-outline">
                                            <input type="text" class="form-control" name="firm_name"  value="<?php echo "$firm_name" ?>" id="firm_name" />
                                            <label class="form-label" for="">Firm name</label>
                                          </div>
                                         </div>
                                         <div class="col-md-6 mb-4">
                                          <div class="form-outline">
                                            <input type="text" class="form-control" name="contact_name"  value="<?php echo "$contact_name" ?>" id="contact_name" />
                                            <label class="form-label" for="">Contact name</label>
                                          </div>
                                         </div>
                                      </div>
                            
                                      <div class="form-outline mb-4">
                                        <select  class="form-control"  name="gst"   id="gst">
                                            <option  >GST Number</option>

                                            <option value="0%"
                                            <?php
                                             if($gst =='0%') 
                                             {
                                                echo"selected";
                                             }
                                             ?>
                                            >
                                            0%</option>

                                            <option value="3%"
                                            <?php
                                             if($gst =='3%') 
                                             {
                                                echo"selected";
                                             }
                                             ?>
                                            >3%</option>

                                            <option value="5%"
                                            <?php
                                             if($gst =='5%') 
                                             {
                                                echo"selected";
                                             }
                                             ?>
                                            >5%</option>
                                            <option value="12%"
                                            <?php
                                             if($gst =='12%') 
                                             {
                                                echo"selected";
                                             }
                                             ?>
                                            >12%</option>
                                            <option value="18%"
                                            <?php
                                             if($gst =='18%') 
                                             {
                                                echo"selected";
                                             }
                                             ?>
                                            >18%</option>
                                            <option value="28%"
                                            <?php
                                             if($gst =='28%') 
                                             {
                                                echo"selected";
                                             }
                                             ?>
                                            >28%</option>
                                        </select>
                
                                      </div>

                                      <div class="form-outline mb-4">
                                        <input type="text" class="form-control" name="number"  value="<?php echo "$number" ?>" id="number" /> 
                                        <label class="form-label" for="">Contact Number</label>
                                      </div>
                                                               
                                      <div class="form-outline mb-4">
                                        <textarea class="form-control"  rows="4" name="address" id="address"><?php echo "$address" ?></textarea>
                                        <label class="form-label" for="">Address</label>
                                      </div>
 
                          
                                      <!-- Submit button -->
                                      <button type="submit"  name="submit" class="btn btn-primary btn-block mb-4">
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

        </div>
            <!-- End of Main Content -->

 

           
<?php
include'footer.php'
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


if(isset($_POST['submit']))
{

$firm_name=$_POST['firm_name'];
$contact_name=$_POST['contact_name'];
$gst=$_POST['gst'];
$number=$_POST['number'];
$address=$_POST['address'];


$query = "UPDATE `vender` SET `firm_name`='$firm_name',`contact_name`='$contact_name',`gst`='$gst',`number`='$number',`address`='$address'
WHERE `id`='$id'";

$data=mysqli_query($con,$query);

if($data)
{
echo "
<script>
alert('Record Updated');

</script>
";
}
else
{
echo "fail to update record";
}

}
?>

