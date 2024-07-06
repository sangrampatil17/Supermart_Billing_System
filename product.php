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

  <title>SB Admin 2 - Blank</title>

  <!-- Custom fonts for this template-->
  <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link
    href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
    rel="stylesheet">

  <!-- Custom styles for this template-->
  <link href="css/sb-admin-2.min.css" rel="stylesheet">

  <style>
    .bg {
      background: url("img/Untitled-1.jpg") no-repeat center center fixed;
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
                      <center>Product Info</center>
                    </h2>
                    <br>
                    <form action="product.php" method="POST">
                      <div class="form-outline  mb-4">
                        <input type="text" class="form-control" placeholder="" name="product_name" id="product_name" required >
                        <label class="form-label" for="">Product name</label>


                      </div>


                      <div class="row">
                        <div class="col-md-6 mb-4">
                          <div class="form-outline ">
                            <select class="form-control" name="gst" id="gst">

                              <option value="0">0%</option>
                              <option value="3">3%</option>
                              <option value="5">5%</option>
                              <option value="12">12%</option>
                              <option value="18">18%</option>
                              <option value="28">28%</option>
                            </select>
                            <label class="form-label" for="">GST %</label>
                          </div>
                        </div>

                        <div class="col-md-6 mb-4">
                          <div class="form-outline ">
                            <input type="number" class="form-control" placeholder="" name="hsn" id="hsn" required >
                            <label class="form-label" for="">HSN Number</label>
                          </div>
                        </div>
                      </div>


                      <div class="form-outline  mb-4">
                        <input type="number" class="form-control" placeholder="" name="barcode" id="barcode" required >
                        <label class="form-label" for="">Barcode</label>

                      </div>


                      <div class="row">
                        <div class="col-md-6 mb-4 ">
                          <div class="form-outline">
                            <input type="number" class="form-control" placeholder="" name="selling_price"
                              id="selling_price" value="0" readonly>
                            <label class="form-label" for="">Selling Price</label>
                          </div>
                        </div>
                        <div class="col-md-6 mb-4 ">
                          <div class="form-outline">
                            <input type="number" class="form-control" placeholder="" name="purchase_price"
                              id="purchase_price" value="0" readonly>
                            <label class="form-label" for="">Purchase Price</label>
                          </div>
                        </div>
                      </div>

                      <div class="row">
                        <div class="col-md-6 mb-4">
                          <div class="form-outline">
                            <input type="number" class="form-control" placeholder="" name="product_weight"
                              id="product_weight" required >
                            <label class="form-label" for="">Product Weight(Gm)</label>
                          </div>
                        </div>
                        <div class="col-md-6 mb-4">
                          <div class="form-outline">
                            <input type="text" class="form-control" placeholder="" name="Net_weight" id="Net_weight" required >
                            <label class="form-label" for="">Net Weight</label>
                          </div>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-md-6 mb-4">
                          <div class="form-outline mb-4">
                            <input type="date" class="form-control" placeholder="" name="manufacturing_date"
                              id="manufacturing_date" value="<?php echo $today ?>" required >
                            <label class="form-label" for="">Manufacture Date</label>
                          </div>
                        </div>
                        <div class="col-md-6 mb-4">
                          <div class="form-outline mb-4">
                            <input type="date" class="form-control" placeholder="" name="Expiry_date"
                              id="Expiry_date" value="<?php echo $today ?>" required >
                            <label class="form-label" for="">Expirt Date</label>
                          </div>
                        </div>
                      </div>
                      <div class="form-outline mb-4">
                        <input type="number" class="form-control" placeholder="" name="quantity" id="quantity" required value="0" readonly>
                        <label class="form-label" for="">Quantity</label>
                      </div>





                      <!-- Submit button -->
                      <button type="submit" name="submit" class="btn btn-primary btn-block mb-4">
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

  </div>
  <!-- End of Main Content -->



  <?php
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

$query="SELECT id FROM product WHERE barcode='$barcode'";
$result=$con->query($query);
if($result->num_rows>0){
  echo " <script>
  window.alert('Product with same barcode already exist');
</script>";
}else{
$sql="INSERT INTO  `product`( `product_name`, `gst`, `hsn`, `barcode`, `selling_price`, `purchase_price`, `product_weight`,
                             `Net_weight`, `manufacturing_date`, `Expiry_date`, `quantity`)
VALUES ('$product_name','$gst','$hsn','$barcode','$selling_price','$purchase_price','$product_weight','$Net_weight','$manufacturing_date',
         '$Expiry_date','$quantity')";

if($con->query($sql)==true)
{
    echo " <script>
      window.alert('Product Added Successfully');
    </script>";
}
}
}
$con->close();
 
?>



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