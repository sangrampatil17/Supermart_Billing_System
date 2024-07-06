<?php 
include 'dbconnection.php'; 
include 'session.php';
if(isset($_POST['showbill'])){
    $basket_query = "SELECT basket_no FROM customer_bill_details WHERE basket_no!='0' AND bill_no IS NULL AND bill_date IS NULL GROUP BY basket_no ORDER BY basket_no ASC";
    $basket_result = $con->query($basket_query);
    if ($basket_result->num_rows > 0) {
        while ($basket_row = $basket_result->fetch_assoc()) {
            $basket_no = $basket_row['basket_no'];

            ?>
            <div class="col-xl-6 col-md-6 mb-4">
                <div class="card border-left-primary shadow h-100">
                <div class="card-header text-center text-primary">
                Basket No. <b><?php echo $basket_no ?></b>
                </div>
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                        <table class="table text-center">
              <thead>
                <tr>
                  <th>Sr.No</th>
                  <th>Particulars</th>
                  <th>Rate</th>
                  <th>QTY</th>
                  <th>Amount</th>
                </tr>
              </thead>
              <tbody id="showbill">
                                <?php
                                $query = "SELECT * FROM customer_bill_details WHERE bill_no IS NULL AND bill_date IS NULL AND basket_no='$basket_no' ORDER BY id DESC";
                                $result = $con->query($query);
                                $i = $total_amount = 0;
                                $total_product_weight = 0;
                                $showbill = "";
                                if ($result->num_rows > 0) {
                                    while ($row = $result->fetch_assoc()) {
                                        $product_id = $row['product_id'];
                                        $product_name = $row['product_name'];
                                        $hsn = $row['hsn'];
                                        $rate = $row['rate'];
                                        $qty = $row['qty'];
                                        $amount = $row['amount'];
                                        $without_gst = $row['without_gst'];
                                        $total_product_weight += ($qty * $row['product_weight']);
                                        $tax = round($amount - $without_gst, 2);
                                        $total_amount += $amount;
                                        $i++;
                                        $showbill .= '<tr><td>' . $i . '</td>
    <td>' . $product_name . '</td>
    <td>' . $rate . '</td>
    <td>' . $qty . '</td>
    <td>' . $amount . '</td>
    </tr>
    ';
                                    }

                                    $showbill .= '
            <tr>
            <th colspan="4">Total</th>
            <th>' . $total_amount . '</th>
            <th></th>
            </tr>
            ';
            echo $showbill;
                                }
                                ?>
                            </table>
                        </div>
                    </div>
                    <div class="card-footer text-right">
                        <a href="new_bill_customer.php?basket_id=<?php echo $basket_no ?>"><button class="btn btn-primary">Proceed >></button></a>
                    </div>
                </div>
            </div>
            <?php
        }
    }
}

?>