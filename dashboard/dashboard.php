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
   <div class="row">
       <div class="col-sm-12">
            <div class="row chart">
                <div class="col-sm-3">
                    <div class="card water">
                        <h6>Water Color Paintings</h6>
                        <div class="count">
                            <img src="https://www.happyfamilyart.com/wp-content/uploads/2014/10/CherryBlossom34.jpg" alt="watercolor" class="profile">
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span>(
                                <?php
                                    $q="select * from products where medium=1";
                                    $result = $conn->query($q);
                                    echo $result->num_rows;
                                ?>
                                )</span>
                        </div>
                    </div>
                </div>
                <div class="col-sm-3">
                    <div class="card oil">
                        <h6>Oil Paintings</h6>
                        <div class="count">
                            <img src="http://webneel.com/sites/default/files/images/project/Paintings%20of%20rural%20indian%20women%20-%20Oil%20painting%20(1).jpg" alt="watercolor" class="profile">
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span>(
                                <?php
                                    $q="select * from products where medium=2";
                                    $result = $conn->query($q);
                                    echo $result->num_rows;
                                ?>
                                )</span>
                        </div>
                    </div>
                </div>
                <div class="col-sm-3">
                    <div class="card glass">
                        <h6>Galss Paintings</h6>
                        <div class="count">
                            <img src="http://milliart.net/wp-content/uploads/2017/08/Stained-Glass-Art-Glass-Painting-Hand-Painted-Glass-Art-Nature-Painting-Glass-Nature-Art-Glass-Wall-Hanging-Four-Seasons-Painting-e1506110389108.jpg" alt="watercolor" class="profile">
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span>(
                                <?php
                                    $q="select * from products where medium=3";
                                    $result = $conn->query($q);
                                    echo $result->num_rows;
                                ?>
                                )</span>
                        </div>
                    </div>
                </div>
                <div class="col-sm-3">
                    <div class="card ink">
                        <h6>Ink Wash Paintings</h6>
                        <div class="count">
                            <img src="https://s3.amazonaws.com/productimages.goantiques.gemr/66010404/664920220_fullsize.jpeg" alt="watercolor" class="profile">
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span>(
                                <?php
                                    $q="select * from products where medium=4";
                                    $result = $conn->query($q);
                                    echo $result->num_rows;
                                ?>
                                )</span>
                        </div>
                    </div>
                </div>
            </div>
       </div>
    </div>
    
    <div class="container-fluid">
    <div class="row">
    <div class="col-sm-12 order">
            <h4>Product Sell List</h4>
           <div class="row orderlist head">
                <div class="col-sm-2">Product</div>
                <div class="col-sm-3">Buyer Name</div>
                <div class="col-sm-3">Seller Name</div>
                <div class="col-sm-2">Price</div>
                <div class="col-sm-2"></div>
           </div>
           <?php
           
            ?>
           
           <?php
            $q = "select * from sell_products";
            $result = $conn->query($q);

            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    $product_id = $row['product_id'];   
            ?>
            <div class="row orderlist">
            <div class="col-sm-2">
                <img src="../gallery/<?php echo $row['product'] ?>" alt="watercolor" class="product"><br/>
            </div>
            <div class="col-sm-3"><br/><?php echo $row['buyer_name'] ?><br/>(<?php echo $row['buyer_phone'] ?>)</div>
            <div class="col-sm-3"><br/><?php echo $row['seller_name'] ?><br/>(<?php echo $row['seller_phone'] ?>)</div>
            <div class="col-sm-2"><br/><b><?php echo $row['price'] ?> MMK</b></div>
            <div class="col-sm-2"><br/>
            <a href="deleteproduct.php?productid=<?php echo $product_id ?>">
            <button class="btn btn-sm btn-danger">
                Delete
            </button>
            </a>
            </div>
            </div>
               <?php
                    }
                }
            ?>
           
       </div>
    </div>
   </div>
    </div>
    <hr>
   <div class="container-fluid">
        <div class="row order">
            <div class="col-sm-12">
            <h4>Gallery Sell List</h4>
            <div class="row orderlist head">
                    <div class="col-sm-2">Product</div>
                    <div class="col-sm-3">Buyer Name</div>
                    <div class="col-sm-3">Seller Name</div>
                    <div class="col-sm-2">Price</div>
                    <div class="col-sm-2"></div>
            </div>
            <?php
            
                ?>
            
            <?php
                $q = "select * from sell_galleries";
                $result = $conn->query($q);

                if ($result->num_rows > 0) {
                    while($row = $result->fetch_assoc()) {
                    $product_id = $row['product_id'];
                ?>
                <div class="row orderlist">
                <div class="col-sm-2">
                    <img src="../gallery/<?php echo $row['product'] ?>" alt="watercolor" class="product"><br/>
                </div>
                <div class="col-sm-3"><br/><?php echo $row['buyer_name'] ?><br/>(<?php echo $row['buyer_phone'] ?>)</div>
                <div class="col-sm-3"><br/><?php echo $row['seller_name'] ?><br/>(<?php echo $row['seller_phone'] ?>)</div>
                <div class="col-sm-2"><br/><b><?php echo $row['price'] ?> MMK</b></div>
                <div class="col-sm-2"><br/>
                    <a href="deletegallery.php?productid=<?php echo $product_id ?>">
                    <button class="btn btn-sm btn-danger">
                       Delete
                    </button>
                    </a>
                </div>
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