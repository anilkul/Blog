<?php

	if (isset($_GET['u_id'])) {
        $user_id = $_GET['u_id'];
    }

    $query = "SELECT * FROM users WHERE user_id = $user_id"; // query yarat
        $selectUsersById = mysqli_query($con, $query); //query'yi yolla
        while ($row = mysqli_fetch_assoc($selectUsersById)) {  //yollanan query'yi associcative array seklinde tanimla
        extract($row); // assoc array seklinde tanimlanan query'yi $key = value; formatina donustur.
        // $post_id = $_GET['p_id']; 
        }
    
?>


    <form action="" method="post" enctype="multipart/form-data"> 
      <!-- enctype="multipart/form-data form upload etmek icin kullanilir -->


      <div class="form-group">
       <label for="title">Username</label>
       <input type="text" class="form-control" name="username" value="<?php echo $username ?>">
     </div>

     <div class="form-group">
       <label for="user_password">Password</label>
       <input type="text" class="form-control" name="user_password" value="<?php echo $user_password ?>">
     </div>


     <div class="form-group">
       <label for=user_firstname">First Name</label>
       <input class="form-control" type="text" name="user_firstname" id="" value="<?php echo $user_firstname ?>">
     </div>

     <div class="form-group">
       <label for="user_lastname">Last Name</label>
       <input class="form-control" type="text" name="user_lastname" id="" value="<?php echo $user_lastname ?>">
     </div>

     <div class="form-group">
       <label for="user_email">Email</label>
       <input class="form-control" type="text"  name="user_email" value="<?php echo $user_email ?>">
     </div>

    <?php if(!empty($user_image)) { ?>
     <div class="form-group">
       <label for="user_image">User Image</label>
       <img width="200" src="../images/<?php echo $user_image ?>" alt="image" class="img-responsive">
     </div>
     <?php } ?>

     <div class="form-group">
       <label for="user_image">Upload New User Image</label>
       <input type="file"  name="user_image" value="<?php echo $user_image ?>">
     </div>

     <div class="form-group">
       <label for="user_role">User Role</label>
       <select name="user_role" id="" >
         <option value="<?php echo $user_role ?>"><?php echo $user_role ?></option>
         <?php if ($user_role=="subscriber") {
            ?>
         <option value="published">admin</option>
         <?php 
        } else {
            ?>
         <option value="draft">subscriber</option>
         <?php 
        } ?>
       </select>
     </div>

<?php
  if (isset($_POST['update_user'])) {
      $username           = $_POST['username'];
      $user_password      = $_POST['user_password'];
      $user_firstname     = $_POST['user_firstname'];
      $user_lastname      = $_POST['user_lastname'];
      $user_email         = $_POST['user_email'];
      $user_image         = $_FILES['user_image']['name'];
      $user_image_temp    = $_FILES['user_image']['tmp_name'];
      $user_role          = $_POST['user_role'];
      move_uploaded_file($user_image_temp, "../images/$user_image"); //yuklenen dosyayi temp directory den istedigimiz directory ye tasiyabiliriz.

      if(!empty($user_image))
      $img_query = "UPDATE users SET user_image='$user_image' WHERE user_id = $user_id";
      $img_query_result = mysqli_query($con, $img_query);

      $up_query = "UPDATE users SET username='$username', user_password='$user_password', user_firstname='$user_firstname', user_lastname='$user_lastname', user_email='$user_email', user_role='$user_role' WHERE user_id = $user_id";
      $up_query_result = mysqli_query($con, $up_query);
      if (!$up_query_result) {
        echo "CANNOT CONNECT";
      }
  }
  ?>


     <div class="form-group">
      <input class="btn btn-primary" type="submit" name="update_user" value="Update User">
    </div>


  </form>
