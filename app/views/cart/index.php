<?php
include_once 'app/views/share/header.php';
$totalPrice = 0;

// Kiểm tra xem session cart có tồn tại không
if (!isset($_SESSION['cart']) || empty($_SESSION['cart'])) {
    echo "Giỏ hàng trống!";
} else {
    // Hiển thị danh sách sản phẩm trong giỏ hàng
    echo "<h2 style='color: blue;text-align: center;'><b>Danh sách giỏ hàng</b></h2>";
    echo "<table class='table'>";
    echo "<thead>";
    echo "<tr>";
    echo "<th>ID</th>";
    echo "<th>Name</th>";
    echo "<th>Description</th>";
    echo "<th>Image</th>";
    echo "<th>Quantity</th>";
    echo "<th>Price</th>";
    echo "<th>Remove</th>";
    echo "</tr>";
    echo "</thead>";
    echo "<tbody>";
    foreach ($_SESSION['cart'] as $item) {
	$totalPrice += $item->price * $item->quantity;
        echo "<tr>";
        echo "<td>$item->id</td>";
        echo "<td>$item->name</td>";
        echo "<td>$item->description</td>";
        echo "<td><img src='/chieu2/$item->image' alt='Product Image' style='max-width: 100px; max-height: 100px;'></td>";
	    // echo "<td>
        //     <form method='post' action='/chieu2/cart/updateQuality/$item->id'>
        //         <input name='quality' type='number' value=".$item->quantity." />
        //         <input type='submit' value='Update' class='btn btn-info' />
        //     </form>
        //     </td>";
        
        echo "<td>";
        // Thêm nút tăng và giảm số lượng
        echo "<div class='quantity-control'>";
        echo "<form method='post' action='/chieu2/cart/updateQuality/$item->id'>";
        echo "<button type='submit' name='action' value='decrease'>-</button>";
        echo "<span class='product-quantity'>" . $item->quantity . "</span>";
        echo "<button type='submit' name='action' value='increase'>+</button>";
        echo "</form>";
        echo "</div>";
        echo "</td>";

        echo "<td>";
        echo "<span class='product-total'>" . ($item->price * $item->quantity)." "."$". "</span>";
        echo "</td>";
    
        
        echo "<td><a class='btn btn-danger' href='/chieu2/cart/removeItem/$item->id'>Delete</a></td>"; // Sửa dòng này
        echo "</tr>";
    }
    echo "</tbody>";
    echo "</table>";
    
    echo "<div class='cart-total'>";
    echo "<p><strong>Tổng giá:</strong> <span class='total-price'>" . $totalPrice ." "."$"."</span></p>";
    echo "</div>";

    // Hiển thị nút Checkout
    echo "<form action='show1' method='post'>";
    echo "<input type='submit' value='Thanh toán'>";
    echo "</form>";
}

    echo "<br>";
    echo "<div class='out-button' style='text-align:center;'>";
    echo "<form action='/chieu2/' method='post'>"; // Chuyển hướng sang trang checkout.php
    echo "<input type='submit' value='Quay Lại Trang Chủ' class='btn btn-primary'>";
    echo "</form>";
    echo "</div>";

include_once 'app/views/share/footer.php';
?>
