<?php
include_once 'app/views/share/header.php';
?>

<?php

    if(isset($errors)){
        echo "<ul>";
        foreach($errors as $err){
            echo "<li class='text-danger'>$err</li>";
        }
        echo "</ul>";
    }

?>

<div class="card-body p-5">
    <h2 style="text-align: center;"></h2>

        <form class="user" action="/chieu2/checkout/save" method="post">
            
            <div class="form-group">
                <input type="text" class="form-control form-control-user" id="customer_name" name="customer_name" placeholder="Name">
            </div>
            <div class="form-group">
                <input type="text" class="form-control form-control-user" id="customer_email" name="customer_email" placeholder="Email">
            </div>
            <div class="form-group">
                <input type="text" class="form-control form-control-user" id="customer_phone" name="customer_phone" placeholder="Phone">
            </div>
            <div class="form-group">
                <input type="text" class="form-control form-control-user" id="diachi" name="diachi" placeholder="Address">
            </div>
            <div class="form-group">
                <input type="text" class="form-control form-control-user" id="ghichu" name="ghichu" placeholder="Note">
            </div>
            <div class="form-group text-center">
                <button class="btn btn-primary btn-icon-split p-3">
                    Save information
                </button>
            </div>
        </form>

    <?php
    echo "<br>";
    echo "<div class='out-button'>";
    echo "<form action='/chieu2/cart/show' method='post'>"; 
    echo "<input type='submit' value='Quay lại' class='btn btn-primary'>";
    echo "</form>";
    echo "</div>";
    ?>




   
</div>
<?php
include_once 'app/views/share/footer.php';
?>