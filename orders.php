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

    <div class="container-fluid pt-5" style="background-color: #f8f9fa; font-family: 'Arial', sans-serif;">
        <div class="row px-xl-5">
            <div class="col-lg-12">
                <?php
                $orders_table = $admin->ret("SELECT * FROM `orders` WHERE `u_id`='$u_id' ORDER BY `o_id` DESC");
                while ($orders_row = $orders_table->fetch(PDO::FETCH_ASSOC)) {
                    $o_id = $orders_row['o_id'];
                    $status = $orders_row['o_status'];
                ?>
                <div class="card shadow-lg border-0 mb-4 rounded-3" style="border-radius: 15px;">
                    <div class="card-header"
                        style="background-color: #ffffff; border-bottom: 2px solid #e0e0e0; padding: 1.5rem;">
                        <h3 class="text-center mb-0">
                            <span class="badge <?php echo getStatusBadgeClass($status); ?>"
                                style="font-size: 1.1rem; padding: 0.5rem 1rem;">
                                <?php echo getStatusText($status); ?>
                            </span>
                        </h3>
                    </div>

                    <div class="card-body" style="padding: 1.5rem;">
                        <div class="row customer-info mb-4"
                            style="border-bottom: 1px solid #e0e0e0; padding-bottom: 1rem;">
                            <?php echo renderCustomerInfo($orders_row, $username); ?>
                        </div>

                        <div class="table-responsive">
                            <table class="table table-hover border" style="border-radius: 10px; overflow: hidden;">
                                <thead class="table-light">
                                    <tr>
                                        <th scope="col" class="fw-bold">Product</th>
                                        <th scope="col" class="fw-bold text-center">Quantity</th>
                                        <th scope="col" class="fw-bold text-end">Price</th>
                                        <th scope="col" class="fw-bold text-end">Subtotal</th>
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
                                            $total += $subtotal;
                                        ?>
                                    <tr style="transition: background-color 0.3s;">
                                        <td class="align-middle">
                                            <div class="d-flex align-items-center">
                                                <div class="ms-2">
                                                    <h6 class="mb-0 fw-semibold"><?php echo $product_row['p_name']; ?>
                                                    </h6>
                                                    <?php if (isset($product_row['p_category'])) { ?>
                                                    <small
                                                        class="text-muted"><?php echo $product_row['p_category']; ?></small>
                                                    <?php } ?>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="text-center align-middle">
                                            <span class="badge bg-light text-dark px-3 py-2"
                                                style="padding: 0.5rem 1rem;"><?php echo $oproduct_row['p_quantity']; ?></span>
                                        </td>
                                        <td class="text-end align-middle">
                                            ₹<?php echo number_format($product_row['p_price'], 2); ?></td>
                                        <td class="text-end align-middle">₹<?php echo number_format($subtotal, 2); ?>
                                        </td>
                                    </tr>
                                    <?php } ?>
                                </tbody>
                                <tfoot class="table-light">
                                    <tr>
                                        <td colspan="3" class="text-end fw-bold">Total Amount</td>
                                        <td class="text-end fw-bold text-primary">
                                            ₹<?php echo number_format($total, 2); ?></td>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                </div>
                <?php } ?>
            </div>
        </div>
    </div>

    <?php
    function getStatusBadgeClass($status)
    {
        switch ($status) {
            case 'ordered':
                return 'bg-warning text-dark';
            case 'accepted':
                return 'bg-info text-white';
            case 'delivery':
                return 'bg-primary text-white';
            case 'delivered':
                return 'bg-success text-white';
            default:
                return 'bg-secondary text-white';
        }
    }

    function getStatusText($status)
    {
        switch ($status) {
            case 'ordered':
                return 'Order Placed';
            case 'accepted':
                return 'Order Accepted';
            case 'delivery':
                return 'Out for Delivery';
            case 'delivered':
                return 'Order Delivered';
            default:
                return 'Unknown Status';
        }
    }

    function renderCustomerInfo($orders_row, $username)
    {
        return '
        <div class="col-md-3 mb-2">
            <div class="d-flex align-items-center">
                <i class="fa fa-user-circle" style="color: #007bff; font-size: 1.5rem; margin-right: 0.5rem;"></i>
                <div>
                    <small class="text-muted d-block">Customer Name</small>
                    <span class="fw-bold">' . htmlspecialchars($username) . '</span>
                </div>
            </div>
        </div>
        <div class="col-md-3 mb-2">
            <div class="d-flex align-items-center">
                <i class="fa fa-map-marker" style="color: #dc3545; font-size: 1.5rem; margin-right: 0.5rem;"></i>
                <div>
                    <small class="text-muted d-block">Delivery Address</small>
                    <span class="fw-bold">' . htmlspecialchars($orders_row['o_address']) . '</span>
                </div>
            </div>
        </div>
        <div class="col-md-3 mb-2">
            <div class="d-flex align-items-center">
                <i class="fa fa-phone" style="color: #28a745; font-size: 1.5rem; margin-right: 0.5rem;"></i>
                <div>
                    <small class="text-muted d-block">Contact Number</small>
                    <span class="fw-bold">' . htmlspecialchars($orders_row['o_number']) . '</span>
                </div>
            </div>
        </div>
        <div class="col-md-3 mb-2">
            <div class="d-flex align-items-center">
                <i class="fa fa-credit-card" style="color: #17a2b8; font-size: 1.5rem; margin-right: 0.5rem;"></i>
                <div>
                    <small class="text-muted d-block">Transaction ID</small>
                    <span class="fw-bold">' . htmlspecialchars($orders_row['o_transaction_id']) . '</span>
                </div>
            </div>
        </div>
    ';
    }
    ?>

    <?php include 'footer.php'; ?>

    <?php include 'script.php'; ?>


</body>

</html>