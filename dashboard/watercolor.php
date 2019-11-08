<!DOCTYPE html>
<html lang="en">
<head>
    <?php
        require_once('../headerlink/headerlink.php');
        require_once('../admin/config/db.php');
    ?>
    <link rel="stylesheet" type="text/css" href="css/dashboard.css">
    <link rel="stylesheet" type="text/css" href="css/product.css">
</head>
<body style="background:#2C2C2C">
    <?php require_once('nav.php') ?>
    <div class="container-fluid prodcut">
        <div class="row">
        <?php
            $q = "select * from products where medium=1";
            $result = $conn->query($q);

            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
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
                                    <b>Price</b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span> <?php echo $row['price']?> MMK</span>
                                </figcaption>
                            </figure>
                        </div>
                    </div>
                    <?php
                }
            }
            ?>
        </div>
    </div>
</body>
</html>