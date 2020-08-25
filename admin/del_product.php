<?php
session_start();
if(isset($_SESSION['mail']) && isset($_SESSION['pass'])) {
    //$sql = "DELETE FROM tên_bảng WHERE"
    //mysqli_query($conn, $sql)
    define('LAYOUT', true);
    include_once('config/connect.php');
    $prd_id = $_GET['prd_id'];
    $sql_prd = "DELETE FROM product WHERE prd_id = '$prd_id'";
    mysqli_query($conn, $sql_prd);
    header('location: index.php?page_layout=product');
}
else {
    header('location: index.php');
}

?>