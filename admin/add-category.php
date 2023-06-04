<?php include('partials/menu.php'); ?>

<div class="main-content">
    <div class="wrapper">
        <h1>Thêm danh mục</h1>

        <br><br>

        <?php 
        
            if(isset($_SESSION['add']))
            {
                echo $_SESSION['add'];
                unset($_SESSION['add']);
            }

            if(isset($_SESSION['upload']))
            {
                echo $_SESSION['upload'];
                unset($_SESSION['upload']);
            }
        
        ?>

        <br><br>

        <!-- Add CAtegory Form Starts -->
        <form action="" method="POST" enctype="multipart/form-data">

            <table class="tbl-30">
                <tr>
                    <td>Tiêu đề:</td>
                    <td>
                        <input type="text" name="title" placeholder="Nhập tiêu đề">
                    </td>
                </tr>

                <tr>
                    <td>Hình ảnh: </td>
                    <td>
                        <input type="file" name="image">
                    </td>
                </tr>

                <tr>
                    <td>Nổi bật: </td>
                    <td>
                        <input type="radio" name="featured" value="Có"> Có 
                        <input type="radio" name="featured" value="Không"> Không 
                    </td>
                </tr>

                <tr>
                    <td>Hoạt động:</td>
                    <td>
                        <input type="radio" name="active" value="Hiển thị"> Hiển thị 
                        <input type="radio" name="active" value="Ẩn"> Ẩn
                    </td>
                </tr>

                <tr>
                    <td colspan="2">
                        <input type="submit" name="submit" value="Add Category" class="btn-secondary">
                    </td>
                </tr>

            </table>

        </form>

        <?php 
        

            if(isset($_POST['submit']))
            {

                $title = $_POST['title'];

                if(isset($_POST['featured']))
                {
                    $featured = $_POST['featured'];
                }
                else
                {
                    $featured = "Không";
                }

                if(isset($_POST['active']))
                {
                    $active = $_POST['active'];
                }
                else
                {
                    $active = "Ẩn";
                }

                if(isset($_FILES['image']['name']))
                {
                    $image_name = $_FILES['image']['name'];

                    if($image_name != "")
                    {
                        $ext = end(explode('.', $image_name));

                        $image_name = "Food_Category_".rand(000, 999).'.'.$ext; 
                        

                        $source_path = $_FILES['image']['tmp_name'];

                        $destination_path = "../images/category/".$image_name;

                        $upload = move_uploaded_file($source_path, $destination_path);

                        if($upload==false)
                        {
                            $_SESSION['upload'] = "<div class='error'>Không thể tải lên hình ảnh.</div>";
                            header('location:'.SITEURL.'admin/add-category.php');
                            die();
                        }

                    }
                }
                else
                {
                    $image_name="";
                }
                $sql = "INSERT INTO tbl_category SET 
                    title='$title',
                    image_name='$image_name',
                    featured='$featured',
                    active='$active'
                ";

                $res = mysqli_query($conn, $sql);

                if($res==true)
                {
                    $_SESSION['add'] = "<div class='success'>Danh mục đã được thêm thành công.</div>";
                    header('location:'.SITEURL.'admin/manage-category.php');
                }
                else
                {

                    $_SESSION['add'] = "<div class='error'>Danh mục đã được thêm thất bại</div>";
                    header('location:'.SITEURL.'admin/add-category.php');
                }
            }
        
        ?>

    </div>
</div>

<?php include('partials/footer.php'); ?>