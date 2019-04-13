<?php session_start();?>
<?php

/**
 * Use an HTML form to create a new entry in the
 * users table.
 *
 */
require "config.php";
require "common.php";
$style = "";
$emptyStyle= ""; ?>
<!-- <script type="text/javascript">
  var mailVal = localStorage.getItem("email");
  if(mailVal){
      window.location.href = 'view.php';
  }
</script> -->
<?php
if (isset($_POST['addTransaction'])) {
    $transactionDate = $_POST['transactionDate'];
    $purchasePrice = $_POST['purchasePrice'];
    $discount = $_POST['discountPrice'];
    $totalPrice = $_POST['totalPrice'];
    $mobileno = $_SESSION["mobileno"];
	if (!empty($purchasePrice) && !empty($discount)) {
		$emptyStyle=  "style='display:none;'";
  try {
		$connection = new PDO($dsn, $username, $password, $options);
		
		$sql = sprintf(
				"SELECT cid
				FROM customer
				WHERE telephone_no = :telephone_no");
		$statement = $connection->prepare($sql);
		$statement->bindParam(':telephone_no', $mobileno, PDO::PARAM_STR);
        $statement->execute();
        $result = $statement->fetchAll();
        $new_user = array(
                "transaction_date" => $transactionDate,
                "total_price"     => $totalPrice,
                "purchase_price"       => $purchasePrice,
                "discount" => $discount,
                "cid"  => $result[0][0]
            );
    if( $statement->rowCount() != 0){
		$style = "style='display:none;'";
		$sql1 = sprintf(
				"INSERT INTO %s (%s) values (%s)",
				"transaction",
				implode(", ", array_keys($new_user)),
				":" . implode(", :", array_keys($new_user))
		);

		$statement = $connection->prepare($sql1);
		$statement->execute($new_user);
		$connection = null;
		if ($statement->rowCount() > 0) {
            header('Location: index.php');
			 exit();
		}
	}
	else{
		$style = "style='display:block;'";
	}
	} catch(PDOException $error) {
	       echo $error->getMessage();
				 die();
	}
}
else{
$emptyStyle=  "style='display:block;'";
}
}
?>
<?php $GLOBALS['state'] = 0; include "templates/header.php";?>
<div id="error" <?php echo $style;?>>Customer doesn't exist!</div>
<div id="error" <?php echo $emptyStyle;?>>No field can be left empty!</div>

<div class="signup-wrap"  style="height: 100%">
	<div class="login-html" style="overflow:auto">
    <input id="tab-2" type="radio" name="tab" class="sign-up" checked><label for="tab-2" class="tab">Add Transaction</label>
<div class="login-form">
    <div class="sign-up-htm">
        <form name="transactionForm" method="post">
            <div class="group">
                <label for="transactionDate" class="label">Transaction Date:</label>
                <input id="transactionDate" name="transactionDate" type="text" value="<?php echo date('d/m/y'); ?>" readonly="" class="input"/>
            </div>  
            <div class="group">
                <input type="button" name="addInput" class="button" onclick="addInputElement()" value="ADD ITEM">
            </div> 
            <div class="group row">
                <span onclick="removeItem(this)" style="position: absolute;right: 0;color: beige;border: 1px solid;z-index: 1111;cursor: pointer;">X</span>
                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                <label for="itemId" class="label">Item Id:</label>
                <input id="itemId" name="itemId" type="number" class="input"/>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                <label for="item" class="label">Item Price:</label>
                <input id="itemPrice" name="itemPrice" type="number" min="1" step="any" onchange="calculatePrice()" class="input itemPrice"/>
                </div>
            </div>
            <input id="purchasePrice" name="purchasePrice" style="visibility:hidden" type="number" class="input"> 
            <div class="group" id="discount">
                <label for="discountPrice" class="label">Discount:</label>
                <input id="discountPrice" name="discountPrice" type="number" onchange="calculatePrice()" class="input"> 
            </div>
            <div class="group">
                <label for="totalPrice" class="label">Total Price:</label>
                <input id="totalPrice" name="totalPrice" type="text"  readonly="" class="input"/>
            </div>

            <div class="group">
                <input type="submit" name="addTransaction" class="button" value="ADD TRANSACTION">
            </div>
        </form>
    </div>
</div>   
</div>
</div>

<script type="text/javascript">   
 function addInputElement(){
     var el = document.getElementById("discount");
     el.insertAdjacentHTML('beforebegin', `<div class="group row">
                <span onclick="removeItem(this)" style="position: absolute;right: 0;color: beige;border: 1px solid;z-index: 1111;cursor: pointer;">X</span>
                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                <label for="itemId" class="label">Item Id:</label>
                <input id="itemId" name="itemId" type="number" class="input"/>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                <label for="item" class="label">Item Price:</label>
                <input id="itemPrice" name="itemPrice" type="number" min="1" step="any" onchange="calculatePrice()" class="input itemPrice"/>
                </div>
            </div>`);

} 

function removeItem(el){
    var parent = $(el).parent();
    $(el).parent().empty();
    parent.remove();
    calculatePrice();
}
    function calculatePrice() {
        var els =  document.getElementsByClassName('itemPrice');
        //console.log(purchasePrice);
        var purchasePrice = 0;
        for (let el of els){
            if(el.value){
            purchasePrice+=parseFloat(el.value);
        }
            }
        var discount = document.getElementById('discountPrice').value?document.getElementById('discountPrice').value:0;
        var totalPrice = 0;
        totalPrice = purchasePrice - purchasePrice * (parseFloat(discount) / 100);
        document.getElementById('totalPrice').value = totalPrice;
        document.getElementById('purchasePrice').value = purchasePrice;
    }
</script>
</body>

</html>

<?php include "templates/footer.php"; ?>
