<?php include 'inc/a_header.php'; ?>
<?php include 'inc/a_sidebar.php'; ?>
        <div class="grid_10">
            <div class="box round first grid">
                <h2>Category List</h2>
                <?php
                if (isset($_GET['cat_del_id'])) {
                	$catid = $_GET['cat_del_id'];
                	$query = "DELETE FROM category WHERE id= '$catid'";
                	$delcat = $db->delete($query );
                	if ($delcat) {
                    echo "<span class='successmsg'>Category Deleted Successfully!</span>";
                }else{
                    echo "<span class='failmsg'>Category Not Deleted!</span>";
                }
                	
                }

                ?>
         
                <div class="block"> 
             
                    <table class="data display datatable" id="example">
					<thead>
			
						<tr>
							<th>Serial No.</th>
							<th>Category</th>
							<th>Action</th>
						</tr>
			
					</thead>
				 
					<tbody>
		<?php
		$query = "SELECT * FROM category ORDER BY id DESC";
		$cate = $db->select($query);
		if ($cate) { 
			$i = 0;
			while ( $result = $cate->fetch_assoc()) {
			$i++; ?>
						<tr class="odd gradeX">
							<td><?php echo $i; ?></td>
							<td><?php echo $result['c_name']; ?></td>
							<td><a href="edit_cat.php?cat_edit_id=<?php echo $result['id'];?>">Edit</a> || <a onclick="return confirm('Are you sure want to delete?')" href="?cat_del_id=<?php echo $result['id'];?>">Delete</a></td>

						</tr>
						<?php } } ?>
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