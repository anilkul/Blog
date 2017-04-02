
<?php
if (isset($_POST['create_post'])) {
  $post_title = $_POST['title'];
  $post_author = $_SESSION['username'];
  $post_category_id = $_POST['post_category_id'];
  $post_status = $_POST['post_status'];

    $post_image = $_FILES['image']['name']; //dosya upload edecegimiz icin input html taginin ismi = image, name ise yuklenen dosyanin ismi
    $post_image_temp = $_FILES['image']['tmp_name'];

    $post_tags = $_POST['post_tags'];
    $post_content = $_POST['post_content'];
    $post_date = date('d-m-y');
    // $post_comment_count = 4;

    move_uploaded_file($post_image_temp, "../images/$post_image"); //yuklenen dosyayi temp directory den istedigimiz directory ye tasiyabiliriz.
      $query = "INSERT INTO posts(post_category_id, post_title, post_author, post_date, post_image, post_content, post_tags, post_status) VALUES($post_category_id, '$post_title', '$post_author', now(), '$post_image', '$post_content', '$post_tags', '$post_status')"; //tablodaki sira onemli

      $result = mysqli_query($con, $query);
      if (!$result) {
        echo "CANNOT CONNECT ";
      }
    }

if ($_SESSION['user_role']!== "admin") {
    header("Location: profile.php");  
    }
    header("Location: posts.php");
    ?>


    <form action="" method="post" enctype="multipart/form-data"> 
      <!-- enctype="multipart/form-data form upload etmek icin kullanilir -->


      <div class="form-group">
       <label for="title">Post Title</label>
       <input type="text" class="form-control" name="title">
     </div>

     <div class="form-group">
     <label for="post_category_id">Post Category</label><br>
         <select name="post_category_id" id="" >
          <?php
        $query = "SELECT * FROM categories"; // query yarat
        $selectCategories = mysqli_query($con, $query); //query'yi yolla
        while ($row = mysqli_fetch_assoc($selectCategories)) {
          $cat_id = $row['cat_id'];
          $cat_title = $row['cat_title']; ?>
          <option value="<?php echo $cat_id ?>"><?php echo $cat_title ?></option>

          <?php 
        } ?>

      </select>

  </div>


  

 <div class="form-group">
   <select name="post_status" id="">
     <option value="draft">Post Status</option>
     <option value="published">Published</option>
     <option value="draft">Draft</option>
   </select>
 </div>



 <div class="form-group">
   <label for="post_image">Post Image</label>
   <input type="file"  name="image">
 </div>

 <div class="form-group">
   <label for="post_tags">Post Tags</label>
   <input type="text" class="form-control" name="post_tags">
 </div>

 <div class="form-group">
   <label for="post_content">Post Content</label>
   <textarea class="form-control" name="post_content" id="" cols="30" rows="10"></textarea>
 </div>



 <div class="form-group">
  <input class="btn btn-primary" type="submit" name="create_post" value="Publish Post">
</div>


</form>

