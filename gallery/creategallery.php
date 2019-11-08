<?php
session_start();
require_once('../admin/config/db.php');
$username = $_COOKIE['username'];
$userid = $_COOKIE['userid'];

if(isset($_POST['creategallery'])){
    $user_id = $_POST['user_id'];
    $gallery = "select * from galleries";
    $result = $conn->query($gallery);
    while($row = $result->fetch_assoc()){
        if($row['user_id']==$user_id){
            $message = "you have alerady created gallery in last day ";

            echo "<SCRIPT type='text/javascript'> //not showing me this
                alert('$message');
                window.location.replace(\"http://localhost/artgallery/gallery/gallery.php\");
            </SCRIPT>";

            break;
        }
                 
    }
}
?>
        
<!DOCTYPE html>
<html lang="en">
<head>
    <?php
        require_once('../headerlink/headerlink.php')
    ?>
    <link rel="stylesheet" type="text/css" href="css/creategallery.css">
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
   <div class="container">
       <div class="row top">
           <div class="col-sm-6">
               <!-- <h4 style="color:#0484B4">Add Product</h4> -->
               <form action="addgallery.php" method="post" enctype="multipart/form-data" upload_max_filesize = "5000M">
                    <input type="hidden" name="userid" value="<?php echo $userid ?>">
                    <input type="hidden" name="username" value="<?php echo $username ?>">
                    <div class="form-group">
                        <label for="image">Add Image</label>
                        <input type="file" name="photo" class="form-control" required id="profile-img" style="background:#DBE4EA;text-align:left">
                        
                        <img src="" id="profile-img-tag" width="200px" style="margin-top:5px"/>
                      
                    </div>
                    <div class="form-group">
                        <label for="title">Title</label>
                        <input type="text" name="title"  class="form-control" placeholder="enter image title"  required>
                    </div>
                    <div class="form-group wh">
                        <div class="col-sm-6">
                            <label for="width">Width</label>
                            <input type="number" name="width"  class="form-control" min=0 required>
                        </div>
                        <div class="col-sm-6">
                            <label for="height">Height</label>
                            <input type="number" name="height"  class="form-control" min=0 required>
                        </div>
                    </div>
                    <div class="fomr-group">
                        <label for="medium" class="med">Medium</label>
                        <select name="medium" class="form-control form-group">
                            <option value="" hidden>Choose image medium</option>
                            <option value="1">Water Color</option>
                            <option value="2">Oil</option>
                            <option value="3">Glass</option>
                            <option value="4">Ink Wash</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="price">Price</label>
                        <input type="number" name="price" class="form-control" placeholder="if you want to sell add price">
                    </div>
                   
                   
                    <button class="btn btn-sm btn-primary form-control add_gallery" type="submit" name="product">Add</button>
               </form>
           </div>
           <div class="col-sm-6" id="g" style="display:none">
                <div class="row" style="margin-top:50px">
                    <b><i>You should add at least 5 photos to create gallery</i></b>
                </div>
                <br/>
                <div class="row">
                
                    <?php
                        $q = "select * from create_galleries";
                        $result = $conn->query($q);
                        if ($result->num_rows > 0) {
                        while($row = $result->fetch_assoc()) {
                            if($row['user_id'] !==$userid){

                            }else{
                               $creategallery_userid =  $_SESSION['user_id']=$row['user_id'];
                     ?>
                            <div class="col-sm-4 col-lg-4 col-md-4">
                                <img src="<?php echo $row['photo'] ?>" alt="image" width="150" height="150" style="margin-bottom:20px">
                            </div>
                            <script>
                                document.getElementById('g').style.cssText="display:block";
                                
                            </script>
                    <?php  
                                
                            }
                        }
                        }
                    ?>
                     <div class="col-sm-12">
                        <form action="addgallery.php" method="post">
                            <input type="hidden" name="user_id" value="<?php echo $creategallery_userid ?>">
                             <div class="form-group">
                            <br/>
                            <input type="checkbox" name="agree" value="1" required style="width:20px"> Do you agree with our service
                            </div>
                            <button class="btn btn-sm btn-primary form-control ok_btn" type="submit" name="create_delete">Ok</button>
                        </form>
                        <form action="deletegallery.php" method="post">
                            <input type="hidden" name="user_id" value="<?php echo $creategallery_userid ?>">
                             <div class="form-group">
                            <br/>
                            
                            <button class="btn btn-sm btn-danger form-control cancel_btn" type="submit" name="delete_gallery">Cancel</button>
                        </form>
                        
                    </div>
                </div>
               
            <!-- <button class="btn btn-lg btn-primary" onclick='myfun()' id="del">OK</button> -->
               
        </div>
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
 
