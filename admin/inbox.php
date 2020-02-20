<?php include 'inc/a_header.php'; ?>
<?php include 'inc/a_sidebar.php'; ?>
<div class="grid_10">
	<div class="box round first grid">
		<h2>Inbox</h2>
		<?php
		if (!isset($_GET['seenid']) || $_GET['seenid'] == null) {
			echo "Failed!";
		}else{
			$seenid = $_GET['seenid'];
			$query = "UPDATE contact
               SET 
               status = '1'
               WHERE id = '$seenid' "; 

               $updatepost = $db->update($query);
               if ($updatepost) {
                echo "<span class='successmsg'>Message sent in the Seen Box!</span>";
            }else{
                echo "<span class='failmsg'>Message not sent in the Seen Box!";
            }    
        }
		

		?>
		<div class="block">        
			<table class="data display datatable" id="example">
				<thead>
					<tr>
						<th width="8%">SL No.</th>
						<th width="12%">Name</th>
						<th width="20%">Email</th>
						<th width="25%">Message</th>
						<th width="20%">Date</th>
						<th width="15%">Action</th>
					</tr>
				</thead>
				<tbody>
					<?php
					$query = "SELECT * FROM contact WHERE status = '0' ORDER BY id DESC";
					$getcontactData = $db->select($query);
					if ($getcontactData) {
						$i = 0;
						while ($inbox = $getcontactData->fetch_assoc()) {
							$i++;
							?>
							<tr class="odd gradeX">

								<td><?php echo $i; ?></td>
								<td><?php echo $inbox['firstname']; ?> <?php echo $inbox['lastname']; ?></td>
								<td><?php echo $inbox['email']; ?></td>
								<td><?php echo $fm->textshorten($inbox['msg'], 30); ?></td>
								<td><?php echo $fm->formatDate($inbox['date']); ?></td>
								<td><a href="viewmsg.php?msgid=<?php echo $inbox['id']; ?>">View</a> || 
									<a href="replymsg.php?msgid=<?php echo $inbox['id']; ?>">Reply</a> || 
									<a onclick="return confirm('Are you sure sent to Seen Box?')" href="?seenid=<?php echo $inbox['id']; ?>">Seen</a>
								</td>
							</tr>
						<?php }}?>
					</tbody>
				</table>
			</div>
		</div>

		<div class="box round first grid">
			<h2>Seen Message</h2>
			<?php
                if (isset($_GET['delmsgid'])) {
                	$delmsgid = $_GET['delmsgid'];
                	$query = "DELETE FROM contact WHERE id = '$delmsgid' ";
                	$delmsg = $db->delete($query );
                	if ($delmsg) {
                    echo "<span class='successmsg'>Message Deleted Successfully!</span>";
                }else{
                    echo "<span class='failmsg'>Message Not Deleted!</span>";
                }
                	
                }

                ?>
			<div class="block">        
				<table class="data display datatable" id="example">
					<thead>
						<tr>
							<th width="8%">SL No.</th>
							<th width="12%">Name</th>
							<th width="20%">Email</th>
							<th width="25%">Message</th>
							<th width="20%">Date</th>
							<th width="15%">Action</th>
						</tr>
					</thead>
					<tbody>
						<?php
						$query = "SELECT * FROM contact WHERE status = '1' ORDER BY id DESC";
						$getcontactData = $db->select($query);
						if ($getcontactData) {
							$i = 0;
							while ($inbox = $getcontactData->fetch_assoc()) {
								$i++;
								?>
								<tr class="odd gradeX">

									<td><?php echo $i; ?></td>
									<td><?php echo $inbox['firstname']; ?> <?php echo $inbox['lastname']; ?></td>
									<td><?php echo $inbox['email']; ?></td>
									<td><?php echo $fm->textshorten($inbox['msg'], 30); ?></td>
									<td><?php echo $fm->formatDate($inbox['date']); ?></td>
									<td><a href="viewmsg.php?msgid=<?php echo $inbox['id']; ?>">View</a> || <a onclick="return confirm('Are you sure to Delete?')" href="?delmsgid=<?php echo $inbox['id']; ?>">Delete</a> 
									</td>
								</tr>
							<?php }}?>
						</tbody>
					</table>
				</div>
			</div>
		</div>
		<div class="clear">
		</div>
	</div>

	<script type="text/javascript">

		$(document).ready(function () {
			setupLeftMenu();

			$('.datatable').dataTable();
			setSidebarHeight();


		});
	</script>

	<?php include 'inc/a_footer.php'; ?>