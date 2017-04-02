
<?php 
		session_start();
        $username = $_POST['username'];
        $user_password = $_POST['user_password'];
        mysqli_real_escape_string($con, $username);
        mysqli_real_escape_string($con, $user_password);
    $query = "SELECT * FROM users WHERE username='$username'";
    $selectUserQuery = mysqli_query($con, $query);

    if (!$selectUserQuery) {
        die("QUERY FAILED" . mysqli_error($con));
    }

    while($row = mysqli_fetch_assoc($selectUserQuery)) {
        $db_id             = $row['user_id'];
        $db_user_password  = $row['user_password'];
        $db_username       = $row['username'];
        $db_user_firstname = $row['user_firstname'];
        $db_user_lastname  = $row['user_lastname'];
        $db_user_role      = $row['user_role'];

    }

	


	
?>