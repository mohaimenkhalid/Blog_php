<?php include '../lib/Session.php';
    Session::checkSession();
 ?>

<?php include '../config/config.php'; ?>
<?php include '../lib/Database.php'; ?>



<?php 

    $db = new Database();

?>



<?php 

//Delete page..



if (!isset($_GET['delpage']) || $_GET['delpage'] == NULL) {
       
       echo "<script>window.location= 'index.php';</script>";
       //header("Location:catlist.php"); 
    } else{


        $pageid = $_GET['delpage'];


     $delquery = "DELETE FROM tbl_page WHERE id = '$pageid'";
	$delpage = $db->delete($delquery);

	if ($delpage) {
                    echo "<script> alert('Page Deleted Successfully!')</script>";
                    echo "<script>window.location= 'index.php';</script>";
                }

                else{

                    echo "<script> alert('Page not Deleted Successfully!')</script>";
                    echo "<script>window.location= 'index.php';</script>";
                }

    }



	


?>
