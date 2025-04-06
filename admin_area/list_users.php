<h3 class="text-center text-success">All Users</h3>
<table class="table-border mt-5">
    <thead class="table-head text-center">
        <?php
        $get_users="Select * from `user_table`";
        $result=mysqli_query($con,$get_users);
        $row=mysqli_num_rows($result);
        


        if($row==0){
            echo "<h2 class='text-danger text-center mt-5'>No Users Found</h2>";
        }else{
            echo "<tr>
            <th>S1 No</th>
            <th>username</th>
            <th>User email</th>
            <th>User Image</th>
            <th>User Address</th>
            <th>User Mobile</th>
            <th>Delete</th>
        </tr>
        </thead>
        <tbody class=''>";
            $number=0;
            while($row_data=mysqli_fetch_assoc($result)){
                $number++;
                $user_id=$row_data['user_id'];
                $username=$row_data['username'];
                $user_email=$row_data['user_email'];
                $user_image=$row_data['user_image']; 
                $user_address=$row_data['user_address'];
                $user_mobile=$row_data['user_mobile'];
                echo"<tr>
            <td>$number</td>
            <td>$username</td>
            <td>$user_email</td>
            <td><img src='../users_area/user_images/$user_image' alt='$username' class='product-image'/></td>
            <td>$user_address</td>
            <td>$user_mobile</td>
            <td><a href='index.php?delete_users=$user_id'><i class='fa-solid fa-trash'></i></a></td>
        </tr>";
            }
        }
        ?>
    </tbody>
</table>
