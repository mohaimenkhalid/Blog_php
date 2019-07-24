<?php include 'inc/header.php'; ?>



<?php
	
	if (isset($_GET['id'])) {

		$id = $_GET['id'];
	}

?>





	<div class="contentsection contemplete clear">
		<div class="maincontent clear">

			<?php 

			$query = "SELECT * FROM tbl_post WHERE id = $id ";

			$post = $db->select($query);

			if ($post) {
				while ($result = $post->fetch_assoc()) {
					
				
			?>
			<div class="about">
				<h2><?php echo $result['title']; ?></h2>
				<h4><?php echo $fm->formatDate($result['date']); ?>, By <?php echo $result['author']; ?></h4>
				<img src="admin/<?php echo $result['image']; ?>" alt="MyImage"/>
				<?php echo $result['body']; ?>


				<div class="relatedpost clear">
					<h2>Related articles</h2>
				<?php
				//related post......

				$catid = $result['cat'];
				$queryrelated = " SELECT * FROM tbl_post WHERE cat = '$catid' limit 6 ";
				$relatedpost = $db->select($queryrelated);
				if ($relatedpost) {
					while ($rresult = $relatedpost->fetch_assoc()) {
						

				?>
					<a href="post.php?id=<?php echo $rresult['id']; ?> "><img src="admin/<?php echo $rresult['image']; ?>" alt="Related post"/></a>
					
					<?php } } else { echo "No related post available!!"; }  ?>


				</div>


				<?php  } //while loop close..... ?>

				<?php  } else {
					header("Location:404.php");
				}  ?>

				
				
	</div>

		</div>

<?php include 'inc/sidebar.php'; ?>
<?php include 'inc/footer.php'; ?>	