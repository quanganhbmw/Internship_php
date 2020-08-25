<?php
if(!defined('LAYOUT')) {
    die('bạn không có quyền truy cập vào file');
}
?>
               <!--	Feature Product	-->
                <div class="products">
                    <h3>Sản phẩm nổi bật</h3>
                    <div class="product-list row">
                        <?php
                        $sql_featured_prd = "SELECT * FROM product WHERE prd_featured = 1 ORDER BY prd_id DESC LIMIT 6";
                        $data_featured_prd = mysqli_query($conn, $sql_featured_prd);
                        while($row_featured_prd = mysqli_fetch_array($data_featured_prd)) {
                        ?>
                        <div class="col-md-4">
                            <div class="product-item text-center">
                                <a href="index.php?page_layout=product&prd_id=<?php echo $row_featured_prd['prd_id']; ?>"><img src="admin/img/products/<?php echo $row_featured_prd['prd_image']; ?>"></a>
                                <h4><a href="index.php?page_layout=product&prd_id=<?php echo $row_featured_prd['prd_id']; ?>"><?php echo $row_featured_prd['prd_name']; ?></a></h4>
                                <p>Giá Bán: <span><?php echo $row_featured_prd['prd_price']; ?>đ</span></p>
                            </div>
                        </div>
                        <?php } ?>
                    </div>
                </div>
                <!--	End Feature Product	-->