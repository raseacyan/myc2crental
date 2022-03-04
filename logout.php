<?php

session_start();
session_destroy();
?>
<!DOCTYPE html>
<html>
<head>
	<title>Demo</title>
</head>
<body>
		<?php include("inc/nav.php"); ?>
		
		<p>You have been logged out.</p>
</body>
</html>