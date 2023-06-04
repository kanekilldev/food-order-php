<?php include('partials/menu.php'); ?>

<div class="main-content">
    <div class="wrapper">
        <h1>Thêm quản trị viên</h1>

        <br><br>

        <?php 
            if(isset($_SESSION['add'])) 
            {
                echo $_SESSION['add']; 
                unset($_SESSION['add']); 
            }
        ?>

        <form action="" method="POST">

            <table class="tbl-30">
                <tr>
                    <td>Tên người dùng: </td>
                    <td>
                        <input type="text" name="full_name" placeholder="Enter Your Name">
                    </td>
                </tr>

                <tr>
                    <td>Tài khoản: </td>
                    <td>
                        <input type="text" name="username" placeholder="Your Username">
                    </td>
                </tr>

                <tr>
                    <td>Mật khẩu: </td>
                    <td>
                        <input type="password" name="password" placeholder="Your Password">
                    </td>
                </tr>

                <tr>
                    <td colspan="2">
                        <input type="submit" name="submit" value="Add Admin" class="btn-secondary">
                    </td>
                </tr>

            </table>

        </form>


    </div>
</div>

<?php include('partials/footer.php'); ?>


<?php 

    if(isset($_POST['submit']))
    {
      
        $full_name = $_POST['full_name'];
        $username = $_POST['username'];
        $password = md5($_POST['password']); 

     
        $sql = "INSERT INTO tbl_admin SET 
            full_name='$full_name',
            username='$username',
            password='$password'
        ";
 
        $res = mysqli_query($conn, $sql) or die(mysqli_error());


        if($res==TRUE)
        {
          
            $_SESSION['add'] = "<div class='success'>Quản trị viên đã thêm thành công.</div>";
            header("location:".SITEURL.'admin/manage-admin.php');
        }
        else
        {

            $_SESSION['add'] = "<div class='error'>Quản trị viên đã thêm thất bại.</div>";
            header("location:".SITEURL.'admin/add-admin.php');
        }

    }
    
?>