<?php
session_start();
require_once('../admin/config/db.php');
$userid = $_COOKIE['userid'];
$useremail = $_COOKIE['useremail'];


if(isset($_POST['feedback'])){

    $user_id = $_POST['user_id'];
    $user_email = $_POST['useremail'];
    $comment = $_POST['comment'];

    if($useremail !== $user_email){
        $message = "your email incorrect";
    
            echo "<SCRIPT type='text/javascript'> //not showing me this
                alert('$message');
                window.location.replace(\"http://localhost/artgallery/gallery/home.php\");
            </SCRIPT>";
    }else{
        $feedback="insert into feedbacks (user_id,user_email,comment,created_date) values
        ($user_id,'$user_email','$comment',now())";
         if(mysqli_query($conn,$feedback)){
            $message = "your feedback send to admin successfully";
    
            echo "<SCRIPT type='text/javascript'> //not showing me this
                alert('$message');
                window.location.replace(\"http://localhost/artgallery/gallery/home.php\");
            </SCRIPT>";
         }
    }

  
}


?>