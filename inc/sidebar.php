

		<div class="sidebar clear">
			<div class="samesidebar clear">
				<h2>Categories</h2>

				<?php 

				$query = "SELECT * FROM  tbl_category";
				$category = $db->select($query);
				if ($category) {
					while ($result = $category->fetch_assoc()) {
					

				?>

					<ul>
						<li><a href="posts.php?category=<?php echo $result['id']; ?>"><?php echo $result['name']; ?></a></li>
											
					</ul>

					<?php } }else { echo "Not available"; } ?>
			</div>
			
			<div class="samesidebar clear">
				<h2>Latest articles</h2>

				<?php 

			$query = " SELECT * FROM tbl_post ORDER BY id DESC  LIMIT  4";
			$post = $db->select($query);
			if ($post) {
				while ($result = $post->fetch_assoc()) {
			
			?>
					<div class="popular clear">
						<h3><a href="post.php?id=<?php echo $result['id']; ?> "><?php echo $result['title']; ?></a></h3>
						<a href="post.php?id=<?php echo $result['id']; ?> "><img src="admin/<?php echo $result['image']; ?>" alt="post image"/></a>
						<?php echo $fm->textShorten($result['body'],150); ?>
					</div>

			<?php 	} } else{ header("Location:404.php"); }?>

					
					
	
			</div>
			
		</div>