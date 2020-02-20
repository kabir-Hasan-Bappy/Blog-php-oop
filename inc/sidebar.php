<div class="sidebar clear">
	<div class="samesidebar clear">
		<h2>Categories</h2>
		<ul>
			<?php
			$query = "SELECT *FROM category";
			$category = $db->select($query);
			if ($category) { 
				while ( $result = $category->fetch_assoc()) { ?>

					<li><a href="posts.php?category=<?php echo $result['id'];?>"><?php echo $result['c_name'];?></a></li>
				<?php } } else { ?>
					<li>No category Created! </li>
				<?php }?>

			</ul>
		</div>

		<div class="samesidebar clear">
			<h2>Latest articles</h2>
			<?php
				$query = "SELECT * FROM post ORDER BY id DESC LIMIT 5";
				$post = $db->select($query);
				if ($post) { 
			while ( $result = $post->fetch_assoc()) { ?>
			<div class="popular clear">
				<h3><a href="post.php?id=<?php echo $result['id'];?>"><?php echo $result['title'];?></a></h3>
				<a href="post.php?id=<?php echo $result['id'];?>"><img src="admin/<?php echo $result['image'];?>" alt="post image"/></a>
				<p><?php echo $fm->textshorten($result['body'], 100);?></p>	
			</div>
          <?php } } else{ header("Location: 404.php");} ?>
		</div>

	</div>