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
            <a href="index.php" class="nav-item nav-link">Home</a>
            <a href="shop.php"
                class="nav-item nav-link <?php echo ($current_page == 'shop.php') ? 'active' : ''; ?>">Shop</a>
            <a href="orders.php"
                class="nav-item nav-link <?php echo ($current_page == 'orders.php') ? 'active' : ''; ?>">Orders</a>
            <a href="feedback.php"
                class="nav-item nav-link <?php echo ($current_page == 'feedback.php') ? 'active' : ''; ?>">Feedback</a>

        </div>
        <div class="navbar-nav ml-auto py-0">
            <a href="controller/auth.php?logout=logout" class="nav-item nav-link">Logout</a>
        </div>
    </div>
</nav>