<?php

require_once '../includes/db.php';

$places_xml = simplexml_load_file('basketball.kml');

$sql = $db->prepare('
	INSERT INTO courts (name, longitude, latitude)
	VALUES (:name, :longitude, :latitude)
');

foreach ($places_xml->Document->Folder[0]->Placemark as $place) {
	$coords = explode(',', trim($place->Point->coordinates));


	$sql->bindValue(':name', $place->name, PDO::PARAM_STR);
	$sql->bindValue(':longitude', $coords[0], PDO::PARAM_STR);
	$sql->bindValue(':latitude', $coords[1], PDO::PARAM_STR);
	$sql->execute();
}

// Lets us debug errors in our SQL code
// REMOVE FROM PRODUCTION CODE!!!
var_dump($sql->errorInfo());
