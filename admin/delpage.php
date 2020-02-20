<?php include '../lib/Session.php'; 
Session::checkSession();
?>
<?php
include '../config/config.php'; 
include '../lib/Database.php'; 
include '../helpers/Format.php'; 
?>
<?php 
$db = new Database();
?>
<?php
if (!isset($_GET['delpageid']) || $_GET['delpageid'] == null) {
	header("Location: index.php");
}else{
	$delpageid = $_GET['delpageid'];
	$delQuery = "DELETE FROM pages WHERE id = '$delpageid'";
	$delpost = $db->delete($delQuery);
	if ($delpost ) {
		echo "<script>alert('Page Deleted Successfully!');</script>";
		echo "<script>window.location = 'index.php';</script>";
	}else{
		echo "<script>alert('Page Not Deleted Successfully!');</script>";
		echo "<script>window.location = 'index.php';</script>";
	}

	
}
?>

