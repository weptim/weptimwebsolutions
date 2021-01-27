<?php
	
	$msg = '';
	$msgClass = '';

	//check forsubmit button
	if(filter_has_var(INPUT_POST, 'submit')) {
		# Get form Data
		$name = htmlspecialchars($_POST['name']);
		$email = htmlspecialchars($_POST['email']);
		$message = htmlspecialchars($_POST['message']);

		# validate all feilds
		if (!empty($name) && !empty($email) && !empty($message)) {
			
			if (filter_var($email, FILTER_VALIDATE_EMAIL) === false) {
				// failed
				$msg = 'use a valid email';
			    $msgClass = 'alert-danger';
			} else {
				// passed
				// recipent email
				$mailto = 'weptimwebsolutions@gmail.com';
				$subject = 'contact request from'. $name;
				$body = '<h2>Contact Request</h2>
				<h4>name</h4><p>'. $name . '</p>
				<h4>email</h4><p>'. $email . '</p>
				<h4>message</h4><p>'. $message . '</p>
				';
				// email headers
				$headers = "MIME-Version: 1.0" . "\r\n";
				$headers .= "Content Type:text/html; Charset=UTF-8" . "\r\n";

				// additional headers
				$headers .= "From:" .$name. "<".$email.">". "\r\n";
				if (mail($mailto, $subject, $body, $headers)) {
					// email sent
					$msg = 'Your Email Has Been Sent';
					$msgClass = 'alert-success';
				} else {
					$msg = 'Your Email has not been sent';
					$msgClass = 'alert-danger';
				}
			}
		} else {
			# failed
			$msg = 'please fill in all the feilds';
			$msgClass = 'alert-danger';
		}
	}

?>
<!DOCTYPE html>
<html>
<head>
	<title>contact us</title>
	<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
	<nav>
		<div class="container">
		<a class="nav" href="index.php">My Website</a> 
	</div>
	</nav>
	<section>
		<div class="container">
			<?php if($msg!= ''): ?>
				<div class="alert <?php echo $msgClass; ?>">
					<?php echo $msg; ?>
				</div>

			<?php endif; ?>
			<form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
				<div class="form-group">
					<label>name</label><br>
					<input type="text" name="name"  class="form-controll" placeholder="name..." value="<?php echo isset($_POST['name']) ? $name : ''; ?> ">
				</div>
				<div class="form-group">
					<label>Email</label><br>
					<input type="text" name="email" class="form-controll" placeholder="email..." value="<?php echo isset($_POST['email']) ? $email : ''; ?>">
				</div>
				<div class="form-group">
					<label>message</label><br>
					<textarea name="message" class="form-controll"><?php echo isset($_POST['message']) ? $message : ''; ?></textarea>
				</div>
				<br>
				<button type="submit" name="submit" class="btn">submit</button>
			</form>
		</div>
	</section>
</body>
</html>