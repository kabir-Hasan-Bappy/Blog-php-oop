<?php include '../lib/Session.php'; 
Session::checkLogin();
?>
<?php
include '../config/config.php'; 
include '../lib/Database.php'; 
include '../helpers/Format.php'; 
?>
<?php 
$db = new Database();
$fm = new Format();
?>
<!DOCTYPE html>
<head>
<meta charset="utf-8">
<title>Password Recovery</title>
    <link rel="stylesheet" type="text/css" href="css/stylelogin.css" media="screen" />
</head>
<body>
<div class="container">
	<section id="content">
		<?php
		if ($_SERVER['REQUEST_METHOD']== 'POST') {
			$email = $fm->validation($_POST['email']);
			$email = mysqli_real_escape_string($db->link, $email);
			
			$query = "SELECT * FROM users WHERE email = '$email' LIMIT 1";
        	$mailcheck = $db->select($query);
        	if ($mailcheck != false ) {
        		while ($value = $mailcheck->fetch_assoc()) {
        			$userid = $value['id'];
        			$username = $value['username'];
        			
        		}
        		$text = substr($email, 0, 3);
        		$rand = rand(10000, 99999);
        		$newpass = '$text$rand';
        		$password = md5($newpass);

        		$query = "UPDATE 
        				  users
        		          SET
        		          password = '$password' 
        		          WHERE id= '$userid'";
                $updatepass = $db->update($query);
                $to = "$email";
                $from = "kabir.softwindtech@gmail.com";
                $headers = "$from\n";
                $headers .= "MIME-Version: 1.0" . "\r\n" ;
                $headers .= "Content-type: text/html; charset=UTF-8" . "\r\n";
                $subject = "Your Password";
                $message = "Your Username is '.$username.' and Password is '.$newpass.'";
                $sendMail = mail($to, $subject, $message, $headers);

                if ($sendMail) {
                	echo "<span style='color:green; font-size:20px;'>Please check your Email!</span>";
                }else{
                	echo "<span style='color:red; font-size:20px;'>Email Not Send!</span>";
                }

        	}
				
			else{
				echo "<span style='color:red; font-size:20px;'>Email Not Exist!</span>";
			}

		}

		?>
		<form action="" method="post">
			<h1>Password Recovery</h1>
			<div>
				<input type="text" placeholder="Enter Valid Email" required="" name="email"/>
			</div>
			<div>
				<input type="submit" value="Send Email" />
			</div>
		</form>
		<!-- form -->
		<div class="button">
			<a href="login.php">Log In</a>
		</div>
		<!-- button -->
	</section>
	<!-- content -->
</div>
<!-- container -->
</body>
</html>