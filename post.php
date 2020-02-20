<?php include 'inc/header.php'; ?>
<?php
if (!isset($_GET['id']) || $_GET['id']== NULL) {
	header("Location: 404.php");
}else{
	$id = $_GET['id'];
}
?>

	<div class="contentsection contemplete clear">
		<div class="maincontent clear">
			<div class="about">
				<?php
				$query = "SELECT *FROM post WHERE id = $id ";
				$post = $db->select($query);
				if ($post) { 
			while ( $result = $post->fetch_assoc()) { ?>

				<h2><?php echo $result['title'];?></h2>
				<h4><?php echo $fm->formatDate($result['date']);?> , By <strong><?php echo $result['author'];?></strong></h4>
				<img src="admin/<?php echo $result['image'];?>" alt="MyImage"/>
				<p><?php echo $result['body'];?></p>
				
					<div class="relatedpost clear">
					<h2>Related articles</h2>
					<?php
					$cat_id = $result['cat'];
					$queryrelated = "SELECT * FROM post WHERE cat = '$cat_id' LIMIT 6";
				    $relatedpost = $db->select($queryrelated);
				if ($relatedpost) { 
						while ( $result = $relatedpost->fetch_assoc()) { ?>
					
					<a href="post.php?id=<?php echo $result['id'];?>"><img src="admin/<?php echo $result['image'];?>" alt="post image"/></a>
				<?php } } else{ echo "NO Related post found!!";}?>
				</div>
				<?php } } else{ header("Location: 404.php");} ?>
	</div>

		</div>
		<?php include 'inc/sidebar.php';?>
	</div>

	<?php include 'inc/footer.php';?>