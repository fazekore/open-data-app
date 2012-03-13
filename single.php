<?php



$id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);

if (empty($id)) {
	header('Location: index.php');
	exit;
}


require_once 'includes/db.php';


$sql = $db->prepare('
	SELECT id, name, longitude, latitude
	FROM courts
	WHERE id = :id
');


$sql->bindValue(':id', $id, PDO::PARAM_INT);
$sql->execute();
$results = $sql->fetch();

if (empty($results)) {
	header('Location: index.php');
	exit; 
}

?><!DOCTYPE HTML>
<html>
<head>
	<meta charset="utf-8">
	<title><?php echo $results['name']; ?> &middot; Basketball Courts</title>
</head>
<body>
	
	<h1><?php echo $results['name']; ?></h1>
	<p>Longitude: <?php echo $results['longitude']; ?></p>
	<p>Latitude: <?php echo $results['latitude']; ?></p>	
</body>
</html>
