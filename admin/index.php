<?php include 'inc/header.php'; ?>
<?php include 'inc/sidebar.php'; ?>

        <div class="grid_10">
		
            <div class="box round first grid">

             <?php 

		$loginmsg = Session::get("loginmsg");
		if (isset($loginmsg)) {
		echo "<p >".$loginmsg."</p";
	}
	session::set("loginmsg", NULL);
		?>	
                <h2> Dashbord</h2>
                <div class="block">               
                  Welcome admin panel        
                </div>
            </div>
        </div>
       
<?php include 'inc/footer.php'; ?>