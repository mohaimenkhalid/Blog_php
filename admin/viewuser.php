<?php include 'inc/header.php'; ?>
<?php include 'inc/sidebar.php'; ?>

<?php 
if(!isset($_GET['userid']) || $_GET['userid'] == NULL){

echo "<script>window.location = 'userlist.php';</script>";
}

else{

    $userid = $_GET['userid'];
}
?>
        <div class="grid_10">
        
            <div class="box round first grid">
                <h2>User Details</h2>
        <div class="block"> 



    <?php 

        if ( $_SERVER['REQUEST_METHOD'] == 'POST' ) {

            echo "<script>window.location = 'userlist.php';</script>";

            }


    ?>


            <form action="" method="post" enctype="multipart/form-data">
            <table class="form">

        <?php 

            $query = " SELECT * FROM tbl_user  WHERE id = '$userid'   ";
            $profiledata = $db->select($query);

            if ($profiledata) {
            while ($result = $profiledata->fetch_assoc()) {
          

        ?>

                       
                        <tr>
                            <td>
                                <label>Name</label>
                            </td>
                            <td>
                                <input type="text" readonly value="<?php echo $result['name']; ?>" class="medium" />
                            </td>
                        </tr>

                        <tr>
                            <td>
                                <label>Username</label>
                            </td>
                            <td>
                                <input type="text" readonly value="<?php echo $result['username']; ?>" class="medium" />
                            </td>
                        </tr>

                        <tr>
                            <td>
                                <label>Email</label>
                            </td>
                            <td>
                                <input type="text" readonly value="<?php echo $result['email']; ?>" class="medium" />
                            </td>
                        </tr>

                         <tr>
                            <td>
                                <label>Details</label>
                            </td>
                            <td>
                                <input type="text"  readonly value="<?php echo $result['details']; ?>" class="medium" />
                            </td>
                        </tr>



                        <tr>
                            <td></td>
                            <td>
                                <input type="submit" name="submit" Value=" Back to userlist" />
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