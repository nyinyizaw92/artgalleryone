<!DOCTYPE html>
<html lang="en">
<head>
<link rel="stylesheet" type="text/css" href="css/profile.css">
</head>
<body>
<nav class="navbar navbar-expand-sm fixed-top" style="background:black">
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="nav navbar-nav ml-auto main-nav animated slideInDown" id="check-click"">
            <li class="nav-item">
                <a class="nav-link" href="home.php">Home</a>
            </li>
            <li class="nav-item dropdown">
                <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">Painting <b class="caret"></b></a>
                <ul class="dropdown-menu">
                    <li><a href="addproduct.php" class="paint">Add Product</a></li>
                    <li><a href="watercolor.php" class="paint">Water Colour Painting</a></li>
                    <li><a href="oilpainting.php" class="paint">Oil Painting</a></li>
                    <li><a href="glasspainting.php" class="paint">Glass Painting</a></li>
                    <li><a href="inkwash.php" class="paint">Ink Wash Painting</a></li>
                </ul>
            </li>   
            <li class="nav-item dropdown">
                <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">Auction <b class="caret"></b></a>
                <ul class="dropdown-menu">
                    <li><a href="addauctionproduct.php" class="paint">Add Auction Product</a></li>
                    <li><a href="auctionlist.php" class="paint">Auction List</a></li>
                </ul>
            </li>   
            <li class="nav-item">
                <a class="nav-link" href="gallery.php">Gallery</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="userprofile.php">Profile</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="logout.php">Logout</a>
            </li>
        </ul>
        <a href="#" class="mobile-icon" onclick="slideshow()"><i class="fa fa-bars"></i></a>
    </div>
</nav>
</body>
</html>
