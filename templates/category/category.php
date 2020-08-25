<?php
if(!defined('LAYOUT')) {
    die('bạn không có quyền truy cập vào file');
}
if(isset($_GET['cat_id'])) {
    $cat_id = $_GET['cat_id'];
}
if(isset($_GET['page'])) {
    $page = $_GET['page'];
}
else {
    $page = 1;
}
$so_luong_ban_ghi_trong_mot_trang = 5;
$key_ban_dau_tien_trong_mot_trang = $page * $so_luong_ban_ghi_trong_mot_trang - $so_luong_ban_ghi_trong_mot_trang;

$tat_ca_ban_ghi = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM product WHERE cat_id = $cat_id"));
$tong_so_trang = ceil($tat_ca_ban_ghi/$so_luong_ban_ghi_trong_mot_trang);

$page_navigation = '';
$page_prev = $page - 1;
if($page_prev <= 0) {
    $page_prev = 1;
}
//nút lùi
$page_navigation .= '<li class="page-item"><a class="page-link" href="index.php?page_layout=category&cat_id='.$cat_id.'&page='.$page_prev.'">&laquo;</a></li>';
//số trang
for($i = 1; $i <= $tong_so_trang; $i++) {
    $page_navigation .= '<li class="page-item"><a class="page-link" href="index.php?page_layout=category&cat_id='.$cat_id.'&page='.$i.'">'.$i.'</a></li>';
}

//nút tiến    
$page_next = $page + 1;
if($page_next == $tong_so_trang) {
    $page_next = $tong_so_trang;
}
$page_navigation .= '<li class="page-item"><a class="page-link" href="index.php?page_layout=category&cat_id='.$cat_id.'&page='.$page_next.'">&raquo;</a></li>'
?>
                <!--	List Product	-->
                <div class="products">
                    <?php
                    $sql_cat = "SELECT * FROM category WHERE cat_id = $cat_id";
                    $data_cat = mysqli_query($conn, $sql_cat);
                    $row_cat = mysqli_fetch_array($data_cat);
                    ?>
                    <h3><?php echo $row_cat['cat_name']; ?> (hiện có <?php echo $tat_ca_ban_ghi; ?> sản phẩm)</h3>
                    <div class="product-list row">
                        <?php
                        $sql_prd = "SELECT * FROM product WHERE cat_id = $cat_id ORDER BY prd_id DESC LIMIT $key_ban_dau_tien_trong_mot_trang, $so_luong_ban_ghi_trong_mot_trang";
                        $data_prd = mysqli_query($conn, $sql_prd);
                        while($row_prd = mysqli_fetch_array($data_prd)) {
                        ?>
                        <div class="col-md-4">
                            <div class="product-item text-center">
                                <a href="#"><img src="admin/img/products/<?php echo $row_prd['prd_image']; ?>"></a>
                                <h4><a href="#"><?php echo $row_prd['prd_name']; ?></a></h4>
                                <p>Giá Bán: <span><?php echo $row_prd['prd_price']; ?>đ</span></p>
                            </div>
                        </div>
                        <?php } ?>
                    </div>
                </div>
                <!--	End List Product	-->
                
                <div id="pagination">
                    <ul class="pagination">
                        <?php echo $page_navigation; ?>
                    </ul> 
                </div>

