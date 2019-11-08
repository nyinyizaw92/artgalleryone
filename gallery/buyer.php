<?php 
    session_start();
    error_reporting(E_ALL);
    ini_set('display_errors', 1);
    require_once('../admin/config/db.php');
    $username = $_COOKIE['username'];
    $useremail = $_COOKIE['useremail'];
    $userid = $_COOKIE['userid'];

    if(isset($_POST['buy'])){
    $product_price = $_POST['product_price'];
    $name = $_POST['name'];
    $buyer_id = $_POST['buyer_id'];
    $seller_id = $_POST['seller_id'];
    $product_id = $_POST['product_id'];
    $buyer_name = $_POST['buyer_name'];
    $seller_name = $_POST['seller_name'];
    $seller_phone = $_POST['seller_phone'];
    $product_photo = $_POST['product_photo'];
    $email = $_POST['email'];
    $phone = preg_replace('/^0/','+95',$_POST['phone']);
    $address = $_POST['address'];
        if($buyer_id == $userid && $name==$username && $email==$useremail){
            $data = "select coin,user_id from user_coins where user_id=$userid";
            $result = mysqli_query($conn,$data);
            $num = mysqli_num_rows($result);
             $result = $conn->query($data);
            if($num ==1){
               
                while($row = $result->fetch_assoc()){
                    if($row['coin'] > $product_price || $row['coin'] == $product_price){
                        //insert into sell_products when buy
                        $insert_user = "insert into sell_products(buyer_name,seller_name,product,product_id,buyer_phone,seller_phone,address,price,created_date) values
                        ('$buyer_name','$seller_name','$product_photo','$product_id','$phone','$seller_phone','$address',$product_price,now())";

                        $conn->set_charset("utf8");
                        mysqli_query($conn,$insert_user);

                        //difference user coin and product price
                        $leftcoin = $row['coin'] - $product_price;
                        $update_buyer = "update user_coins set coin=$leftcoin where user_id=$userid";
                        mysqli_query($conn,$update_buyer);

                        $data = "select coin,user_id from user_coins where user_id=$seller_id";
                        $result = mysqli_query($conn,$data);
                        $num = mysqli_num_rows($result);
                         $result = $conn->query($data);
                        if($num ==1){   //if seller id already exit
                           
                            // while($row = $result->fetch_assoc()){
                                $addcoin = $row['coin']+$product_price;
                                $update_seller = "update user_coins set coin=$addcoin where user_id=$seller_id";
                                mysqli_query($conn,$update_seller);

                                $update_product = "update products set sell=1 where sha1(id)='$product_id'";
                                mysqli_query($conn,$update_product);

                                $message = 'You buy successfully.We will call you later';
            
                                echo "<SCRIPT type='text/javascript'> //not showing me this
                                    alert('$message');
                                    window.location.replace(\"http://localhost/artgallery/gallery/buyproductsave.php\");
                                </SCRIPT>";
                           // }
                        }else{ //if seller id doesn't already exit
                            $inser_coin = "insert into user_coins (user_id,coin,created_date) values
                            ($seller_id,$product_price,now())";
                            mysqli_query($conn,$inser_coin);

                            $update_product = "update products set sell=1 where sha1(id)='$product_id'";
                            mysqli_query($conn,$update_product);
                            
                            $message = 'You buy successfully.We will call you later';
        
                            echo "<SCRIPT type='text/javascript'> //not showing me this
                                alert('$message');
                                window.location.replace(\"http://localhost/artgallery/gallery/buyproductsave.php\");
                            </SCRIPT>";
                        }
                        
                       
                    }else{ //not enough bill 
                        $message = 'you have not enough money please fill your bill';
            
                        echo "<SCRIPT type='text/javascript'> //not showing me this
                            alert('$message');
                            window.location.replace(\"http://localhost/artgallery/gallery/userprofile.php\");
                        </SCRIPT>";
                    }
                }
            }else{   //new user and doesn't have money
                $message = 'you have no money please fill your bill';
            
                echo "<SCRIPT type='text/javascript'> //not showing me this
                    alert('$message');
                    window.location.replace(\"http://localhost/artgallery/gallery/userprofile.php\");
                </SCRIPT>";
            }
        }elseif($email!==$useremail){   //if user email is not equal 
            $message = 'user emial incorrect try again';
            
            echo "<SCRIPT type='text/javascript'> //not showing me this
                alert('$message');
                window.location.replace(\"http://localhost/artgallery/gallery/\");
            </SCRIPT>";
        }elseif($name!==$username){    //if usernme is not equal
            $message = 'user name incorrect try again';
            
            echo "<SCRIPT type='text/javascript'> //not showing me this
                alert('$message');
                window.location.replace(\"http://localhost/artgallery/gallery/\");
            </SCRIPT>";
        }
    }

    if(isset($_POST['reset'])){
        echo "<SCRIPT type='text/javascript'> //not showing me this
        window.location.replace(\"http://localhost/artgallery/gallery/moreitems.php\");
        </SCRIPT>";
    }
    
?>