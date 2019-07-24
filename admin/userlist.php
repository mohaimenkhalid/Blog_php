<?php include 'inc/header.php'; ?>
<?php include 'inc/sidebar.php'; ?>

        <div class="grid_10">
            <div class="box round first grid">
                <h2>User List</h2>

<?php 

//Delete List..

if (isset($_GET['deluser'])) {


	$deluser = $_GET['deluser'];

	$delquery = "DELETE FROM tbl_category WHERE id = '$deluser'";
	$deldata = $db->delete($delquery);

		if ($deldata) {
                    echo "<span style='color:green;font-size:18px;'>User Deleted  Successfully!!</span>";
                }

                else{

                    echo "<span style='color:red;font-size:18px;'>User not Deleted!!</span>";
				}
				
	}


?>

                <div class="block">        
                    <table class="data display datatable" id="example">
					<thead>
						<tr>
							<th>Serial No.</th>
							<th>Name</th>
							<th>Username</th>
                            <th>Email</th>
                            <th>Details</th>
                            <th>Role</th>
                            <th>Action</th>

						</tr>
					</thead>
					<tbody>
						<?php 

						$query = "SELECT * FROM tbl_user ORDER BY id DESC ";
						$category = $db->select($query);

						if ($category) {
							$i= 0;
							while ($result = $category->fetch_assoc()) {
								$i++;
						
						?>

						<tr class="odd gradeX"">
							<td width="5%"><?php echo $i; ?></td>
							<td width="12%"><?php echo $result['name']; ?></td>
                            <td width="7%"><?php echo $result['username']; ?></td>
                            <td width="10%"><?php echo $result['email']; ?></td>
                            <td width="20%"><?php echo $fm->textShorten($result['details'],40); ?></td>
                            <td width="5%">
                            <?php
                            
                            if ($result['role']== '0') {
                                echo "Admin";
                            }elseif ($result['role']== '1') {
                                echo "Author";
                            }elseif ($result['role']== '2') {
                                echo "Editor";
                            }
                            ?>
                            </td>
							<td width="15%"><a  href="viewuser.php?userid=<?php echo $result['id']; ?>">View</a>
                            
                            <?php

                                if(Session::get('userrole') == '0'){

                                ?>
                            
                             || <a onclick="return confirm('Are you sure to delete!');" href="?deluser=<?php echo $result['id']; ?>">Delete</a>
                             
                                <?php } ?>
                             
                             </td>


						</tr>

						<?php } } ?>
					
					</tbody>
				</table>
               </div>
            </div>
        </div>

        <script type="text/javascript">
	        $(document).ready(function () {
	            setupLeftMenu();
	            $('.datatable').dataTable();
				setSidebarHeight();
	        });
 		</script>


       <?php include 'inc/footer.php'; ?>

