<?php
session_start();
if(isset($_SESSION['mail']) && isset($_SESSION['pass'])) {
    //$sql = "DELETE FROM tên_bảng WHERE"
    //mysqli_query($conn, $sql)
    define('LAYOUT', true);
    include_once('config/connect.php');
    $user_id = $_GET['user_id'];
    $sql_user = "DELETE FROM user WHERE user_id = '$user_id'";
    mysqli_query($conn, $sql_user);
    header('location: index.php?page_layout=user');
}
else {
    header('location: index.php');
}

?>