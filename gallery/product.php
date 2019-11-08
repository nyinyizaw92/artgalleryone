<?php 
session_start();
require_once('../admin/config/db.php');
if(isset($_POST['product'])){
    $userid = $_POST['userid'];
    $username = $_POST['username'];
    $title = $_POST['title'];
    $width = $_POST['width'];
    $height = $_POST['height'];
    $medium = $_POST['medium'];
    $price = $_POST['price'];
    $agree = $_POST['agree'];
    $target_path = "products/";
    $target_path = $target_path.basename($_FILES['photo']['name']);

    if(move_uploaded_file($_FILES['photo']['tmp_name'], $target_path)){
        if($price==''){
            $qy="insert into products (photo,user_name,user_id,title,width,height,medium,price,agree,created_date) values
          ('$target_path','$username',$userid,'$title',$width,$height,$medium,0,$agree,now())";
          if( mysqli_query($conn,$qy)){
            $message = "add successfully";

            echo "<SCRIPT type='text/javascript'> //not showing me this
                alert('$message');
                window.location.replace(\"http://localhost/artgallery/gallery/home.php\");
            </SCRIPT>";
          }
        }else{
            $qy="insert into products (photo,user_name,user_id,title,width,height,medium,price,agree,sell,created_date) values
            ('$target_path','$username',$userid,'$title',$width,$height,$medium,$price,$agree,1,now())";
          if( mysqli_query($conn,$qy)){
            $message = "add successfully";

            echo "<SCRIPT type='text/javascript'> //not showing me this
                alert('$message');
                window.location.replace(\"http://localhost/artgallery/gallery/home.php\");
            </SCRIPT>";
          }
        }
    }

}

if(isset($_POST['auctionproduct'])){
  $userid = $_POST['userid'];
  $username = $_POST['username'];
  $title = $_POST['title'];
  $width = $_POST['width'];
  $height = $_POST['height'];
  $medium = $_POST['medium'];
  $price = $_POST['price'];
  $agree = $_POST['agree'];
  $date = $_POST['date'];
  $hour = $_POST['hour'];
  $min = $_POST['min'];
  $target_path = "products/";
  $target_path = $target_path.basename($_FILES['photo']['name']);

  if(move_uploaded_file($_FILES['photo']['tmp_name'], $target_path)){
   
          $qy="insert into auction_products (photo,user_name,user_id,title,width,height,medium,price,agree,day,hour,minute,created_date) values
          ('$target_path','$username',$userid,'$title',$width,$height,$medium,$price,$agree,'$date',$hour,$min,now())";
        if( mysqli_query($conn,$qy)){
          $message = "add successfully";

          echo "<SCRIPT type='text/javascript'> //not showing me this
              alert('$message');
              window.location.replace(\"http://localhost/artgallery/gallery/auctionlist.php\");
          </SCRIPT>";
      
      }
  }

}
?>