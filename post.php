<?php include 'includes/db.php'; ?>
<?php include 'includes/header.php'; ?>

<!-- Navigation -->
<?php include 'includes/navigation.php'; ?>

<!-- Page Content -->
<div class="container">

    <div class="row">

        <!-- Blog Entries Column -->
        <div class="col-md-8">


            <?php

            if (isset($_GET['p_id'])) {
                $post_id = $_GET['p_id'];
            }

            $query = "SELECT * FROM posts WHERE post_id = $post_id";
            $selectAllPostsQuery = mysqli_query($con, $query);

            while ($row = mysqli_fetch_assoc($selectAllPostsQuery)) {
                $post_title   = $row['post_title'];
                $post_author  = $row['post_author'];
                $post_date    = $row['post_date'];
                $post_image   = $row['post_image'];
                $post_content = $row['post_content']; ?>

                <h1 class="page-header">
                    Page Heading
                    <small>Secondary Text</small>
                </h1>

                <!-- First Blog Post -->
                <h2>
                    <a href="#"><?php echo $post_title ?></a>
                </h2>
                <p class="lead">
                    by <a href="index.php"><?php echo $post_author ?></a>
                </p>
                <p><span class="glyphicon glyphicon-time"></span><?php echo $post_date ?></p>
                <hr>
                <?php if(!empty($post_image)) { ?>
                    <img style="width:900px;height:300px;" class="img-responsive" src="images/<?php echo $post_image ?>" alt="post_image">
                    <hr>
                <?php } ?>
                <p><?php echo $post_content ?></p>
                <a class="btn btn-primary" href="post.php?p_id=<?php echo $post_id ?>">Read More <span class="glyphicon glyphicon-chevron-right"></span></a>

                <hr>

                <?php } ?> 

                
                <!-- Blog Comments -->
                
                <?php
                    if (isset($_POST['create_comment'])) {
                        $post_id = $_GET['p_id'];

                        $comment_author = $_POST['comment_author'];
                        $comment_email = $_POST['comment_email'];
                        $comment_content = $_POST['comment_content'];

                        $query = "INSERT INTO comments(comment_post_id, comment_author, comment_email, comment_content, comment_status, comment_date) VALUES($post_id,'$comment_author', '$comment_email', '$comment_content', 'unapproved', now())";
                        $createCommentQuery = mysqli_query($con, $query);

                        $comment_count_query = "UPDATE posts SET post_comment_count = post_comment_count + 1 WHERE post_id = $post_id";
                        $update_comment_count=mysqli_query($con, $comment_count_query);
                    }



                ?>

                <!-- Comments Form -->
                <div class="well">
                    <h4>Leave a Comment:</h4>
                    <form  role="form" action="" method="post">
                        <div class="form-group">
                            <label for="comment_author">Comment Author</label>
                            <input name="comment_author" class="form-control" type="text">
                        </div>
                        <div class="form-group">
                            <label for="comment_email">Email</label>
                            <input name="comment_email" class="form-control" type="email">
                        </div>
                        <div class="form-group">
                            <label for="comment_content">Comment</label>
                            <textarea class="form-control" rows="3" name="comment_content"></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary" name="create_comment">Submit</button>
                    </form>
                </div>

                <hr>

                <!-- Posted Comments -->
                <?php
                    if (isset($_GET['p_id'])) {
                        $comment_post_id = $_GET['p_id'];
                    }
                    $query = "SELECT * FROM comments WHERE comment_post_id=$comment_post_id AND comment_status='approved' ORDER BY comment_id DESC";
                    $comment_result = mysqli_query($con, $query);
                    while ($row = mysqli_fetch_assoc($comment_result)) {
                        $comment_date    = $row['comment_date'];
                        $comment_content = $row['comment_content'];
                        $comment_author  = $row['comment_author'];
                ?>

                <!-- Comment -->
                <div class="media">
                    <a class="pull-left" href="#">
                        <img class="media-object" src="http://placehold.it/64x64" alt="">
                    </a>
                    <div class="media-body">
                        <h4 class="media-heading"><?php echo $comment_author ?>
                            <small><?php echo $comment_date ?></small>
                        </h4>
                        <?php echo $comment_content ?>
                    </div>
                </div>
                <?php } ?>

            </div>

            <!-- Blog Sidebar Widgets Column -->
            <?php include 'includes/sidebar.php'; ?>

        </div>
        <!-- /.row -->

        <hr>

        <?php
        include 'includes/footer.php';
        ?>