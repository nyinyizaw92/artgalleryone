<?php
session_start();
require_once('../admin/config/db.php');
$username = $_COOKIE['username'];
$userid = $_COOKIE['userid']
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <?php
        require_once('../headerlink/headerlink.php')
    ?>
    <link rel="stylesheet" type="text/css" href="css/auctionlist.css">
    <script src="https://code.jquery.com/jquery-1.10.2.js"></script>
</head>
<body style="background-color:#DBE4EA">
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
               $q = "select * from auction_products";
               $result = $conn->query($q);
                $count = $result->num_rows;
               if ($result->num_rows > 0) {
                   while($row = $result->fetch_assoc()) {
                        $id = $row['id'];
                        $name = $row['user_name'];
                        $photo = $row['photo'];
                        $user_id = $row['user_id'];
                        $hour = $row['hour'];
                        $minute = $row['minute'];
                        $date = $row['day'];
                        $medium = $row['medium'];
                        $second = 0;
                        $time = $hour.":".$minute.":".$second;
                        $auction_time = $date." ".$time;
                        ?>
                        <div class="col-sm-4">
                            <div class="card middle">
                                <div class="front">
                                    <img src="<?php echo $photo ?>" alt="image" class="currentimage">
                                    
                                </div>
                                <div class="back">
                                <div class="back-content middle">
                                   <div class="sm">
                                   <b>Artists</b>  <i>:  <?php echo $name ?></i> <br/>
                                    <b>Title</b><i> :<?php echo $row['title'] ?></i><br/>
                                    <b>Medium</b> <i> : <?php 
                                            if($medium==1){
                                                echo 'Water Color';
                                            }elseif($medium==2){
                                                echo 'Oil Painting';
                                            }elseif($medium==3){
                                                echo 'Glass Painting';
                                            }elseif($medium==4){
                                                echo 'Ink Wash';
                                            }
                                        ?></i><br/>
                                    <b>Width</b>  <i> : <?php echo $row['width'] ?> '</i><br/>
                                    <b>Height</b>  <i> : <?php echo $row['height'] ?> '</i><br/>
                                    <b>Price</b> <i> : <?php echo $row['price'] ?> MMK</i>
                                  
                                    
                                    <!-- <script>
                                        var cou = "<?php echo $count ?>";
                                        var date = "<?php echo $auction_time ?>";
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
                                            } 
                                        }, 1000); 

                                    </script> -->
                                   </div>
                                </div>
                            </div>
                           
                            </div>
                            <div class="time">
                            <?php
                                        if($user_id !== $userid){
                                            if($row['sell']==1){
                                                ?>
                                                <button class="btn btn-danger btn-sm">
                                                    <a style="text-decoration:none;color:black;cursor:not-allowed"
                                                    href="#" >Ordered</a>
                                                </button>
                                                <?php
                                            }elseif($row['sell'] == 2){
                                                ?>
                                                <button class="btn btn-danger btn-sm">
                                                    <a style="text-decoration:none;color:black;cursor:not-allowed"
                                                    href="#" >Auction Time Up</a>
                                                </button>
                                                <?php
                                            }else{
                                                ?>
                                                <button class="btn btn-info btn-sm">
                                                    <a style="text-decoration:none;color:black"
                                                    href="auctiontime.php?id=<?php echo $user_id?> && product_id=<?php echo sha1($id) ?>">Time Left to buy</a>
                                                </button>
                                                <?php
                                            }
                                           
                                        }else{
                                           ?>
                                         <button class="btn btn-danger btn-sm">
                                            <a style="text-decoration:none;color:black"
                                            href="auctiontime.php?id=<?php echo $user_id?> && product_id=<?php echo sha1($id) ?>">Delete</a>
                                        </button>
                                           <?php
                                        }
                                    ?>
                              
                            </div>
                           
                        
                        </div>
                    <?php
                               
                   }
                }
            ?>  
        </div>
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
</body>
</html>