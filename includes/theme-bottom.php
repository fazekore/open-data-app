	</div>

	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>
	<script src="http://maps.googleapis.com/maps/api/js?key=AIzaSyCOSF6EUJHi28FLeCSkKsQsG1gtn4vRkN4&sensor=false"></script>
	<script src="js/latlng.min.js"></script>
	<?php if (strpos($_SERVER['HTTP_HOST'], 'localhost') !== false) : ?>
	<script src="js/courts.js"></script>
	<?php else : ?>
	<script src="js/courts.min.js"></script>
	<?php endif; ?>
</body>
</html>
