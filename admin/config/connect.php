<?php
if(!defined('LAYOUT')) {
    die('bạn không có quyền truy cập vào file');
}

$conn = mysqli_connect('localhost','root','','shop_dien_thoai');

if($conn) {
    mysqli_query($conn, "SET NAMES 'utf8'");
}
else {
    die('fail!!'.mysqli_error());
}
?>