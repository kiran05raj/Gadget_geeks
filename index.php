<?php include 'config.php';
$admin = new Admin(); ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <?php include 'head.php'; ?>
</head>

<body>
    <div class="container-fluid">
        <div class="row align-items-center py-3 px-xl-5">
            <div class="col-lg-9 d-none d-lg-block">
                <a href="" class="text-decoration-none">
                    <h1 class="m-0 display-5 font-weight-semi-bold">
                        <span class="text-primary font-weight-bold border px-3 mr-1">Gadget Geek</span>
                    </h1>
                </a>
            </div>

            <div class="col-lg-3 col-6 text-right">
                <a href="cart.php" class="btn border">
                    <i class="fas fa-shopping-cart text-primary"></i>
                    <span class="badge">0</span>
                </a>
            </div>
        </div>
    </div>

    <!-- Navbar Start -->
    <div class="container-fluid mb-5">
        <div class="row border-top px-xl-5">

            <div class="col-lg-12">
                <nav class="navbar navbar-expand-lg bg-light navbar-light py-3 py-lg-0 px-0">
                    <a href="" class="text-decoration-none d-block d-lg-none">
                        <h1 class="m-0 display-5 font-weight-semi-bold">
                            <span class="text-primary font-weight-bold border px-3 mr-1">Gadget Geek</span>
                        </h1>
                    </a>
                    <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#navbarCollapse">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse justify-content-between" id="navbarCollapse">
                        <div class="navbar-nav mr-auto py-0">
                            <a href="index.php" class="nav-item nav-link active">Home</a>
                            <a href="shop.php" class="nav-item nav-link">Shop</a>
                            <a href="orders.php" class="nav-item nav-link">Orders</a>
                            <a href="feedback.php" class="nav-item nav-link">Feedback</a>

                        </div>
                        <div class="navbar-nav ml-auto py-0">
                            <!-- <a href="controller/auth.php?logout=logout" class="nav-item nav-link">Logout</a> -->
                        </div>
                    </div>
                </nav>
                <div id="header-carousel" class="carousel slide" data-ride="carousel">
                    <div class="carousel-inner">
                        <div class="carousel-item active" style="height: 410px">
                            <img class="img-fluid" src="user/img/gadget-geek1.jpg" alt="Image" />
                            <div class="carousel-caption d-flex flex-column align-items-center justify-content-center">
                                <div class="p-3" style="max-width: 700px">
                                    <!-- <h4 class="text-light text-uppercase font-weight-medium mb-3">
                                        10% Off Your First Order
                                    </h4> -->
                                    <h3 class="display-4 text-white font-weight-semi-bold mb-4">
                                        Great Products
                                    </h3>
                                    <a href="shop.php" class="btn btn-light py-2 px-3">Shop Now</a>
                                </div>
                            </div>
                        </div>
                        <div class="carousel-item" style="height: 410px">
                            <img class="img-fluid" src="user/img/gadget-geek2.jpg" alt="Image" />
                            <div class="carousel-caption d-flex flex-column align-items-center justify-content-center">
                                <div class="p-3" style="max-width: 700px">
                                    <!-- <h4 class="text-light text-uppercase font-weight-medium mb-3">
                                        10% Off Your First Order
                                    </h4> -->
                                    <h3 class="display-4 text-white font-weight-semi-bold mb-4">
                                        Reasonable Price
                                    </h3>
                                    <a href="shop.php" class="btn btn-light py-2 px-3">Shop Now</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <a class="carousel-control-prev" href="#header-carousel" data-slide="prev">
                        <div class="btn btn-dark" style="width: 45px; height: 45px">
                            <span class="carousel-control-prev-icon mb-n2"></span>
                        </div>
                    </a>
                    <a class="carousel-control-next" href="#header-carousel" data-slide="next">
                        <div class="btn btn-dark" style="width: 45px; height: 45px">
                            <span class="carousel-control-next-icon mb-n2"></span>
                        </div>
                    </a>
                </div>
            </div>

            <!-- Shop Product Start -->
            <div class="col-lg-12 col-md-12" style="margin-top: 150px;">
                <div class="row pb-3">

                    <?php

                    $product_table = $admin->ret("SELECT * FROM `product`");
                    $index = 1;
                    while ($product_row = $product_table->fetch(PDO::FETCH_ASSOC)) { ?>
                        <div class="col-lg-3 col-md-6 col-sm-12 pb-1">
                            <div class="card product-item border-0 mb-4">
                                <a href="product-detail.php?p_id=<?php echo $product_row['p_id']; ?>"
                                    class="card-header product-img position-relative overflow-hidden bg-transparent border p-0">
                                    <img class="img-fluid" style="height: 304px;"
                                        src="admin/controller/<?php echo $product_row['p_photo']; ?>" alt="" />
                                </a>
                                <div class="card-body border-left border-right text-center p-0 pt-4 pb-3">
                                    <h6 class="text-truncate mb-3"><?php echo $product_row['p_name'] ?></h6>
                                    <div class="d-flex justify-content-center">
                                        <h6>₹ <?php echo $product_row['p_price'] ?></h6>
                                        <h6 class="text-muted ml-2"><del>₹ <?php echo $product_row['p_price'] * 1.2 ?></del>
                                        </h6>
                                    </div>
                                </div>
                                <div class="card-footer d-flex justify-content-between bg-light border">
                                    <a href="product-detail.php?p_id=<?php echo $product_row['p_id']; ?>"
                                        class="btn btn-sm text-dark p-0"><i class="fas fa-eye text-primary mr-1"></i>View
                                        Detail</a>
                                    <a href="controller/add.php?p_id=<?php echo $product_row['p_id'] ?>"
                                        class="btn btn-sm text-dark p-0"><i
                                            class="fas fa-shopping-cart text-primary mr-1"></i>Add
                                        To Cart</a>
                                </div>
                            </div>
                        </div>
                    <?php $index++;
                    } ?>



                </div>
            </div>
            <!-- Shop Product End -->
        </div>

    </div>
    <!-- Navbar End -->





    <?php include 'footer.php'; ?>
    <?php include 'script.php'; ?>
</body>

</html>