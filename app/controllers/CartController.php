<?php
class CartController
{

    private $productModel;
    private $db;

    public function __construct()
    {
        $this->db = (new Database())->getConnection();
        $this->productModel = new ProductModel($this->db);
    }


    // public function updateQuality($id)
    // {
    //     $newQuantity = $_POST['quality'];
    //     foreach ($_SESSION['cart'] as &$item) {
    //         if ($item->id == $id) {
    //             $item->quantity = $newQuantity;

    //             break;
    //         }
    //     }
    //     header('Location: /chieu2/cart/show');
    // }
    

    public function updateQuality($id)
    {
    $action = $_POST['action']; // Lấy hành động từ form
    $quantityChange = ($action == 'increase') ? 1 : -1; // Xác định thay đổi số lượng là tăng (+1) hoặc giảm (-1)
    
    foreach ($_SESSION['cart'] as $key => &$item) {
        if ($item->id == $id) {
            $item->quantity += $quantityChange; // Thay đổi số lượng

            // Kiểm tra nếu số lượng sản phẩm là 0 thì xóa sản phẩm khỏi giỏ hàng
            if ($item->quantity <= 0) {
                unset($_SESSION['cart'][$key]);
            }
            break;
        }
    }
        header('Location: /chieu2/cart/show');
    }



    public function removeItem($id)
    {
    // Kiểm tra xem giỏ hàng có tồn tại không
    if (isset($_SESSION['cart'])) {
        // Duyệt qua các sản phẩm trong giỏ hàng
        foreach ($_SESSION['cart'] as $key => $item) {
            // Nếu tìm thấy sản phẩm với ID tương ứng, loại bỏ nó khỏi giỏ hàng
            if ($item->id == $id) {
                unset($_SESSION['cart'][$key]);
                break;
            }
        }
    }

    // Chuyển hướng người dùng đến trang giỏ hàng
    header('Location: /chieu2/cart/show');
}



    public function Add($id)
    {
        // Khởi tạo một phiên cart nếu chưa tồn tại
        if (!isset($_SESSION['cart'])) {
            $_SESSION['cart'] = [];
        }

        // Lấy sản phẩm từ ProductModel bằng $id
        $product = $this->productModel->getProductById($id);

        // Nếu sản phẩm tồn tại, thêm vào giỏ hàng
        if ($product) {
            // Kiểm tra xem sản phẩm đã tồn tại trong giỏ hàng chưa
            $productExist = false;
            foreach ($_SESSION['cart'] as &$item) {
                if ($item->id == $id) {
                    $item->quantity++;
                    $productExist = true;
                    break;
                }
            }

            // Nếu sản phẩm chưa tồn tại trong giỏ hàng, thêm mới vào
            if (!$productExist) {
                $product->quantity = 1;
                $_SESSION['cart'][] = $product;
            }

            header('Location: /chieu2/cart/show');
        } else {
            echo "Không tìm thấy sản phẩm với ID này!";
        }
    }
    function show()
    {
        include_once 'app/views/cart/index.php';
    }
    function show1()
    {
        include_once 'app/views/cart/checkout.php';
    }
    
}
