<h3 class="text-center text-success">All Orders</h3>
<table class="table-border mt-5">
    <thead class="table-head text-center">
        <?php
        $get_orders="Select * from `user_orders`";
        $result=mysqli_query($con,$get_orders);
        $row=mysqli_num_rows($result);
        

        if($row==0){
            echo "<h2 class='text-danger text-center mt-5'>No Orders Found</h2>";
        }else{
            echo "<tr>
            <th>S1 No</th>
            <th>Due amount</th>
            <th>Invoice Number</th>
            <th>Total Products</th>
            <th>Order Date</th>
            <th>Status</th>
            <th>Delete</th>
        </tr>
        </thead>
        <tbody class=''>";
            $number=0;
            while($row_data=mysqli_fetch_assoc($result)){
                $number++;
                $order_id=$row_data['order_id'];
                $user_id=$row_data['user_id'];
                $amount_due=$row_data['amount_due'];
                $invoice_number=$row_data['invoice_number'];
                $total_products=$row_data['total_products'];
                $order_date=$row_data['order_date'];
                $order_status=$row_data['order_status'];
                echo"<tr>
            <td>$number</td>
            <td>$amount_due</td>
            <td>$invoice_number</td>
            <td>$total_products</td>
            <td>$order_date</td>
            <td>$order_status</td>
            <td><a href='index.php?delete_orders=$order_id'><i class='fa-solid fa-trash'></i></a></td>
        </tr>";
            }
        }
        ?>
    </tbody>
</table>
