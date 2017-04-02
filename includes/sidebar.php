
<div class="col-md-4">
<?php session_start() ?>

<!-- Login -->
<?php if(empty($_SESSION['user_role'])) { ?>
    <div class="well">

        <h4>Login</h4>
        <form action="" method="post">
            <div class="form-group">
                <input name="username" type="text" class="form-control" placeholder="Username">
            </div>
            <div class="input-group">
                <input type="password" name="user_password" class="form-control" placeholder="Password">
                <span class="input-group-btn">
                    <button class="btn btn-primary" name="login" type="submit">Login</button>
                </span>
            </div>
            <div>
                <?php
                if (isset($_POST['login'])) {
                    include 'login.php';
                    if ($username === $db_username && $user_password === $db_user_password) {
                        $_SESSION['username'] = $db_username;
                        $_SESSION['user_firstname'] = $db_user_firstname;
                        $_SESSION['user_lastname'] = $db_user_lastname;
                        $_SESSION['user_role'] = $db_user_role;
                        header("Location: admin");
                        
                    } elseif ($username !== $db_username && $user_password !== $db_user_password) {
                        header('refresh: 5; url=index.php');
                        echo 'Invalid Credentials, wait 5 seconds or just click <a href="index.php">HERE</a> to check again.'; //hayvan fonksiyonu

                        
                    } else {
                        header("Location: index.php");
                    }
                }
         
                ?>
            </div>
            

        </form> <!--Search form-->
        <!-- /.input-group -->
    </div>
<?php } else { ?>
    <div class="well">
        Welcome, <?php echo $_SESSION['user_firstname'] ?><a href="admin/includes/logout.php"><i class="fa fa-fw fa-power-off"></i> Log Out</a>
    </div>
<?php } ?>
    <!-- Blog Search Well -->
    <div class="well">

        <h4>Blog Search</h4>
        <form action="search.php" method="post">
            <div class="input-group">
                <input name="search" type="text" class="form-control">
                <span class="input-group-btn">
                    <button name="submit" class="btn btn-default" type="submit">
                        <span class="glyphicon glyphicon-search"></span>
                    </button>
                </span>
            </div>
        </form> <!--Search form-->
        <!-- /.input-group -->
    </div>

    


    <!-- Blog Categories Well -->
    <div class="well">

        <?php
        $query = "SELECT * FROM categories";
        $selectCategoriesSidebar = mysqli_query($con, $query);

        
        ?>

        <h4>Blog Categories</h4>
        <div class="row">
            <div class="col-lg-6">
                <ul class="list-unstyled">
                    <?php
                    while ($row = mysqli_fetch_assoc($selectCategoriesSidebar)) {
                        $cat_title = $row['cat_title'];
                        $cat_id = $row['cat_id'];

                        echo "<li><a href='category.php?category=$cat_id'>" . $cat_title . "</a></li>";
                    }
                    ?>
                    
                </ul>
            </div>
            
            <!-- /.col-lg-6 -->
        </div>
        <!-- /.row -->
    </div>






    <!-- Side Widget Well -->
    <?php include 'includes/widget.php'; ?>
    
</div>
</div>
<hr>















