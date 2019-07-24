<?php include 'inc/header.php'; ?>
<?php include 'inc/sidebar.php'; ?>

<style>
    
.leftside{
    float: left;
    width: 70%;

}
.rightside{
    float: left;
    width: 30%;
}

.rightside img{

    width:170px;
    height: 160px;
}

</style>





        <div class="grid_10">
		
            <div class="box round first grid">
                <h2>Update Site Title and Description</h2>

<?php 

       if ( $_SERVER['REQUEST_METHOD'] == 'POST' ) {


            $title = $fm->validation($_POST['title']);
            $slogan = $fm->validation($_POST['slogan']);

            $title = mysqli_real_escape_string($db->link,  $title);
             $slogan = mysqli_real_escape_string($db->link, $slogan);
              

               

                $permited  = array('png');
                $file_name = $_FILES['image']['name'];
                $file_size = $_FILES['image']['size'];
                $file_temp = $_FILES['image']['tmp_name'];

                $div = explode('.', $file_name);
                $file_ext = strtolower(end($div));
                $unique_image = substr(md5(time()), 0, 10).'.'.$file_ext;
                $uploaded_image = "upload/".$unique_image;


                if ($title == "" || $slogan == "" ) {
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


            $query = " UPDATE title_slogan SET  title = '$title', slogan = '$slogan', image = '$uploaded_image' WHERE id=1 ";
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



                    $query = "UPDATE title_slogan SET  title = '$title', slogan = '$slogan' WHERE id=1 ";
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








                <div class="block sloginblock"> 
                <div class="leftside">              
                <form action="" method="post" enctype="multipart/form-data">

                    <?php 

                    $query = "SELECT * FROM title_slogan WHERE id = 1 ORDER BY id DESC";
                    $blog_title = $db->select($query);
                    if ($blog_title) {
                       while ($result = $blog_title->fetch_assoc()) {
                      

                    ?>
                    <table class="form">					
                        <tr>
                            <td>
                                <label>Website Title</label>
                            </td>
                            <td>
                                <input type="text" value="<?php echo $result['title'];?>"  name="title" class="medium" />
                            </td>
                        </tr>
						 <tr>
                            <td>
                                <label>Website Slogan</label>
                            </td>
                            <td>
                                <input type="text" value="<?php echo $result['slogan'];?>" name="slogan" class="medium" />
                            </td>
                        </tr>

                        <tr>
                            <td>
                                <label>Upload Logo</label>
                            </td>
                            <td>
                                <input type="file" name="image" />
                            </td>
                        </tr>
						 
						
						 <tr>
                            <td>
                            </td>
                            <td>
                        <input type="submit" name="submit" Value="Update" />
                            </td>
                        </tr>

                        
                    </table>
                    </form>

                </div>


                <div class="rightside>">
                    <h3>Blog current LOGO:</h3>
                    <img src="<?php echo $result['image'];?>" alt="logo" />
                    

                </div>

                 <?php  } } ?>
                </div>

   
            </div>
        </div>
        
<?php include 'inc/footer.php'; ?>