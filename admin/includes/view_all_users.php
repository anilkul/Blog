<table class="table table-bordered table-hover">
    <thead>
        <tr>
            <th>Id</th>
            <th>Username</th>
            <th>Firstname</th>
            <th>Lastname</th>
            <th>Email</th>
            <th>Image</th>
            <th>User Role</th>
        </tr>
    </thead>
    <tbody>
        
        <?php
        $query = "SELECT * FROM users"; // query yarat
        $selectUsers = mysqli_query($con, $query); //query'yi yolla
        while ($row = mysqli_fetch_assoc($selectUsers)) {  //yollanan query'yi associcative array seklinde tanimla
        extract($row); // assoc array seklinde tanimlanan query'yi $key = value; formatina donustur.
        
        ?>
        <tr>
            <td><?php echo $user_id ?></td>
            <td><?php echo $username ?></td>
            <td><?php echo $user_firstname ?></td>
            <td><?php echo $user_lastname ?></td>
            <td><?php echo $user_email ?></td>
            <td>
                <?php if (!empty($user_image)) {
            ?>
                <img width="100" src="../images/<?php echo $user_image ?>" alt="image" class="img-responsive">
                <?php 
        } else {
            ?>
                <p align="center">No Image</p>        
                <?php 
        } ?>
            </td>
            <td><?php echo $user_role ?></td>
            <td><a href="users.php?source=edit_user&u_id=<?php echo $user_id ?>">Edit</a></td>
            <?php if($user_role == "admin") { ?>
            <td><a href="users.php?change_to_subscriber=<?php echo $user_id ?>">Subscriber</a></td>
            <?php } else { ?>
            <td><a href="users.php?change_to_admin=<?php echo $user_id ?>">Admin</a></td>
            <?php } ?>
            <td><a href="users.php?delete=<?php echo $user_id ?>">Delete</a></td>
            
        </tr>
        <?php 
        } ?>
    </tbody>
</table> 

<?php 
if (isset($_GET['change_to_admin'])) {
    $user_id = $_GET['change_to_admin'];
    $change_to_admin_query = "UPDATE users SET user_role = 'admin' WHERE user_id = $user_id";
    $change_to_admin_result = mysqli_query($con, $change_to_admin_query);
    
    header("Location: users.php");
}


if (isset($_GET['change_to_subscriber'])) {
    $user_id = $_GET['change_to_subscriber'];
    $change_to_subscriber_query = "UPDATE users SET user_role = 'subscriber' WHERE user_id = $user_id";
    $change_to_subscriber_result = mysqli_query($con, $change_to_subscriber_query);
    
    header("Location: users.php");
}





if (isset($_GET['delete'])) {
    $user_id = $_GET['delete'];
    $del_user = "DELETE FROM users WHERE user_id = $user_id";
    $del_user_result = mysqli_query($con, $del_user);
    
    header("Location: users.php");
}
?>