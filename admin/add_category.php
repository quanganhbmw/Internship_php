<?php
if(!defined('LAYOUT')) {
    die('bạn không có quyền truy cập vào file');
}
?>
	<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">			
		<div class="row">
			<ol class="breadcrumb">
				<li><a href="#"><svg class="glyph stroked home"><use xlink:href="#stroked-home"></use></svg></a></li>
				<li><a href="">Quản lý danh mục</a></li>
				<li class="active">Thêm danh mục</li>
			</ol>
		</div><!--/.row-->
		
		<div class="row">
			<div class="col-lg-12">
				<h1 class="page-header">Thêm danh mục</h1>
			</div>
		</div><!--/.row-->
        <?php
        //$sql_add_cat = "INSERT INTO tên_bảng(id, tên, năm_sinh) VALUES('giá_trị_id', 'giá_trị_tên', 'giá_trị_năm_sinh')";
        //$data = mysqli_query($conn, $sql_add_cat);
        
        if(isset($_POST['sbm'])) {
            //code để thêm vào db
            //Bước 1: lấy dữ liệu cũ ra (để kiểm tra trùng danh mục)
            //Bước 2: thêm mới
            $cat_name = $_POST['cat_name'];
            
            $sql_cat = "SELECT * FROM category WHERE cat_name = '$cat_name'";
            $query = mysqli_query($conn, $sql_cat);
            $num_row = mysqli_num_rows($query);
            if($num_row > 0) {
                $error = '<div class="alert alert-danger">Danh mục đã tồn tại !</div>';
            }
            else {
                $sql_add_cat = "INSERT INTO category(cat_name) VALUES('$cat_name')";
                $query_add_cat = mysqli_query($conn, $sql_add_cat);
                header('location: index.php?page_layout=category');
            }
        }
        
        ?>
        <div class="row">
            <div class="col-lg-12">
                <div class="panel panel-default">
                    <div class="panel-body">
                        <div class="col-md-8">
                        	<?php
                            if(isset($error)) {
                                echo $error;
                            }
                            ?>
                            <form role="form" method="post">
                            <div class="form-group">
                                <label>Tên danh mục:</label>
                                <input required type="text" name="cat_name" class="form-control" placeholder="Tên danh mục...">
                            </div>
                            <button type="submit" name="sbm" class="btn btn-success">Thêm mới</button>
                            <button type="reset" class="btn btn-default">Làm mới</button>
                        </div>
                    	</form>
                    </div>
                </div>
            </div><!-- /.col-->
        </div>
	</div>	<!--/.main-->	

