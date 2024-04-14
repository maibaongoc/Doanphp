<?php
require_once 'app/models/CheckoutModel.php';

class CheckoutController
{

    private $checkoutModel;
    private $db;

    public function __construct()
    {
        $this->db = (new Database())->getConnection();
        $this->checkoutModel = new CheckoutModel($this->db);
    }

    // public function listProducts()
    // {

    //     $stmt = $this->productModel->readAll();

    //     include_once 'app/views/product_list.php';
    // }

    public function add()
    {
        include_once 'app/views/cart/checkout.php';
    }

    public function save()
    {
        //lưu sản phẩm vào CSDL, kèm upload hình ảnh lên thư mục uploads/ của server
        //cập nhật tên đường dẫn hình ảnh vào cột image của bảng Product
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $customer_name = $_POST['customer_name'] ?? '';
            $customer_email = $_POST['customer_email'] ?? '';
            $customer_phone = $_POST['customer_phone'] ?? '';
            $diachi = $_POST['diachi'] ?? '';
            $ghichu = $_POST['ghichu'] ?? '';

            // if (isset($_POST['id'])) {
            //     //update
            //     $id = $_POST['id'];
            // }

            
            // //lưu sản phẩm
            // if (!isset($id)){

                // thêm sản phẩm 
                $result = $this->checkoutModel->createProduct($customer_name, $customer_email, $customer_phone, $diachi,$ghichu);
                header('Location: /chieu2/cart/show1');
            // }
            
            

            if (is_array($result)) {
                // Có lỗi, hiển thị lại form với thông báo lỗi
                $errors = $result;
                include 'app/views/cart/checkout.php';
            } else {
                // Không có lỗi, chuyển hướng ve trang chu hoac trang danh sach
                header('Location: /chieu2');
            }
        }
    }

    function show1()
    {
        include_once 'app/views/cart/checkout.php';
    }
    


   
}
