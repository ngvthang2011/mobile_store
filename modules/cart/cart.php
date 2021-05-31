<?php 
    if(isset($_SESSION['cart'])){
        if(isset($_POST['sbm'])){
            foreach($_POST['qty'] as $prd_id => $qty){
                $_SESSION['cart'][$prd_id] = $qty;
            }
        }
        $arr_id = array();
        foreach($_SESSION['cart'] as $prd_id=>$qty){
            $arr_id[]=$prd_id;
        }
    $list_id = implode(', ', $arr_id);
    $sql="SELECT * FROM product WHERE prd_id IN($list_id)";
    $query = mysqli_query($conn, $sql);

?>
<!--	Cart	-->
<div id="my-cart">
    <div class="row">
        <div class="cart-nav-item col-lg-7 col-md-7 col-sm-12">Thông tin sản phẩm</div>
        <div class="cart-nav-item col-lg-2 col-md-2 col-sm-12">Tùy chọn</div>
        <div class="cart-nav-item col-lg-3 col-md-3 col-sm-12">Giá</div>
    </div>
    <form method="post">
        <?php 
        $total_price = 0;
        $total_price_all = 0;
        while($prd = mysqli_fetch_array($query)){ 
            $total_price = $prd['prd_price']*$_SESSION['cart'][$prd['prd_id']];
            $total_price_all += $total_price;
        ?>
        <div class="cart-item row">
            <div class="cart-thumb col-lg-7 col-md-7 col-sm-12">
                <img src="./admin/img/<?php echo $prd['prd_image']; ?>">
                <h4><?php echo $prd['prd_name']; ?></h4>
            </div>

            <div class="cart-quantity col-lg-2 col-md-2 col-sm-12">
                <input type="number" id="quantity" class="form-control form-blue quantity" name="qty[<?php echo $prd['prd_id'];?>]" value="<?php echo $_SESSION['cart'][$prd['prd_id']]; ?>" min="1">
            </div>
            <div class="cart-price col-lg-3 col-md-3 col-sm-12"><b><?php echo number_format($total_price,0,'','.') ?>đ</b><a href="./modules/cart/del_cart.php?prd_id=<?php echo $prd['prd_id'];?>">Xóa</a></div>
        </div>
       <?php } ?>
        <div class="row">
            <div class="cart-thumb col-lg-7 col-md-7 col-sm-12">
                <button id="update-cart" class="btn btn-success" type="submit" name="sbm">Cập nhật giỏ hàng</button>
            </div>
            <div class="cart-total col-lg-2 col-md-2 col-sm-12"><b>Tổng cộng:</b></div>
            <div class="cart-price col-lg-3 col-md-3 col-sm-12"><b><?php echo number_format($total_price_all,0,'','.') ?>đ</b></div>
        </div>
    </form>

</div>
<!--	End Cart	-->

<?php }else{ ?>
    <div class="alert alert-danger">Hiện tại giỏ hàng của bạn chưa có sản phẩm nào!</div>
<?php } ?>

<!--	Customer Info	-->
<div id="customer">
    <form method="post">
        <div class="row">

            <div id="customer-name" class="col-lg-4 col-md-4 col-sm-12">
                <input placeholder="Họ và tên (bắt buộc)" type="text" name="name" class="form-control" required>
            </div>
            <div id="customer-phone" class="col-lg-4 col-md-4 col-sm-12">
                <input placeholder="Số điện thoại (bắt buộc)" type="text" name="phone" class="form-control" required>
            </div>
            <div id="customer-mail" class="col-lg-4 col-md-4 col-sm-12">
                <input placeholder="Email (bắt buộc)" type="text" name="mail" class="form-control" required>
            </div>
            <div id="customer-add" class="col-lg-12 col-md-12 col-sm-12">
                <input placeholder="Địa chỉ nhà riêng hoặc cơ quan (bắt buộc)" type="text" name="add"
                    class="form-control" required>
            </div>

        </div>
    </form>
    <div class="row">
        <div class="by-now col-lg-6 col-md-6 col-sm-12">
            <a href="#">
                <b>Mua ngay</b>
                <span>Giao hàng tận nơi siêu tốc</span>
            </a>
        </div>
        <div class="by-now col-lg-6 col-md-6 col-sm-12">
            <a href="#">
                <b>Trả góp Online</b>
                <span>Vui lòng call (+84) 0988 550 553</span>
            </a>
        </div>
    </div>
</div>
<!--	End Customer Info	-->