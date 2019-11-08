<?php
    session_start();
    require_once('../admin/config/db.php');
    $productid = $_GET['product_id'];

    $delete_sell = "delete from products where sha1(id)='$productid'";
      
    if(mysqli_query($conn,$delete_sell)){
     
        $message = "delete product successfully";

        echo "<SCRIPT type='text/javascript'> //not showing me this
            alert('$message');
            window.location.replace(\"http://localhost/artgallery/gallery/userprofile.php\");
        </SCRIPT>";
       
    }

?>