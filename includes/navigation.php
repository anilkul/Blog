    <?php include 'db.php'; ?>
    <?php session_start(); ?>

    <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
        <div class="container">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="index.php">Start Bootstrap</a>
            </div>
            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav">
                    
                    <?php
                        $query = "SELECT * FROM categories";
                        $selectAllCategoriesQuery = mysqli_query($con, $query);

                        while ($row = mysqli_fetch_assoc($selectAllCategoriesQuery)) {
                            $cat_title = $row['cat_title'];

                            echo "<li><a href='#'>" . $cat_title . "</a></li>";  
                        }
                    ?>
                    

                    <?php if ($_SESSION['user_role'] === 'admin') { ?>
                    <li>
                        <a href="admin">Admin</a>
                    </li>
                    <?php } ?>
<!--                     <li>
                        <a href="#">Services</a>
                    </li>
                    <li>
                        <a href="#">Contact</a>
                    </li> -->
                </ul>

                <ul class="nav navbar-right top-nav">
                <?php if($_SESSION['user_role']=='admin') { ?>
                <a href="admin/profile.php"><i class="fa fa-fw fa-user"></i> Profile </a>
                <?php } else if ($_SESSION['user_role']=='subscriber') { ?>
                <a href="profile.php"><i class="fa fa-fw fa-user"></i> Profile </a>
                <?php } ?>
                </ul>


            </div>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container -->
    </nav>