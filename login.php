<?php include('server.php') ?>
<!DOCTYPE html>
<html>
<head>
	<title>Now its time to register user</title>
	<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
	<div class="fullscreen-bg">
    <video loop muted autoplay poster="videoframe.jpg" class="fullscreen-bgvideo">
        <source src="bg-video.mp4" type="video/mp4">
    </video>
</div>
	<div class="header">
		<h2>infinitive form</h2>

		<img class="logo" src="logoforform.png" alt="">
	</div>
	
	<form method="post" action="login.php">

		<?php include('errors.php'); ?>

		<div class="input-group">
			<label></label>
			<input type="text" name="username" placeholder="USERNAME" >
		</div>
		<div class="input-group">
			<label></label>
			<input type="password" name="password" placeholder="PASSWORD">
		</div>
		<div class="input-group">
			<button type="submit" class="btn" name="login_user">LOG IN</button>
		</div>
	</form>

</body>
</html>