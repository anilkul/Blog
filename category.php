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

            if(isset($_GET['category'])) { //sidebar.php den kategoriye tikladigimizda tanimlanan superglobal category verisini cekiyoruz.
                $post_category_id = $_GET['category'];
            }

            $query = "SELECT * FROM posts WHERE post_category_id = $post_category_id AND post_status= 'published' ORDER BY post_id DESC"; //sadece cekilen category verisi ile ayni id'deki category'lere ait postlari seciyoruz.
            $selectAllPostsQuery = mysqli_query($con, $query);

            while ($row = mysqli_fetch_assoc($selectAllPostsQuery)) {
                $post_id      = $row['post_id'];
                $post_title   = $row['post_title'];
                $post_author  = $row['post_author'];
                $post_date    = $row['post_date'];
                $post_image   = $row['post_image'];
                $post_content = substr($row['post_content'],0,200); //belirli uzunlukta string parcasi dondurur.
                ?>

                <h1 class="page-header">
                    Page Heading
                    <small>Secondary Text</small>
                </h1>

                <!-- First Blog Post -->
                <h2>
                    <a href="post.php?p_id=<?php echo $post_id ?>"><?php echo $post_title ?></a>
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
                <p><?php echo $post_content . "..."?></p>
                <a class="btn btn-primary" href="post.php?p_id=<?php echo $post_id ?>">Read More <span class="glyphicon glyphicon-chevron-right"></span></a>

                <hr>

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