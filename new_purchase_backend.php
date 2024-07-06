<?php 
include 'dbconnection.php'; 
include 'session.php';

if(isset($_POST['cartadd'])){
    $barcode=$_POST['barcode'];
    $query="SELECT * FROM product WHERE barcode='$barcode'";
    $result=mysqli_query($con,$query);
    $lot_count=mysqli_num_rows($result);
        if(mysqli_num_rows($result)>0){
            
            while($row=mysqli_fetch_assoc($result)){
                $product_id=$row['id'];
                $product_name=$row['product_name'];
                $hsn=$row['hsn'];
                $gst_percentage=$row['gst'];
                $selling_price=$row['selling_price'];
                $without_gst=round($selling_price/(1+($gst_percentage)/100),2);
                $gst=$selling_price-$without_gst;
            $query1="SELECT * FROM purchase_bill_details WHERE product_id='$product_id' AND employee_id='$dbemployee_id' AND bill_no IS NULL AND bill_date IS NULL";
            $result1=$con->query($query1);
            if($result1->num_rows>0){
                $row1=mysqli_fetch_assoc($result1);
                $qty=$row1['qty']+1;
                $rate=$row1['rate'];
                $amount=$selling_price=round($rate*$qty,2);
                $without_gst=round($selling_price/(1+($gst_percentage)/100),2);
                $con->query("UPDATE purchase_bill_details SET qty='$qty',amount='$amount',without_gst='$without_gst' WHERE product_id='$product_id' AND employee_id='$dbemployee_id' AND bill_no IS NULL AND bill_date IS NULL");
                echo'<input type="hidden" value="1" id="status_hidden">';
            }else{
            echo'
            <div class="modal fade" id="purchaseModule" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
      tabindex="-1" aria-labelledby="purchaseModule" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-body">
            <div class="row">
            <div class="col-12">
            Purchase Rate
            <input class="form-control" type="number" id="purchase_price">
            </div>
            <div class="col-12">
                QTY
                <input class="form-control" type="number" id="purchase_qty">
            </div>
            <div class="col-12">
                <input type="hidden" id="product_id" value="'.$product_id.'">
                <input type="hidden" id="product_name" value="'.$product_name.'">
                <input type="hidden" id="hsn" value="'.$hsn.'">
                <input type="hidden" id="gst_percentage" value="'.$gst_percentage.'">
            </div>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" data-dismiss="modal">Close</button>
            <button type="button" class="btn btn-success" onclick="cart_insert()" data-bs-dismiss="modal" data-dismiss="modal">Add</button></a>

          </div>
        </div>
      </div>
    </div>
            ';
            echo'<input type="hidden" value="11" id="status_hidden">';
            }
        }
        }
        else{
            echo'<input type="hidden" value="0" id="status_hidden">';
        }
    }
    if(isset($_POST['cart_insert'])){
        $product_id=$_POST['product_id'];
        $product_name=$_POST['product_name'];
        $hsn=$_POST['hsn'];
        $purchase_rate=$_POST['purchase_price'];
        $purchase_qty=$_POST['purchase_qty'];
        $purchase_price=$purchase_qty*$purchase_rate;
        $gst_percentage=$_POST['gst_percentage'];
        $without_gst=round($purchase_price/(1+($gst_percentage)/100),2);
        $query="INSERT INTO `purchase_bill_details`(`employee_id`, `product_id`, `product_name`, `hsn`, `rate`, `qty`, `amount`, `without_gst`, `gst_percentage`) VALUES ('$dbemployee_id','$product_id','$product_name','$hsn','$purchase_rate','$purchase_qty','$purchase_price','$without_gst','$gst_percentage')";
        $con->query($query);
    }
    if(isset($_POST['showbill'])){
       
        $total_bill_product=0;
        $query="SELECT * FROM purchase_bill_details WHERE employee_id='$dbemployee_id' AND bill_no IS NULL AND bill_date IS NULL ORDER BY id DESC";
        $result=$con->query($query);
        $i=$total_amount=0;
        if($result->num_rows>0){
            while($row=$result->fetch_assoc()){
                $product_id=$row['product_id'];
                $product_name=$row['product_name'];
                $hsn=$row['hsn'];
                $rate=$row['rate'];
                $qty=$row['qty'];
                $amount=$row['amount'];
                $employee_id=$row['employee_id'];
                $without_gst=$row['without_gst'];
                $tax=round($amount-$without_gst,2);
                $total_amount+=$amount;
                $i++;
                echo'<tr><td>'.$i.'</td>
                <td>'.$hsn.'</td>
                <td>'.$product_name.'</td>
                <td>'.$rate.'</td>
                <td><i class="fa fa-minus bg-danger text-white rounded p-1" onclick="minusone('.$product_id.','.$employee_id.')"</i></td>
                <td>'.$qty.'</td>
                <td><i class="fa fa-plus bg-success text-white rounded p-1 " onclick="plusone('.$product_id.','.$employee_id.')"</i></td>
                <td>'.$amount.'</td>
                <td><i class="fa fa-trash bg-danger text-white rounded p-1" onclick="delete_qty('.$product_id.','.$employee_id.')"</i></td>
                </tr>
                ';
            }
            echo'
            <tr>
            <th colspan="7">Total</th>
            <th>'.$total_amount.'</th>
            <th></th>
            </tr>
            ';
        }
        echo'<input type="hidden" value="'.$i.'" id="bill_count">';
        echo'<input type="hidden" value="'.$total_amount.'" id="total_amount">';
        
    }
    if(isset($_POST['plusone'])){
        $product_id=$_POST['product_id'];
        $employee_id=$_POST['employee_id'];
        $query="SELECT * FROM purchase_bill_details WHERE product_id='$product_id' AND employee_id='$dbemployee_id' AND bill_no IS NULL AND bill_date IS NULL";
            $result=$con->query($query);
            if($result->num_rows>0){
                $row=mysqli_fetch_assoc($result);
                $qty=$row['qty']+1;
                $rate=$row['rate'];
                $gst_percentage=$row['gst_percentage'];
                $amount=$selling_price=round($rate*$qty,2);
                $without_gst=round($selling_price/(1+($gst_percentage)/100),2);
                $con->query("UPDATE purchase_bill_details SET qty='$qty',amount='$amount',without_gst='$without_gst' WHERE product_id='$product_id' AND employee_id='$dbemployee_id' AND bill_no IS NULL AND bill_date IS NULL");
            }
    }
    if(isset($_POST['minusone'])){
        $product_id=$_POST['product_id'];
        $employee_id=$_POST['employee_id'];
        $query="SELECT * FROM purchase_bill_details WHERE product_id='$product_id' AND employee_id='$dbemployee_id' AND bill_no IS NULL AND bill_date IS NULL";
            $result=$con->query($query);
            if($result->num_rows>0){
                $row=mysqli_fetch_assoc($result);
                $qty=$row['qty']-1;
                $rate=$row['rate'];
                $gst_percentage=$row['gst_percentage'];
                $amount=$selling_price=round($rate*$qty,2);
                $without_gst=round($selling_price/(1+($gst_percentage)/100),2);
                if($qty<1){
                    $query="DELETE FROM purchase_bill_details WHERE  product_id='$product_id' AND employee_id='$dbemployee_id' AND bill_no IS NULL AND bill_date IS NULL";
                    $con->query($query);
                }else{
                    $con->query("UPDATE purchase_bill_details SET qty='$qty',amount='$amount',without_gst='$without_gst' WHERE product_id='$product_id' AND employee_id='$dbemployee_id' AND bill_no IS NULL AND bill_date IS NULL");
            }
                
        }
    }
    if(isset($_POST['delete_qty'])){
        $product_id=$_POST['product_id'];
        $employee_id=$_POST['employee_id'];
        $query="DELETE FROM purchase_bill_details WHERE  product_id='$product_id' AND employee_id='$dbemployee_id' AND bill_no IS NULL AND bill_date IS NULL";
                    $con->query($query);
    }
    if(isset($_POST['generate_bill'])){
        $cash_amount=$_POST['cash_amount'];
        $upi_amount=$_POST['upi_amount'];
        $card_amount=$_POST['card_amount'];
        $vendor=$_POST['vendor'];
        $billdate=$_POST['billdate'];
        $to_pay=$_POST['to_pay'];
        $query="SELECT id FROM purchase_bill ORDER BY id DESC LIMIT 1";
        $result=$con->query($query);
        $invoice_no=0;
        if($result->num_rows>0){
            $row=$result->fetch_assoc();
            $invoice_no=$row['id'];
        }
        $invoice_no++;
        $query="SELECT * FROM purchase_bill_details WHERE employee_id='$dbemployee_id' AND bill_no IS NULL AND bill_date IS NULL ORDER BY id DESC";
        $result=$con->query($query);
        $total_amount=$total_without_gst=0;
        if($result->num_rows>0){
            while($row=$result->fetch_assoc()){
                $product_id=$row['product_id'];
                $product_name=$row['product_name'];
                $hsn=$row['hsn'];
                $rate=$row['rate'];
                $qty=$row['qty'];
                $amount=$row['amount'];
                $employee_id=$row['employee_id'];
                $without_gst=$row['without_gst'];
                $tax=round($amount-$without_gst,2);
                $total_amount+=$amount;
                $total_without_gst+=$without_gst;
                $con->query("UPDATE purchase_bill_details SET bill_no='$invoice_no',bill_date='$billdate' WHERE employee_id='$dbemployee_id' AND bill_no IS NULL AND bill_date IS NULL");
                $con->query("UPDATE product SET quantity=quantity+$qty WHERE id='$product_id'");
            }
            $con->query("INSERT INTO `purchase_bill`(`vendor_id`,`billdate`, `without_gst`, `amount`, `user_id`, `cash`, `upi`, `card`) VALUES ('$vendor','$billdate','$total_without_gst','$total_amount','$dbemployee_id','$cash_amount','$upi_amount','$card_amount')");
        }
        echo $invoice_no;
        
    }
?>