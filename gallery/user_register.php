<?php
    error_reporting(E_ALL);
    ini_set('display_errors', 1);
    require_once('../admin/config/db.php');

    if(isset($_POST['login'])){
        $userlogin = $_POST['userlogin'];
        $password = $_POST['password'];
        $confirm_pass = $_POST['confirm_pass'];
        $phone = preg_replace('/^0/','+95',$_POST['phone']);
        

        $q = "select * from user_registers";
        $result = $conn->query($q);

        if ($result->num_rows > 0) {
           
            while($row = $result->fetch_assoc()) {
                if($row['username']==$userlogin && $row['password']==$password && $password==$confirm_pass){
                $update = "update user_registers set phone='$phone' where username='$userlogin'";
                mysqli_query($conn,$update);

                session_start();
                $_SESSION['username'] = $row['username'];
                $_SESSION['useremail'] = $row['email'];
                $_SESSION['id'] = $row['id'];
                $_SESSION['phone'] = $phone;
                $_SESSION['nrc'] = $row['nrc'];

                setcookie("userid",$row['id'],time()+3600);
                setcookie("username",$row['username'],time()+3600);
                setcookie("useremail",$row['email'],time()+3600);
                setcookie("phone",$row['phone'],time()+3600);
                setcookie("nrc",$row['nrc'],time()+3600);
                header('location:home.php');
                }elseif($password!==$row['password']){
                    $message = "incorrect password";

                    echo "<SCRIPT type='text/javascript'> //not showing me this
                        alert('$message');
                        window.location.replace(\"http://localhost/artgallery/gallery\");
                    </SCRIPT>";
                }
                
                elseif($password!==$confirm_pass){
                    $message = "password doesn't match";

                    echo "<SCRIPT type='text/javascript'> //not showing me this
                        alert('$message');
                        window.location.replace(\"http://localhost/artgallery/gallery\");
                    </SCRIPT>";
                }else{
                    $message = "user doesn't exit please try again or register first";
                    echo "<SCRIPT type='text/javascript'> //not showing me this
                        alert('$message');
                        window.location.replace(\"http://localhost/artgallery/gallery\");
                    </SCRIPT>";
                }
            }
        }
     
    }

    if(isset($_POST['register'])){
        $username = $_POST['username'];
        $useremail = $_POST['useremail'];
        $usernrc = $_POST['usernrc'];
        $userpassword = $_POST['userpassword'];
        $userconfirm_pass = $_POST['userconfirm_pass'];

        $q = "select * from user_registers where email='$useremail'";
        $result = mysqli_query($conn,$q);
        $num = mysqli_num_rows($result);

        if($num ==1){
            $message = 'useremail already exit';

            echo "<SCRIPT type='text/javascript'> //not showing me this
                alert('$message');
                window.location.replace(\"http://localhost/artgallery/gallery\");
            </SCRIPT>";
        }elseif($userpassword!==$userconfirm_pass){
            $message = 'password does not match';

            echo "<SCRIPT type='text/javascript'> //not showing me this
                alert('$message');
                window.location.replace(\"http://localhost/artgallery/gallery\");
            </SCRIPT>";
        }else{
            $insert_user = "insert into user_registers(username,email,nrc,password,phone,profile) values
            ('$username','$useremail','$usernrc','$userpassword',null,null)";
            $conn->set_charset("utf8");
            mysqli_query($conn,$insert_user);
            $message = 'register successfully,Thank!';

            echo "<SCRIPT type='text/javascript'> //not showing me this
                alert('$message');
                window.location.replace(\"http://localhost/artgallery/gallery/\");
            </SCRIPT>";
        }
    }
?>