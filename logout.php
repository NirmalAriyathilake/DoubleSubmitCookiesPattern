<?php
	session_start();
	session_destroy();
	unset($_SESSION['username']);
	$_SESSION['message'] = "You are successfully logged out";
	header("Location: login.php");	
?>

<html>
<body>
<script>
	alert("You are successfully logged out!");
</script>
</body>
</html>