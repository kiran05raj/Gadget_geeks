<?php
include 'config.php';
$admin = new Admin();

if (!$_SESSION['u_id']) {
    echo "<script>
    alert('not logged in...');
    window.location.href='login.html';
    </script>";
}

$u_id = $_SESSION['u_id'];

$user_table = $admin->ret("SELECT * FROM `user` WHERE `u_id`='$u_id'");
$user_row = $user_table->fetch(PDO::FETCH_ASSOC);
$username = $user_row['u_name'];
$current_page = basename($_SERVER['PHP_SELF']);