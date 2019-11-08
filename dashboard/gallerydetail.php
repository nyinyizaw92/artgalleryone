<!DOCTYPE html>
<html lang="en">
<head>
    <?php
        require_once('../headerlink/headerlink.php');
        require_once('../admin/config/db.php');
        $userid = $_GET['id'];
    ?>
    <link rel="stylesheet" type="text/css" href="css/dashboard.css">
    <link rel="stylesheet" type="text/css" href="css/product.css">
</head>
<body style="background:#2C2C2C;color:white;">
   
    <div class="container-fluid prodcut">
    <a href="gallery.php">
        <button class="btn btn-sm btn-danger">Back</button>
    </a>
        <div class="row">
        <?php
           
            $q = "select * from galleries";
            $result = $conn->query($q);

            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                   $user_id = $row['user_id'];
                   if($userid == sha1($user_id)){
                    $created_date = $_SESSION['created_date'] = $row['created_date'];
                    $splitTimeStamp = explode(" ",$created_date);
                    $date =$_SESSION['date'] =  $splitTimeStamp[0];
                    $time = $splitTimeStamp[1];
                    $user_name = $_SESSION['user_name'] = $row['user_name'];
                    ?>
                        <div class="col-sm-3">
                        <div class="card">
                            <figure>
                                <img src="../gallery/<?php echo $row['photo'] ?>" alt="image">
                                <figcaption>
                                    <b>Artists</b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span> <?php echo $row['user_name']?></span><br/>
                                    <b>Title</b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span><?php echo $row['title']?></span><br/>
                                    <b>Height</b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span> <?php echo $row['height']?> ' </span><br/>
                                    <b>Width</b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span><?php echo $row['width']?> '</span><br/>
                                    <b>Price</b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span> <?php echo $row['price']?> MMK</span><br/>
                                    
                                </figcaption>
                            </figure>
                        </div>
                   
                        </div>
                    <?php
                   }
                }
            }
            ?>
        </div>
        <div class="row">
            <div class="col-sm-12">
            <br/>
            <h6>Gallery is created by <?php echo $user_name ?> at (<?php echo $date ?>)</h6>
            <a href="deletedata.php?id=<?php echo $userid ?>">
                <button class="btn btn-sm btn-danger">Delete</button>
            </a>
            </div>
        </div>
    </div>
</body>
</html>