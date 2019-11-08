<?php 
    session_start();
    error_reporting(E_ALL);
    ini_set('display_errors', 1);
    require_once('../admin/config/db.php');
   

    if(isset($_POST['buy'])){
    $product_price = $_POST['product_price'];
    $name = $_POST['name'];
    $email = $_POST['email'];
    $seller_id = $_POST['seller_id'];
    $product_id = $_POST['product_id'];
    $seller_name = $_POST['seller_name'];
    $seller_phone = $_POST['seller_phone'];
    $product_photo = $_POST['product_photo'];
    $phone = preg_replace('/^0/','+95',$_POST['phone']);
    $address = $_POST['address'];
    $buyer = "select * from user_registers where username='$name' and email='$email'";
    // $result = mysqli_query($conn,$buyer);
    // while($row = $result->fetch_assoc()){
        $result = mysqli_query($conn,$buyer);
       $num = mysqli_num_rows($result);
       if($num==0){
        $message = 'usename or email does not exit';
            
            echo "<SCRIPT type='text/javascript'> //not showing me this
                alert('$message');
                window.location.replace(\"http://localhost/artgallery/gallery/index.php\");
            </SCRIPT>";
       }else if($num==1){
            while($row = $result->fetch_assoc())
            {
                 $buyer_name = $row['username'];
                 $buyer_email = $row['email'];
                 $userid =$_SESSION['id']=$row['id'];

                 $data = "select coin,user_id from user_coins where user_id=$userid";
                 $result = mysqli_query($conn,$data);
                 $num = mysqli_num_rows($result);
                  $result = $conn->query($data);
                 if($num ==1){
                    
                     while($row = $result->fetch_assoc()){
                         if($row['coin'] > $product_price || $row['coin'] == $product_price){
                             $insert_user = "insert into sell_products(buyer_name,seller_name,product,product_id,buyer_phone,seller_phone,address,price,created_date) values
                             ('$buyer_name','$seller_name','$product_photo','$product_id','$phone','$seller_phone','$address',$product_price,now())";
                             $conn->set_charset("utf8");
                             mysqli_query($conn,$insert_user);
                             $leftcoin = $row['coin'] - $product_price;
                             $update_buyer = "update user_coins set coin=$leftcoin where user_id=$userid";
                             mysqli_query($conn,$update_buyer);
                             $data = "select coin,user_id from user_coins where user_id=$seller_id";
                             $result = mysqli_query($conn,$data);
                             $num = mysqli_num_rows($result);
                              $result = $conn->query($data);
                             if($num ==1){
                                
                                 while($row = $result->fetch_assoc()){
                                     $addcoin = $row['coin']+$product_price;
                                     $update_seller = "update user_coins set coin=$addcoin where user_id=$seller_id";
                                     mysqli_query($conn,$update_seller);
                                     $update_product = "update products set sell=1 where sha1(id)='$product_id'";
                                     mysqli_query($conn,$update_product);
                                     $message = 'You buy successfully.We will call you later';
                 
                                     echo "<SCRIPT type='text/javascript'> //not showing me this
                                         alert('$message');
                                         window.location.replace(\"http://localhost/artgallery/gallery/buyproductsavebefore.php\");
                                     </SCRIPT>";
                                 }
                             }
                             
                            
                         }else{
                             $message = 'you have not enough money please fill your bill';
                 
                             echo "<SCRIPT type='text/javascript'> //not showing me this
                                 alert('$message');
                                 window.location.replace(\"http://localhost/artgallery/gallery/index.php\");
                             </SCRIPT>";
                         }
                     }
                 }else{
                     $message = 'you have no money please fill your bill';
                 
                     echo "<SCRIPT type='text/javascript'> //not showing me this
                         alert('$message');
                         window.location.replace(\"http://localhost/artgallery/gallery/index.php\");
                     </SCRIPT>";
                 }
            }       
        }

    //$conn->set_charset("utf8");
     
          
      
    }

    if(isset($_POST['reset'])){
        echo "<SCRIPT type='text/javascript'> //not showing me this
        window.location.replace(\"http://localhost/artgallery/gallery/index.php\");
        </SCRIPT>";
    }
    
?>