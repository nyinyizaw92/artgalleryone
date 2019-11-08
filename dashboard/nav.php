<?php
        session_start();
        $email = $_COOKIE['useremail']
    ?>

<div class="container-fluid header">
        <div class="row">
            <div class="col-lg-12">
                <nav class="navbar navbar-expand-sm">
                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <ul class="nav navbar-nav">
                            <li class="nav-item">
                               <img class="profile" src="https://cdn.pixabay.com/photo/2015/10/05/22/37/blank-profile-picture-973460_960_720.png" alt="profile"> <span style="color:white"><?php echo $email ?></span>
                            </li>
                        </ul>
                        <ul class="nav navbar-nav ml-auto">
                            <li class="nav-item">
                                <a class="nav-link" href="dashboard.php">Home</a>
                            </li>
                            <li class="nav-item dropdown">
                                <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">Painting <b class="caret"></b></a>
                                <ul class="dropdown-menu">
                                    <li><a href="watercolor.php">Water Colour Painting</a></li>
                                    <li><a href="oilpaint.php">Oil Painting</a></li>
                                    <li><a href="glasspaint.php">Glass Painting</a></li>
                                    <li><a href="inkwash.php">Ink Wash Painting</a></li>
                                </ul>
                            </li>   
                            <li class="nav-item">
                                <a class="nav-link" href="gallery.php">Gallery</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="auctionlist.php">Auction List</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="user.php">Users</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="logout.php">Logout</a>
                            </li>
                        </ul>
                    </div>
                </nav>
            </div>
        </div>
    </div>
