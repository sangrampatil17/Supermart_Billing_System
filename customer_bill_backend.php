<?php 
include 'dbconnection.php'; 
//include 'session.php';

if(isset($_POST['check_customer'])){
    $mobile_number=$_POST['mobile_number'];
    $query="SELECT * FROM customer_details WHERE mobile='$mobile_number'";
	$result=mysqli_query($con,$query);
    $arr=[];
	if(mysqli_num_rows($result)>0){
		$i=0;
		$row=mysqli_fetch_assoc($result);
            $name=$row['name'];
            $city=$row['city'];
            $arr=[
                "name"=>$name,
                "city"=>$city,
            ];
    }
    $json_merge = json_encode($arr);
echo $json_merge;
}
if(isset($_POST['cartadd'])){
    $barcode=$_POST['barcode'];
    $basket_no=$_POST['basket_no'];
    $query="SELECT * FROM product WHERE barcode='$barcode' AND quantity>0";
    $result=mysqli_query($con,$query);
    $lot_count=mysqli_num_rows($result);
        if(mysqli_num_rows($result)>0){
            echo'<input type="hidden" value="1" id="status_hidden">';
            while($row=mysqli_fetch_assoc($result)){
                $product_id=$row['id'];
                $product_name=$row['product_name'];
                $hsn=$row['hsn'];
                $gst_percentage=$row['gst'];
                $selling_price=$row['selling_price'];
                $product_weight=$row['product_weight'];
                $without_gst=round($selling_price/(1+($gst_percentage)/100),2);
                $gst=$selling_price-$without_gst;
            $query1="SELECT * FROM customer_bill_details WHERE product_id='$product_id' AND  bill_no IS NULL AND bill_date IS NULL AND basket_no='$basket_no'";
            $result1=$con->query($query1);
            if($result1->num_rows>0){
                $row1=mysqli_fetch_assoc($result1);
                $qty=$row1['qty']+1;
                $rate=$row1['rate'];
                $amount=$selling_price=round($rate*$qty,2);
                $without_gst=round($selling_price/(1+($gst_percentage)/100),2);
                $con->query("UPDATE customer_bill_details SET qty='$qty',amount='$amount',without_gst='$without_gst' WHERE product_id='$product_id' AND bill_no IS NULL AND bill_date IS NULL AND basket_no='$basket_no'");
            }else{
            $query="INSERT INTO `customer_bill_details`(`product_id`, `product_name`, `hsn`, `rate`, `qty`, `amount`, `without_gst`, `gst_percentage`,`basket_no`,`product_weight`) VALUES ('$product_id','$product_name','$hsn','$selling_price','1','$selling_price','$without_gst','$gst_percentage','$basket_no','$product_weight')";
            $con->query($query);
            }
        }
        }
        else{
            echo'<input type="hidden" value="0" id="status_hidden">';
        }
}
    if(isset($_POST['showbill'])){
        $basket_no=$_POST['basket_no'];
        $total_bill_product=0;
        $showbill="";
        $total_product_weight=0;
        $query="SELECT * FROM customer_bill_details WHERE bill_no IS NULL AND bill_date IS NULL AND basket_no='$basket_no' ORDER BY id DESC";
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
                $without_gst=$row['without_gst'];
                $total_product_weight+=($qty*$row['product_weight']);
                $tax=round($amount-$without_gst,2);
                $total_amount+=$amount;
                $i++;
                $showbill.='<tr><td>'.$i.'</td>
                <td>'.$product_name.'</td>
                <td>'.$rate.'</td>
                <td><i class="fa fa-minus bg-danger text-white rounded p-1" onclick="minusone('.$product_id.')"</i></td>
                <td>'.$qty.'</td>
                <td><i class="fa fa-plus bg-success text-white rounded p-1 " onclick="plusone('.$product_id.')"</i></td>
                <td>'.$amount.'</td>
                <td><i class="fa fa-trash bg-danger text-white rounded p-1" onclick="delete_qty('.$product_id.')"</i></td>
                </tr>
                ';
            }
            $showbill.='
            <tr>
            <th colspan="7">Total</th>
            <th>'.$total_amount.'</th>
            <th></th>
            </tr>
            ';
        }
        $showbill.='<input type="hidden" value="'.$i.'" id="bill_count">';
        $showbill.='<input type="hidden" value="'.$total_amount.'" id="total_amount">';
        $showbill.='<input type="hidden" value="'.$total_product_weight.'" id="hidden_total_product_weight">';
        echo $showbill;
    }
    if(isset($_POST['plusone'])){
        $product_id=$_POST['product_id'];
        $basket_no=$_POST['basket_no'];
        $query="SELECT * FROM customer_bill_details WHERE product_id='$product_id' AND  bill_no IS NULL AND bill_date IS NULL AND basket_no='$basket_no'";
            $result=$con->query($query);
            if($result->num_rows>0){
                $row=mysqli_fetch_assoc($result);
                $qty=$row['qty']+1;
                $rate=$row['rate'];
                $gst_percentage=$row['gst_percentage'];
                $amount=$selling_price=round($rate*$qty,2);
                $without_gst=round($selling_price/(1+($gst_percentage)/100),2);
                $con->query("UPDATE customer_bill_details SET qty='$qty',amount='$amount',without_gst='$without_gst' WHERE product_id='$product_id' AND bill_no IS NULL AND bill_date IS NULL AND basket_no='$basket_no'");
            }
    }
    if(isset($_POST['minusone'])){
        $product_id=$_POST['product_id'];
        $mobile_number=$_POST['mobile_number'];
        $basket_no=$_POST['basket_no'];
        $query="SELECT * FROM customer_bill_details WHERE product_id='$product_id' AND  bill_no IS NULL AND bill_date IS NULL AND basket_no='$basket_no'";
            $result=$con->query($query);
            if($result->num_rows>0){
                $row=mysqli_fetch_assoc($result);
                $qty=$row['qty']-1;
                $rate=$row['rate'];
                $gst_percentage=$row['gst_percentage'];
                $amount=$selling_price=round($rate*$qty,2);
                $without_gst=round($selling_price/(1+($gst_percentage)/100),2);
                if($qty<1){
                    $query="DELETE FROM customer_bill_details WHERE  product_id='$product_id' AND bill_no IS NULL AND bill_date IS NULL AND basket_no='$basket_no'";
                    $con->query($query);
                }else{
                    $con->query("UPDATE customer_bill_details SET qty='$qty',amount='$amount',without_gst='$without_gst' WHERE product_id='$product_id' AND bill_no IS NULL AND bill_date IS NULL AND basket_no='$basket_no'");
            }
                
        }
    }
    if(isset($_POST['delete_qty'])){
        $product_id=$_POST['product_id'];
        $basket_no=$_POST['basket_no'];
        $mobile_number=$_POST['mobile_number'];
        $query="DELETE FROM customer_bill_details WHERE  product_id='$product_id' AND  bill_no IS NULL AND bill_date IS NULL AND basket_no='$basket_no'";
                    $con->query($query);
    }
    if(isset($_POST['generate_bill'])){
        $cash_amount=$_POST['cash_amount'];
        $upi_amount=$_POST['upi_amount'];
        $card_amount=$_POST['card_amount'];
        $mobile_number=$_POST['mobile_number'];
        $customer_name=$_POST['customer_name'];
        $billdate=$_POST['billdate'];
        $city=$_POST['city'];
        $to_pay=$_POST['to_pay'];
        $customer_id=NULL;
        if($mobile_number!=""){
            $query="SELECT * FROM customer_details WHERE mobile='$mobile_number'";
        $result=$con->query($query);
        if($result->num_rows>0){
            $row=$result->fetch_assoc();
            $customer_id=$row['id'];
        }else{
            $insert_query="INSERT INTO `customer_details`(`name`, `city`, `mobile`) VALUES ('$customer_name','$city','$mobile_number')";
            $con->query($insert_query);
            $select_query="SELECT id FROM customer_details ORDER BY id DESC LIMIT 1";
            $select_result=$con->query($select_query);
            $select_row=$select_result->fetch_assoc();
            $customer_id=$select_row['id'];
        }
        }
        $query="SELECT id FROM customer_bill ORDER BY id DESC LIMIT 1";
        $result=$con->query($query);
        $invoice_no=0;
        if($result->num_rows>0){
            $row=$result->fetch_assoc();
            $invoice_no=$row['id'];
        }
        $invoice_no++;
        $query="SELECT * FROM customer_bill_details WHERE bill_no IS NULL AND bill_date IS NULL ORDER BY id DESC";
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
                $without_gst=$row['without_gst'];
                $tax=round($amount-$without_gst,2);
                $total_amount+=$amount;
                $total_without_gst+=$without_gst;
                $con->query("UPDATE customer_bill_details SET bill_no='$invoice_no',bill_date='$billdate',employee_id='$dbemployee_id' WHERE  bill_no IS NULL AND bill_date IS NULL");
                $con->query("UPDATE product SET quantity=quantity-$qty WHERE id='$product_id'");
            }
            $con->query("INSERT INTO `customer_bill`(`customer_id`,`billdate`, `without_gst`, `amount`, `user_id`, `cash`, `upi`, `card`) VALUES ('$customer_id','$billdate','$total_without_gst','$total_amount','$dbemployee_id','$cash_amount','$upi_amount','$card_amount')");
        }
        echo $invoice_no;
        
    }