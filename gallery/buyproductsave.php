<?php 
    session_start();
    error_reporting(E_ALL);
    ini_set('display_errors', 1);
    require_once('../admin/config/db.php');
    $username = $_COOKIE['username'];
    $useremail = $_COOKIE['useremail'];
    $userid = $_COOKIE['userid'];

    $data = "SELECT * FROM sell_products ORDER BY id DESC LIMIT 1";
    $result = $conn->query($data);
        while($row = $result->fetch_assoc()){
            ?>
            <div class="row" style="text-align:center">
                <div class="col-sm-12">
                    <h4>Please screenshoot and save this page.<br/>We will check it when deliver the painting.Thank!</h4>
                    <figure>
                        <img src="<?php echo $row['product'] ?>" alt="image" style="width:300px;height:250px;">
                        <figcaption>
                            <h5>Artist : <span><?php echo $row['seller_name'] ?></span></h5>
                            <h5>Price : <span><?php echo $row['price'] ?> MMK</span></h5>
                            <a href="http://localhost/artgallery/gallery/home.php">
                                <button class="btn btn-primary">OK</button>
                            </a>
                        </figcaption>
                    </figure>

                </div>
            </div>
            <?php
        }

?>
