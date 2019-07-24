<?php include 'inc/header.php'; ?>
<?php include 'inc/sidebar.php'; ?>


<?php 
    
    if (!isset($_GET['pageid']) || $_GET['pageid'] == NULL) {
       
       echo "<script>window.location= 'index.php';</script>";
       //header("Location:catlist.php"); 
    } else{


        $pageid = $_GET['pageid'];

    }

?>


        <div class="grid_10">
		
            <div class="box round first grid">
                <h2>Update Page</h2>
        <div class="block"> 

    <?php 

        if ( $_SERVER['REQUEST_METHOD'] == 'POST' ) {

         

            $name = mysqli_real_escape_string($db->link,  $_POST['name']);
              $body = mysqli_real_escape_string($db->link, $_POST['body']);
               


                if ($name == ""  || $body == "" ) {
                    echo "<span style='color:red;font-size:18px;'>Field must not be empty!!</span>";

                }else{

             $updatequery = "UPDATE tbl_page SET name = '$name', body = '$body' WHERE id= '$pageid' ";

                                $updated_rows = $db->update($updatequery);
                                 if ($updated_rows) {
                                 echo "<span class='success'>Page Updated Successfully.
                                 </span>";
                                } else {
                                 echo "<span class='error'>Page Not Updated !</span>";
                                }
                    }

        }

    ?>
                 <form action="" method="post" enctype="multipart/form-data">

                    
                     <?php 

                            $query = " SELECT * FROM tbl_page WHERE id = '$pageid'";
                            $pages = $db->select($query);

                            if ($pages) {
                               while ($result = $pages->fetch_assoc()) {
          

                                ?>

                    <table class="form">
                       
                        <tr>
                            <td>
                                <label>Name</label>
                            </td>
                            <td>
                                <input type="text" name="name" value="<?php echo $result['name'];?>" class="medium" />
                            </td>
                        </tr>

                        <tr>
                            <td style="vertical-align: top; padding-top: 9px;">
                                <label>Content</label>
                            </td>
                            <td>
                                <textarea  name="body" class="tinymce" style=" min-height: 20pc;  min-width: 835px;">
                                    
                                    <?php echo $result['body'];?>

                                </textarea>
                            </td>
                        </tr>
					<tr>
                            <td></td>
                            <td>
                
                                <input type="submit" name="submit" Value="Update" />
                                <span ><a onclick="return confirm('Are you sure to delete the Page!');" style="border: 1px solid #ddd; color: #444; font-weight: normal; background-color:#f0f0f0;  cursor: pointer; font-size: 20px; padding: 2px 10px;"  href="delpage.php?delpage=<?php echo $result['id'];?>">Delete</a></span>
                            </td>
                        </tr>
                    </table>

                      <?php } }else {
					    echo "<h2> 404 Page Not Found</h2>";;
				} ?>

                    </form>
                </div>
            </div>
        </div>
    
<?php include 'inc/footer.php'; ?>