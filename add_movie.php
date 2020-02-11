<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
//add_movie.php ** it processes the info from form and adds to database. **

include('db_movie.php');
include('pre_header.php');

if (isset($_POST['title'])) {
	$title = $_POST['title'];
}
if (isset($_POST['sort_title'])) {
	$sort_title = $_POST['sort_title'];
}
if (isset($_POST['year'])) {
	$year = $_POST['year'];
}
if (isset($_POST['rating'])) {
	$rating = $_POST['rating'];
}
if (isset($_POST['released'])) {
	$released = $_POST['released'];
}
if (isset($_POST['runtime'])) {
	$runtime = $_POST['runtime'];
}
if (isset($_POST['genre'])) {
	$genre = $_POST['genre'];
}
if (isset($_POST['director'])) {
	$director = $_POST['director'];
}
if (isset($_POST['writer'])) {
	$writer = $_POST['writer'];
}
if (isset($_POST['actors'])) {
	$actors = $_POST['actors'];
}
if (isset($_POST['plot'])) {
	$plot = $_POST['plot'];
}
if (isset($_POST['language'])) {
	$language = $_POST['language'];
}
if (isset($_POST['country'])) {
	$country = $_POST['country'];
}
if (isset($_POST['imdb_score'])) {
	$imdb_score = $_POST['imdb_score'];
}
if (isset($_POST['imdb_id'])) {
	$imdb_id = $_POST['imdb_id'];
}
if (isset($_POST['type'])) {
	$type = $_POST['type'];
}
if (isset($_POST['region'])) {
	$region = $_POST['region'];
	print_r($region);
	echo "<br>";
}
if (isset($_POST['format'])) {
	$format = $_POST['format'];
	print_r($format);
	echo "<br>";
}
if (isset($_POST['shelfmark'])) {
	$shelfmark = $_POST['shelfmark'];
}
if (isset($_POST['season'])) {
	$season = $_POST['season'];
}
if (isset($_POST['episode'])) {
	$episode = $_POST['episode'];
}
if (isset($_POST['notes'])) {
	$notes = $_POST['notes'];
}
if (isset($_POST['status'])) {
	$status = $_POST['status'];
}

if (isset($title)) {
	echo "<title>Adding $title</title>";
	include('header.php');
if ($type == "movie") {
$movie_id = addMovie($title, $sort_title, $year, $released, $runtime, $plot, $imdb_score, $imdb_id, $shelfmark, $notes, $status);
echo "<p>$movie_id</p>";
} 
elseif ($type == "series") {
$movie_id = addSeries($title, $sort_title, $year, $released, $runtime, $plot, $imdb_score, $imdb_id, $shelfmark, $season, $episode, $notes, $status);
echo "<p>$movie_id</p>";
}


	if ($movie_id != 0) {
	echo doResources($rating,$movie_id,"rating",1);
	echo doResources($genre,$movie_id,"genre",2);
	echo doResources($director,$movie_id,"director",3);
	echo doResources($writer,$movie_id,"writer",4);
	echo doResources($actors,$movie_id,"actor",5);
	echo doResources($language,$movie_id,"language",6);
	echo doResources($country,$movie_id,"country",7);
	echo doResources($type,$movie_id,"type",8);
	echo doArrayedResources($region,$movie_id,"region",9);
	echo doArrayedResources($format,$movie_id,"format",10);
	}

} else { // make sure the form has been submitted
	echo "<title>Error adding movie</title>";
	include('header.php');
	echo "<h2>Insufficient details provided to add this item</h2>";
}
?>

<?php
// functions specific to this form

function doResources($item_value,$movie_id,$item_type,$resource_type_id) {
	if (strpos($item_value, ", ")){
	$values = explode(', ',$item_value);
	$item_id = "";
	foreach($values as $value) {
		echo "<h3>$value</h3>";
		$resource_id = checkValueExistsGetIdOrInsertNew($item_type,$value,$movie_id);
		echo "<h4>$resource_id</h4>";
		$linkDir = addToManyLink($movie_id,$resource_type_id,$resource_id);
//		echo "<h3>$linkDir</h3>";
	}
	} else {
	$resource_id = checkValueExistsGetIdOrInsertNew($item_type,$item_value, $movie_id);
		$linkDir = addToManyLink($movie_id,$resource_type_id,$resource_id);
//		echo "<h3>$linkDir</h3>";
	}

}

function doArrayedResources($resource_array,$movie_id,$item_type,$resource_type_id) {
	foreach($resource_array as $resource) {
		$linkDir = addToManyLink($movie_id,$resource_type_id,$resource);
		echo "<h3>$linkDir</h3>";	
	}
}
?>