<?php

require_once '../includes/users.php';

if (!user_signed_in()) {
	header('Location: sign-in.php');
	exit;
}

require_once '../includes/db.php';

$results = $db->query('
	SELECT id, name, adr, lat, lng, rate_count, rate_total
	FROM courts
	ORDER BY name ASC
');

?><!DOCTYPE html>
<html lang="en-ca">
<head>
	<meta charset="utf-8">
	<title>Admin · Basketball Court Finder</title>
</head>
<body>

	<a href="sign-out.php">Sign Out</a>

	<ol class="courts">
	<?php foreach ($results as $court) : ?>
		<li><?php echo $court['name']; ?></li>
	<?php endforeach; ?>
	</ol>

</body>
</html>
