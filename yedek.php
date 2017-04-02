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
                            if (isset($_POST['submit'])) {
                                $cat_title = $_POST['cat_title'];
                                //bir veri girilmedi ise veya bosluk girildi ise
                                if ($cat_title == "" || empty($cat_title)) {
                                    echo "This field should not be empty";
                                } else {
                                    $query = "INSERT INTO categories(cat_title) VALUES ('$cat_title')";
                                    $createCategoryQuery = mysqli_query($con, $query);

                                    if (!$createCategoryQuery) {
                                        die('QUERY FAILED!' . mysqli_error($con));
                                    }
                                }
                            }
                            ?>

                            <form action="" method="post">

                                <div class="form-group">
                                    <label for="cat_title">Categories</label>
                                    <?php




                                     if (isset($_GET['edit'])) {
                                         $cat_id = $_GET['edit'];
                                        $query = "SELECT * FROM categories WHERE cat_id = $cat_id"; // query yarat
                                        $selectCategoriesId = mysqli_query($con, $query); //query'yi yolla


                                        while ($row = mysqli_fetch_assoc($selectCategoriesId)) {  //yollanan query'yi associcative array seklinde tanimla
                                        extract($row); // assoc array seklinde tanimlanan query'yi $key = value; formatina donustur.

                                            function updateCat($cat)
                                            {
                                                if (isset($cat)) {
                                                    echo $cat;
                                                }
                                            } ?>

                                     <input type="text" class="form-control" name="cat_title" value="<?php updateCat($cat_title) ?>">

                                    <?php 
                                        }
                                     } else {
                                         ?>

                                    <input type="text" class="form-control" name="cat_title">

                                    <?php 
                                     } ?>


                            <!-- UPDATE CATEGORY -->
                            <?php
                                if (isset($_POST['update'])) {
                                    $new_cat_title = $_POST['cat_title2'];
                                    $update = "UPDATE categories SET cat_title = '$new_cat_title' WHERE cat_id = $cat_id";
                                    $updateCategoryTitle = mysqli_query($con, $update);
                                }
                            ?>





                                   
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
                                    <th>Id</th>
                                    <th>Category Title</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php // Kategorileri bul
                                $query = "SELECT * FROM categories"; // query yarat
                                $selectCategories = mysqli_query($con, $query); //query'yi yolla
                                while ($row = mysqli_fetch_assoc($selectCategories)) {  //yollanan query'yi associcative array seklinde tanimla
                                    extract($row); // assoc array seklinde tanimlanan query'yi $key = value; formatina donustur.



                                    echo "<tr>";
                                    echo "<td>" . $cat_id . "</td>";
                                    if(isset($_GET['edit'])) {
                                        echo "<td><input type='text' class='form-control' name='cat_title2' value='$cat_title'></td>";
                                    } else {
                                        echo "<td>" . $cat_title . "</td>";
                                    }
                                    
                                    echo "<td><a href='categories.php?delete={$cat_id}'> Delete </a></td>";// ? ile delete kismini GET ile cekilebilecek sekilde superglobal olarak tanimladik.
                                    echo "<td><a href='categories.php?edit={$cat_id}'> Edit </a></td>";
                                    echo "</tr>";
                                }
                                ?>


                                <?php
                                if (isset($_GET['delete'])) { //url'de tanimladigimiz superglobal delete degerini sanity check yapiyoruz
                                    $cat_id = $_GET['delete']; // yeni cat_id degerimiz silinmesini istedigimiz kategorinin id'si
                                    $query = "DELETE FROM categories WHERE cat_id = $cat_id"; // query yarattik
                                    $delete_query = mysqli_query($con, $query); //query'yi yolladik

                                    header("Location: categories.php"); //Bu komut sayfayi yenilememizi saglar. Bunu yapmazsak 2 kere delete'ye basmak zorunda kaliriz cunku ilk seferde delte degeri superglobala atanir ikincisinde uygulanir.
                                }
                                ?>

                                <?php
                                    echo
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