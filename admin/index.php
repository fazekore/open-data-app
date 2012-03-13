<?php

require_once '../includes/db.php';

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
	
	<a href="add.php">Add</a>
    <ul>
	
	<?php foreach ($results as $court) : ?>
		<li>
			<?php echo $court['name']; ?>
			&bull;
			
            <a href="edit.php?id=<?php echo $court['id']; ?>">Edit</a>
            
			<a href="delete.php?id=<?php echo $court['id']; ?>">Delete</a>
		</li>
	<?php endforeach; ?>
	</ul>
	
</body>
</html>
