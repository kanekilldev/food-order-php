<?php include('../config/constants.php'); ?>

<html>
    <head>
        <title>Đăng nhập - Food Order System</title>
        <link rel="stylesheet" href="../css/admin.css">
    </head>

    <body>
        
        <div class="login">
            <h1 class="text-center">Đăng nhập</h1>
            <br><br>

            <?php 
                if(isset($_SESSION['login']))
                {
                    echo $_SESSION['login'];
                    unset($_SESSION['login']);
                }

                if(isset($_SESSION['no-login-message']))
                {
                    echo $_SESSION['no-login-message'];
                    unset($_SESSION['no-login-message']);
                }
            ?>
            <br><br>

            <form action="" method="POST" class="text-center">
            Tài khoản: <br>
            <input type="text" name="username" placeholder="Nhập tài khoản"><br><br>

            Mật khẩu: <br>
            <input type="password" name="password" placeholder="Nhập mật khẩu"><br><br>

            <input type="submit" name="submit" value="Login" class="btn-primary">
            <br><br>
            </form>
            <!-- Login Form Ends HEre -->

            <p class="text-center">Created By - <a href="#">Trương Nguyễn Trung Hậu</a></p>
        </div>

    </body>
</html>

<?php 


    if(isset($_POST['submit']))
    {

        $username = mysqli_real_escape_string($conn, $_POST['username']);
        
        $raw_password = md5($_POST['password']);
        $password = mysqli_real_escape_string($conn, $raw_password);

        //2. SQL to check whether the user with username and password exists or not
        $sql = "SELECT * FROM tbl_admin WHERE username='$username' AND password='$password'";

        //3. Execute the Query
        $res = mysqli_query($conn, $sql);

        //4. COunt rows to check whether the user exists or not
        $count = mysqli_num_rows($res);

        if($count==1)
        {
            //User AVailable and Login Success
            $_SESSION['login'] = "<div class='success'>Login Successful.</div>";
            $_SESSION['user'] = $username; //TO check whether the user is logged in or not and logout will unset it

            //REdirect to HOme Page/Dashboard
            header('location:'.SITEURL.'admin/');
        }
        else
        {
            //User not Available and Login FAil
            $_SESSION['login'] = "<div class='error text-center'>Username or Password did not match.</div>";
            //REdirect to HOme Page/Dashboard
            header('location:'.SITEURL.'admin/login.php');
        }


    }

?>