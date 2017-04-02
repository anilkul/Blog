<?php include 'includes/header.php' ?>

<body>

    <div id="wrapper">

        <!-- Navigation -->
        <?php include 'includes/navigation.php' ?>

        <div id="page-wrapper">

            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">

                        <h1 class="page-header">
                            Welcome To The Admin Page
                            <small>Author</small>
                        </h1>

                        <div class="col-xs-6">

                            <?php
                            insertCategories();
                            ?>

                            <form action="" method="post">

                                <div class="form-group">
                                    <label for="cat_title">Categories</label>
                                    <!-- UPDATE CATEGORY -->
                                    <?php include 'includes/update_categories.php'; ?>
         
                                    </div>
                                    <div class="form-group">
                                       <input class="btn btn-primary" type="submit" name="submit" value="Add Category">
                                       <input type="submit" class="btn btn-primary" name="update" value="Update Category">
                                   </div>
                               </form>

                           </div>
                           <!-- Add Category Form -->
                           <div class="col-xs-6">
                            <table class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th>Category Title</th>
                                    </tr>
                                </thead>
                                <tbody>
                                <?php // Kategorileri bul
                                createCategoryTable();
                                ?>


                                <?php
                                deleteCategory();
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <!-- /.row -->

        </div>
        <!-- /.container-fluid -->

    </div>
    <!-- /#page-wrapper -->
    <?php include 'includes/footer.php' ?>