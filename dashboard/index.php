<!DOCTYPE html>
<html lang="en">
<head>
    <?php
        require_once('../headerlink/headerlink.php');
    ?>
    <style>
        body{
            background:#F4F6F6;
        }
        .col-sm-4{
            position:relative;
            margin-top:15%;
            margin-left:30%;
        }

        h3{
            text-align:center
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="row">
           <div class="col-sm-4">
           <h3>Login</h3><br/>
            <form action="login.php" method="post">
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" name="email" placeholder="enter email" required class="form-control">
                </div>
                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" name="password" placeholder="enter password" required class="form-control">
                </div>
                <button type="submit" class="btn btn-sm btn-danger">Submit</button>
            </form>
           </div>
        </div>
    </div>
</body>
</html>