<?php
class CheckoutModel {
    private $conn;
    private $table_name = "checkout";

    public function __construct($db) {
        $this->conn = $db;
    }

    

    function createProduct($customer_name, $customer_email, $customer_phone, $diachi,$ghichu)
    {
        // uploadResult: đường dẫn của file hình 
        // uploadResult = false: lỗi upload hình ảnh
        // Kiểm tra ràng buộc đầu vào
        $errors = [];
        if (empty($customer_name)) {
            $errors['customer_name'] = 'Tên sản phẩm không được để trống';
        }
        if (empty($customer_email)) {
            $errors['customer_email'] = 'Email không được để trống';
        }
        if (empty($customer_phone)) {
            $errors['customer_phone'] = 'Số điện thoại không được để trống';
        }

        if (empty($diachi)) {
            $errors['diachi'] = 'Mô tả không được để trống';
        }
        if (empty($ghichu)) {
            $errors['ghichu'] = '';
        }

        

        if (count($errors) > 0) {
            return $errors;
        }

         

        // Truy vấn tạo sản phẩm mới

        $query = "INSERT INTO " . $this->table_name . " (customer_name, customer_email, customer_phone, diachi,ghichu) VALUES (:customer_name, :customer_email, :customer_phone, :diachi, :ghichu)";
        $stmt = $this->conn->prepare($query);

        // Làm sạch dữ liệu
        $customer_name = htmlspecialchars(strip_tags($customer_name));
        $customer_email = htmlspecialchars(strip_tags($customer_email));
        $customer_phone = htmlspecialchars(strip_tags($customer_phone));
        $diachi = htmlspecialchars(strip_tags($diachi));
        $ghichu = htmlspecialchars(strip_tags($ghichu));


        // Gán dữ liệu vào câu lệnh
        $stmt->bindParam(':customer_name', $customer_name);
        $stmt->bindParam(':customer_email', $customer_email);
        $stmt->bindParam(':customer_phone', $customer_phone);
        $stmt->bindParam(':diachi', $diachi);
        $stmt->bindParam(':ghichu', $ghichu);

        // Thực thi câu lệnh
        if ($stmt->execute()) {
            return true;
        }

        return false;
    }

    

   
}