<?php include 'inc/header.php'; ?>
<?php include 'inc/sidebar.php'; ?>


<?php 
    
    $userid = Session::get('userid');
    $userrole = Session::get('userrole');

?>

        <div class="grid_10">
        
            <div class="box round first grid">
                <h2>Update Profile</h2>
        <div class="block"> 



    <?php 

        if ( $_SERVER['REQUEST_METHOD'] == 'POST' ) {

         

            $name = mysqli_real_escape_string($db->link,  $_POST['name']);
             $username = mysqli_real_escape_string($db->link, $_POST['username']);
              $email = mysqli_real_escape_string($db->link, $_POST['email']);
               $details = mysqli_real_escape_string($db->link, $_POST['details']);



                    $query = " UPDATE tbl_user SET name = '$name', username = '$username', email = '$email', details = '$details'  WHERE id= $userid ";
                                $updated_rows = $db->update($query);

                                 if ($updated_rows) {
                                 echo "<span class='success'>Profile Update Successfully.
                                 </span>";
                                } else {
                                 echo "<span class='error'>Profile Not Updated !!</span>";
                                }

            }


    ?>


            <form action="" method="post" enctype="multipart/form-data">
            <table class="form">

        <?php 

            $query = " SELECT * FROM tbl_user  WHERE id = '$userid'  AND role= '$userrole' ";
            $profiledata = $db->select($query);

            if ($profiledata) {
            while ($profileresult = $profiledata->fetch_assoc()) {
          

        ?>

                       
                        <tr>
                            <td>
                                <label>Name</label>
                            </td>
                            <td>
                                <input type="text" name="name" value="<?php echo $profileresult['name']; ?>" class="medium" />
                            </td>
                        </tr>

                        <tr>
                            <td>
                                <label>Username</label>
                            </td>
                            <td>
                                <input type="text" name="username" value="<?php echo $profileresult['username']; ?>" class="medium" />
                            </td>
                        </tr>

                        <tr>
                            <td>
                                <label>Email</label>
                            </td>
                            <td>
                                <input type="text" name="email" value="<?php echo $profileresult['email']; ?>" class="medium" />
                            </td>
                        </tr>

                         <tr>
                            <td>
                                <label>Details</label>
                            </td>
                            <td>
                                <input type="text" name="details" value="<?php echo $profileresult['details']; ?>" class="medium" />
                            </td>
                        </tr>



                        <tr>
                            <td></td>
                            <td>
                                <input type="submit" name="submit" Value="Update Profile" />
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