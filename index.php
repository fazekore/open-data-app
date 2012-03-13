<?php

require_once 'includes/db.php';

$results = $db->query('
	SELECT id, name, longitude, latitude
	FROM courts
	ORDER BY name ASC
');

?><!DOCTYPE HTML>
<html>
<head>
	<meta charset="utf-8">
	<title>Basketball Courts</title>
</head>
<body>
	
	
    <ul>
	
	<?php foreach ($results as $court) : ?>
		<li>
			<a href="single.php?id=<?php echo $court['id']; ?>"><?php echo $court['name']; ?></a>
		
		</li>
	<?php endforeach; ?>
	</ul>
	
</body>
</html>
