<?php $db= mysqli_connect("localhost","root","","phpcurd_db");?><!doctype html>
<html>
<head><title>PHP CRUD</title></head>
<body>
    <form method="post">
    <label>Name</label>
    <input type="text" name="name" placeholder="enter name" required><br><br>
    <label>Email</label>
    <input type="email" name="email" placeholder="enter email" required><br><br>
    <label>Address</label>
    <input type="text" name="address" placeholder="Enter Address" required><br><br>
        <input type="submit" name="submit" value="submit">
    </form>
    <hr>
    <h3>Users List</h3>
    <table style="width:80%" border="1">
    <tr>
        <th>S#</th>
        <th>Name</th>
        <th>Email</th>
        <th>Address</th>
        <th>Operations</th></tr><?php
        $i=1;
        $qry="select *from user";
        $run=$db -> query ($qry);
        if($run -> num_rows > 0){
            while($row=$run -> fetch_assoc()){
            $id=$row['user_id'];
                
           ?>
        <tr>
            <td><?php echo $i++;?></td>
            <td><?php echo $row['user_name']?></td>
            <td><?php echo $row['user_email']?></td>
            <td><?php echo $row['user_address']?></td>
            <td>
            <a href="edit.php?id=<?php echo $id; ?>">Edit</a>
                <a href="delete.php?id=<?php echo $id;?>" onclick="return confirm('are you sure?')">Delete</a>
            </td>
        </tr>
        
        <?php
            }
        }
       
        ?>
       </table></body></html>

<?php
if(isset($_POST['submit'])){
    $name=$_POST['name'];
    $email=$_POST['email'];
    $address=$_POST['address'];
    
    $qry="INSERT INTO user values(null,'$name','$email','$address') ";
    if(mysqli_query($db,$qry)){
        echo '<script>alert("registered successfully")</script>';
        header('location:user.php');
    }else{
        echo mysqli_error($db);
    }
}

?>