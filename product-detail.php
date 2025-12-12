<?php include 'configuration.php';
$p_id = $_GET['p_id'];
$product_table = $admin->ret("SELECT * FROM `product` WHERE `p_id`='$p_id'");
$product_row = $product_table->fetch(PDO::FETCH_ASSOC);
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

    <!-- Shop Detail Start -->
    <div class="container-fluid py-5">
        <div class="row px-xl-5">
            <div class="col-lg-5 pb-5">
                <div id="product-carousel" class="carousel slide" data-ride="carousel">
                    <div class="carousel-inner border">
                        <div class="carousel-item active">
                            <img class="w-100 h-100" src="admin/controller/<?php echo $product_row['p_photo'] ?>"
                                alt="Image" />
                        </div>
                        <div class="carousel-item">
                            <img class="w-100 h-100" src="admin/controller/<?php echo $product_row['p_photo'] ?>"
                                alt="Image" />
                        </div>
                        <div class="carousel-item">
                            <img class="w-100 h-100" src="admin/controller/<?php echo $product_row['p_photo'] ?>"
                                alt="Image" />
                        </div>
                        <div class="carousel-item">
                            <img class="w-100 h-100" src="admin/controller/<?php echo $product_row['p_photo'] ?>"
                                alt="Image" />
                        </div>
                    </div>
                    <a class="carousel-control-prev" href="#product-carousel" data-slide="prev">
                        <i class="fa fa-2x fa-angle-left text-dark"></i>
                    </a>
                    <a class="carousel-control-next" href="#product-carousel" data-slide="next">
                        <i class="fa fa-2x fa-angle-right text-dark"></i>
                    </a>
                </div>
            </div>

            <div class="col-lg-7 pb-5">
                <h3 class="font-weight-semi-bold"><?php echo $product_row['p_name'] ?></h3>

                <h3 class="font-weight-semi-bold mb-4">₹ <?php echo $product_row['p_price'] ?></h3>
                <p class="mb-4"><?php echo $product_row['p_description'] ?></p>

                <div class="d-flex align-items-center mb-4 pt-2">
                    <a href="controller/add.php?p_id=<?php echo $product_row['p_id'] ?>" class="btn btn-primary px-3">
                        <i class="fa fa-shopping-cart mr-1"></i> Add To Cart
                    </a>
                </div>
            </div>
        </div>
    </div>

    <?php include 'footer.php'; ?>
    <?php include 'script.php'; ?>


</body>

</html>