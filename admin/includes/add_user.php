
<?php
if (isset($_POST['create_user'])) {

      
      $username           = $_POST['username'];
      $user_password      = $_POST['user_password'];
      $user_firstname     = $_POST['user_firstname'];
      $user_lastname      = $_POST['user_lastname'];
      $user_email         = $_POST['user_email'];
      $user_image         = $_FILES['user_image']['name'];
      $user_image_temp    = $_FILES['user_image']['tmp_name'];
      $user_role          = $_POST['user_role'];






  // $post_title = $_POST['title'];
  // $post_author = $_POST['author'];
  // $post_category_id = $_POST['post_category_id'];
  // $post_status = $_POST['post_status'];

  //   $post_image = $_FILES['image']['name']; //dosya upload edecegimiz icin input html taginin ismi = image, name ise yuklenen dosyanin ismi
  //   $post_image_temp = $_FILES['image']['tmp_name'];

  //   $post_tags = $_POST['post_tags'];
  //   $post_content = $_POST['post_content'];
  //   $post_date = date('d-m-y');
    // $post_comment_count = 4;

    move_uploaded_file($user_image_temp, "../images/$user_image"); //yuklenen dosyayi temp directory den istedigimiz directory ye tasiyabiliriz.
      $query = "INSERT INTO users(username, user_password, user_firstname, user_lastname, user_email, user_image, user_role) VALUES('$username', '$user_password', '$user_firstname', '$user_lastname', '$user_email', '$user_image', '$user_role')"; //tablodaki sira onemli

      $result = mysqli_query($con, $query);
      if (!$result) {
        echo "CANNOT CONNECT ";
      }
    }

    ?>


    <form action="" method="post" enctype="multipart/form-data"> 
      <!-- enctype="multipart/form-data form upload etmek icin kullanilir -->


      <div class="form-group">
       <label for="title">Username</label>
       <input type="text" class="form-control" name="username">
     </div>

     <div class="form-group">
       <label for="user_password">Password</label>
       <input type="text" class="form-control" name="user_password">
     </div>

    <?php if(!empty($post_image)) { ?>
     <div class="form-group">
       <label for="user_firstname">First Name</label>
       <input class="form-control" type="text" name="user_firstname" id="">
     </div>
     <?php } ?>

     <div class="form-group">
       <label for="user_lastname">Last Name</label>
       <input class="form-control" type="text" name="user_lastname" id="">
     </div>

     <div class="form-group">
       <label for="user_email">Email</label>
       <input class="form-control" type="text"  name="user_email">
     </div>

     <div class="form-group">
       <label for="user_image">User Image</label>
       <input type="file"  name="user_image">
     </div>

     <div class="form-group">
       <label for="user_role">User Role</label><br>
       <select name="user_role" id="" >
         <option value="published">admin</option>
         <option value="draft">subscriber</option>
         
       </select>
     </div>



     <div class="form-group">
      <input class="btn btn-primary" type="submit" name="create_user" value="Create User">
    </div>


  </form>