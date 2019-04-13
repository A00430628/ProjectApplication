<?php $GLOBALS['state'] = 0;include "templates/header.php"; ?>

<div class="login-form">
    <div class="sign-up-htm">
        <form method="post">
            <div class="group">
                <label for="transactionDate" class="label">Transaction Date:</label>
                <input id="transactionDate" name="transactionDate" type="text" value="<?php echo date('d/m/y'); ?>" readonly=""/>
            </div>   
            <div class="group">
                <label for="purchasePrice" class="label">Purchase Price:</label>
                <input id="purchasePrice" name="purchasePrice" type="number" min="1" step="any" onchange="calculatePrice()"/>
            </div>
            <div class="group">
                <label for="discount" class="label">Discount:</label>
                <input id="discount" name="discount" type="number" onchange="calculatePrice()">
            </div>
            <div class="group">
                <label for="totalPrice" class="label">Total Price:</label>
                <input id="totalPrice" name="totalPrice" type="text"  readonly=""/>
            </div>

            <div class="group">
                <input type="submit" name="addTransaction"  value="ADD TRANSACTION">
            </div>
        </form>
    </div>
</div>   


<script type="text/javascript">    
    function calculatePrice() {
        var purchasePrice = document.getElementById('purchasePrice').value;
        //console.log(purchasePrice);
        var discount = document.getElementById('discount').value;
        var totalPrice = 0;
        totalPrice = purchasePrice - purchasePrice * (discount / 100);
        document.getElementById('totalPrice').value = totalPrice;
    }
</script>
</body>

</html>
<?php
if (isset($_POST['addTransaction'])) {
    try{
    require 'config.php';
    $GLOBALS['state'] = 1;
    $connection = new PDO($dsn, $username, $password, $options);
    
    $transactionDate = $_POST['transactionDate'];
    $purchasePrice = $_POST['purchasePrice'];
    $discount = $_POST['discount'];
    $totalPrice = $_POST['totalPrice'];
    $mobileno = $_Session["mobileno"];
    
    $sql = "Select cid from customer where cid = '$mobileno'";
    $statement = $connection->prepare($sql);
    $statement->execute();
    $result = $statement->fetchAll();
    $connection = null;
    }
    catch(PDOException $error) {
		echo $error->getMessage();
	}

//    if (empty($purchasePrice) || empty($discount)) {
//        //echo 'Please enter all the details';
//        header("Location: addTransaction.php");
//        echo 'Please enter all the details';
//        exit();
//    } else {
        
        
        //$cid = mysqli_query($conn, $sql) or die(mysqli_error($conn));
        //$query = "INSERT INTO transaction(transaction_date,total_price,purchase_price,discount,cid) VALUES('$transactionDate','$totalPrice','$purchasePrice','$discount','$cid')"; 
        //$result = mysqli_query($conn, $sql) or die(mysqli_error($conn));
        //if (mysqli_query($conn, $query)) {
        //    echo 'Record Inserted';
        //    header("Location:index.php");
        //} else {
        //    echo 'Error: ' . $query . '<br>' . mysqli_error($conn);
        //}
    //}
}
?>

<?php include "templates/footer.php"; ?>
