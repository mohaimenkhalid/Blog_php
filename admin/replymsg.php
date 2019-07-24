<?php include 'inc/header.php'; ?>
<?php include 'inc/sidebar.php'; ?>

<?php 
    
    if (!isset($_GET['msgid']) || $_GET['msgid'] == NULL) {
       
       echo "<script>window.location= 'inbox.php';</script>";
       //header("Location:catlist.php"); 
    } else{


        $id = $_GET['msgid'];
    }

?>

 <?php 

        if ( $_SERVER['REQUEST_METHOD'] == 'POST' ) {

            $to = $fm->validation($_POST['toEmail']);
            $form = $fm->validation($_POST['fromEmail']);
            $subject = $fm->validation($_POST['subject']);
            $message = $fm->validation($_POST['message']);

            $sendEmail = mail($to, $subject, $message, $form);

            if ($sendEmail) {
                
                echo "<span style='color:green;font-size:18px;'>Email Send successfully.</span>";
            }else{


                echo "<span style='color:red;font-size:18px;'>Something wrong... please try agmain later</span>";
            }
            
        }


    ?>

        <div class="grid_10">
		
            <div class="box round first grid">
                <h2>Reply Message</h2>
        <div class="block"> 

                 <form action="" method="post" enctype="multipart/form-data">

                    <?php 

                        $query = "SELECT * FROM tbl_contact WHERE id = '$id' ";
                        $msg = $db->select($query);

                        if ($msg) {
                            
                            while ($result = $msg->fetch_assoc()) {
                              
                        
                        ?>

                    <table class="form">
                       
                         <tr>
                            <td>
                                <label>To</label>
                            </td>
                            <td>
                                <input type="text" readonly name="toEmail" value="<?php echo $result['email']; ?>" class="medium" />
                            </td>
                        </tr>

                        <tr>
                            <td>
                                <label>Form</label>
                            </td>
                            <td>
                                <input type="text" name="fromEmail" placeholder="Enter your Email.." class="medium" />
                            </td>
                        </tr>

                         <tr>
                            <td>
                                <label>Subject</label>
                            </td>
                            <td>
                                <input type="text" name="subject" placeholder="Subject.." class="medium" />
                            </td>
                        </tr>
                     
                        
                    

                        <tr>
                            <td>
                                <label>Message</label>
                            </td>
                            <td>
                                <textarea name="message" style=" min-height: 100px;  min-width: 500px;"  >
                                    

                                </textarea>
                            </td>
                        </tr>

                         



						<tr>
                            <td></td>
                            <td>
                                <input type="submit" name="submit" Value="Send" />
                            </td>
                        </tr>
                    </table>

                    <?php } } ?>
                    </form>
                </div>
            </div>
        </div>
    
<?php include 'inc/footer.php'; ?>