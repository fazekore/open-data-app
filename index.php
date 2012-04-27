<?php
/**
* Displays the list and map for the Open Data Set
*
* @package ca.thomasjbradley.dinobonefinder
* @copyright 2012 Thomas J Bradley
* @author Thomas J Bradley <hey@thomasjbradley.ca>
* @link https://github.com/bradlet/dino-bone-finder
* @license New BSD License
* @version 1.0.0
*/

require_once 'includes/db.php';

$results = $db->query('
	SELECT id, name, longitude, latitude, rate_count, rate_total
	FROM courts
	ORDER BY name ASC
');

include 'includes/theme-top.php';

?>
<div id="left-menu">
<button id="geo">Find Me</button>
<form id="geo-form">
	<label for="adr">Address</label>
	<input id="adr">
</form>
	<ol class="courts">
	<?php foreach ($results as $court) : ?>
		
		<?php
		if ($court['rate_count'] > 0) {
			$rating = round($court['rate_total'] / $court['rate_count']);
		} else {
			$rating = 0;
		}
	?>
	<li itemscope itemtype="http://schema.org/TouristAttraction" data-id="<?php echo $court['id']; ?>">
		<strong class="distance"></strong>
		<a href="courts/<?php echo $court['id']; ?>" itemprop="name"><?php echo $court['name']; ?></a>
		<span itemprop="geo" itemscope itemtype="http://schema.org/GeoCoordinates">
			<meta itemprop="latitude" content="<?php echo $court['latitude']; ?>">
			<meta itemprop="longitude" content="<?php echo $court['longitude']; ?>">
		</span>
		
		<ol class="rater">
		<?php for ($i = 1; $i <= 5; $i++) : ?>
			<?php $class = ($i <= $rating) ? 'is-rated' : ''; ?>
			<li class="rater-level <?php echo $class; ?>">★</li>
		<?php endfor; ?>
		</ol>
	</li>
<?php endforeach; ?>
</ol>
</div>
<div id="map"></div>

<?php

include 'includes/theme-bottom.php';

?>
