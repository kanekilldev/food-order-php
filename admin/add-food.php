<?php include('partials/menu.php'); ?>

<div class="main-content">
    <div class="wrapper">
        <h1>Thêm món ăn</h1>

        <br><br>

        <?php 
            if(isset($_SESSION['upload']))
            {
                echo $_SESSION['upload'];
                unset($_SESSION['upload']);
            }
        ?>

        <form action="" method="POST" enctype="multipart/form-data">
        
            <table class="tbl-30">

                <tr>
                    <td>Tiêu đề: </td>
                    <td>
                        <input type="text" name="title" placeholder="Tiêu đề món ăn">
                    </td>
                </tr>

                <tr>
                    <td>Mô tả </td>
                    <td>
                        <textarea name="description" cols="30" rows="5" placeholder="Mô tả món ăn"></textarea>
                    </td>
                </tr>

                <tr>
                    <td>Giá: </td>
                    <td>
                        <input type="number" name="price">
                    </td>
                </tr>

                <tr>
                    <td>Hình ảnh:</td>
                    <td>
                        <input type="file" name="image">
                    </td>
                </tr>

                <tr>
                    <td>Danh mục: </td>
                    <td>
                        <select name="category">

                            <?php 
                                $sql = "SELECT * FROM tbl_category WHERE active='Hiển thị'";
                                
                                $res = mysqli_query($conn, $sql);

                                $count = mysqli_num_rows($res);

                                if($count>0)
                                {
                                    while($row=mysqli_fetch_assoc($res))
                                    {
                                        $id = $row['id'];
                                        $title = $row['title'];

                                        ?>

                                        <option value="<?php echo $id; ?>"><?php echo $title; ?></option>

                                        <?php
                                    }
                                }
                                else
                                {
                                    ?>
                                    <option value="0">Không tìm thấy danh mục</option>
                                    <?php
                                }
                            

                                //2. Display on Drpopdown
                            ?>

                        </select>
                    </td>
                </tr>

                <tr>
                    <td>Nổi bật:</td>
                    <td>
                        <input type="radio" name="featured" value="Có"> Có
                        <input type="radio" name="featured" value="Không"> Không
                    </td>
                </tr>

                <tr>
                    <td>Hoạt động: </td>
                    <td>
                        <input type="radio" name="active" value="Hiển thị"> Hiển thị
                        <input type="radio" name="active" value="Ẩn"> Ẩn
                    </td>
                </tr>

                <tr>
                    <td colspan="2">
                        <input type="submit" name="submit" value="Add Food" class="btn-secondary">
                    </td>
                </tr>

            </table>

        </form>

        
        <?php 

            if(isset($_POST['submit']))
            {
                $title = $_POST['title'];
                $description = $_POST['description'];
                $price = $_POST['price'];
                $category = $_POST['category'];

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

                    if($image_name!="")
                    {

                        $ext = end(explode('.', $image_name));

                        $image_name = "Food-Name-".rand(0000,9999).".".$ext; 

                        $src = $_FILES['image']['tmp_name'];

                        $dst = "../images/food/".$image_name;

                        $upload = move_uploaded_file($src, $dst);

                        if($upload==false)
                        {

                            $_SESSION['upload'] = "<div class='error'>Không thể tải lên hình ảnh.</div>";
                            header('location:'.SITEURL.'admin/add-food.php');

                            die();
                        }

                    }

                }
                else
                {
                    $image_name = ""; 
                }

                $sql2 = "INSERT INTO tbl_food SET 
                    title = '$title',
                    description = '$description',
                    price = $price,
                    image_name = '$image_name',
                    category_id = $category,
                    featured = '$featured',
                    active = '$active'
                ";


                $res2 = mysqli_query($conn, $sql2);

                if($res2 == true)
                {
                    $_SESSION['add'] = "<div class='success'>Món ăn được thêm thành công.</div>";
                    header('location:'.SITEURL.'admin/manage-food.php');
                }
                else
                {
                    //FAiled to Insert Data
                    $_SESSION['add'] = "<div class='error'>Món ăn được thêm thất bại.</div>";
                    header('location:'.SITEURL.'admin/manage-food.php');
                }

                
            }

        ?>


    </div>
</div>

<?php include('partials/footer.php'); ?>