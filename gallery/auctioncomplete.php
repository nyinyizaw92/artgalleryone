<?php
    session_start();
    require_once('../admin/config/db.php');
    $username = $_COOKIE['username'];
    $userid = $_COOKIE['userid'];

 if(isset($_POST['complete'])){
     $buyer_name = $_POST['buyer_name'];
     $seller_name = $_POST['seller_name'];
     $product_photo = $_POST['product_photo'];
     $product_id = $_POST['product_id'];
     $seller_phone = $_POST['seller_phone'];
     $auction_price = $_POST['auction_price'];
    $phone = preg_replace('/^0/','+95',$_POST['phone']);
    $address = $_POST['address'];

    $insert_user = "insert into sell_auctions(buyer_name,seller_name,product,product_id,phone,seller_phone,address,product_price,created_date) values
    ('$buyer_name','$seller_name','$product_photo','$product_id','$phone','$seller_phone','$address',$auction_price,now())";
    $conn->set_charset("utf8");
    mysqli_query($conn,$insert_user);
   
    $data = "select coin,user_id from user_coins where user_id=$seller_id";
    $result = mysqli_query($conn,$data);
    $num = mysqli_num_rows($result);
     $result = $conn->query($data);
    if($num ==1){
       
        while($row = $result->fetch_assoc()){
            $addcoin = $row['coin']+$auction_price;
            $update_seller = "update user_coins set coin=$addcoin where user_id=$seller_id";
            mysqli_query($conn,$update_seller);
            $update_product = "update auction_products set sell=1 where sha1(id)='$product_id'";
            mysqli_query($conn,$update_product);
            $delete = "delete from acution_times where product_id='$product_id'";
            mysqli_query($conn,$delete);
            $message = 'Thank You So Much';

            echo "<SCRIPT type='text/javascript'> //not showing me this
                alert('$message');
                window.location.replace(\"http://localhost/artgallery/gallery/auctionlist.php\");
            </SCRIPT>";
        }
    }else{ //if seller id doesn't already exit
        $inser_coin = "insert into user_coins (user_id,coin,created_date) values
        ($seller_id,$auction_price,now())";
        mysqli_query($conn,$inser_coin);

        $update_product = "update auction_products set sell=1 where sha1(id)='$product_id'";
        mysqli_query($conn,$update_product);

        $delete = "delete from acution_times where product_id='$product_id'";
        mysqli_query($conn,$delete);
        
        $message = 'Thank You So Much';

        echo "<SCRIPT type='text/javascript'> //not showing me this
            alert('$message');
            window.location.replace(\"http://localhost/artgallery/gallery/auctionlist.php\");
        </SCRIPT>";
    }
}

?>