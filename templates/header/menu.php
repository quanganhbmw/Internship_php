<?php
if(!defined('LAYOUT')) {
    die('bạn không có quyền truy cập vào file');
}
?>
            <nav>
                <div id="menu" class="collapse navbar-collapse">
                    <ul>
                        <?php
                        $sql_menu = "SELECT * FROM category ORDER BY cat_id ASC";
                        $data_menu = mysqli_query($conn, $sql_menu);
                        while($row_menu = mysqli_fetch_array($data_menu)) {
                        ?>
                        <li class="menu-item">
                            <a href="index.php?page_layout=category&cat_id=<?php echo $row_menu['cat_id']; ?>"><?php echo $row_menu['cat_name']; ?></a>
                        </li>
                        <?php } ?>
                    </ul>
                </div>
            </nav>