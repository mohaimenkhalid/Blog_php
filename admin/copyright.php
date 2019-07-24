<?php include 'inc/header.php'; ?>
<?php include 'inc/sidebar.php'; ?>

        <div class="grid_10">
            <div class="box round first grid">
                <h2>Update Copyright Text</h2>
                <div class="block copyblock"> 

                    <?php 

                    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                        
                        $copyright = mysqli_real_escape_string($db->link, $_POST['copyright']);


                        if ($copyright == "") {
                            echo "<span style='color:red;font-size:18px;'>Field must not be empty!!</span>";
                        }

                        else{


                            $query_footer = "UPDATE tbl_footer SET note = '$copyright' WHERE id=1";
                            $updated_footer = $db->update($query_footer);
                            if ($updated_footer) {
                                 echo "<span class='success'>Data Updated Successfully.
                                 </span>";
                                } else {
                                 echo "<span class='error'>Data Not Updated !</span>";
                                }

                        }
                    }

                    ?>



                 <form method="post" >
                    <table class="form">

                    <?php  

                    $query = "SELECT * FROM tbl_footer";
                    $footer = $db->select($query);
                    if ($footer) {
                        while ($result = $footer->fetch_assoc()) {
      

                    ?>					
                        <tr>
                            <td>
                                <input type="text" value="<?php echo $result['note']; ?>" name="copyright" class="large" />
                            </td>
                        </tr>
						
						 <tr> 
                            <td>
                                <input type="submit" name="submit" Value="Update" />
                            </td>
                        </tr>


                        <?php  } } ?>
                    </table>
                    </form>
                </div>
            </div>
        </div>
       
<?php include 'inc/footer.php'; ?>