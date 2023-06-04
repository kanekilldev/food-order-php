<?php include('partials/menu.php'); ?>

<div class="main-content">
    <div class="wrapper">
        <h1>Quản lý đặt hàng</h1>

                <br /><br /><br />

                <?php 
                    if(isset($_SESSION['update']))
                    {
                        echo $_SESSION['update'];
                        unset($_SESSION['update']);
                    }
                ?>
                <br><br>

                <table class="tbl-full">
                    <tr>
                        <th>STT</th>
                        <th>Tên món ăn</th>
                        <th>Giá tiền</th>
                        <th>Số lượng</th>
                        <th>Tổng cộng</th>
                        <th>Trạng thái</th>
                        <th>Tên khách hàng</th>
                        <th>Số điện thoại</th>
                        <th>Địa chỉ</th>
                        <th>Chức năng</th>
                    </tr>

                    <?php 
                        $sql = "SELECT * FROM tbl_order ORDER BY id DESC";
                        $res = mysqli_query($conn, $sql);
                        $count = mysqli_num_rows($res);
                        $sn = 1;

                        if($count>0)
                        {
                            while($row=mysqli_fetch_assoc($res))
                            {
                                $id = $row['id'];
                                $food = $row['food'];
                                $price = $row['price'];
                                $qty = $row['qty'];
                                $total = $row['total'];
                                $order_date = $row['order_date'];
                                $status = $row['status'];
                                $customer_name = $row['customer_name'];
                                $customer_contact = $row['customer_contact'];
                                $customer_email = $row['customer_email'];
                                $customer_address = $row['customer_address'];
                                
                                ?>

                                    <tr>
                                        <td><?php echo $sn++; ?>. </td>
                                        <td><?php echo $food; ?></td>
                                        <td><?php echo $price; ?></td>
                                        <td><?php echo $qty; ?></td>
                                        <td><?php echo $total; ?></td>

                                        <td>
                                            <?php 

                                                if($status=="Đặt hàng")
                                                {
                                                    echo "<label>$status</label>";
                                                }
                                                elseif($status=="Khi giao hàng")
                                                {
                                                    echo "<label style='color: orange;'>$status</label>";
                                                }
                                                elseif($status=="Đã giao hàng")
                                                {
                                                    echo "<label style='color: green;'>$status</label>";
                                                }
                                                elseif($status=="Đã hủy")
                                                {
                                                    echo "<label style='color: red;'>$status</label>";
                                                }
                                            ?>
                                        </td>

                                        <td><?php echo $customer_name; ?></td>
                                        <td><?php echo $customer_contact; ?></td>
                                        
                                        <td><?php echo $customer_address; ?></td>
                                        <td>
                                            <a href="<?php echo SITEURL; ?>admin/update-order.php?id=<?php echo $id; ?>" class="btn-secondary">Cập nhật</a>
                                        </td>
                                    </tr>

                                <?php

                            }
                        }
                        else
                        {
                            //Order not Available
                            echo "<tr><td colspan='12' class='error'>Đơn đặt hàng không có sẵn</td></tr>";
                        }
                    ?>

 
                </table>
    </div>
    
</div>

<?php include('partials/footer.php'); ?>