<?php include 'inc/header.php'; ?>
<?php include 'inc/sidebar.php'; ?>


<?php 
    
    if (!isset($_GET['viewpostid']) || $_GET['viewpostid'] == NULL) {
       
       echo "<script>window.location= 'postlist.php';</script>";
       //header("Location:catlist.php"); 
    } else{

        $postid = $_GET['viewpostid'];
    }

?>


<?php 

if ( $_SERVER['REQUEST_METHOD'] == 'POST' ) {

    echo "<script>window.location = 'postlist.php';</script>";

    }


?>


        <div class="grid_10">
        
            <div class="box round first grid">
                <h2>Edit Post</h2>
        <div class="block"> 



                 <form action="" method="post" enctype="multipart/form-data">
                    <table class="form">


        <?php 

        $query = " SELECT * FROM tbl_post  WHERE id = '$postid'  ORDER BY id DESC";
        $post = $db->select($query);

        if ($post) {
           while ($postresult = $post->fetch_assoc()) {
          

        ?>

                       
                        <tr>
                            <td>
                                <label>Title</label>
                            </td>
                            <td>
                                <input type="text" name="title" readonly value="<?php echo $postresult['title']; ?>" class="medium" />
                            </td>
                        </tr>
                     
                        <tr>
                            <td>
                                <label>Category</label>
                            </td>
                            <td>
                                <select  id="select" name="cat">
                                    <option value="1">Select Category</option>

                            <?php 

                                $query = "SELECT * FROM tbl_category ORDER BY id DESC ";
                                $category = $db->select($query);
                                if ($category) {
                                   
                                 while ($result = $category->fetch_assoc()) {
                                    
                        
                        ?>
                                    <option  
                                    <?php 

                                    if ($postresult['cat'] == $result['id']){    
                                     
                                    ?>
                                    selected= "selected"
                                    <?php } ?> value="<?php echo $result['id']; ?>"><?php echo $result['name']; ?></option>

                                
                                    
                                    <?php } } ?>
                                </select>
                            </td>
                        </tr>

                    
                        <tr>
                            <td>
                                <label> Image</label>
                            </td>
                            <td>
                                <img height="80px" width="200px" src="<?php echo $postresult['image']; ?>"/>
                                
                            </td>
                        </tr>
                        <tr>
                            <td style="vertical-align: top; padding-top: 9px;">
                                <label>Content</label>
                            </td>
                            <td>
                                <textarea readonly name="body" class="tinymce" >
                                    
                                    <?php echo $postresult['body']; ?>

                                </textarea>
                            </td>
                        </tr>

                         <tr>
                            <td>
                                <label>Tags</label>
                            </td>
                            <td>
                                <input readonly type="text" name="tags" value="<?php echo $postresult['tags']; ?>" class="medium" />
                            </td>
                        </tr>


                         <tr>
                            <td>
                                <label>Author</label>
                            </td>
                            <td>
                                <input type="text" readonly name="author" value="<?php echo $postresult['author']; ?>" class="medium" />
                                
                            </td>
                        </tr>

                        <tr>
                            <td>
                               
                            </td>
                            <td>
                            <input type="submit" name="submit" Value="Back to postlist" />
                                
                            </td>
                        </tr>



                       


                          <?php } } else {
					    echo "<h2> 404 Page Not Found</h2>";
				}?>
                    </table>

                  
                    </form>


                    
                </div>
            </div>
        </div>
    
<?php include 'inc/footer.php'; ?>