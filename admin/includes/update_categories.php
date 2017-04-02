<?php 

if (isset($_GET['edit'])) {
    $cat_id = $_GET['edit'];
    $query = "SELECT * FROM categories WHERE cat_id = $cat_id"; // query yarat
    $selectCategoriesId = mysqli_query($con, $query); //query'yi yolla
    while ($row = mysqli_fetch_assoc($selectCategoriesId)) {
        $cat_id = $row['cat_id'];
        $cat_title = $row['cat_title'];


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

<?php
    if (isset($_POST['update'])) {
        $new_cat_title = $_POST['cat_title'];
        $update = "UPDATE categories SET cat_title = '$new_cat_title' WHERE cat_id = $cat_id";
        $updateCategoryTitle = mysqli_query($con, $update);
    }
?>