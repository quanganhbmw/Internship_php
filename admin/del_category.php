<?php
session_start();
if(isset($_SESSION['mail']) && isset($_SESSION['pass'])) {
    //$sql = "DELETE FROM tên_bảng WHERE"
    //mysqli_query($conn, $sql)
    define('LAYOUT', true);
    include_once('config/connect.php');
    $cat_id = $_GET['cat_id'];
    $sql_cat = "DELETE FROM category WHERE cat_id = '$cat_id'";
    mysqli_query($conn, $sql_cat);
    header('location: index.php?page_layout=category');
}
else {
    header('location: index.php');
}

?>