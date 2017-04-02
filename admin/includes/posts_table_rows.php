<tr>
    <td><?php echo $post_author ?></td>
    <td><a href="../post.php?p_id=<?php echo $post_id ?>"><?php echo $post_title ?></a></td>

    <?php
                                        $query = "SELECT * FROM categories WHERE cat_id = $post_category_id"; // query yarat
                                        $selectCategoriesId = mysqli_query($con, $query); //query'yi yolla
                                        while ($row = mysqli_fetch_assoc($selectCategoriesId)) {
                                            $cat_id = $row['cat_id'];
                                            $cat_title = $row['cat_title']; ?>
                                            <td><?php echo $cat_title ?></td>
                                            <?php 
                                        } ?>
                                            <td><?php echo $post_status ?></td>
                                            <td>
                                                <?php if (!empty($post_image)) {
                                            ?>
                                                <img width="100" src="../images/<?php echo $post_image ?>" alt="image" class="img-responsive" >
                                                <?php 
                                        } else {
                                            ?>
                                                <p align="center">No Image</p>        
                                                <?php 
                                        } ?>
                                            </td>
                                            <td><?php echo $post_tags ?></td>
                                            <td><?php echo $post_comment_count ?></td>
                                            <td><?php echo $post_date ?></td>
                                            <td><a href="posts.php?source=edit_post&p_id=<?php echo $post_id ?>">Edit</a></td> <!-- Hem source'a yonlendirdik hem de p_id ile post id'mizi yolladik -->
                                            <td><a href="posts.php?delete=<?php echo $post_id ?>">Delete</a></td>
                                        </tr>