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

    <link rel="stylesheet" type="text/css" href="css/paintingtype.css">
    <link rel="stylesheet" type="text/css" href="css/profile.css">
</head>
<body style="background-color:#DBE4EA">
    <div class="container-fluid header">
        <div class="row">
            <div class="col-lg-12">
               <?php include_once('nav.php') ?>
            </div>
        </div>
    </div>
   <div class="container-fluid body">
   <div class="row">
        <?php
            $q = "select * from products";
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
                    if($medium ==2 ){
                    ?>
                    <div class="col-sm-3">
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
                                            <a style="text-decoration:none;color:black"
                                            href="#">Ordered</a>
                                        </button>
                                        <?php
                                    }else{
                                        ?>
                                        <button class="btn btn-info btn-sm">
                                            <a style="text-decoration:none;color:black"
                                            href="detail.php?id=<?php echo $user_id?> && product_id=<?php echo $product_id ?>">Details</a>
                                        </button>
                                        <?php
                                    }
                                    
                                }else{
                                    
                                }
                            ?>
                        </figcaption>
                    </figure>
                </div>
                    <?php
                    }  
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