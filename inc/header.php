<?php include 'config/config.php'; ?>
<?php include 'lib/Database.php'; ?>
<?php include 'helpers/Format.php'; ?>


<?php 

	$db = new Database();
	$fm = new Format();

?>

<!DOCTYPE html>
<html>
<head>

<?php 
	if(isset($_GET['pageid'])){

		$pagetitleid = $_GET['pageid'];

		$query = "SELECT * FROM tbl_page WHERE id = '$pagetitleid' ";
		$page = $db->select($query);
		if ($page) {
			while ($result = $page->fetch_assoc()) {
?>
	<title><?php echo $result['name']; ?> | <?php echo TITLE; ?></title>

	<?php } } }

	elseif(isset($_GET['id'])){

	$pagepostid = $_GET['id'];

	$query = "SELECT * FROM tbl_post WHERE id = '$pagepostid' ";
	$page = $db->select($query);
	if ($page) {
		while ($result = $page->fetch_assoc()) {
?>
<title><?php echo $result['title']; ?> | <?php echo TITLE; ?></title>

<?php } } }


elseif(isset($_GET['category'])){

	$categoryid = $_GET['category'];

	$query = "SELECT * FROM tbl_category WHERE id = '$categoryid' ";
	$page = $db->select($query);
	if ($page) {
		while ($result = $page->fetch_assoc()) {
?>
<title><?php echo $result['name']; ?> | <?php echo TITLE; ?></title>

<?php } } }
	
	
	
	else{ ?>

	<title><?php echo $fm->title(); ?> | <?php echo TITLE; ?></title>

	<?php } ?>


	<meta name="language" content="English">
	<meta name="description" content="It is a website about education">
	<meta name="keywords" content="blog,cms blog">
	<meta name="author" content="Delowar">
	<link rel="stylesheet" href="font-awesome-4.5.0/css/font-awesome.css">	
	<link rel="stylesheet" href="css/nivo-slider.css" type="text/css" media="screen" />
	<link rel="stylesheet" href="style.css">
	<script src="js/jquery.js" type="text/javascript"></script>
	<script src="js/jquery.nivo.slider.js" type="text/javascript"></script>

<script type="text/javascript">
$(window).load(function() {
	$('#slider').nivoSlider({
		effect:'random',
		slices:10,
		animSpeed:500,
		pauseTime:5000,
		startSlide:0, //Set starting Slide (0 index)
		directionNav:false,
		directionNavHide:false, //Only show on hover
		controlNav:false, //1,2,3...
		controlNavThumbs:false, //Use thumbnails for Control Nav
		pauseOnHover:true, //Stop animation while hovering
		manualAdvance:false, //Force manual transitions
		captionOpacity:0.8, //Universal caption opacity
		beforeChange: function(){},
		afterChange: function(){},
		slideshowEnd: function(){} //Triggers after all slides have been shown
	});
});
</script>
</head>

<body>
	<div class="headersection templete clear">
		<a href="#">
			<div class="logo">

				 <?php 

                    $query = "SELECT * FROM title_slogan WHERE id = 1 ORDER BY id DESC";
                    $blog_title = $db->select($query);
                    if ($blog_title) {
                       while ($result = $blog_title->fetch_assoc()) {
                      

                    ?>

				<img src="admin/<?php echo $result['image'];?>" alt="logo" />
				<h2><?php echo $result['title'];?></h2>
				<p><?php echo $result['slogan'];?></p>



                    <?php } } ?>
			</div>
		</a>
		<div class="social clear">
			<div class="icon clear">
				<?php 

                    $query = "SELECT * FROM tbl_social ORDER BY id DESC";

                    $social = $db->select($query);

                    if ($social) {
                        while ($result = $social->fetch_assoc()) {

                    ?>

				<a href="<?php echo $result['fb']; ?>" target="_blank"><i class="fa fa-facebook"></i></a>
				<a href="<?php echo $result['tw']; ?>" target="_blank"><i class="fa fa-twitter"></i></a>
				<a href="<?php echo $result['ln']; ?>" target="_blank"><i class="fa fa-linkedin"></i></a>
				<a href="<?php echo $result['gp']; ?>" target="_blank"><i class="fa fa-google-plus"></i></a>


				<?php } } ?>
			</div>
			<div class="searchbtn clear">
			<form action="search.php" method="get">
				<input type="text" name="search" placeholder="Search keyword..."/>
				<input type="submit" name="submit" value="Search"/>
			</form>
			</div>
		</div>
	</div>
<div class="navsection templete">
	<ul>
		<?php 
		$path = $_SERVER['SCRIPT_FILENAME'];
		$currentpage = basename($path, '.php');
		
		?>
		
		<li><a  <?php if($currentpage == 'index'){ echo 'id ="active"'; }?> href="index.php">Home</a></li>
		<li><a <?php if($currentpage == 'about'){ echo 'id ="active"'; }?> href="about.php">About</a></li>	
		<li><a <?php if($currentpage == 'contact'){ echo 'id ="active"'; }?> href="contact.php">Contact</a></li>
	
	<?php
		$query = "SELECT * FROM tbl_page ORDER BY id ASC";
		$page = $db->select($query);
		if ($page) {
			while ($result = $page->fetch_assoc()) {
	?>
			<li><a
			
			<?php

				if(isset($_GET['pageid']) && $_GET['pageid'] == $result['id']){
					echo 'id ="active"';

				}
			
			?>
			
			 href="pageview.php?pageid=<?php echo $result['id']; ?>"><?php echo $result['name']; ?></a></li>

			<?php } } ?>
	</ul>
</div>
