<?php include 'header.php'; ?>
<div class="bank">
    <form class="carddetails" action="paypal.php" method="post">
        <input type="text" name="cardnumber" placeholder="Card Number (16)" pattern="[0-9]{16}" required class="form-control" maxlength="16">
        <input type="text" name="date" placeholder="Exp Date 00/0000" pattern="[0-9/]{7}" required class="form-control">
        <input type="text" name="holder" placeholder="Cardholder Name" pattern="[A-Za-z ]+" title="use english letters" required class="form-control">
        <input type="text" name="cvv" placeholder="CVV/CVC (3)" pattern="[0-9]{3}" required class="form-control" maxlength="3">
        <input type="submit" value="Pay" class="submit_button btn btn-primary w-100 py-2"> 
    </form> 
</div>
<?php include 'footer.php'; ?>
