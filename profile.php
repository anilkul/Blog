<?php include 'includes/header.php' ?>

<body>
    <?php
    if(isset($_SESSION['username'])) {
        $username = $_SESSION['username'];
    }    

        $query = "SELECT * FROM users WHERE username = '{$username}' "; // query yarat
        $selectUsersById = mysqli_query($con, $query); //query'yi yolla
        if (!$selectUsersById) {
            echo"CANNOT CONNECT: ", mysqli_error($con);
        }

        while ($row = mysqli_fetch_assoc($selectUsersById)) {  //yollanan query'yi associcative array seklinde tanimla
        extract($row); // assoc array seklinde tanimlanan query'yi $key = value; formatina donustur.
        // $post_id = $_GET['p_id']; 
        }
    
    ?>

    
    
    <div id="wrapper">

        <!-- Navigation -->
        <?php include 'includes/navigation.php' ?>

        <div id="page-wrapper">

            <div class="container-fluid" id="form" style="margin: 0 100px 100px 100px;">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                            Profile
                            <small><?php echo $username ?></small>
                        </h1>
                    </div>
                </div>
                <?php
                    $username = $_SESSION['username'];
                    $escuname = mysqli_real_escape_string($con, $username);
                    $query = "SELECT * FROM posts WHERE post_author = '" . $escuname . "'";
                    $posts_query = mysqli_query($con, $query);
                    if (!$posts_query) {
                        echo"CANNOT CONNECT: ", mysqli_error($con);
                    }
                    $num_rows = mysqli_num_rows($posts_query);

                    
                ?>
                <?php  if ($num_rows !== 0) { ?>
                <?php include 'admin/includes/view_all_posts.php' ?>
                <hr>
                <?php } ?>
                
                <form action="" method="post" enctype="multipart/form-data"> 
                <div class="row">
                
                 <div class="col-lg-6">
                     <label for="user_image">User Image</label>
                     <?php if (!empty($user_image)) { ?>
                        <img width="300" src="images/<?php echo $user_image ?>" alt="image" class="img-responsive">
                     <?php } else { ?>
                        <img width="300" src="images/no_user_image.jpg" alt="no_image" class="img-responsive">
                     <?php } ?>
                     <br>
                     <div class="form-group">
                     <label for="user_image">Upload New User Image</label>
                     <input type="file"  name="user_image" value="<?php echo $user_image ?>">
                 </div>
                 </div>
                 
                


                <div class="col-lg-6">
                <!-- /.row -->
                
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

                  header("Location: profile.php");
              }
              ?>

            <div class="form-group">
              <input class="btn btn-primary" type="submit" name="update_user" value="Update User">
          </div>

          </div>
        </div>
    </form>
    </div>
    </div>
      


<!-- /#page-wrapper -->
<?php include 'includes/footer.php' ?>