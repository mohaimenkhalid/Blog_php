<?php include '../lib/Session.php';

Session::init();
Session::checklogin();
 ?>
<?php include '../config/config.php'; ?>
<?php include '../lib/Database.php'; ?>
<?php include '../helpers/Format.php'; ?>


<?php 

	$db = new Database();
	$fm = new Format();

?>



<!DOCTYPE html>
<head>
<meta charset="utf-8">
<title>Login</title>
    <link rel="stylesheet" type="text/css" href="css/stylelogin.css" media="screen" />
</head>
<body>
<div class="container">
	<section id="content">


		<?php 

		if ( $_SERVER['REQUEST_METHOD'] == 'POST' ) {

                    $email = $fm->validation($_POST['email']);
                    $email = mysqli_real_escape_string($db->link, $email);
            
                    if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
                        echo "Invalid email address.";
                    }else{

                        $mailquery = "SELECT * FROM tbl_user WHERE email = '$email' LIMIT 1 ";
                        $mailcheck = $db->select($mailquery);
                        if ($mailcheck != false) {
                            
                            while($value = $mailcheck->fetch_assoc()){

                                $userid = $value['id'];
                                $username = $value['username'];

                            }

                            $text = substr($email, 0, 3);
                            $rand = rand(1000, 99999);
                            $newpass = "$text$rand";
                            $password = md5($newpass);

                            $query = "UPDATE tbl_user SET password = '$password' WHERE id= $userid ";
                            $updated_rows = $db->update($query);

                            $to = $email;
                            $from = "bolg@gnail.com";
                            $subject = "New password for login blog admin.";
                            $headers = "From: $from\n";
                            $headers .= 'MIME-Version: 1.0';
                            $headers .= 'Content-type: text/html; charset=iso-8859-1';
                            $message = "Your Username is".$username." and  new password is ".$newpass." Please visit the website to login.";

                            $sentmail = mail($to, $subject, $from, $message, $headers);

                            if($sentmail){
                                    echo "New password sent to email successfully!!";
                            }else {
                                echo "email not successfully";
                            }

                                 
                                    
                         }else {
                                 echo "Email not exist!!";
                            }

                    }
        
        }

		?>

		<form action="" method="post">
			<h1>Password Recovery</h1>
			<div>
				<input type="text" placeholder="Enter valid email" required="" name="email"/>
			</div>

			<div>
				<input type="submit" value="Send mail" />
			</div>
		</form><!-- form -->
		<div class="button">
			<a href="login.php">Login here</a>
		</div><!-- button -->
	</section><!-- content -->
</div><!-- container -->
</body>
</html>