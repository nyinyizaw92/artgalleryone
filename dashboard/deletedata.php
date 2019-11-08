<?php
    session_start();
    require_once('../admin/config/db.php');
    $userid = $_GET['id'];

    $delete_sell = "delete from galleries where sha1(user_id)='$userid'";
      
    if(mysqli_query($conn,$delete_sell)){
     
        $message = "delete product successfully";

        echo "<SCRIPT type='text/javascript'> //not showing me this
            alert('$message');
            window.location.replace(\"http://localhost/artgallery/dashboard/gallery.php\");
        </SCRIPT>";
       
    }

?>