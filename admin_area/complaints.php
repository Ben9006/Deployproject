<h3 class="text-center text-success">All Complaints</h3>
<table class="table-border mt-5">
    <thead class="table-head text-center">
        <?php
        $get_complaints="Select * from `contact_table`";
        $result=mysqli_query($con,$get_complaints);
        $row=mysqli_num_rows($result);
        

        if($row==0){
            echo "<h2 class='text-danger text-center mt-5'>No Complaints Found</h2>";
        }else{
            echo "<tr>
            <th>S1 No</th>
            <th>Username</th>
            <th>Email</th>
            <th>Message</th>
            <th>Complaint Date</th>
            <th>Delete</th>
        </tr>
        </thead>
        <tbody class=''>";
            $number=0;
            while($row_data=mysqli_fetch_assoc($result)){
                $number++;
                $contact_id=$row_data['contact_id'];
                $username=$row_data['username'];
                $email=$row_data['email'];
                $message=$row_data['message'];
                $date=$row_data['date'];
                echo"<tr>
            <td>$number</td>
            <td>$username</td>
            <td>$email</td>
            <td>$message</td>
            <td>$date</td>
            <td><a href='index.php?delete_complaints=$contact_id'><i class='fa-solid fa-trash'></i></a></td>
        </tr>";
            }
        }
        ?>
    </tbody>
</table>
