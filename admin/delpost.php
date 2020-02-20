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
if (!isset($_GET['delpostid']) || $_GET['delpostid'] == null) {
	header("Location: postlist.php");
}else{
	$delpostid = $_GET['delpostid'];

	$query = "SELECT * FROM post WHERE id = '$delpostid'";
	$post = $db->select($query);
	if ($post) {

		while ($delimg = $post->fetch_assoc()) {

			$dellink = $delimg['image'];
			unlink($dellink);

		}
	}

	$delQuery = "DELETE FROM post WHERE id = '$delpostid'";
	$delpost = $db->delete($delQuery);
	if ($delpost ) {
		echo "<script>alert('Post Deleted Successfully!');</script>";
		echo "<script>window.location = 'postlist.php';</script>";
	}else{
		echo "<script>alert('Post Not Deleted Successfully!');</script>";
		echo "<script>window.location = 'postlist.php';</script>";
	}

	
}
?>

