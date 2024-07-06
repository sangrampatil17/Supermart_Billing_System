<?php 
include 'dbconnection.php'; 
include 'session.php';
$id=$_GET['id'];
if(isset($_POST['submit']))
{
$product_name=$_POST['product_name'];
$gst=$_POST['gst'];
$hsn=$_POST['hsn'];
$barcode=$_POST['barcode'];
$selling_price=$_POST['selling_price'];
$purchase_price=$_POST['purchase_price'];
$product_weight=$_POST['product_weight'];
$Net_weight=$_POST['Net_weight'];
$manufacturing_date=$_POST['manufacturing_date'];
$Expiry_date=$_POST['Expiry_date'];
$quantity=$_POST['quantity'];


$query = "UPDATE `product` SET `product_name`='$product_name',`gst`='$gst',`hsn`='$hsn',`barcode`='$barcode',`selling_price`='$selling_price',`purchase_price`='$purchase_price'
                              ,`product_weight`='$product_weight',`Net_weight`='$Net_weight',`manufacturing_date`='$manufacturing_date'
                              ,`Expiry_date`='$Expiry_date',`quantity`='$quantity' WHERE `id`='$id'";

$data=mysqli_query($con,$query);

if($data)
{
echo "
<script>
alert('Record Updated');
window.location.replace('producttb.php');
</script>
";
}
else
{
echo "fail to update record";
}

}

$query="SELECT * FROM `product` WHERE id='$id'";
$result=$con->query($query);
 if($result->num_rows>0)
 {
    while($row=$result->fetch_assoc())
    {
        $product_name=$row['product_name'];
        $gst=$row['gst'];
        $hsn=$row['hsn'];
        $barcode=$row['barcode'];
        $selling_price=$row['selling_price'];
        $purchase_price=$row['purchase_price'];
        $product_weight=$row['product_weight'];
        $Net_weight=$row['Net_weight'];
        $manufacturing_date=$row['manufacturing_date'];
        $Expiry_date=$row['Expiry_date'];
        $quantity=$row['quantity'];
       
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

    <title>SB Admin 2 - Blank</title>

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
                          <div class="col-lg-12">
                            <h2 class="fw-bold mb-3"><center>Product Info</center></h2>
                            <br>
                            <form action=" " method="POST">
                              
                              <!-- 2 column grid layout with text inputs for the first and last names -->
                              
                                
                                  <div class="form-outline  mb-4">
                                    <input type="text" class="form-control" placeholder="Product name" value="<?php echo "$product_name" ?>"  name="product_name" id="product_name"  required>
                                    Product name

                                
                                 </div>
                                
                    
                              <div class="row">
                                <div class="col-md-6 mb-4">
                              <div class="form-outline ">
                                <select  class="form-control" name="gst" id="gst" >
                                <option  >GST Number</option>
                                <option value="0%"
                                            <?php
                                             if("$gst" =='0') 
                                             {
                                                echo"selected";
                                             }
                                             ?> 
                                            >0%</option>
                                            <option value="3"
                                            <?php
                                             if("$gst" =='3') 
                                             {
                                                echo"selected";
                                             }
                                             ?>
                                            >3%</option>
                                            <option value="5"
                                            <?php
                                             if("$gst" =='5') 
                                             {
                                                echo"selected";
                                             }
                                             ?>
                                            >5%</option>
                                            <option value="12"
                                            <?php
                                             if("$gst" =='12') 
                                             {
                                                echo"selected";
                                             }
                                             ?>
                                            >12%</option>
                                            <option value="18"
                                            <?php
                                             if("$gst" =='18') 
                                             {
                                                echo"selected";
                                             }
                                             ?>
                                            >18%</option>
                                            <option value="28"
                                            <?php
                                             if("$gst" =='28') 
                                             {
                                                echo"selected";
                                             }
                                             ?>
                                            >28%</option>
                                        </select>
                                        GST Percentage

                            </div>
                              </div>

                              <div class="col-md-6 mb-4">
                              <div class="form-outline ">
                                <input type="number" class="form-control"  placeholder="HSN Number" value="<?php echo "$hsn" ?>"  name="hsn" id="hsn" required> 
                                HSN Number
                              </div>
                              </div>
                              </div>    
                              
                              
                              <div class="form-outline  mb-4">
                                <input type="number" class="form-control" placeholder="Barcode" value="<?php echo "$barcode" ?>"  name="barcode" id="barcode" required readonly>
                                Barcode
                            
                             </div>
                            
                             
                              <div class="row">
                                <div class="col-md-6 mb-4">
                                 <div class="form-outline">
                                   <input type="number" class="form-control" placeholder="Selling Price" value="<?php echo "$selling_price" ?>"  name="selling_price" id="selling_price" required>
                                   Selling Price
                                 </div>
                                </div>
                                <div class="col-md-6 mb-4">
                                 <div class="form-outline">
                                   <input type="number" class="form-control" placeholder="Purchase Price" value="<?php echo "$purchase_price" ?>"  name="purchase_price" id="purchase_price"  required>
                                   Purchase Price
                                 </div>
                                </div>
                             </div>
                  
                             <div class="row">
                                <div class="col-md-6 mb-4">
                                 <div class="form-outline">
                                   <input type="number" class="form-control"  placeholder="Product Weight" value="<?php echo "$product_weight" ?>" name="product_weight" id="product_weight" required>
                                   Product Weight(Gm)
                                 </div>
                                </div>
                                <div class="col-md-6 mb-4">
                                 <div class="form-outline">
                                   <input type="text" class="form-control" placeholder="Net Weight" value="<?php echo "$Net_weight" ?>"   name="Net_weight" id="Net_weight"  required>
                                   Net Weight

                                 </div>
                                </div>
                             </div>
                            
                            
                                 <div class="form-outline mb-4">
                                   <input type="date" class="form-control" placeholder="Manufacture Date" value="<?php echo "$manufacturing_date" ?>"  name="manufacturing_date" id="manufacturing_date" required>
                                   Manufacture Date

                                 </div>
                               
                             
                                 <div class="form-outline mb-4">
                                   <input type="date" class="form-control" placeholder="Expiry Date" value="<?php echo "$Expiry_date" ?>"   name="Expiry_date" id="Expiry_date" required>
                                   Expirt Date

                                 </div>
                             
                                 <div class="form-outline mb-4">
                                    <input type="number" class="form-control" placeholder="Quantity" value="<?php echo "$quantity" ?>"  name="quantity" id="quantity"  required>
                                    Quantity
                                  </div>




                  
                              <!-- Submit button -->
                              <button type="submit" name="submit" class="btn btn-primary btn-block mb-4">
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