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

    <!-- Shop Start -->
    <div class="container-fluid pt-5">
        <div class="row px-xl-5">
            <!-- Shop Product Start -->
            <div class="col-lg-12 col-md-12">
                <div class="row pb-3">
                    <div class="col-12 pb-1">
                        <div class="d-flex align-items-center justify-content-between mb-4">
                            <form action="">
                                <div class="input-group">
                                    <input type="text" id="searchInput" class="form-control"
                                        placeholder="Search by name" />
                                    <div class="input-group-append">
                                        <span class="input-group-text bg-transparent text-primary">
                                            <i class="fa fa-search"></i>
                                        </span>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>

                    <?php
                    $product_table = $admin->ret("SELECT * FROM `product`");
                    $index = 1;
                    while ($product_row = $product_table->fetch(PDO::FETCH_ASSOC)) { ?>
                        <div class="col-lg-3 col-md-6 col-sm-12 pb-1 product-item">
                            <div class="card border-0 mb-4">
                                <a href="product-detail.php?p_id=<?php echo $product_row['p_id']; ?>"
                                    class="card-header product-img position-relative overflow-hidden bg-transparent border p-0">
                                    <img class="img-fluid" style="height: 304px;"
                                        src="admin/controller/<?php echo $product_row['p_photo']; ?>" alt="" />
                                </a>
                                <div class="card-body border-left border-right text-center p-0 pt-4 pb-3">
                                    <h6 class="text-truncate mb-3 product-name"><?php echo $product_row['p_name'] ?></h6>
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
    <!-- Shop End -->

    <?php include 'footer.php'; ?>
    <?php include 'script.php'; ?>

    <!-- JavaScript for Search Functionality -->
    <script>
        document.getElementById("searchInput").addEventListener("keyup", function() {
            let searchValue = this.value.toLowerCase();
            let productItems = document.querySelectorAll(".product-item");

            productItems.forEach(function(item) {
                let productName = item.querySelector(".product-name").textContent.toLowerCase();
                if (productName.includes(searchValue)) {
                    item.style.display = "block";
                } else {
                    item.style.display = "none";
                }
            });
        });
    </script>

</body>

</html>