<?php include 'inc/header.php'; ?>
<?php include 'inc/sidebar.php'; ?>


<?php 
    
    if (!isset($_GET['editpostid']) || $_GET['editpostid'] == NULL) {
       
       echo "<script>window.location= 'postlist.php';</script>";
       //header("Location:catlist.php"); 
    } else{


        $postid = $_GET['editpostid'];
    }

?>

        <div class="grid_10">
        
            <div class="box round first grid">
                <h2>Edit Post</h2>
        <div class="block"> 



    <?php 

        if ( $_SERVER['REQUEST_METHOD'] == 'POST' ) {

         

            $title = mysqli_real_escape_string($db->link,  $_POST['title']);
             $cat = mysqli_real_escape_string($db->link, $_POST['cat']);
              $body = mysqli_real_escape_string($db->link, $_POST['body']);
               $tags = mysqli_real_escape_string($db->link, $_POST['tags']);
                $author = mysqli_real_escape_string($db->link, $_POST['author']);
                $userid = mysqli_real_escape_string($db->link, $_POST['userid']);

                $permited  = array('jpg', 'jpeg', 'png', 'gif');
                $file_name = $_FILES['image']['name'];
                $file_size = $_FILES['image']['size'];
                $file_temp = $_FILES['image']['tmp_name'];

                $div = explode('.', $file_name);
                $file_ext = strtolower(end($div));
                $unique_image = substr(md5(time()), 0, 10).'.'.$file_ext;
                $uploaded_image = "upload/".$unique_image;


                if ($title == "" || $cat == "" || $body == "" || $tags == "" || $author == "" ) {
                    echo "<span style='color:red;font-size:18px;'>Field must not be empty!!</span>";

                } else{


                // check image updated or not ...

                if (!empty($file_name)) {
                    
               
                        if($file_size >1048567) {
                                 echo "<span class='error'>Image Size should be less then 1MB! </span>";
                                } 
                        elseif (in_array($file_ext, $permited) === false) {
                                 echo "<span class='error'>You can upload only:-" .implode(', ', $permited)."</span>";
                                } 
                        else{
                                move_uploaded_file($file_temp, $uploaded_image);


                    $query = "UPDATE tbl_post SET cat = '$cat', title = '$title', body = '$body', image = '$uploaded_image', author = '$author', tags = '$tags', userid = '$userid' WHERE id= $postid ";
                                $updated_rows = $db->update($query);

                                 if ($updated_rows) {
                                 echo "<span class='success'>Data Updated Successfully.
                                 </span>";
                                } else {
                                 echo "<span class='error'>Data Not Updated !</span>";
                                }

                            }



                } 



                else{



                    $query = "UPDATE tbl_post SET cat = '$cat', title = '$title', body = '$body', author = '$author', tags = '$tags', userid = '$userid' WHERE id= $postid ";
                                $updated_rows = $db->update($query);

                                 if ($updated_rows) {
                                 echo "<span class='success'>Data Updated Successfully.
                                 </span>";
                                } else {
                                 echo "<span class='error'>Data Not Updated !</span>";
                                }

                }


            }

        }


    ?>


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
                                <input type="text" name="title" value="<?php echo $postresult['title']; ?>" class="medium" />
                            </td>
                        </tr>
                     
                        <tr>
                            <td>
                                <label>Category</label>
                            </td>
                            <td>
                                <select id="select" name="cat">
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
                                <label>Upload Image</label>
                            </td>
                            <td>
                                <img height="80px" width="200px" src="<?php echo $postresult['image']; ?>"/>
                                <div><input type="file" name="image"  /></div>
                            </td>
                        </tr>
                        <tr>
                            <td style="vertical-align: top; padding-top: 9px;">
                                <label>Content</label>
                            </td>
                            <td>
                                <textarea name="body" class="tinymce" >
                                    
                                    <?php echo $postresult['body']; ?>

                                </textarea>
                            </td>
                        </tr>

                         <tr>
                            <td>
                                <label>Tags</label>
                            </td>
                            <td>
                                <input type="text" name="tags" value="<?php echo $postresult['tags']; ?>" class="medium" />
                            </td>
                        </tr>


                         <tr>
                            <td>
                                <label>Author</label>
                            </td>
                            <td>
                                <input type="text" name="author" value="<?php echo $postresult['author']; ?>" class="medium" />
                                <input type="hidden" readonly name="userid" value="<?php echo Session::get('userid'); ?>" class="medium" />
                            </td>
                        </tr>



                        <tr>
                            <td></td>
                            <td>
                                <input type="submit" name="submit" Value="Update" />
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