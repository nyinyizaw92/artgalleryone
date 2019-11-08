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
   
    <link rel="stylesheet" type="text/css" href="css/gallerypage.css">
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
    <div class="container-fluid">
            <br/>
            <div class="row">
                <div class="col-sm-12" style="text-align:right">
                <br/><br/>
                    <form action="creategallery.php" method="post">
                        <input type="hidden" value="<?php echo $userid ?>" name="user_id">
                        <button class="btn btn-sm btn-primary" type="submit" name="creategallery">Add Gallery</button>
                    </form>  
                </div>
            </div>
    </div>
   
    <div class="container">
        <div class="row gallery-img">
        <?php
            $gallery = "select * from galleries  where user_id!=$userid group by user_id";
            $result = $conn->query($gallery);
            while($row = $result->fetch_assoc()){
            //   if($row['user_id']==$userid){
                 
            //   }elseif($row['user_id']!==$userid){
                $title = $_SESSION['title'] = $row['title'];
                $price = $_SESSION['price'] = $row['price'];
                $userid=$_SESSION['userid']=$row['user_id'];
            ?>
             <div class="col-sm-3">
              
                <img src="<?php echo $row['photo'] ?>" alt="image" class="galleryimage"><br>
                <div class="col-sm-12">
                   <p>Title :  <?php echo $title ?></p>
                  <button class="btn btn-sm btn-info  more-gallery"><a href="detailgallery.php?id=<?php echo sha1($userid)?>">More Gallery</a></button>
                </div>
               
               
              </div>
            <?php   
              }
            //}
          
        ?>
        </div>
    </div>
   

   <script type="text/javascript">
        function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                
                reader.onload = function (e) {
                    $('#profile-img-tag').attr('src', e.target.result);
                }
                reader.readAsDataURL(input.files[0]);
            }
        }
        $("#profile-img").change(function(){
            readURL(this);
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
</body>
</html>