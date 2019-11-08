<?php
    session_start();
    require_once('../admin/config/db.php');
    $buyerid = $_COOKIE['userid'];
    $buyer_name = $_COOKIE['username'];
    $userid = $_GET['id'];
    $productid = $_GET['product_id'];

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <?php
        require_once('../headerlink/headerlink.php');
        $url = "http://localhost/artgallery/gallery/auctionwin.php?id=$productid";
    ?>
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
     <meta http-equiv="refresh" content="15">
    <link rel="stylesheet" type="text/css" href="css/auctiontime.css">
    <script src="https://code.jquery.com/jquery-3.4.1.js"
        integrity="sha256-WpOohJOqMqqyKL9FccASB9O0KwACQJpFTUBLTYOVvVU="
        crossorigin="anonymous"></script>
    <style>
        .img-magnifier-container {
        position:relative;
        }

        .img-magnifier-glass {
        position: absolute;
        border: 1px solid #000;
        border-radius: 50%;
        cursor: none;
        /*Set the size of the magnifier glass:*/
        width: 100px;
        height: 100px;
        margin-top:20px;
        margin-left:45px
        }
    </style>
   <script>
        function magnify(imgID, zoom) {
        var img, glass, w, h, bw;
        img = document.getElementById(imgID);
        /*create magnifier glass:*/
        glass = document.createElement("DIV");
        glass.setAttribute("class", "img-magnifier-glass");
        /*insert magnifier glass:*/
        img.parentElement.insertBefore(glass, img);
        /*set background properties for the magnifier glass:*/
        glass.style.backgroundImage = "url('" + img.src + "')";
        glass.style.backgroundRepeat = "no-repeat";
        glass.style.backgroundSize = (img.width * zoom) + "px " + (img.height * zoom) + "px";
        bw = 3;
        w = glass.offsetWidth / 2;
        h = glass.offsetHeight / 2;
        /*execute a function when someone moves the magnifier glass over the image:*/
        glass.addEventListener("mousemove", moveMagnifier);
        img.addEventListener("mousemove", moveMagnifier);
        /*and also for touch screens:*/
        glass.addEventListener("touchmove", moveMagnifier);
        img.addEventListener("touchmove", moveMagnifier);
        function moveMagnifier(e) {
            var pos, x, y;
            /*prevent any other actions that may occur when moving over the image*/
            e.preventDefault();
            /*get the cursor's x and y positions:*/
            pos = getCursorPos(e);
            x = pos.x;
            y = pos.y;
            /*prevent the magnifier glass from being positioned outside the image:*/
            if (x > img.width - (w / zoom)) {x = img.width - (w / zoom);}
            if (x < w / zoom) {x = w / zoom;}
            if (y > img.height - (h / zoom)) {y = img.height - (h / zoom);}
            if (y < h / zoom) {y = h / zoom;}
            /*set the position of the magnifier glass:*/
            glass.style.left = (x - w) + "px";
            glass.style.top = (y - h) + "px";
            /*display what the magnifier glass "sees":*/
            glass.style.backgroundPosition = "-" + ((x * zoom) - w + bw) + "px -" + ((y * zoom) - h + bw) + "px";
        }
        function getCursorPos(e) {
            var a, x = 0, y = 0;
            e = e || window.event;
            /*get the x and y positions of the image:*/
            a = img.getBoundingClientRect();
            /*calculate the cursor's x and y coordinates, relative to the image:*/
            x = e.pageX - a.left;
            y = e.pageY - a.top;
            /*consider any page scrolling:*/
            x = x - window.pageXOffset;
            y = y - window.pageYOffset;
            return {x : x, y : y};
        }
        }
    </script>
</head>
<body style="background-color:#DBE4EA">


    <div class="container-fluid">
        <div class="row" style="margin-top:20px;margin-left:25px">
          
                <a href="auctionlist.php"><button class="btn btn-danger btn-sm">Back</button></a>
            
        </div>
        <div class="row">
            <div class="col-sm-6">
                <div class="row">
                    <?php
                    $q = "select * from user_registers where id=$userid";
                    $result = $conn->query($q);
                    if ($result->num_rows > 0) {
                        while($row = $result->fetch_assoc()) {
                            $seller_id = $_SESSION['id'] = $row['id'];
                            $seller_name = $_SESSION['username'] = $row['username'];
                            $seller_phone = $_SESSION['phone'] = $row['phone'];
                        ?>
                        <div class="col-sm-2"><h6>Artists</h6></div>
                        <div class="col-sm-10"> <h6> : <?php echo $row['username'] ?></h6></div>
                        <?php
                        }
                    }
                    ?>
                    <?php
                        $q = "select * from auction_products where sha1(id)='$productid'";
                        $result = $conn->query($q);
                            if ($result->num_rows > 0) {
                                while($row = $result->fetch_assoc()) {
                                    $product_price = $_SESSION['price'] = $row['price'];
                                    $product_photo = $_SESSION['photo'] = $row['photo'];
                                    $hour = $row['hour'];
                                    $minute = $row['minute'];
                                    $date = $row['day'];
                                    $second = 0;
                                    $time = $hour.":".$minute.":".$second;
                                    $auction_times = $_SESSION['time'] = $auction_time = $date." ".$time;
                                    ?>
                                    <div class="col-sm-2"><h6>Title</h6></div>
                                    <div class="col-sm-10"><h6> : <?php echo $row['title'] ?></h6></div>
                                    <div class="col-sm-2"><h6>Width</h6></div>
                                    <div class="col-sm-10"><h6> : <?php echo $row['width'] ?> ' </h6></div>
                                    <div class="col-sm-2"><h6>Height</h6></div>
                                    <div class="col-sm-10"><h6> : <?php echo $row['height'] ?> ' </h6></div>
                                    <div class="col-sm-2"><h6>Medium</h6></div>
                                    <div class="col-sm-10"><h6> : 
                                        <?php 
                                            if($row['medium']==1){
                                                echo 'Water Color';
                                            }elseif($row['medium']==2){
                                                echo 'Oil Painting';
                                            }elseif($row['medium']==3){
                                                echo 'Glass Painting';
                                            }elseif($row['medium']==4){
                                                echo 'Ink Wash';
                                            }
                                        ?>
                                        
                                    </h6></div>
                                    <div class="col-sm-2"><h6>Price</h6></div>
                                    <div class="col-sm-10"><h6> : <?php echo $row['price'] ?> MMK</h6></div>
                                    <div class="col-sm-12 img-magnifier-container">
                                        <img src="<?php echo $row['photo']?>" alt="image" class="detailimage" id="myimage" >
                                        <!-- <div id="myresult" class="img-zoom-result" style="display:none"></div> -->
                                        <!-- <span id="glass"></span> -->
                                    </div>
                                    <?php
                                }
                            }
                    ?>
                </div>
                
            </div>
            <?php
            if( $_SESSION['price'] == 0){

            }else{
                ?>
                <div class="col-sm-4">
                   <h2><span id="demo"></span></h2>
                   <script>
                                var date = "<?php echo $auction_times ?>";
                                var deadline = new Date(date).getTime(); 
                                var x = setInterval(function() { 
                                var now = new Date().getTime(); 
                                var t = deadline - now; 
                                var days = Math.floor(t / (1000 * 60 * 60 * 24)); 
                                var hours = Math.floor((t%(1000 * 60 * 60 * 24))/(1000 * 60 * 60)); 
                                var minutes = Math.floor((t % (1000 * 60 * 60)) / (1000 * 60)); 
                                var seconds = Math.floor((t % (1000 * 60)) / 1000); 
                                //document.getElementById("demo").innerHTML = days + "d "  
                                //document.getElementById("demo").innerHTML =  hours + "h " + minutes + "m " + seconds + "s "; 
                                document.getElementById("demo").innerHTML =  "Time Left : " +minutes + "m " + seconds + "s "; 
                                    if (t < 0) { 
                                        clearInterval(x); 
                                        document.getElementById("demo").innerHTML = "EXPIRED"; 
                                        var str =document.getElementById("demo").textContent;  
                                        if(str=="EXPIRED"){
                                            var url ="<?php echo $url ?>"
                                            window.location.replace(url);
                                        }
                                    } 
                                }, 1000); 

                            </script>
                 <div class="auction_user">
                <?php
                  $q = "select * from acution_times where product_id='$productid' order by auction_price desc";
                  $result = $conn->query($q);
                      if ($result->num_rows > 0) {
                          while($row = $result->fetch_assoc()) {
                            ?>
                            <div class="row">
                                <div class="col-sm-4 bit_name"><?php
                                  if($row['buyer_name'] == $buyer_name){ 
                                      echo 'you bit ';
                                    } else{
                                        echo $row['buyer_name'];
                                    }
                                    ?>
                            </div>
                             <div class="col-sm-6 bit_price"><br/><?php echo $row['auction_price'] ?> MMK</div>
                            </div>
                            <?php
                          }
                        }
                ?>
                 </div>
                 <div class="auctionform">
                 <form action="checkauction.php" method="post">
                    <input type="hidden" name="product_price" value="<?php echo $product_price ?>">
                    <input type="hidden" name="seller_name" value="<?php echo $seller_name ?>">
                    <input type="hidden" name="buyer_name" value="<?php echo $buyer_name?>">
                    <input type="hidden" name="product_photo" value="<?php  echo $product_photo ?>">
                    <input type="hidden" name="seller_id" value="<?php echo $seller_id ?>">
                    <input type="hidden" name="buyer_id" value="<?php echo $buyerid?>">
                    <input type="hidden" name="product_id" value="<?php  echo $productid ?>">
                    <input type="hidden" name="seller_phone" value="<?php  echo $seller_phone ?>">
                    <input type="hidden" name="user_id" value="<?php echo $userid ?>">
                    <label for="price">Price : </label> <input type="number" name="price" required>
                    <input type="submit" name="save" value="Auction" class="btn btn-primary btn-xs" id="btn">
                 </form>
                  
                </div>
                </div>
               
                <?php
            }
            ?>
        </div>
    </div>

    <script>
        magnify("myimage", 3);
    </script>

</body>
</html>