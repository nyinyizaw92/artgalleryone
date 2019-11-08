<?php 
session_start();
require_once('../admin/config/db.php');


if(isset($_POST['delete_gallery'])){
    $user_id = $_POST['user_id'];
        $delete = "delete from create_galleries where user_id='$user_id'";
        if(mysqli_query($conn,$delete)){
            $del = "delete from galleries where user_id='$user_id' and agree=0";
            mysqli_query($conn,$del);

            echo "<SCRIPT type='text/javascript'> //not showing me this
               
                window.location.replace(\"http://localhost/artgallery/gallery/gallery.php\");
            </SCRIPT>";
        } 
    }

?>
 