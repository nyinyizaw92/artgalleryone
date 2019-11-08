<?php 
    session_start();
    error_reporting(E_ALL);
    ini_set('display_errors', 1);
    require_once('../admin/config/db.php');
    $username = $_COOKIE['username'];
    $useremail = $_COOKIE['useremail'];
    $userid = $_COOKIE['userid'];

    if(isset($_POST['save'])){
    $product_price = $_POST['product_price'];
    $buyer_id = $_POST['buyer_id'];
    $seller_id = $_POST['seller_id'];
    $product_id = $_POST['product_id'];
    $buyer_name = $_POST['buyer_name'];
    $seller_name = $_POST['seller_name'];
    $seller_phone = $_POST['seller_phone'];
    $product_photo = $_POST['product_photo'];
    $auction_price = $_POST['price'];
    $user_id = $_POST['user_id'];
    
        if($buyer_id == $userid){
            if($auction_price < $product_price){
                echo "<SCRIPT type='text/javascript'> //not showing me this
                    alert('$message');
                    window.location.replace(\"http://localhost/artgallery/gallery/auctiontime.php?id=$user_id && product_id=$product_id\");
                </SCRIPT>";
            }else{
                $data = "select coin,user_id from user_coins where user_id=$userid";
                $result = mysqli_query($conn,$data);
                $num = mysqli_num_rows($result);
                $result = $conn->query($data);
                if($num ==1){
                    while($row = $result->fetch_assoc()){
                        if($row['coin'] >= $product_price && $row['coin'] >= $auction_price){
                            $insert_user = "insert into acution_times(buyer_name,seller_name,product_price,auction_price,product_photo,product_id,seller_phone,seller_id) values
                            ('$buyer_name','$seller_name',$product_price,$auction_price,'$product_photo','$product_id','$seller_phone',$seller_id)";
                            mysqli_query($conn,$insert_user);
                            $leftcoin = $row['coin'] - $auction_price;
                            $update_buyer = "update user_coins set coin=$leftcoin where user_id=$userid";
                            mysqli_query($conn,$update_buyer);
                            
                            $message = 'wait until auction time complete';
                
                            echo "<SCRIPT type='text/javascript'> //not showing me this
                                alert('$message');
                                window.location.replace(\"http://localhost/artgallery/gallery/auctiontime.php?id=$user_id && product_id=$product_id\");
                            </SCRIPT>";
                            
                        }else{
                            $message = 'you have not enough money please fill your bill';
                
                            echo "<SCRIPT type='text/javascript'> //not showing me this
                                alert('$message');
                                window.location.replace(\"http://localhost/artgallery/gallery/userprofile.php\");
                            </SCRIPT>";
                        
                        }
                    }
                }else{  //user_coin have no record
                    $message = 'you have no money please fill your bill';
                
                    echo "<SCRIPT type='text/javascript'> //not showing me this
                        alert('$message');
                        window.location.replace(\"http://localhost/artgallery/gallery/userprofile.php\");
                    </SCRIPT>";
                }
            }
           
        }elseif($buyer_id !== $userid){
            $message = 'user emial incorrect try again';
            
            echo "<SCRIPT type='text/javascript'> //not showing me this
                alert('$message');
                window.location.replace(\"http://localhost/artgallery/gallery/\");
            </SCRIPT>";
         }
    }

?>