<?php include 'inc/header.php'; ?>
<?php
if ($_SERVER['REQUEST_METHOD']== 'POST') {
	$firstname = $fm->validation($_POST['firstname']);
	$lastname = $fm->validation($_POST['lastname']);
	$email = $fm->validation($_POST['email']);
	$msg = $fm->validation($_POST['msg']);

	$firstname = mysqli_real_escape_string($db->link, $firstname);
	$lastname = mysqli_real_escape_string($db->link, $lastname);
	$email = mysqli_real_escape_string($db->link, $email);
	$msg = mysqli_real_escape_string($db->link, $msg);

	$errorfn = "";
	$errorln = "";
	$errorem = "";
	$errormsg = "";

	if (empty($firstname)) {
		$errorfn = "First Name must not be empty!";
	}
	if (empty($lastname)) {
		$errorln = "Last Name must not be empty!";
	}
	if (empty($email)) {
		$errorem = "Email must not be empty!";
	}
	if (empty($msg)) {
		$errormsg = "Message must not be empty!";
	}
	else{
		$query = "INSERT INTO contact (firstname, lastname, email, msg) VALUES ('$firstname','$lastname','$email','$msg')";
		$insertContact = $db->insert($query);
		if ($insertContact) {
			$message = "Message Sent Sucessfully !";
		}else{
			$error = "Failed to Send Message !";
		} 
	}

}
?>

<div class="contentsection contemplete clear">
	<div class="maincontent clear">
		<div class="about">
			<?php
			if (isset($message)) {
				echo "<span style='color:green; float:right; font-weight:bold;'>$message</span>";
			}

			?>
			<h2>Contact us</h2>
			<form action="" method="post">
				<table>
					<tr>
						<td>Your First Name:</td>
						<td>
							<?php if(isset($errorfn)){
								echo "<span style='color:red; float:left;'>$errorfn</span>";
							}?>
							<input type="text" name="firstname" placeholder="Enter first name"/>
						</td>
					</tr>
					<tr>
						<td>Your Last Name:</td>
						<td>
							<?php if(isset($errorln)){
								echo "<span style='color:red; float:left;'>$errorln</span>";
								}?>
							<input type="text" name="lastname" placeholder="Enter Last name"/>
						</td>
					</tr>

					<tr>
						<td>Your Email Address:</td>
						<td>
							<?php if(isset($errorem)){
							echo "<span style='color:red; float:left;'>$errorem</span>";
						}?>
							<input type="email" name="email" placeholder="Enter Email Address"/>
						</td>
					</tr>
					<tr>
						<td>Your Message:</td>
						<td>
							<?php if(isset($errorln)){
								echo "<span style='color:red; float:left;'>$errormsg</span>";
							}?>
							<textarea name="msg"></textarea>
						</td>
					</tr>
					<tr>
						<td></td>
						<td>
							<input type="submit" name="submit" value="Submit"/>
						</td>
					</tr>
				</table>
				<form>				
				</div>

			</div>
			
				
				<?php include 'inc/sidebar.php';?>
			

			<?php include 'inc/footer.php';?>