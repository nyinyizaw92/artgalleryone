<?php
    session_start();
    require_once('../admin/config/db.php');
    $username = $_COOKIE['username'];
    $userid = $_COOKIE['userid'];
   


   
    
    $product_id = $_SESSION['id'] = $_GET['id'];
   $q = "select * from acution_times where product_id='$product_id' order by id desc limit 1";
   $result = $conn->query($q);
       if ($result->num_rows > 0) {
           while($row = $result->fetch_assoc()) {
                $buyer_name = $_SESSION['buyer'] = $row['buyer_name'];
                $seller_name = $_SESSION['seller'] = $row['seller_name'];
                $product_photo = $_SESSION['product_photo'] = $row['product_photo'];
                $auction_price = $_SESSION['price'] = $row['auction_price'];
                $product_id = $_SESSION['product_id'] = $row['product_id'];
                $seller_phone = $_SESSION['phone'] = $row['seller_phone'];
                $seller_id =$_SESSION['id'] = $row['seller_id'];
                ?>
           
<html lang="en">
<head>
    <?php
        require_once('../headerlink/headerlink.php')
    ?>
    <link rel="stylesheet" href="css/auctionwin.css">
</head>
<body>
       
        <div class="container">
            <div class="row">
            <?php
                if($buyer_name == $username){
                    ?>
                 <div class="col-sm-12">
                    <h6>You buyed this painting from <?php echo $seller_name ?> with <?php echo $auction_price ?>MMK</h6>
                    <p>Please screenshot this page before filling form.</p>

                    <img src="<?php echo $product_photo ?>" alt="image" class="auctionimage">

                    <form action="auctioncomplete.php" method="post">
                        <input type="hidden" name="buyer_name" value="<?php echo  $buyer_name ?>">
                        <input type="hidden" name="seller_name" value="<?php echo  $seller_name ?>">
                        <input type="hidden" name="product_photo" value="<?php echo  $product_photo ?>">
                        <input type="hidden" name="auction_price" value="<?php echo  $auction_price ?>">
                        <input type="hidden" name="product_id" value="<?php echo  $product_id ?>">
                        <input type="hidden" name="seller_phone" value="<?php echo  $seller_phone ?>">
                        <input type="hidden" name="seller_id" value="<?php echo  $seller_id ?>">
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" name="email" required class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="phone">Phone</label>
                            <input type="number" name="phone" required class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="address">Address</label>
                            <textarea name="address" id="address" cols="20" rows="5" class="form-control"></textarea>
                        </div>
                        <div class="form-group">
                            <button type="submit" name="complete" class="btn btn-primary btn-xs form-control">Submit</button>
                        </div>
                    </form>
                </div>
                    <?php
                }else{
                    ?>
                    <div class="col-sm-12">
                        <h6>This painting had got by <?php echo $buyer_name ?> with <?php echo $auction_price ?> MMK</h6>
                        <p>Gook luck next auction!</p>
                        <img src="<?php echo $product_photo ?>" alt="image" class="auctionimage">
                        <br/><br/>
                        <button class="btn btn-danger btn-sm" style="width:120px"><a href="auctionlist.php">Ok</a></button>
                    </div>
                    <?php
                }
            ?>
            </div>
        </div>
</body>
</html>

<?php

     
}
}else{
   
    //echo $product_id;

    $update_product = "update auction_products set sell=2 where sha1(id)='$product_id'";
    mysqli_query($conn,$update_product);

    echo "<SCRIPT type='text/javascript'> //not showing me this
        
        window.location.replace(\"http://localhost/artgallery/gallery/auctionlist.php\");
    </SCRIPT>";
}
?>

