<?php
    session_start();
    require_once('../admin/config/db.php');

    if(isset($_COOKIE['userid'])){
        header('location:home.php');
    }else{
       
    
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <?php
        require_once('../headerlink/headerlink.php')
    ?>
    <link rel="stylesheet" type="text/css" href="css/index.css">
</head>
<body>
    <div class="container">
        <section id="banner">
            <button class="btn btn-sm btn-primary" id="loginone">Login</button> 
            <button class="btn btn-sm btn-info" id="register">Register</button>
        </section>
        <section id="signup">
            <form  action="user_register.php" method="post">
                <div class="form-group">
                    <label for="username">Username</label>
                    <input type="text" name="username"  class="form-control" placeholder="enter your name"  required>
                </div>
                
                <div class="form-group">
                    <label for="useremail">Email</label>
                    <input type="email" name="useremail" class="form-control" placeholder="enter your email"  required>
                </div>

                <div class="form-group">
                    <label for="usernrc">N.R.C</label>
                    <input type="text" name="usernrc"  class="form-control" placeholder="enter your nrc" required>
                </div>
                
                <div class="form-group">
                    <label for="userpassword">Password</label>
                    <input type="password" name="userpassword"  class="form-control" placeholder="enter your password" minlength=8 required>
                </div>
                
                <div class="form-group">
                    <label for="userconfirm_pass">Confirm Password</label>
                    <input type="password" name="userconfirm_pass"  class="form-control" placeholder="enter your confirm_pass" required>
                </div>
                
                <button class="btn btn-danger btn-md" name="register">Register</button>
            </form>
        </section>
        <section id="login" style="display:none">
            <form  action="user_register.php" method="post">
                <div class="form-group">
                    <label for="userlogin">Username</label>
                    <input type="text" name="userlogin"  class="form-control" placeholder="enter your name"  required>
                </div>
               
                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" name="password"  class="form-control" placeholder="enter your password" required>
                </div>

                <div class="form-group">
                    <label for="confirm_pass">Confirm Password</label>
                    <input type="password" name="confirm_pass"  class="form-control" placeholder="enter your confirm_pass" required>
                </div>
               
                <div class="form-group">
                    <label for="phone">Phone</label>
                    <input type="phone" name="phone" class="form-control" placeholder="enter your phone no" required>
                </div>
                <button class="btn btn-danger btn-md" name="login">Login</button>
            </form>
        </section>
       
        <section id="about">
            <div>
                <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
               
                <!-- Wrapper for slides -->
                <div class="carousel-inner">
                    <div class="carousel-item active">
                    <img class="d-block w-100" src="https://cdn.shopify.com/s/files/1/1130/7582/products/CHUBLA181222_620x.jpg?v=1559104479" data-color="lightblue" alt="First Image">
                    
                    </div>
                    <div class="carousel-item">
                    <img class="d-block w-100" src="https://cms.befunky.com/1c68afb2148e6ea85a6e733ebd32d0396ef23c08_pta-gouache.jpg?auto=format&fm=jpg&w=540&ixlib=js-1.2.1&s=bff613319310944c338f2cdac08a0510" data-color="firebrick" alt="Second Image">
                    
                    </div>

                    <div class="carousel-item">
                    <img class="d-block w-100" src=" https://previews.123rf.com/images/denyskuvaiev/denyskuvaiev1503/denyskuvaiev150300038/37612707-painting-of-venice-italy-painted-by-pencil.jpg" data-color="violet" alt="Third Image">
                    
                    </div>
                    <div class="carousel-item">
                    <img class="d-block w-100" src="https://i.etsystatic.com/10717004/r/il/02c544/1533712218/il_570xN.1533712218_bu1l.jpg" data-color="violet" alt="Third Image">
                    
                    </div>
                   
                </div>
                <p>
                    <span>A</span>rt gallery contains lot of painting art designs draw with different painting type.You can buy or sell your painting
                    products in our wetbsite.Plase reigster first and find painting that you want to buy or present your talent in here.
                </p>
            </div>
        </section>
    </div>
    <br/>
    <div class="container">
    <section class="section section-light">
		<h2>Our Team Services</h2>
		<p>
			Welcome to art gallery website.You can buy or sell your 
            painting and show your paintings her.Our team service include phone service and home delivery 
            service.If you want to sell your painting product you can post.And someone buy your product we will call you who 
            buyed your product.At that time we will come to you and bring your painting product.Product charges are already add your bank 
            account.But you should pay as delivery fee that is based on your location.But if you buy some painting products from
            website,you don't need to pay delivery fee when we give you the product that you had buyed.Notice that
            your bank account should have enough money when you buy product.Thank you!Have a grate day.
		</p> 
	</section>
    </div>

    <div class="container">
        <div class="row  product">
        <?php
            $q = "select * from products where sell!=1 limit 3";
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
                        <i> title : <?php echo $title ?></i><br/>
                        <i> Medium : 
                                <?php 
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
                                <i> width : <?php echo $width ?>'</i><br/>
                                <i> height : <?php echo $height ?>'</i><br/>
                            <?php
                                
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
                                            href="beforedetail.php?userid=<?php echo sha1($user_id) ?> && product_id=<?php echo sha1($product_id) ?>">Details</a>
                                        </button>
                                        <?php
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

    <div class="container">
    <section class="section section-light">
		<h4>System Agreements</h4>
		<p>
            Hello customers,we want to explain about our system aggrement.First we request you to register and login when you use or website.
            We allow you to buy or sell painting products.And also allow you to create gallery free.But you can create gallery at once time 
            before we delete your gallery after you had created.And you should know our service.
            If you want to sell your product you don't need to pay that product to us.We believe that the product is yours
            and actually have you when you sell.But please inform us from feedback form if you had sold this to another person in any way after you
            posted to website.Or you may have trouble.That mean if someone buy your product from our website,we will call to you 
            to get that product.At that time if you don't have product how about tell our buyer customer who had been payed for fee.
            In that case you should return pay to us double price of your product price.So notice before and after you posted.Be careful.
            We are trust you.
		</p> 
	</section>
    </div>
    <script>
        $( document ).ready(function() {
            $('#loginone').click(function(){
                $('#login').show(1,function(){
                    $('#signup').hide()
                })
            })
        });

        $( document ).ready(function() {
            $('#register').click(function(){
                $('#signup').show(1,function(){
                    $('#login').hide()
                })
            })
        });
    </script>
    
    <script>
        $('.carousel').carousel({
        interval: 6000,
        pause: "false"
        });
    </script>
</body>
</html>
<?php
    }
?>