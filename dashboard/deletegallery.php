<?php
    session_start();
    require_once('../admin/config/db.php');
    $productid = $_GET['productid'];
    $delete = "delete from galleries where sha1(id)='$productid'";
    mysqli_query($conn,$delete);


    $delete_sell = "delete from sell_galleries where product_id='$productid'";
    mysqli_query($conn,$delete_sell);
    $message = "delete product successfully";

    echo "<SCRIPT type='text/javascript'> //not showing me this
        alert('$message');
        window.location.replace(\"http://localhost/artgallery/dashboard/dashboard.php\");
    </SCRIPT>";
  

?>