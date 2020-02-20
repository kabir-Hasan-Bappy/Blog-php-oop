<?php include 'inc/header.php';?>
<?php
if (!isset($_GET['page']) || $_GET['page'] == null) {
  header("Location: 404.php");
}else{
  $pageid = $_GET['page'];
}
?>
	<?php 
      	$query = "SELECT * FROM pages WHERE id = '$pageid'";
                    $getpage = $db->select($query);
                    if ($getpage) {
                        while ($pageresult = $getpage->fetch_assoc()) { ?>    

	<div class="contentsection contemplete clear">
		<div class="maincontent clear">
			<div class="about">
				  
				<h2><?php echo $pageresult['page_name']; ?></h2>
	
				<?php echo $pageresult['content']; ?>
	</div>

		</div>
	<?php } }else{ header('Location: 404.php');}?>
		<?php include 'inc/sidebar.php';?>
	</div>

	<?php include 'inc/footer.php';?>