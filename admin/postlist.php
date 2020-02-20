<?php include 'inc/a_header.php'; ?>
<?php include 'inc/a_sidebar.php'; ?>
        <div class="grid_10">
            <div class="box round first grid">
                <h2>Post List</h2>
                <div class="block">  
                    <table class="data display datatable" id="example">
					<thead>
						<tr>
							<th width="5%">Sl No.</th>
							<th width="15%">Title</th>
							<th width="10%">Category</th>
							<th width="20%">Description</th>
							<th width="10%">Image</th>
							<th width="10%">Author</th>
							<th width="10%">Tags</th>
							<th width="10%">Date</th>
							<th width="10%">Action</th>
						</tr>
					</thead>
					<tbody>
						<?php
		$query = "SELECT post.*, category.c_name FROM post
		INNER JOIN category ON post.cat = category.id ORDER BY post.id DESC";
		$post = $db->select($query);
		if ($post) { 
			$i=0;
			while ( $result = $post->fetch_assoc()) {
				$i++;
			 ?>
						<tr class="odd gradeX">
							<td><?php echo $i;?></td>
							<td><?php echo $result['title'];?></td>
							<td><?php echo $result['c_name'];?></td>
							<td><?php echo $fm->textShorten($result['body'],100);?></td>
							<td><img src="<?php echo $result['image'];?>" alt="" height="40px" width="60px"></td>
							<td><?php echo $result['author'];?></td>
							<td><?php echo $result['tags'];?></td>
							<td><?php echo $fm->formatdate($result['date']);?></td>
							<td>

								<a href="viewpost.php?viewpostid=<?php echo $result['id'];?>">View</a> 
								<?php if (Session::get('userId') == $result['userid'] || Session::get('userRole') == '0') { ?> ||
								<a href="editpost.php?editpostid=<?php echo $result['id'];?>">Edit</a> || 
								<a onclick= "return confirm('Are u sure to Delete?')" href="delpost.php?delpostid=<?php echo $result['id'];?>">Delete</a>

								<?php } ?>
							</td>
						</tr>
					<?php }}?>
					</tbody>
				</table>
	
               </div>
            </div>
        </div>
         <?php include 'inc/a_footer.php'; ?>
	<script type="text/javascript">
        $(document).ready(function () {
            setupLeftMenu();
            $('.datatable').dataTable();
			setSidebarHeight();
        });
    </script>
    