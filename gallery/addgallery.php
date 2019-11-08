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
    $target_path = "gallery/";
    $target_path = $target_path.basename($_FILES['photo']['name']);

    if(move_uploaded_file($_FILES['photo']['tmp_name'], $target_path)){
        if($price==''){
            $gallery="insert into galleries (photo,user_name,user_id,title,width,height,medium,price,created_date) values
          ('$target_path','$username',$userid,'$title',$width,$height,$medium,0,now())";
          if( mysqli_query($conn,$gallery)){
            $create_gallery="insert into create_galleries (photo,user_id,title,width,height,medium,price,created_date) values
            ('$target_path',$userid,'$title',$width,$height,$medium,0,now())";
             if(mysqli_query($conn,$create_gallery)){
                $message = "add one product to your gallery";

                echo "<SCRIPT type='text/javascript'> //not showing me this
                    alert('$message');
                    window.location.replace(\"http://localhost/artgallery/gallery/creategallery.php\");
                </SCRIPT>";
             }
          }
        }else{
            $gallery="insert into galleries (photo,user_name,user_id,title,width,height,medium,price,created_date) values
            ('$target_path','$username',$userid,'$title',$width,$height,$medium,$price,now())";
          if( mysqli_query($conn,$gallery)){
            $create_gallery="insert into create_galleries (photo,user_id,title,width,height,medium,price,created_date) values
            ('$target_path',$userid,'$title',$width,$height,$medium,$price,now())";
            if(mysqli_query($conn,$create_gallery)){
                $message = "add one product to your gallery";

                echo "<SCRIPT type='text/javascript'> //not showing me this
                    alert('$message');
                    window.location.replace(\"http://localhost/artgallery/gallery/creategallery.php\");
                </SCRIPT>";
            }
          }
        }
    }

}

if(isset($_POST['create_delete'])){
    $user_id = $_POST['user_id'];
    $agree = $_POST['agree'];
    $q = "select * from create_galleries where user_id=$user_id";
    $result = $conn->query($q);
    if ($result->num_rows < 5) {
        
        $message = "You should add at least 5 photos to create gallery";

        echo "<SCRIPT type='text/javascript'> //not showing me this
            alert('$message');
            window.location.replace(\"http://localhost/artgallery/gallery/creategallery.php\");
        </SCRIPT>";
    }else{
        $delete = "delete from create_galleries where user_id='$user_id'";
        if(mysqli_query($conn,$delete)){
            $update = "update galleries set agree=$agree where user_id=$user_id";
            mysqli_query($conn,$update);

            echo "<SCRIPT type='text/javascript'> //not showing me this
               
                window.location.replace(\"http://localhost/artgallery/gallery/userprofile.php\");
            </SCRIPT>";
        } 
    }
}
?>
 