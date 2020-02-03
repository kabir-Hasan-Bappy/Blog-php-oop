<?php include 'inc/header.php';
include 'inc/slider.php';
include 'config/config.php'; 
include 'lib/Database.php'; 
include 'helpers/Format.php'; 
?>
<?php 
$db = new Database();
$fm = new Format();?>


<div class="contentsection contemplete clear">

	<div class="maincontent clear">
		<?php
		$query = 'SELECT * FROM post LIMIT 3';
		$post = $db->select($query);
		if ($post) { 
			while ( $result = $post->fetch_assoc()) { ?>

				<div class="samepost clear">
					<h2><a href="post.php?id=<?php echo $result['id']; ?>"><?php echo $result['title']; ?></a></h2>
					<h4><?php echo $fm->formatDate($result['date']); ?>, By <a href="#"><?php echo $result['author']; ?></a></h4>
					<a href="#"><img src="images/<?php echo $result['image'];?>" alt="post image"/></a>
					<p>
						<?php echo $fm->textShorten($result['body']); ?>
					</p>
					<div class="readmore clear">
						<a href="post.php?id=<?php echo $result['id']; ?>">Read More</a>
					</div>
				</div>
				<?php } } else{
		header("Location: 404.php");
	}?> <!-- end while loop-->
			</div>
			<?php include 'inc/sidebar.php';?>
		</div>
	

	<?php include 'inc/footer.php';?>