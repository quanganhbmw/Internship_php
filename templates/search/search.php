<?php
if(!defined('LAYOUT')) {
    die('bạn không có quyền truy cập vào file');
}
if(isset($_POST['keyword'])) {
    $keyword = $_POST['keyword'];
}
else {
    $keyword = $_GET['keyword'];
}
$array_keyword = explode(' ', $keyword);
$keyword_result = '%'.implode('%', $array_keyword).'%';

if(isset($_GET['page'])) {
    $page = $_GET['page'];
}
else {
    $page = 1;
}
$so_luong_ban_ghi_trong_mot_trang = 3;
$key_ban_dau_tien_trong_mot_trang = $page * $so_luong_ban_ghi_trong_mot_trang - $so_luong_ban_ghi_trong_mot_trang;

$tat_ca_ban_ghi = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM product WHERE prd_name LIKE '$keyword_result'"));
$tong_so_trang = ceil($tat_ca_ban_ghi/$so_luong_ban_ghi_trong_mot_trang);

$page_navigation = '';
$page_prev = $page - 1;
if($page_prev <= 0) {
    $page_prev = 1;
}
//nút lùi
$page_navigation .= '<li class="page-item"><a class="page-link" href="index.php?page_layout=search&keyword='.$keyword.'&page='.$page_prev.'">&laquo;</a></li>';
//số trang
for($i = 1; $i <= $tong_so_trang; $i++) {
    $page_navigation .= '<li class="page-item"><a class="page-link" href="index.php?page_layout=search&keyword='.$keyword.'&page='.$i.'">'.$i.'</a></li>';
}
//nút tiến    
$page_next = $page + 1;
if($page_next >= $tong_so_trang) {
    $page_next = $tong_so_trang;
}
$page_navigation .= '<li class="page-item"><a class="page-link" href="index.php?page_layout=search&keyword='.$keyword.'&page='.$page_next.'">&raquo;</a></li>'
?>
                <!--	List Product	-->
                <div class="products">
                    <div id="search-result">Kết quả tìm kiếm với sản phẩm <span><?php echo $keyword; ?></span></div>
                    <div class="product-list row">
                        <?php
                        $sql_search = "SELECT * FROM product WHERE prd_name LIKE '$keyword_result' LIMIT $key_ban_dau_tien_trong_mot_trang, $so_luong_ban_ghi_trong_mot_trang";
                        $data_search = mysqli_query($conn, $sql_search);
                        while($row_search = mysqli_fetch_array($data_search)) {
                        ?>
                        <div class="col-md-4">
                            <div class="product-item text-center">
                                <a href="index.php?page_layout=product&prd_id=<?php echo $row_search['prd_id']; ?>">
                                    <img src="admin/img/products/<?php echo $row_search['prd_image']; ?>">
                                </a>
                                <h4>
                                    <a href="index.php?page_layout=product&prd_id=<?php echo $row_search['prd_id']; ?>">
                                        <?php echo $row_search['prd_name']; ?>
                                    </a>
                                </h4>
                                <p>Giá Bán: <span><?php echo $row_search['prd_price']; ?>đ</span></p>
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
