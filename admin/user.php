<?php
if(!defined('LAYOUT')) {
    die('bạn không có quyền truy cập vào file');
}
?>
<script>
    function thongBao() {
        var confirmmm = confirm('Bạn có chắc chắn muốn xóa hay không?');
        return confirmmm;
    }
    
</script>
	<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">			
		<div class="row">
			<ol class="breadcrumb">
				<li><a href="#"><svg class="glyph stroked home"><use xlink:href="#stroked-home"></use></svg></a></li>
				<li class="active">Danh sách thành viên</li>
			</ol>
		</div><!--/.row-->
		
		<div class="row">
			<div class="col-lg-12">
				<h1 class="page-header">Danh sách thành viên</h1>
			</div>
		</div><!--/.row-->
		<div id="toolbar" class="btn-group">
            <a href="index.php?page_layout=add_user" class="btn btn-success">
                <i class="glyphicon glyphicon-plus"></i> Thêm thành viên
            </a>
        </div>
		<div class="row">
			<div class="col-lg-12">
				<div class="panel panel-default">
					<div class="panel-body">
                        <table 
                            data-toolbar="#toolbar"
                            data-toggle="table">

						    <thead>
						    <tr>
						        <th data-field="id" data-sortable="true">ID</th>
						        <th data-field="name"  data-sortable="true">Họ & Tên</th>
                                <th data-field="price" data-sortable="true">Email</th>
                                <th>Quyền</th>
                                <th>Hành động</th>
						    </tr>
                            </thead>
                            <tbody>
                                <?php
                                $sql_user = "SELECT * FROM user ORDER BY user_id DESC";
                                $data = mysqli_query($conn, $sql_user);
                                
                                while($row = mysqli_fetch_array($data)) {
                                ?>
                                <tr>
                                    <td style=""><?php echo $row['user_id']; ?></td>
                                    <td style=""><?php echo $row['user_full']; ?></td>
                                    <td style=""><?php echo $row['user_mail']; ?></td>
                                    <td>
                                        <span class="label 
                                        <?php
                                        if($row['user_level'] == 1) {
                                            echo 'label-danger';
                                        }  
                                        else {
                                            echo 'label-warning';
                                        }
                                        ?> ">
                                            <?php
                                            if($row['user_level'] == 1) {
                                                echo 'Admin';
                                            }  
                                            else {
                                                echo 'Member';
                                            }
                                            ?>
                                        </span>
                                    </td>
                                    <td class="form-group">
                                        <a href="index.php?page_layout=edit_user&user_id=<?php echo $row['user_id'] ?>" class="btn btn-primary"><i class="glyphicon glyphicon-pencil"></i></a>
                                        <a onclick="return thongBao();" href="del_user.php?user_id=<?php echo $row['user_id'] ?>" class="btn btn-danger"><i class="glyphicon glyphicon-remove"></i></a>
                                    </td>
                                </tr>
                                <?php } ?>
                                
                            </tbody>
						</table>
                    </div>
                    <div class="panel-footer">
                        <nav aria-label="Page navigation example">
                            <ul class="pagination">
                                <li class="page-item"><a class="page-link" href="#">&laquo;</a></li>
                                <li class="page-item"><a class="page-link" href="#">1</a></li>
                                <li class="page-item"><a class="page-link" href="#">2</a></li>
                                <li class="page-item"><a class="page-link" href="#">3</a></li>
                                <li class="page-item"><a class="page-link" href="#">&raquo;</a></li>
                            </ul>
                        </nav>
                    </div>
				</div>
			</div>
		</div><!--/.row-->	
	</div>	<!--/.main-->

