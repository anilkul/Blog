<table class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>Id</th>
                                    <th>Author</th>
                                    <th>Comment</th>
                                    <th>Email</th>
                                    <th>Status</th>
                                    <th>In Response To</th>
                                    <th>Date</th>
                                    <th>Aprrove</th>
                                    <th>Unapprove</th>
                                    <th>Delete</th>
                                </tr>
                            </thead>
                            <tbody>
                                
    <?php
        $query = "SELECT * FROM comments"; // query yarat
        $selectComments = mysqli_query($con, $query); //query'yi yolla
        while ($row = mysqli_fetch_assoc($selectComments)) {  //yollanan query'yi associcative array seklinde tanimla
        extract($row); // assoc array seklinde tanimlanan query'yi $key = value; formatina donustur.
       
    ?>
                                    <tr>
                                    <td><?php echo $comment_id ?></td>
                                    <td><?php echo $comment_author ?></td>
                                    <td><?php echo $comment_content ?></td>
                                    <td><?php echo $comment_email ?></td>
                                    <td><?php echo $comment_status ?></td>
                                    <?php
                                        $query = "SELECT * FROM posts WHERE post_id = $comment_post_id";
                                        $selectPostIdQuery = mysqli_query($con, $query);
                                        while ($row = mysqli_fetch_assoc($selectPostIdQuery)) {
                                            $post_id = $row['post_id'];
                                            $post_title = $row['post_title'];
                                        }

                                    ?>
                                    <!-- basliga link verelim -->
                                    <td><a href='../post.php?p_id=<?php echo $post_id ?>'><?php echo $post_title ?></a></td>
                                    <td><?php echo $comment_date ?></td>
                                    <td><a href="comments.php?approve=<?php echo $comment_id ?>">Approve</a></td>
                                    <td><a href="comments.php?unapprove=<?php echo $comment_id ?>">Unapprove</a></td>
                                    <td><a href="comments.php?delete=<?php echo $comment_id ?>">Delete</a></td>
                                    </tr>
        <?php  } ?>
                            </tbody>
                        </table> 

        <?php
        if (isset($_GET['unapprove'])) {
            $comment_id = $_GET['unapprove'];
            $unapprove_query = "UPDATE comments set comment_status = 'unapproved' WHERE comment_id = $comment_id";
            $unapprove_result = mysqli_query($con, $unapprove_query);
            if ($del_com_query) {
                echo "Deleted";
            }
            header("Location: comments.php");
        }

        if (isset($_GET['approve'])) {
            $comment_id = $_GET['approve'];
            $approve_query = "UPDATE comments set comment_status = 'approved' WHERE comment_id = $comment_id";
            $approve_result = mysqli_query($con, $approve_query);
            if ($del_com_query) {
                echo "Deleted";
            }
            header("Location: comments.php");
        }




        if (isset($_GET['delete'])) {
            $comment_id = $_GET['delete'];
            $del_com_query = "DELETE FROM comments WHERE comment_id = $comment_id";
            $del_com_result = mysqli_query($con, $del_com_query);
            if ($del_com_query) {
                echo "Deleted";
            }
            header("Location: comments.php");
        }
    ?>