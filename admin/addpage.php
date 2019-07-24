<?php include 'inc/header.php'; ?>
<?php include 'inc/sidebar.php'; ?>

        <div class="grid_10">
		
            <div class="box round first grid">
                <h2>Add New Page</h2>
        <div class="block"> 

    <?php 

        if ( $_SERVER['REQUEST_METHOD'] == 'POST' ) {

            $name = mysqli_real_escape_string($db->link,  $_POST['name']);
              $body = mysqli_real_escape_string($db->link, $_POST['body']);

                if ($name == ""  || $body == "" ) {
                    echo "<span style='color:red;font-size:18px;'>Field must not be empty!!</span>";

                }else{

            $postquery = "INSERT INTO tbl_page( name, body) VALUES('$name', '$body' )";

                        $inserted_rows = $db->insert($postquery);

                         if ($inserted_rows) {
                         echo "<span class='success'>Page Created Successfully.
                         </span>";
                        } else {
                         echo "<span class='error'>Page Created Inserted !</span>";
                        }

                    }


        }


    ?>

                 <form action="addpage.php" method="post" enctype="multipart/form-data">
                    <table class="form">
                       
                        <tr>
                            <td>
                                <label>Name</label>
                            </td>
                            <td>
                                <input type="text" name="name" placeholder="Enter Post Title..." class="medium" />
                            </td>
                        </tr>
                     
                        
                    

                        <tr>
                            <td style="vertical-align: top; padding-top: 9px;">
                                <label>Content</label>
                            </td>
                            <td>
                                <textarea name="body" class="tinymce"></textarea>
                            </td>
                        </tr>

                         



						<tr>
                            <td></td>
                            <td>
                                <input type="submit" name="submit" Value="Create Page" />
                            </td>
                        </tr>
                    </table>
                    </form>
                </div>
            </div>
        </div>
    
<?php include 'inc/footer.php'; ?>