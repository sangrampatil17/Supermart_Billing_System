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
</head>

<body id="page-top">

  <?php
  include 'header.php';
  ?>

  <body>

    <div class="card o-hidden border-1 shadow-lg my-5">
      <div class="card-body p-1">

        <div class=container>

          <div class="row">
            <div class="col-lg-12 pt-2">

              <div class="col-md-3 ">
                <div class="form-outline">
                  <input type="date" class="form-control" name="date" id="date" value="<?php echo $today ?>">
                  <label class="form-label" for="">Bill Date</label>
                </div>
              </div>
            </div>

            <div class="col-md-4">
              <div class="form-outline">
                <input type="number" class="form-control" name="mobile_number" id="mobile_number"
                  onkeyup="check_customer()">
                <label class="form-label" for="">MOBILE NUMBER</label>
              </div>
            </div>
            <div class="col-md-4 ">
              <div class="form-outline">
                <input type="text" class="form-control" name="customer_name" id="customer_name">
                <label class="form-label" for="">CUSTOMER NAME</label>
              </div>
            </div>



            <div class="col-md-4 ">
              <div class="form-outline">
                <input type="text" class="form-control" name="city" id="city">
                <label class="form-label" for="">CITY/VILLAGE</label>
              </div>
            </div>
          </div>


          <div class="row mt-2">
            <div class="col-md-6 mb-4">
              <div class="form-outline">
                <input type="text" class="form-control" name="barcode" id="barcode">
                <label class="form-label" for="">BARCODE</label>
              </div>
            </div>
            <div class=col-md-6 mb-4>
              <button type="button" class="btn btn-primary " name="add_product" id="add_product" onclick="cartadd()">
                Add
              </button>
            </div>
          </div>

          <div>
            <table class="table text-center">
              <thead>
                <tr>
                  <th>Sr.No</th>
                  <th>HSN</th>
                  <th>Particulars</th>
                  <th>Rate</th>
                  <th></th>
                  <th>QTY</th>
                  <th></th>
                  <th>Amount</th>
                  <th>Delete</th>
                </tr>
              </thead>
              <tbody id="showbill">

              </tbody>
            </table>
            <div class="text-right" id="payment_button" style="display: none;">
              <button class="btn btn-primary" onclick="payment_module_open()">Payment</button>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div>
    </div>
    <div id="show_data">

    </div>
    <div class="modal fade" id="payment_module" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
      tabindex="-1" aria-labelledby="payment_module" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-body">
            <div class="row">
              <div class="col-md-5">
                <p id="display_bill_amount"></p>
              </div>
              <div class="col-md-4 text-success">
                <h3 id="paid_bill_amount"></h3>
              </div>


              <div class="col-md-5 pt-2">
                <label for="">Cash</label>
              </div>
              <div class="col-md-4 pb-2">
                <input type="text" class="form-control 6" placeholder="Cash Amount" id="cash_amount"
                  onkeydown="check_enter(6)" onkeyup="check_paid_amount()">
              </div>
              <div class="col-md-3">
              </div>

              <div class="col-md-5 pt-2">
                <label for="">UPI</label>
              </div>
              <div class="col-md-4 pb-2">
                <input type="text" class="form-control 7" placeholder="UPI Amount" id="upi_amount"
                  onkeydown="check_enter(7)" onkeyup="check_paid_amount()">
              </div>
              <div class="col-md-3">
              </div>

              <div class="col-md-5 pt-2">
                <label for="">Card</label>
              </div>
              <div class="col-md-4 pb-2">
                <input type="text" class="form-control 8" placeholder=" Card Amount" id="card_amount"
                  onkeydown="check_enter(8)" onkeyup="check_paid_amount()">
              </div>

              <div class="col-md-3">
              </div>
              <div class="col-md-12">
                <p class="text-danger text-start" id="return_cash"></p>
              </div>
              <div class="col-md-3">
              </div>
              <div class="col-md-3">
              </div>
              <div class="col-md-3">
              </div>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" data-dismiss="modal">Close</button>
            <button type="button" id="generate_bill_button" class="btn btn-success" onclick="generate_bill()">Generate
              Bill</button></a>

          </div>
        </div>
      </div>
    </div>
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
    <script>
      var payment_module = new bootstrap.Modal(document.getElementById('payment_module'));
      function payment_module_open() {
        payment_module.show();
        let to_pay = document.getElementById("total_amount").value;
        document.getElementById("display_bill_amount").innerHTML = "Bill Amount: <span class='h3'>" +
          to_pay + "</span>";
        setTimeout(function () {
          $("#cash_amount").focus().val('').val(to_pay);
          check_paid_amount();
        }, 500);
      }
      function check_enter(id) {
        if (event.key === "Enter") {
          id++;
          document.getElementsByClassName(id)[0].focus();
        }
      }
      function check_paid_amount() {
        var cash_amount = document.getElementById("cash_amount").value;
        var upi_amount = document.getElementById("upi_amount").value;
        var card_amount = document.getElementById("card_amount").value;
        document.getElementById("generate_bill_button").style.display = "block";
        let to_pay = document.getElementById("total_amount").value;
        if (cash_amount == "") {
          cash_amount = 0;
        }
        if (upi_amount == "") {
          upi_amount = 0;
        }
        if (card_amount == "") {
          card_amount = 0;
        }
        cash_amount = parseFloat(cash_amount);
        upi_amount = parseFloat(upi_amount);
        card_amount = parseFloat(card_amount);
        to_pay = parseFloat(to_pay);
        var paid_amount = parseFloat(cash_amount + upi_amount + card_amount).toFixed(2);
        paid_amount = parseFloat(paid_amount);
        document.getElementById("paid_bill_amount").innerHTML = paid_amount;
        var remaining_bill_amount = to_pay - paid_amount;
        if (remaining_bill_amount < 0) {
          remaining_bill_amount = 0;
        }
        return_cash = 0;
        //if (cash_amount > 0) 
        {
          return_cash = paid_amount - to_pay;
          return_cash = Math.round((return_cash + Number.EPSILON) * 100) / 100

          document.getElementById("return_cash").innerHTML = "Return <span class='text-danger h2'>" +
            return_cash + "</span>";
        }
        if (return_cash < 0) {
          document.getElementById("generate_bill_button").style.display = "none";
        }
        remaining_bill_amount = Math.round((remaining_bill_amount + Number.EPSILON) * 100) / 100
        //document.getElementById("remaining_bill_amount").innerHTML = remaining_bill_amount;
      }
      function focus() {
        document.getElementById("barcode").value = "";
        document.getElementById("barcode").focus();
      }
      focus();
      showbill();
      document.getElementById("barcode").addEventListener("keyup", function (event) {
        if (event.keyCode === 13) {
          event.preventDefault();
          document.getElementById("add_product").click();

        }
      });
      function generate_bill() {
        var generate_bill = "generate_bill";
        let mobile_number = document.getElementById("mobile_number").value;
        let to_pay = document.getElementById("total_amount").value;
        var billdate = document.getElementById("date").value;
        let mobile_number_length = document.getElementById("mobile_number").value.length;
          let customer_name = document.getElementById("customer_name").value;
          let city = document.getElementById("city").value;
          cash_amount = document.getElementById("cash_amount").value;
          cash_amount -= return_cash;
          upi_amount = document.getElementById("upi_amount").value;
          card_amount = document.getElementById("card_amount").value;
          $.ajax({
            url: "new_bill_backend.php",
            type: "POST",
            data: {
              generate_bill: generate_bill,
              billdate: billdate,
              mobile_number: mobile_number,
              customer_name: customer_name,
              city: city,
              cash_amount: cash_amount,
              upi_amount: upi_amount,
              card_amount: card_amount,
              to_pay: to_pay,
            },
            success: function (data, status) {
              data = "bill.php?bill=" + data;
              window.location.href = data;
            }
          });
      }
      function check_customer() {
        let mobile_number = document.getElementById("mobile_number").value;
        let mobile_number_length = document.getElementById("mobile_number").value.length;
        if (mobile_number_length == 10) {
          let check_customer = "check_customer";
          $.ajax({
            url: "new_bill_backend.php",
            type: "POST",
            data: {
              check_customer: check_customer,
              mobile_number: mobile_number,
            },
            success: function (customer_list, status) {
              data = JSON.parse(customer_list);
              if (customer_list.length > 2) {
                document.getElementById("customer_name").value = data.name;
                document.getElementById("city").value = data.city;
                focus();
              } else {
                document.getElementById("customer_name").value = "";
                document.getElementById("city").value = "";

              }

            }
          });
        }
      }
      function cartadd() {
        let barcode = document.getElementById("barcode").value;
        let cartadd = "cartadd";
        $.ajax({
          url: "new_bill_backend.php",
          type: "POST",
          data: {
            cartadd: cartadd,
            barcode: barcode,
          },
          success: function (data, status) {
            document.getElementById("show_data").innerHTML = data;
            let status_hidden = parseInt(document.getElementById("status_hidden").value);
            if (status_hidden == 0) {
              alert("Wrong Barcode");
            } else if (status_hidden == 1) {

              showbill();
            }

          }
        });
      }
      function showbill() {
        let showbill = "showbill";
        $.ajax({
          url: "new_bill_backend.php",
          type: "POST",
          data: {
            showbill: showbill,
          },
          success: function (data, status) {
            document.getElementById("showbill").innerHTML = data;
            focus();
            let bill_count = document.getElementById("bill_count").value;
            document.getElementById("payment_button").style.display = "none";
            if (bill_count > 0) {
              document.getElementById("payment_button").style.display = "block";
            }
          }
        });
      }
      function plusone(product_id, employee_id) {
        let plusone = "plusone";
        let mobile_number = document.getElementById("mobile_number").value;
        $.ajax({
          url: "new_bill_backend.php",
          type: "POST",
          data: {
            plusone: plusone,
            product_id: product_id,
            employee_id: employee_id,
          },
          success: function (data, status) {
            showbill();
          }
        });
      }
      function minusone(product_id, employee_id) {
        let minusone = "minusone";
        $.ajax({
          url: "new_bill_backend.php",
          type: "POST",
          data: {
            minusone: minusone,
            product_id: product_id,
            employee_id: employee_id,
          },
          success: function (data, status) {
            showbill();
          }
        });
      }
      function delete_qty(product_id, employee_id) {
        let delete_qty = "delete_qty";
        $.ajax({
          url: "new_bill_backend.php",
          type: "POST",
          data: {
            delete_qty: delete_qty,
            product_id: product_id,
            employee_id: employee_id,
          },
          success: function (data, status) {
            showbill();
          }
        });
      }
    </script>
  </body>

</html>