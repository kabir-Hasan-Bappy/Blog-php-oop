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
if (!isset($_GET['del_slider_id']) || $_GET['del_slider_id'] == null) {
	header("Location: sliderlist.php");
}else{
	$del_slider_id = $_GET['del_slider_id'];

	$query = "SELECT * FROM slider WHERE id = '$del_slider_id'";
	$slider = $db->select($query);
	if ($slider) {

		while ($del_slider = $slider->fetch_assoc()) {

			$dellink = $del_slider['slider_image'];
			unlink($dellink);

		}
	}

	$delQuery = "DELETE FROM slider WHERE id = '$del_slider_id'";
	$delslider = $db->delete($delQuery);
	if ($delslider ) {
		echo "<script>alert('Slider Image Deleted Successfully!');</script>";
		echo "<script>window.location = 'sliderlist.php';</script>";
	}else{
		echo "<script>alert('Slider Image Not Deleted Successfully!');</script>";
		echo "<script>window.location = 'sliderlist.php';</script>";
	}

	
}
?>

