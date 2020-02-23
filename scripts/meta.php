<?php
	if (isset($_GET['page'])) {
		$pageTitleid = $_GET['page'];
		$query = "SELECT * FROM pages WHERE id = '$pageTitleid'";
		$pages = $db->select($query);
		if ($pages) {
			while ($result = $pages->fetch_assoc()) {?>
				<title><?php echo $result['page_name']; ?> - <?php echo TITLE; ?></title>
			<?php }}} 

			elseif(isset($_GET['id'])) {
				$postid = $_GET['id'];
				$query = "SELECT * FROM post WHERE id = '$postid'";
				$post = $db->select($query);
				if ($post) {
					while ($result = $post->fetch_assoc()) {?>
						<title><?php echo $result['title']; ?> - <?php echo TITLE; ?></title>
					<?php }}}


					else { ?>
						<title><?php echo $fm->title(); ?> - <?php echo TITLE; ?></title>
					<?php } ?>

					<meta name="language" content="English">
					<?php
					if (isset($_GET['id'])) {
						$keyid = $_GET['id'];
						$query = "SELECT * FROM post WHERE id = '$keyid'";
						$keywords = $db->select($query);
						if ($keywords) {
							while ($result = $keywords->fetch_assoc()) {?>
								<meta name="description" content="<?php echo $result['tags'];?>">

							<?php }}} else{?>
								<meta name="description" content="<?php echo KEYWORDS;?>">
							<?php }?>
							
							<meta name="author" content="Delowar">