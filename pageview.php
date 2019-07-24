<?php include 'inc/header.php'; ?>


<?php
	
	if (isset($_GET['pageid'])) {

		$id = $_GET['pageid'];
    }
    
?>
	<div class="contentsection contemplete clear">
		<div class="maincontent clear">

    <?php
		$query = "SELECT * FROM tbl_page WHERE id = '$id' ";
		$page = $db->select($query);
		if ($page) {
			while ($result = $page->fetch_assoc()) {
	?>

			<div class="about">

				<h2><?php echo $result['name']; ?></h2>

                <?php echo $result['body']; ?>
	
                
	        </div>

            <?php } }else {
					header("Location:404.php");
				}  ?>



		</div>
		
<?php include 'inc/sidebar.php'; ?>
<?php include 'inc/footer.php'; ?>