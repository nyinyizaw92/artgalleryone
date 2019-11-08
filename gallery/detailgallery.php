<?php
session_start();
require_once('../admin/config/db.php');
$username = $_COOKIE['username'];
$userid = $_COOKIE['userid'];
$user_id = $_GET['id'];

$gallery = "select * from user_registers";
$result = $conn->query($gallery);
while($row = $result->fetch_assoc()){
  $userid = sha1($row['id']);
  if($userid==$user_id){
     $username = $_SESSION['username'] = $row['username'];
  }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <?php
        require_once('../headerlink/headerlink.php')
    ?>
    <link rel="stylesheet" type="text/css" href="css/detailgallery.css">
    <!-- <link rel="stylesheet" type="text/css" href="css/profile.css"> -->
</head>
<body>
<div class="container-fluid header">
    <div class="row">
        <div class="col-lg-12">
            <?php include_once('nav.php') ?>
        </div>
    </div>
</div>
<div class="container">
    <div class="row">
    <?php
        $gallery = "select * from galleries";
        $result = $conn->query($gallery);
        while($row = $result->fetch_assoc()){
            $gallery_userid = $_SESSION['user_id'] = $row['user_id'];
            $gallery_id = $_SESSION['id'] = $row['id'];
        $userid = sha1($row['user_id']);
        if($userid==$user_id){
           
            ?>
            <div class="col-sm-4">
                <figure>
                    <img src="<?php echo $row['photo'] ?>" alt="image" class="galleryimage">    
                    <figcaption>
                        <br/>
                        <p><b>Artist : <?php echo $username ?></b></p>
                        <p><b>Title : <?php echo $row['title'] ?></b></p>
                        <p><b>Width : <?php echo $row['width'] ?> ' </b></p>
                        <p><b>Height : <?php echo $row['height'] ?> ' </b></p>
                        <?php
                            if($row['price']==0){
                                echo "NOT FOR SALE";
                            }else{
                            ?>
                            <p><b>Price : <?php echo $row['price'] ?> MMK </b></p>
                            <?php
                            if($row['sell']==1){
                                ?>
                            
                            <button class="btn btn-danger btn-sm">
                                <a style="text-decoration:none;color:black"
                                href="#">Ordered</a>
                            </button>
                                <?php
                            }else{
                                ?>
                                 <a class="gallerydetail"
                                    href="gallerydetail.php?id=<?php echo $gallery_userid?> && product_id=<?php echo sha1($gallery_id) ?>">
                                        <button class="btn btn-sm btn-primary">Buy</button>
                                </a><br/>
                                <?php
                            }
                            }
                        ?>
                    </figcaption>
                </figure>
            </div>
            <?php
        }
        }
    ?>
    </div>
   
    <!-- <div class="row" id="buyerinfo" style="display:none">
        <div class="col-sm-6">
        <form action="buyer.php" method="post">
            <input type="hidden" name="product_price" value="<?php echo $product_price ?>">
            <input type="hidden" name="seller_id" value="<?php echo $seller_id ?>">
            <input type="hidden" name="buyer_id" value="<?php echo $buyerid?>">
            <input type="hidden" name="product_id" value="<?php  echo $productid ?>">
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" name="email" placeholder="enter your email" required class="form-control">
            </div>
            <div class="form-group">
                <label for="name">Name</label>
                <input type="text" name="name" placeholder="enter your name" required class="form-control">
            </div>
            <div class="form-group">
                <label for="phone">Phone no</label>
                <input type="phone" name="phone" placeholder="09.........145" required class="form-control">
            </div>
            <div class="form-group">
                <label for="address">Address</label>
                <textarea name="address" id="address" cols="30" rows="7" class="form-control"></textarea>
            </div>
            <div class="form-group">
                <button class="btn btn-primary form-control" type="submit" name="buy">Buy</button>
            </div>
            
        </form>
        <form action="buyer.php" method="post">
            <div class="form-group">
                <button class="btn btn-danger form-control" type="submit" name="reset">Cancel</button>
            </div>
        </form>
        </div>
    </div> -->
</div>
<script type="text/javascript">
	function slideshow(){
		var x = document.getElementById('check-click');
		if(x.style.display === "none"){
			x.style.display = "block";
		}else{
			x.style.display = "none";
		}
	}

</script>
<!-- <script>
    function buy(){
        document.getElementById('buyerinfo').style.cssText = "display:block"
    }
</script> -->
</body>
</html>