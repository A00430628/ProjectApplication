<?php include "templates/header.php"; session_start();?>

<div class="login-form">
    <div class="sign-up-htm">
        <form method="post">
            <div class="group">
                <label for="lname" class="label">Last Name:</label>
                <input id="lname" name="lname" type="text" >
            </div>   
            <div class="group">
                <label for="fname" class="label">First Name:</label>
                <input id="fname" name="fname" type="text" >
            </div>
            <div class="group">
                <label for="mobileno" class="label">Mobile No.:</label>
                <input id="mobileno" name="mobileno" type="number">
            </div>
            <div class="group">
                <label for="mailingAddress" class="label">Mailing Address:</label>
                <input id="mailingAddress" name="mailingAddress" type="text" >
            </div>
            <div class="group">
                <label for="discountCode" class="label">Discount Code:</label>
                <input id="discountCode" name="discountCode" type="text" >
            </div>
            
            <div class="group">
                <input type="submit" name="addCustomer"  value="ADD CUSTOMER">
            </div>
        </form>
    </div>
</div>   
</body>

</html>
<?php
if (isset($_POST['addCustomer'])) {
    require 'config.php';

    $lname = $_POST['lname'];
    $fname = $_POST['fname'];
    $mobileno = $_POST['mobileno'];
    $mailingAddress = $_POST['mailingAddress'];
    $discountCode = $_POST['discountCode'];

    if (empty($lname) || empty($fname) || empty($mobileno) || empty($mailingAddress) || empty($discountCode)) {
        echo 'Please enter all the details';
        header("Location: addCustomer.php");
        echo 'Please enter all the details';
        exit();
    } else {
        $query = "INSERT INTO customer(lname,fname,telephone_no,mailing_address,discount_code) VALUES('$lname','$fname','$mobileno','$mailingAddress','$discountCode')";
        //$result = mysqli_query($conn, $sql) or die(mysqli_error($conn));
        if (mysqli_query($conn, $query)) {
            echo 'Record Inserted';
            $_SESSION["mobileno"]=$mobileno;
            header("Location:addTransaction.php");
        } else {
            echo 'Error: ' . $query . '<br>' . mysqli_error($conn);
        }
    }
}
?>

<?php include "templates/footer.php"; ?>
