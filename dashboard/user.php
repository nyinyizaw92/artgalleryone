<?php
 require_once('../admin/config/db.php');

 ?>
<!DOCTYPE html>
<html lang="en">
<head>
     <?php
        require_once('../headerlink/headerlink.php');
    ?>
    <link rel="stylesheet" type="text/css" href="css/dashboard.css">
</head>
<body>
   <?php require_once('nav.php') ?>

   <div class="container-fluid">
        <div class="row order">
            <div class="col-sm-12">
            
            <div class="row orderlist head">
                    <div class="col-sm-2">Profile</div>
                    <div class="col-sm-3"> Name</div>
                    <div class="col-sm-3">Email</div>
                    <div class="col-sm-2">N.R.C</div>
                    <div class="col-sm-2">Phone</div>
            </div>
            <?php
            
                ?>
            
            <?php
                $q = "select * from user_registers";
                $conn->set_charset("utf8");
                $result = $conn->query($q);

                if ($result->num_rows > 0) {
                    while($row = $result->fetch_assoc()) {
                  
                ?>
                <div class="row orderlist">
                    <div class="col-sm-2">
                        <?php
                            if($row['profile']){
                                ?>
                            <img src="../gallery/<?php echo $row['profile'] ?>" alt="profile" class="product">
                                <?php
                            }else{
                                ?>
                            <img src="https://www.scirra.com/images/articles/Windows-8-User-Account.jpg" alt="profile" class="product">
                                <?php
                            }
                            ?>
                    </div>
                    <div class="col-sm-3"><br/><?php echo $row['username'] ?></div>
                    <div class="col-sm-3"><br/><?php echo $row['email'] ?></div>
                    <div class="col-sm-2"><br/><b><?php echo $row['nrc'] ?> </b></div>
                    <div class="col-sm-2"><br/><b><?php echo $row['phone'] ?> </b></div>
                </div>
                <?php
                        }
                    }
                ?>
            </div>
        </div>
   </div>
   
    
</body>
</html>