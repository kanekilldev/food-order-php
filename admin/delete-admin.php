<?php 

    include('../config/constants.php');

    $id = $_GET['id'];

    $sql = "DELETE FROM tbl_admin WHERE id=$id";

    $res = mysqli_query($conn, $sql);

    if($res==true)
    {

        $_SESSION['delete'] = "<div class='success'>Quản trị viên đã xóa thành công.</div>";

        header('location:'.SITEURL.'admin/manage-admin.php');
    }
    else
    {


        $_SESSION['delete'] = "<div class='error'>Không thể xóa quản trị viên. Thử lại sau.</div>";
        header('location:'.SITEURL.'admin/manage-admin.php');
    }


?>