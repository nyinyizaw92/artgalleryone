<?php
     
    require_once('../admin/config/db.php');
    $useremail = $_POST['email'];
    $password =md5( $_POST['password']);

    $q = "select * from admins where email='$useremail' and password='$password'";
    $result = mysqli_query($conn,$q);
    $num = mysqli_num_rows($result);

    if($num ==1){
        session_start();
        setcookie("useremail",$useremail,time()+3600);
        header('location:dashboard.php');
    }else{
        $message = 'something wrong try again';

        echo "<SCRIPT type='text/javascript'> //not showing me this
            alert('$message');
            window.location.replace(\"http://localhost/artgallery/dashboard\");
        </SCRIPT>";
    }
?>