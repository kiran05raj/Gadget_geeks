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
    <div class="container-fluid pt-5">
        <div class="row px-xl-5">
            <div class="col-12 mb-4">
                <h2 class="position-relative text-uppercase mx-xl-5 mb-4">
                    <span class="bg-light pr-3">Your Feedback</span>
                </h2>
            </div>

            <?php
            $orders_table = $admin->ret("SELECT orders.* FROM `orders` LEFT JOIN `feedback` ON orders.`o_id` = feedback.`o_id` WHERE orders.`u_id` = '$u_id' AND orders.`o_status` = 'delivered';");

            if ($orders_table->rowCount() == 0) { ?>
                <div class="col-12 text-center py-5">
                    <div class="alert alert-info" role="alert">
                        <h4>No delivered orders found</h4>
                        <p class="mb-0">Orders will appear here once they're delivered.</p>
                    </div>
                </div>
            <?php }

            while ($orders_row = $orders_table->fetch(PDO::FETCH_ASSOC)) {
                $o_id = $orders_row['o_id'];
                $status = $orders_row['o_status'];
            ?>
                <div class="col-lg-12 mb-4">
                    <div class="card shadow-sm border-0">
                        <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
                            <h5 class="mb-0">Order #<?php echo $o_id; ?></h5>
                            <span class="badge bg-light text-dark">Delivered</span>
                        </div>

                        <div class="card-body">
                            <!-- Customer Information Cards -->
                            <div class="row mb-4">
                                <div class="col-md-3 mb-3">
                                    <div class="card h-100 border-left-primary">
                                        <div class="card-body py-2">
                                            <div class="row no-gutters align-items-center">
                                                <div class="col mr-2">
                                                    <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                                        Customer</div>
                                                    <div class="h5 mb-0 font-weight-bold text-gray-800">
                                                        <?php echo $username; ?></div>
                                                </div>
                                                <div class="col-auto">
                                                    <i class="fas fa-user fa-2x text-gray-300"></i>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-3 mb-3">
                                    <div class="card h-100 border-left-success">
                                        <div class="card-body py-2">
                                            <div class="row no-gutters align-items-center">
                                                <div class="col mr-2">
                                                    <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                                        Address</div>
                                                    <div class="small mb-0 font-weight-bold text-gray-800">
                                                        <?php echo $orders_row['o_address']; ?></div>
                                                </div>
                                                <div class="col-auto">
                                                    <i class="fas fa-home fa-2x text-gray-300"></i>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-3 mb-3">
                                    <div class="card h-100 border-left-info">
                                        <div class="card-body py-2">
                                            <div class="row no-gutters align-items-center">
                                                <div class="col mr-2">
                                                    <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                                                        Phone</div>
                                                    <div class="h5 mb-0 font-weight-bold text-gray-800">
                                                        <?php echo $orders_row['o_number']; ?></div>
                                                </div>
                                                <div class="col-auto">
                                                    <i class="fas fa-phone fa-2x text-gray-300"></i>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-3 mb-3">
                                    <div class="card h-100 border-left-warning">
                                        <div class="card-body py-2">
                                            <div class="row no-gutters align-items-center">
                                                <div class="col mr-2">
                                                    <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                                        Transaction ID</div>
                                                    <div class="h5 mb-0 font-weight-bold text-gray-800">
                                                        <?php echo $orders_row['o_transaction_id']; ?></div>
                                                </div>
                                                <div class="col-auto">
                                                    <i class="fas fa-credit-card fa-2x text-gray-300"></i>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Order Details Table -->
                            <div class="table-responsive mb-4">
                                <table class="table table-bordered table-hover">
                                    <thead class="thead-light">
                                        <tr>
                                            <th>Product</th>
                                            <th class="text-center" width="120">Quantity</th>
                                            <th class="text-right" width="150">Price</th>
                                            <th class="text-right" width="150">Subtotal</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $oproduct_table = $admin->ret("SELECT * FROM `ordered_products` WHERE `o_id`='$o_id'");
                                        $total = 0;
                                        while ($oproduct_row = $oproduct_table->fetch(PDO::FETCH_ASSOC)) {
                                            $p_id = $oproduct_row['p_id'];
                                            $product_table = $admin->ret("SELECT * FROM `product` WHERE `p_id`='$p_id'");
                                            $product_row = $product_table->fetch(PDO::FETCH_ASSOC);
                                            $product_price = $product_row['p_price'];
                                            $oproduct_quantity = $oproduct_row['p_quantity'];
                                            $subtotal = $product_price * $oproduct_quantity;
                                            $total = $total + $subtotal;
                                        ?>
                                            <tr>
                                                <td class="align-middle"><?php echo $product_row['p_name']; ?></td>
                                                <td class="align-middle text-center"><?php echo $oproduct_row['p_quantity']; ?>
                                                </td>
                                                <td class="align-middle text-right">
                                                    ₹<?php echo number_format($product_price, 2); ?></td>
                                                <td class="align-middle text-right">₹<?php echo number_format($subtotal, 2); ?>
                                                </td>
                                            </tr>
                                        <?php } ?>
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <td colspan="3" class="text-right font-weight-bold">Total:</td>
                                            <td class="text-right text-primary font-weight-bold">
                                                ₹<?php echo number_format($total, 2); ?></td>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>

                            <!-- Feedback Section -->
                            <div class="card mb-0">
                                <div class="card-header bg-light">
                                    <h5 class="mb-0">Your Feedback</h5>
                                </div>
                                <div class="card-body">
                                    <?php
                                    $feedback_table = $admin->ret("SELECT * FROM `feedback` WHERE `o_id`='$o_id'");
                                    $feedback_row = $feedback_table->fetch(PDO::FETCH_ASSOC);
                                    $feedback_count = $feedback_table->rowCount();

                                    if ($feedback_count > 0) {
                                    ?>
                                        <div class="alert alert-success mb-0">
                                            <i class="fas fa-check-circle mr-2"></i>
                                            <strong>Thank you for your feedback:</strong>
                                            <p class="mt-2 mb-0">"<?php echo $feedback_row['f_feedback']; ?>"</p>
                                        </div>
                                    <?php } else { ?>
                                        <form method="post" action="controller/add.php">
                                            <input type="hidden" value="<?php echo $o_id; ?>" name="o_id">
                                            <div class="form-group">
                                                <label for="feedback_<?php echo $o_id; ?>">
                                                    <i class="fas fa-comment mr-1"></i> Please share your experience with this
                                                    order
                                                </label>
                                                <textarea id="feedback_<?php echo $o_id; ?>" class="form-control"
                                                    placeholder="We'd love to hear your thoughts..." name="feedback_text"
                                                    rows="3" required></textarea>
                                            </div>
                                            <div class="text-right">
                                                <button type="submit" name="feedback" class="btn btn-primary">
                                                    <i class="fas fa-paper-plane mr-1"></i> Submit Feedback
                                                </button>
                                            </div>
                                        </form>
                                    <?php } ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            <?php } ?>
        </div>
    </div>
    <!-- Cart End -->

    <?php include 'footer.php'; ?>

    <?php include 'script.php'; ?>


</body>

</html>