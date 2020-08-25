<?php
if(!defined('LAYOUT')) {
    die('bạn không có quyền truy cập vào file');
}
if(isset($_GET['prd_id'])) {
    $prd_id = $_GET['prd_id'];
}
$sql_prd = "SELECT * FROM product WHERE prd_id = $prd_id";
$data_prd = mysqli_query($conn, $sql_prd);
$row_prd = mysqli_fetch_array($data_prd);
?>
                <div id="product">
                	<div id="product-head" class="row">
                    	<div id="product-img" class="col-lg-6 col-md-6 col-sm-12">
                        	<img src="admin/img/products/<?php echo $row_prd['prd_image']; ?>">
                        </div>
                        <div id="product-details" class="col-lg-6 col-md-6 col-sm-12">
                        	<h1><?php echo $row_prd['prd_name']; ?></h1>
                            <ul>
                            	<li><span>Bảo hành:</span> <?php echo $row_prd['prd_warranty']; ?></li>
                                <li><span>Đi kèm:</span> <?php echo $row_prd['prd_accessories']; ?></li>
                                <li><span>Tình trạng:</span> <?php echo $row_prd['prd_new']; ?></li>
                                <li><span>Khuyến Mại:</span> <?php echo $row_prd['prd_promotion']; ?></li>
                                <li id="price">Giá Bán (chưa bao gồm VAT)</li>
                                <li id="price-number"><?php echo $row_prd['prd_price']; ?>đ</li>
                                <li id="status">
                                    <?php 
                                    if($row_prd['prd_status'] == 1) {
                                        echo 'Còn hàng';
                                    }
                                    else {
                                        echo 'Hết hàng';
                                    }
                                    ?>
                                </li>
                            </ul>
                            <div id="add-cart"><a href="#">Mua ngay</a></div>
                        </div>
                    </div>
                    <div id="product-body" class="row">
                        <div class="col-lg-12 col-md-12 col-sm-12">
                            <h3>Đánh giá về iPhone X 64GB</h3>
                            <?php echo $row_prd['prd_details']; ?>
                        </div>
                    </div>
                    
                    <!--	Comment	-->
                    <?php
                    if(isset($_POST['sbm'])) {
                        $comm_name = $_POST['comm_name'];
                        $comm_mail = $_POST['comm_mail'];
                        $comm_details = $_POST['comm_details'];
                        
                        date_default_timezone_set('Asia/Bangkok');
                        $comm_date = date('Y-m-d H:i:s');
                        
                        $sql_add_comment = "INSERT INTO comment(comm_name, comm_mail, comm_details, comm_date, prd_id) VALUES('$comm_name', '$comm_mail', '$comm_details', '$comm_date', '$prd_id')";
                        mysqli_query($conn, $sql_add_comment);
                    }
                    if(isset($_GET['page'])) {
                        $page = $_GET['page'];
                    }
                    else {
                        $page = 1;
                    }
                    $so_luong_ban_ghi_trong_mot_trang = 5;
                    $key_ban_dau_tien_trong_mot_trang = $page * $so_luong_ban_ghi_trong_mot_trang - $so_luong_ban_ghi_trong_mot_trang;

                    $tat_ca_ban_ghi = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM comment WHERE prd_id = $prd_id"));
                    $tong_so_trang = ceil($tat_ca_ban_ghi/$so_luong_ban_ghi_trong_mot_trang);

                    $page_navigation = '';
                    $page_prev = $page - 1;
                    if($page_prev <= 0) {
                        $page_prev = 1;
                    }
                    //nút lùi
                    $page_navigation .= '<li class="page-item"><a class="page-link" href="index.php?page_layout=product&prd_id='.$prd_id.'&page='.$page_prev.'">&laquo;</a></li>';
                    //số trang
                    for($i = 1; $i <= $tong_so_trang; $i++) {
                        $page_navigation .= '<li class="page-item"><a class="page-link" href="index.php?page_layout=product&prd_id='.$prd_id.'&page='.$i.'">'.$i.'</a></li>';
                    }

                    //nút tiến    
                    $page_next = $page + 1;
                    if($page_next == $tong_so_trang) {
                        $page_next = $tong_so_trang;
                    }
                    $page_navigation .= '<li class="page-item"><a class="page-link" href="index.php?page_layout=product&prd_id='.$prd_id.'&page='.$page_next.'">&raquo;</a></li>'

                    ?>
                    <div id="comment" class="row">
                        <div class="col-lg-12 col-md-12 col-sm-12">
                            <h3>Bình luận sản phẩm</h3>
                            <form method="post">
                                <div class="form-group">
                                    <label>Tên:</label>
                                    <input name="comm_name" required type="text" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label>Email:</label>
                                    <input name="comm_mail" required type="email" class="form-control" id="pwd">
                                </div>
                                <div class="form-group">
                                    <label>Nội dung:</label>
                                    <textarea name="comm_details" required rows="8" class="form-control"></textarea>     
                                </div>
                                <button type="submit" name="sbm" class="btn btn-primary">Gửi</button>
                            </form> 
                        </div>
                    </div>
                    <!--	End Comment	-->  
                    
                    <!--	Comments List	-->
                    <div id="comments-list" class="row">
                    	<div class="col-lg-12 col-md-12 col-sm-12">
                            <?php
                            $sql_comment = "SELECT * FROM comment WHERE prd_id = $prd_id ORDER BY comm_id DESC LIMIT $key_ban_dau_tien_trong_mot_trang, $so_luong_ban_ghi_trong_mot_trang";
                            $data_comment = mysqli_query($conn, $sql_comment);
                            while($row_comment = mysqli_fetch_array($data_comment)) {
                            ?>
                            <div class="comment-item">
                                <ul>
                                    <li><b><?php echo $row_comment['comm_name']; ?></b></li>
                                    <li><?php echo $row_comment['comm_date']; ?></li>
                                    <li>
                                        <?php echo $row_comment['comm_details']; ?>
                                    </li>
                                </ul>
                            </div>
                            <?php } ?>
                        </div>
                    </div>
                    <!--	End Comments List	-->
                </div>
                <!--	End Product	--> 
                <div id="pagination">
                    <ul class="pagination">
                        <?php echo $page_navigation; ?>
                    </ul> 
                </div>               
