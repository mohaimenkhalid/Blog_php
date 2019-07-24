
<?php include 'inc/header.php'; ?>
<?php include 'inc/slider.php'; ?>


<?php
	
	if (isset($_GET['search'])) {

		$search = $_GET['search'];
	}else{

		header("Location:index.php");
	}

?>


	<div class="contentsection contemplete clear">
		<div class="maincontent clear">


	<?php 

			$query = " SELECT * FROM tbl_post WHERE title LIKE '%$search%'  OR body LIKE '%$search%' OR author LIKE '%$search%' OR tags LIKE '%$search%'  ";
			$post = $db->select($query);
			if ($post) {
				while ($result = $post->fetch_assoc()) {
			
			?>

			<div class="samepost clear">
				<h2><a href="post.php?id=<?php echo $result['id']; ?> "><?php echo $result['title']; ?></a></h2>
				<h4><?php echo $fm->formatDate($result['date']); ?>, By <a href="#"><?php echo $result['author']; ?></a></h4>
				 <a href="post.php?id=<?php echo $result['id']; ?> "><img src="admin/<?php echo $result['image']; ?>" alt="post image"/></a>
				<?php echo $fm->textShorten($result['body']); ?>
				<div class="readmore clear">
					<a href="post.php?id=<?php echo $result['id']; ?> ">Read More</a>
				</div>
			</div>

				<?php }  //while loop end ?> 

			<?php 	 } else{  echo "<p> No result found. </p>"; }?>




		</div>


<?php include 'inc/sidebar.php'; ?>
<?php include 'inc/footer.php'; ?>
