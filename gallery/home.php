<?php
    session_start();
    require_once('../admin/config/db.php');
    $username = $_COOKIE['username'];
    $userid = $_COOKIE['userid'];
  
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <?php
        require_once('../headerlink/headerlink.php')
    ?>
   <link href="https://fonts.googleapis.com/css?family=Luckiest+Guy&display=swap" rel="stylesheet">
   <link href="https://fonts.googleapis.com/css?family=Satisfy&display=swap" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="css/home.css">
    <link rel="stylesheet" type="text/css" href="css/map.css">
    <!-- <meta http-equiv="refresh" content="10"> -->
</head>
<body>
<div class="row">
            <div class="col-lg-12">
               <?php include_once('nav.php') ?>
            </div>
        </div>
   <div class="img1">
       <!-- <div>
            <nav class="navbar navbar-expand-sm navbar-light">
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="nav navbar-nav ml-auto main-nav animated slideInDown" id="check-click">
                        <li class="nav-item">
                            <a class="nav-link" href="home.php" style="color:white">Home</a>
                        </li>
                        <li class="nav-item dropdown">
                            <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">Painting <b class="caret"></b></a>
                            <ul class="dropdown-menu">
                            <li><a href="addproduct.php" class="paint">Add Product</a></li>
                            <li><a href="watercolor.php" class="paint">Water Colour Painting</a></li>
                            <li><a href="oilpainting.php" class="paint">Oil Painting</a></li>
                            <li><a href="glasspainting.php" class="paint">Glass Painting</a></li>
                            <li><a href="inkwash.php" class="paint">Ink Wash Painting</a></li>
                            </ul>
                        </li>   
                        <li class="nav-item">
                            <a class="nav-link" href="gallery.php">Gallery</a>
                        </li>
                        <li class="nav-item">   
                            <a class="nav-link" href="userprofile.php">Profile</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="logout.php">Logout</a>
                        </li>
                    </ul>
                    <a href="#" class="mobile-icon"  onclick="slideshow()"><i class="fa fa-bars"></i></a>
                </div>
            </nav>
       </div> -->
        <div class="ptext">
			<span class="border">
                <h3>Art Gallery</h3>
                <h5><a href="profile.php" class="profile">Welcome,<?php echo $username ?></a></h5>
                <br/>
                <div class="container">
                    <div class="row">
                    <div class="col-sm-3">
                        <figure>
                            <img src="https://images.saatchiart.com/saatchi/720911/art/3839282/2909165-AZEKBSMT-6.jpg" alt="image" class="sample spin">  
                            <figcaption>Water color painting</figcaption>
                        </figure>
                    </div>
                    <div class="col-sm-3">
                        <figure>
                            <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSUyKcUPy4M1M38EuIYTI-wRcJbqj9ZnnJqCG-gN6s0ZlTD2yu7" 
                        alt="image" class="sample spin1">
                        <figcaption>Oil painting</figcaption> 
                        </figure>
                    </div>
                    <div class="col-sm-3">
                        <figure>
                            <img src="https://i.ytimg.com/vi/XWkP207B174/maxresdefault.jpg" alt="image" class="sample">
                            <figcaption>Glass painting</figcaption>
                        </figure>
                    </div>
                    <div class="col-sm-3">
                        <figure>
                            <img src="https://images-na.ssl-images-amazon.com/images/I/81ASQU00yUL._SY500_.jpg" alt="image" class="sample">
                            <figcaption>Ink Wash painting</figcaption>
                        </figure>
                    </div>
                    </div>
                </div>
			</span>
        </div>
   </div>
   <section class="section section-light">
		<h2>Our Team Services</h2>
		<p>
			Welcome to art gallery website.You can buy or sell your 
            painting and show your painting scale here without tired.Our team service include phone service and home delivery 
            service.If you want to sell your painting product you can post.And someone buy your product we will call you who 
            buyed your product.At that time we will come to you and bring your painting product.Product charges are already add your bank 
            account.But you should pay as delivery fee that is based on where you lived.But if you buy some painting products from
            website that you like you don't need to pay delivery fee when we give you the product that you had buyed.Notice that
            your bank account should have enough money when you buy product.Thank you!Have a grate day.
		</p> 
	</section>
   <div class="img2">
        <div class="ptext currentinfo">
            <div class="container">
                <div class="row">
                <?php
                    $q = "select * from products limit 3";
                    $result = $conn->query($q);
    
                    if ($result->num_rows > 0) {
                        while($row = $result->fetch_assoc()) {
                            $product_id=$row['id'];
                            $user_id = $row['user_id']; 
                            $title=$row['title'];
                            $medium=$row['medium'];
                            $width=$row['width'];
                            $height=$row['height'];
                            $sell = $row['sell'];
                            ?>
                            <div class="col-sm-4">
                            <figure>
                                <img src="<?php echo $row['photo'] ?>" alt="image" class="currentimage">
                                <figcaption class="fig">
                                    title : <i><?php echo $title ?></i><br/>
                                    Medium : 
                                        <i><?php 
                                               if($medium==1){
                                                   echo 'Water Color';
                                               }elseif($medium==2){
                                                   echo 'Oil Painting';
                                               }elseif($medium==3){
                                                   echo 'Glass Painting';
                                               }elseif($medium==4){
                                                   echo 'Ink Wash';
                                               }
                                            ?>
                                        </i><br/>
                                    width : <i><?php echo $width ?>'</i><br/>
                                    height : <i><?php echo $height ?>'</i><br/>
                                    <?php
                                        if($user_id !== $userid){
                                            if($sell==1){
                                                ?>
                                                <button class="btn btn-danger btn-sm">
                                                    <a style="text-decoration:none;color:black;cursor:not-allowed"
                                                    href="#" >Ordered</a>
                                                </button>
                                                <?php
                                            }else{
                                                ?>
                                                <button class="btn btn-info btn-sm">
                                                    <a style="text-decoration:none;color:black"
                                                    href="detail.php?id=<?php echo $user_id?> && product_id=<?php echo sha1($product_id) ?>">Details</a>
                                                </button>
                                                <?php
                                            }
                                           
                                        }else{
                                            if($sell==1){
                                                ?>
                                                <button class="btn btn-danger btn-sm">
                                                    <a style="text-decoration:none;color:black;cursor:not-allowed"
                                                    href="#" >Ordered</a>
                                                </button>
                                                <?php
                                            }else{
                                            ?>
                                            <button class="btn btn-danger btn-sm">
                                            <a style="text-decoration:none;color:black"
                                            href="deleteproduct.php?id=<?php echo $user_id?> && product_id=<?php echo sha1($product_id) ?>">Delete</a>
                                        </button>
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
            </div>
            <br/>
            <a href="moreitems.php" id="moreitems" >Show More</a>
        </div>
   </div>
   <section class="section section-light">
		<h4>System Aggrements</h4>
		<p>
            Hello customers,we want to explain about our system aggrement.You should know our service and notice that 
            if you want to sell your product you don't need to pay that product to us.We believe that the product is yours
            and actually have you when you sell.But please inform us from feedback form if you had sold this to another person in any way after you
            posted to website.Or you may have trouble.That mean if someone buy your product from our website,we will deliver to you 
            to get that product.At that time if you don't have product how about tell our buyer customer who had been payed for fee.
            In that case you should return pay to us double price of the product.So notice that case after you posted.Be careful.
            We all trust you.
		</p> 
	</section>
   <div class="img3">
        <div class="ptext currentinfo">
            <div class="container-fluid">
                <div class="row">
                     <!-- google map api -->
                   
                    <div class="col-sm-5 feedback" >
                    <i style="font-family: 'Satisfy', cursive;">Feedback form</i><br/><br/>
                        <form action="feedback.php" method="post">
                            <input type="hidden" name="user_id" value="<?php echo $userid ?>">
                            
                            <div class="form-group">
                                <label for="useremail">Email</label>
                                <input type="email" name="useremail" class="form-control" placeholder="enter your email" minlength=8 required>
                            </div>
                            
                            <div class="form-group">
                                <label for="comment">Comments</label>
                                <textarea name="comment" id="comment" cols="30" rows="5" class="form-control"></textarea>
                            </div>
                            
                            <button class="btn btn-danger btn-md" name="feedback" type="submit">Submit</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
   </div>
</body>
<script>
    $('ul.nav li.dropdown').hover(function() {
    $(this).find('.dropdown-menu').stop(true, true).delay(0.1).fadeIn(500);
    }, function() {
    $(this).find('.dropdown-menu').stop(true, true).delay(0.1).fadeOut(500);
    });
</script>
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


</html>
