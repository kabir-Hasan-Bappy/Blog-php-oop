<?php include 'inc/a_header.php'; ?>
<?php include 'inc/a_sidebar.php'; ?>
        <div class="grid_10">
            <div class="box round first grid">
                <h2>User List</h2>
                <?php
                if (isset($_GET['deluser'])) {
                	$deluser = $_GET['deluser'];
                	$query = "DELETE FROM users WHERE id= '$deluser'";
                	$deluser = $db->delete($query );
                	if ($deluser) {
                    echo "<span class='successmsg'>User Deleted Successfully!</span>";
                }else{
                    echo "<span class='failmsg'>User Not Deleted!</span>";
                }
                	
                }

                ?>
         
                <div class="block"> 
             
                    <table class="data display datatable" id="example">
					<thead>
						<tr>
							<th>Serial No.</th>
							<th>Usename</th>
							<th>Email</th>
							<th>Role</th>
							<th>Action</th>
						</tr>
					</thead>
				 
					<tbody>
		<?php
		$query = "SELECT * FROM users ORDER BY id DESC";
		$alluser = $db->select($query);
		if ($alluser) { 
			$i = 0;
			while ( $result = $alluser->fetch_assoc()) {
			$i++; ?>
						<tr class="odd gradeX">
							<td><?php echo $i; ?></td>
							<td><?php echo $result['username']; ?></td>
							<td><?php echo $result['email']; ?></td>
							<td>
								<?php
								 if ($result['role'] == '0') {
								 	echo "Admin";
								 }elseif ($result['role'] == '1') {
								 	echo "Author";
								 }elseif ($result['role'] == '2') {
								 	echo "Editor";
								 }
								 ?></td>
							<td>
								<a href="viewuser.php?viewuserid=<?php echo $result['id'];?>">View</a> 

								<?php if (Session::get('userRole') == '0') {?> || 
								<a onclick="return confirm('Are you sure want to delete?')" href="?deluser=<?php echo $result['id'];?>">Delete</a>
							<?php } ?>
							</td>

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