<table class="table table-bordered table-hover">
    <thead>
        <tr>
            <th>Author</th>
            <th>Title</th>
            <th>Category</th>
            <th>Status</th>
            <th>Image</th>
            <th>Tags</th>
            <th>Comments</th>
            <th>Dates</th>
            <th>Edit</th>
            <th>Delete</th>
        </tr>
    </thead>
    <tbody>

        <?php
        $url = 'http://' . $_SERVER['SERVER_NAME'] . $_SERVER['REQUEST_URI'];
        
        if (strpos($url, 'profile') !== false) {
            $username = $_SESSION['username'];
            $escuname = mysqli_real_escape_string($con, $username);
            $query = "SELECT * FROM posts WHERE post_author = '" . $escuname . "'"; 

        } else {
            $query = "SELECT * FROM posts";
        }
        $selectPosts = mysqli_query($con, $query); //query'yi yolla

        if (!$selectPosts) {
            echo"CANNOT CONNECT: ", mysqli_error($con);
        }
        while ($row = mysqli_fetch_assoc($selectPosts)) {  //yollanan query'yi associcative array seklinde tanimla
        extract($row); // assoc array seklinde tanimlanan query'yi $key = value; formatina donustur.
        
        ?>
        <?php include 'posts_table_rows.php' ?>
        <?php 
    } ?>
</tbody>
</table> 
<?php
if (isset($_GET['delete'])) {
    $the_post_id = $_GET['delete'];
    $query = "DELETE FROM posts WHERE post_id = {$the_post_id}";
    $del_result = mysqli_query($con, $query);
    if (strpos($url, 'profile') !== false) {
    header("Location: profile.php");  
    }
    header("Location: posts.php");
}
?>