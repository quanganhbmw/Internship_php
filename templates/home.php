<?php
if(!defined('LAYOUT')) {
    die('bạn không có quyền truy cập vào file');
}
?>
<!--	Body	-->
<div id="body">
	<div class="container">
    	<div class="row">
        	<div class="col-lg-12 col-md-12 col-sm-12">
            	<?php include_once('templates/header/menu.php'); ?>
            </div>
        </div>
        <div class="row">
        	<div id="main" class="col-lg-8 col-md-12 col-sm-12">
            	<?php include_once('templates/slider/slider.php'); ?>
                
                <?php
                //switch case viết ở đây
                if(isset($_GET['page_layout'])) {
                    switch($_GET['page_layout']) {
                        case 'category': include_once('category/category.php'); break;
                        case 'product': include_once('product/product.php'); break;
                        case 'cart': include_once('cart/cart.php'); break;
                        case 'success': include_once('cart/success.php'); break;
                        case 'search': include_once('search/search.php'); break;
                    }
                }
                else {
                    include_once('sub_index.php');
                }
                ?>
                
            </div>
            
            <?php include_once('templates/sidebar/sidebar.php'); ?>
        </div>
    </div>
</div>
<!--	End Body	-->