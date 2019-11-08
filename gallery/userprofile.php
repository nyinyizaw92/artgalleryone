<?php
    session_start();
    require_once('../admin/config/db.php');
    $username = $_COOKIE['username'];
    $useremail = $_COOKIE['useremail'];
    $userid = $_COOKIE['userid'];
    $userphone = $_COOKIE['phone'];

    if(isset($_POST['submit'])){
            
      $target_path = "userprofile/";
       $target_path = $target_path.basename($_FILES['photo']['name']);
      if(move_uploaded_file($_FILES['photo']['tmp_name'], $target_path)){
        $select = "select * from user_registers";
        $result = $conn->query($select);
            $rows= $result->num_rows > 0;
          for($i=0;$i<$rows;$i++){
             while($row = $result->fetch_assoc()){
                $uploademail = $_SESSION['uploademail'] = $row['email'];
               if($uploademail==$useremail){
                $update = "update user_registers set profile='$target_path' where email='$useremail'";
                if(mysqli_query($conn,$update)){
                  $message = 'success upload';
        
                  echo "<SCRIPT type='text/javascript'> //not showing me this
                      alert('$message');
                      window.location.replace(\"http://localhost/artgallery/gallery/userprofile.php\");
                  </SCRIPT>";
                }
                
               }
                   
               }

            }

          
         //}
        } 
      }

    
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <?php
        require_once('../headerlink/headerlink.php')
    ?>
    <link rel="stylesheet" type="text/css" href="css/profile.css">
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
    <div class="row" style="padding:25px">
          <div class="col-md-5">
          
               <?php 
                $select = "select * from user_registers";
                $result = $conn->query($select);
                while($row = $result->fetch_assoc()){
                    if($row['username'] == $username){
                      if($row['profile']){
                        ?>
                        <div class="col-sm-12">
                            <img src="<?php echo $row['profile'] ?>" style="width:300px;height:300px" class="img img-responsive"><br/>
                        </div>
                        <?php
                      }else{
                        ?>
                          <div class="col-sm-12">
                            <img src="https://www.scirra.com/images/articles/Windows-8-User-Account.jpg" style="width:300px;height:300px" class="img img-responsive"><br>
                          </div>
            
                        <?php
                      }
                    }
                }


                ?>
             <br/>
              <form action="userprofile.php" method="post"  enctype="multipart/form-data"
                upload_max_filesize = "5000M">
                 
                    <div class="form-group col-sm-12">
                      <label for="photo">Upload Image</label>
                      <input type="file" name="photo" class="form-control" required>
                    </div>
                
                    <div class="form-group col-sm-12">
                       <input type="submit" name="submit">
                    </div>
                 
                
              </form>
          </div>

          <div class="col-md-7" style="margin-top:30px">
             <table class="table table-striped table-condensed">
               <thead>
                  <tr>
                    <th>User Info</th>                                          
                  </tr>
              </thead>  
              <tbody>
                <tr>
                    <td>name</td>
                    <td><?php echo $username ?></td>
                </tr>
                <tr>
                    <td>email</td>
                    <td><?php echo $useremail ?></td>
                </tr>
                <tr>
                    <td>phone_no</td>
                    <td><?php echo $userphone ?></td>
                </tr>
                <tr>
                  <td>Your Money</td>
                  <td>
                    <?php 
                      $select = 'select * from user_coins';
                      $result = $conn->query($select);
                      $rows= $result->num_rows;
                      for($i=0;$i<$rows;$i++){
                      while($row = $result->fetch_assoc()){
                        $user_id = $_SESSION['user_id'] = $row['user_id'];
                        if($user_id == $userid){
                            echo $row['coin'];
                            ?>
                            MMK
                          <?php
                        }
                      }
                      }
                     ?>
                  </td>
                </tr> 
                <tr>
                  <?php 
                    if(isset($_POST['add'])){
                    $coin = $_POST['coin'];
                    $q = "select * from user_coins where user_id=$userid";
                    $result = mysqli_query($conn,$q);
                    $num = mysqli_num_rows($result);
                    $result = $conn->query($q);
                         if($num ==1){
                            while($row = $result->fetch_assoc()){
                                $usercoin = $row['coin'];
                                $newcoin = $usercoin + $coin;
                               
                                $update = "update user_coins set coin=$newcoin where user_id=$userid";
                                if(mysqli_query($conn,$update)){
                                $message = 'add your coin success';
        
                                echo "<SCRIPT type='text/javascript'> //not showing me this
                                    alert('$message');
                                    window.location.replace(\"http://localhost/artgallery/gallery/userprofile.php\");
                                </SCRIPT>";
                                }
                            }
                        
                        }
                        else{
                            $insert_coins = "insert into user_coins(user_id,coin,created_date) values
                            ($userid,$coin,now())";
                        
                            mysqli_query($conn,$insert_coins);
                            $message = 'add your coin successfully.Thank!';
                
                            echo "<SCRIPT type='text/javascript'> //not showing me this
                                alert('$message');
                                window.location.replace(\"http://localhost/artgallery/gallery/userprofile.php\");
                            </SCRIPT>";
                        }
                    
                    }
                    //}
                   ?>
                  <td colspan="2" style="align-content: center">
                    <form action="userprofile.php" method="post">
                      <input type="hidden" name="userid" value="<?php echo $userid ?>">
                      <input type="number" name="coin" placeholder="you can add your coin">
                      <input type="submit" name="add" value="Add" class="btn btn-sm btn-primary">
                    </form>
                  </td>
                </tr>           
              </tbody>
            </table>
          </div>
    </div>
    <div class="container-fluid">
       <div class="row">
         
              <div class="col-sm-12">
              <h3 id="product">Your Products</h3>
              </div>
              <br/>
              <?php
              $product_sell = "select * from products";
              $result = $conn->query($product_sell);
              while($row = $result->fetch_assoc()){
                  if($row['user_id'] == $userid){ 
                    ?>
                   
                    <div class="col-sm-3" style="padding:5px;"><img src="<?php echo $row['photo']?>" alt="image" class="ownerimage"/></div>
                    <div class="col-sm-2"><p><br/><?php echo $row['title'] ?></p></div>
                    <div class="col-sm-2">
                      <br/>
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
                    </div>
                    <div class="col-sm-3">
                        <?php
                          if($row['price']==0){
                            ?>
                                <br/><i>Not for sale</i>
                            <?php
                          }else{
                            ?>
                                <br/><span><?php echo $row['price'] ?> MMK</span>
                            <?php
                          }
                        ?>
                    </div>

                    <?php
                    if($row['sell'] == 0){
                      ?>
                       <div class="col-sm-2">
                        <br/>
                            <a style="text-decoration:none;color:black"
                            href="deleteproduct.php?product_id=<?php echo sha1($row['id']) ?>">
                            <button class="btn btn-danger btn-sm">Delete</button>
                            </a>
                        </div>  
                      <?php
                    }else{
                      ?>  
                     <div class="col-sm-2">
                    <br/>
                    <button class="btn btn-danger btn-sm">
                        <a style="text-decoration:none;color:black;cursor:not-allowed"
                        href="#" >Ordered</a>
                    </button>
                        </a>
                    </div>
                      <?php
                    }
                    ?>
                   
                    <br/>
                    <?php
                  }else{
                 
                  }
              }
                ?>
        
            
       </div>
    </div>
    <br/>
    <div class="container-fluid gallery-product">
      <div class="row">
        <div class="col-sm-12"><h3 id="product">Your Galleries</h3></div>
        <?php
            $gallery = "select * from galleries";
            $result = $conn->query($gallery);
            while($row = $result->fetch_assoc()){
              if($row['user_id']==$userid){
              ?>
               <div class="col-sm-3 gall" style="margin-top:10px">
                
                  <img src="<?php echo $row['photo'] ?>" alt="image" width="247" height="150" class="gallery-image"><br>
                  <!-- <div class="col-sm-12 gallery-title" style="text-align:center;background:black;color:white">
                      <?php echo $row['title'] ?>
                  </div> -->
                  <p class="gallery-title">
                    <?php echo $row['title'] ?>
                  </p>
                  <!-- <a class="tarnsparent" href="gallerydetail.php?id=<?php echo sha1($row['name']) ?>"><h4>Gallery of User <?php echo $row['name'] ?></h4></a> -->
                </div>
              <?php 
              }
            }
          
        ?>
      </div>
    </div>
    
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
</body>

</html>
