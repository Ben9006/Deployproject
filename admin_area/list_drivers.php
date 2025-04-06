<h3 class="text-center text-success">All Delivery Agents</h3>
<table class="table-border mt-5">
    <thead class="table-head text-center">
        <?php
        $get_agents="Select * from `drivers_table`";
        $result=mysqli_query($con,$get_agents);
        $row=mysqli_num_rows($result);
        


        if($row==0){
            echo "<h2 class='text-danger text-center mt-5'>No Agents Found</h2>";
        }else{
            echo "<tr>
            <th>S1 No</th>
            <th>Drivers name</th>
            <th>Email</th>
            <th>Mobile Number</th>
            <th>Delete</th>
        </tr>
        </thead>
        <tbody class=''>";
            $number=0;
            while($row_data=mysqli_fetch_assoc($result)){
                $number++;
                $driver_id=$row_data['driver_id'];
                $driver_name=$row_data['driver_name'];
                $driver_email=$row_data['driver_email'];
                $driver_mobile=$row_data['driver_mobile'];
                echo"<tr>
            <td>$number</td>
            <td>$driver_name</td>
            <td>$driver_email</td>
            <td>$driver_mobile</td>
            <td><a href='index.php?delete_agents=$driver_id'><i class='fa-solid fa-trash'></i></a></td>
        </tr>";
            }
        }
        ?>
    </tbody>
</table>
