<?php
session_start();
$username = $_COOKIE['username'];
$userid = $_COOKIE['userid']
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <?php
        require_once('../headerlink/headerlink.php')
    ?>
    <link rel="stylesheet" type="text/css" href="css/addproduct.css">
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
       <div class="row">
           <div class="col-sm-6">
               <h4 style="color:#0484B4">Add Product</h4>
               <form action="product.php" method="post" enctype="multipart/form-data" upload_max_filesize = "5000M">
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
                    <div class="row wh">
                        <div class="col-sm-6 form-group">
                            <label for="width">Width</label>
                            <input type="number" name="width"  class="form-control" min=0 required>
                        </div>
                        <div class="col-sm-6 form-group">
                            <label for="height">Height</label>
                            <input type="number" name="height"  class="form-control" min=0 required>
                        </div>
                    </div>
                    <div class="fomr-group">
                        <label for="medium">Medium</label>
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
                    <div class="form-group">
                        <br/>
                        <input type="checkbox" name="agree" value="1" required style="width:20px"> Do you agree with our service
                    </div>
                    <button class="btn btn-sm btn-success form-control" type="submit" name="product" style="width:150px">Add</button>
               </form>
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