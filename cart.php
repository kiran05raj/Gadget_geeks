<?php include 'configuration.php'; ?>
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

    <!-- Cart Start -->
    <div class="container-fluid pt-5" id="cartSection">
        <div class="row px-xl-5">
            <div class="col-lg-8 table-responsive mb-5">
                <table class="table table-bordered text-center mb-0">
                    <thead class="bg-secondary text-dark">
                        <tr>
                            <th>Products</th>
                            <th>Price</th>
                            <th>Quantity</th>
                            <th>Total</th>
                            <th>Remove</th>
                        </tr>
                    </thead>
                    <tbody class="align-middle">
                        <?php
                        $subTotal = 0;
                        $cart_table = $admin->ret("SELECT * FROM `cart` WHERE `u_id`='$u_id'");
                        while ($cart_row = $cart_table->fetch(PDO::FETCH_ASSOC)) {
                            $p_id = $cart_row['p_id'];
                            $product_table = $admin->ret("SELECT * FROM `product` WHERE `p_id`='$p_id'");
                            $product_row = $product_table->fetch(PDO::FETCH_ASSOC);
                            $subTotal = $subTotal + $product_row['p_price'] * $cart_row['ca_quantity'];
                        ?>

                            <tr>
                                <td class="align-middle"><img src="img/product-1.jpg" alt=""
                                        style="width: 50px;"><?php echo $product_row['p_name']; ?></td>
                                <td class="align-middle">₹ <?php echo $product_row['p_price'] ?></td>
                                <td class="align-middle">
                                    <div class="input-group quantity mx-auto" style="width: 100px;">
                                        <div class="input-group-btn">
                                            <button onclick="decrement(<?php echo $cart_row['ca_id'] ?>)"
                                                class="btn btn-sm btn-primary btn-minus">
                                                <i class="fa fa-minus"></i>
                                            </button>
                                        </div>
                                        <input type="text" class="form-control form-control-sm bg-secondary text-center"
                                            value="<?php echo $cart_row['ca_quantity']; ?>">
                                        <div class="input-group-btn">
                                            <button onclick="increment(<?php echo $cart_row['ca_id'] ?>)"
                                                class="btn btn-sm btn-primary btn-plus">
                                                <i class="fa fa-plus"></i>
                                            </button>
                                        </div>
                                    </div>
                                </td>
                                <td class="align-middle">₹ <?php echo $product_row['p_price'] * $cart_row['ca_quantity']; ?>
                                </td>
                                <td class="align-middle"><a
                                        href="controller/delete.php?ca_id=<?php echo $cart_row['ca_id']; ?>"
                                        class="btn btn-sm btn-primary"><i class="fa fa-times"></i></a>
                                </td>
                            </tr>

                        <?php } ?>
                    </tbody>
                </table>
            </div>
            <div class="col-lg-4">

                <div class="card border-secondary mb-5">
                    <div class="card-header bg-secondary border-0">
                        <h4 class="font-weight-semi-bold m-0">Cart Summary</h4>
                    </div>
                    <div class="card-body">
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
                        <?php if ($subTotal > 0) { ?>
                            <a href="checkout.php" class="btn btn-block btn-primary my-3 py-3">Proceed To Checkout</a>
                        <?php } else { ?>
                            <button class="btn btn-block btn-secondary my-3 py-3" disabled>Cart is Empty</button>
                        <?php } ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Cart End -->

    <?php include 'footer.php'; ?>
    <script>
        function increment(cartId) {

            var xmlhttp = new XMLHttpRequest();
            xmlhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                    document.getElementById("cartSection").innerHTML = this.responseText;
                }
            };
            xmlhttp.open("GET", "./controller/update-cart.php?cart_id=" + cartId + '&action=increment', true);
            xmlhttp.send();
        }

        function decrement(cartId) {

            var xmlhttp = new XMLHttpRequest();
            xmlhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                    document.getElementById("cartSection").innerHTML = this.responseText;

                }
            };
            xmlhttp.open("GET", "./controller/update-cart.php?cart_id=" + cartId + '&action=decrement', true);
            xmlhttp.send();
        }
    </script>
    <?php include 'script.php'; ?>


</body>

</html>