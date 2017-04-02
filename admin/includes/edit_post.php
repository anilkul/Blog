<?php

	if (isset($_GET['p_id'])) {
        $post_id = $_GET['p_id'];
    }

    $query = "SELECT * FROM posts WHERE post_id = $post_id"; // query yarat
        $selectPostsById = mysqli_query($con, $query); //query'yi yolla
        while ($row = mysqli_fetch_assoc($selectPostsById)) {  //yollanan query'yi associcative array seklinde tanimla
        extract($row); // assoc array seklinde tanimlanan query'yi $key = value; formatina donustur.
        // $post_id = $_GET['p_id']; 
        }
    
?>


	<form action="" method="post" enctype="multipart/form-data"> 
      <!-- enctype="multipart/form-data form upload etmek icin kullanilir -->


      <div class="form-group">
       <label for="title">Post Title</label>
       <input type="text" class="form-control" name="title" value="<?php echo $post_title ?>">
     </div>
	
	<div class="form-group">
	 <select name="post_category" id="" >
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
       <label for="users">Post Author</label>
       <input class="form-control" type="text" name="author" id="" value="<?php echo $post_author ?>">
     </div>

     <div class="form-group">
     <label for="post_status">Post Status:</label>   
       <select name="post_status" id="" >
         <option value="<?php echo $post_status ?>"><?php echo $post_status ?></option>
         <?php if ($post_status=="draft") {
            ?>
         <option value="published">published</option>
         <?php 
        } else {
            ?>
         <option value="draft">draft</option>
         <?php 
        } ?>
       </select>
     </div>
	
	<?php if(!empty($post_image)) { ?>
	 <div class="form-group">
       <label for="post_image">Current Image</label>
       <img width="200" src="../images/<?php echo $post_image ?>" alt="image" class="img-responsive">
     </div>
     <?php } ?>

     <div class="form-group">
       <label for="post_image">Post Image</label>
       <input type="file"  name="image">
     </div>

     <div class="form-group">
       <label for="post_tags">Post Tags</label>
       <input type="text" class="form-control" name="post_tags" value="<?php echo $post_tags ?>">
     </div>

     <div class="form-group">
       <label for="post_content">Post Content</label>
       <textarea class="form-control" name="post_content" id="" cols="30" rows="10"><?php echo $post_content ?></textarea>
     </div>


	<?php
	if (isset($_POST['update_post'])) {
	$post_title = $_POST['title'];
    $post_author = $_POST['author'];
    $post_category_id = $_POST['post_category_id'];
    $post_status = $_POST['post_status'];

    $post_image = $_FILES['image']['name']; //dosya upload edecegimiz icin input html taginin ismi = image, name ise yuklenen dosyanin ismi
     $post_image_temp = $_FILES['image']['tmp_name'];
     move_uploaded_file($post_image_temp, "../images/$post_image");


    $post_tags = $_POST['post_tags'];
    $post_content = $_POST['post_content'];
    $post_date = date('d-m-y');



		
			$up_query = "UPDATE posts SET post_title='$post_title', post_category_id='$post_category_id', post_author='$post_author', post_date=now(), post_status='$post_status', post_image='$post_image', post_tags='$post_tags', post_content='$post_content' WHERE post_id = $post_id";
			mysqli_query($con, $up_query);
	}
	?>


     <div class="form-group">
      <input class="btn btn-primary" type="submit" name="update_post" value="Update Post">
    </div>


  </form>