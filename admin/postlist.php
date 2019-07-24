<?php include 'inc/header.php'; ?>
<?php include 'inc/sidebar.php'; ?>


<?php

//Delete category......

	if (isset($_GET['delpostid'])) {
       

        $delid = $_GET['delpostid'];
        
        //delete image from path folder...

        $getallpost = "SELECT * FROM tbl_post WHERE id = '$delid' ";
        $getData = $db->select($getallpost);
        if ($getData) {
			while ($delimg = $getData->fetch_assoc()) {
				$dellink = $delimg['image'];
				unlink($dellink);
			}
		}


		//delete query....
     	$delquery = " DELETE FROM tbl_post WHERE id = '$delid'";
		$delpost = $db->delete($delquery);


		if ($delpost) {
                    echo "<span style='color:green;font-size:18px;'>Post Deleted  Successfully!!</span>";
                }

                else{

                    echo "<span style='color:red;font-size:18px;'>Post not Deleted!!</span>";
                }
 }


?>




        <div class="grid_10">
            <div class="box round first grid">
                <h2>Post List</h2>
                <div class="block">  
                    <table class="data display datatable" id="example">
					<thead>
						<tr>
							<th width="5%">No</th>
							<th width="15%">Post Title</th>
							<th width="20%">Description</th>
							<th width="10%">Category</th>
							<th width="10%">Image</th>
							<th width="10%">Author</th>
							<th width="10%">Tags</th>
							<th width="10%">Date</th>
							<th width="10%">Action</th>
						</tr>
					</thead>
					<tbody>

						<?php 

						$query = " SELECT tbl_post.*, tbl_category.name FROM tbl_post 

						INNER JOIN tbl_category

						ON tbl_post.cat = tbl_category.id

						ORDER BY tbl_post.title DESC";


						$post = $db->select($query);

						if ($post) {
							$i=0;
							while ($result = $post->fetch_assoc()) {
								$i++;
							

						?>




						<tr class="odd gradeX" style="text-align: center;">
							<td><?php echo $i; ?></td>
							<td><?php echo $result['title']; ?></td>
							<td><?php echo $fm->textShorten($result['body'],100); ?></td>
							<td><?php echo $result['name']; ?></td>
							<td><img height="40px" width="60px" src="<?php echo $result['image']; ?>" /></td>
							<td><?php echo $result['author']; ?></td>
							<td><?php echo $result['tags']; ?></td>
							<td class="center"> <?php echo $fm->formatDate($result['date']); ?></td>
							
							<td>
							<a  href="viewtpost.php?viewpostid=<?php echo $result['id']; ?>">View</a> 
							<?php
							if(Session::get('userid') == $result['userid']  || Session::get('userrole') == '0'){
							 ?>
							|| <a  href="editpost.php?editpostid=<?php echo $result['id']; ?>">Edit</a> || 
							<a onclick="return confirm('Are you sure to delete!');" href="postlist.php?delpostid=<?php echo $result['id']; ?>">Delete</a></td>
						
							<?php } ?>
						</tr>
			
			<?php  } } ?>
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

