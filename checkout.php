<?php include 'configuration.php';

$subTotal = 0;
$cart_table = $admin->ret("SELECT * FROM `cart` WHERE `u_id`='$u_id'");
while ($cart_row = $cart_table->fetch(PDO::FETCH_ASSOC)) {
    $p_id = $cart_row['p_id'];
    $product_table = $admin->ret("SELECT * FROM `product` WHERE `p_id`='$p_id'");
    $product_row = $product_table->fetch(PDO::FETCH_ASSOC);
    $subTotal += $product_row['p_price'] * $cart_row['ca_quantity'];
}

if ($subTotal <= 0) {
    header("Location: cart.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <?php include 'head.php'; ?>
</head>

<body>
    <?php include 'topbar.php'; ?>

    <!-- Navbar Start -->
    <div class="container-fluid">
        <div class="row border-top px-xl-5">

            <?php include 'navbar.php'; ?>
        </div>
    </div>
    <!-- Navbar End -->

    <!-- Checkout Start -->
    <div class="container-fluid pt-5">
        <form method="post" action="controller/add.php" class="row px-xl-5">
            <div class="col-lg-8">
                <div class="mb-4">
                    <h4 class="font-weight-semi-bold mb-4">Billing</h4>
                    <div class="row">
                        <div class="col-md-6 form-group">
                            <label>Mobile No</label>
                            <input type="number" name="number" id="address" class="form-control"
                                placeholder="Enter phone number" min="1000000000" max="9999999999" required>
                        </div>
                        <div class="col-md-12 form-group">
                            <label>Address</label>
                            <input type="text" name="address" id="address" class="form-control"
                                placeholder="Enter Your Address" required>
                        </div>
                        <div class="col-md-12">
                            <img src="images/googleqr.png" alt="QR" style="width: 200px; height: 200px">
                        </div>
                        <div class="col-md-12 form-group">
                            <label>Transaction id</label>
                            <input type="number" name="transaction" id="" class="form-control"
                                placeholder="Enter Transaction Id Here" min="10000000000000" max="99999999999999"
                                required>
                        </div>




                    </div>
                </div>

            </div>
            <div class="col-lg-4">
                <div class="card border-secondary mb-5">
                    <div class="card-header bg-secondary border-0">
                        <h4 class="font-weight-semi-bold m-0">Order Total</h4>
                    </div>
                    <div class="card-body">
                        <h5 class="font-weight-medium mb-3">Products</h5>
                        <?php
                        $subTotal = 0;
                        $cart_table = $admin->ret("SELECT * FROM `cart` WHERE `u_id`='$u_id'");
                        while ($cart_row = $cart_table->fetch(PDO::FETCH_ASSOC)) {
                            $p_id = $cart_row['p_id'];
                            $product_table = $admin->ret("SELECT * FROM `product` WHERE `p_id`='$p_id'");
                            $product_row = $product_table->fetch(PDO::FETCH_ASSOC);
                            $subTotal = $subTotal + $product_row['p_price'] * $cart_row['ca_quantity'];
                        ?>
                        <div class="d-flex justify-content-between">
                            <div class="d-flex">

                                <p style="margin-right: 8px;"><?php echo $cart_row['ca_quantity']; ?> x</p>
                                <p><?php echo $product_row['p_name']; ?></p>
                            </div>
                            <p>₹ <?php echo $product_row['p_price'] ?></p>
                        </div>
                        <?php } ?>
                        <hr class="mt-0">
                        <div class="d-flex justify-content-between mb-3 pt-1">
                            <h6 class="font-weight-medium">Subtotal</h6>
                            <h6 class="font-weight-medium">₹ <?php echo $subTotal; ?></h6>
                        </div>
                        <div class="d-flex justify-content-between">
                            <h6 class="font-weight-medium">Shipping</h6>
                            <h6 class="font-weight-medium">₹ 40</h6>
                        </div>
                    </div>
                    <div class="card-footer border-secondary bg-transparent">
                        <div class="d-flex justify-content-between mt-2">
                            <h5 class="font-weight-bold">Total</h5>
                            <h5 class="font-weight-bold">₹ <?php echo $subTotal + 40; ?></h5>
                        </div>
                    </div>
                </div>
                <div class="card-footer border-secondary bg-transparent">
                    <button name="checkout" type="submit"
                        class="btn btn-lg btn-block btn-primary font-weight-bold my-3 py-3">Place
                        Order</button>
                </div>

            </div>
        </form>
    </div>
    <!-- Checkout End -->
    </div>
    </div>
    <!-- Shop End -->

    <?php include 'footer.php'; ?>
    <?php include 'script.php'; ?>


</body>

</html>