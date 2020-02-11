<?php
include('pre_header.php');

include('db_movie.php');
$resource_type = $_GET['resource'];
$resource_id = $_GET['resource_id'];
echo "<title>resource.php - $resource_type; $resource_id</title>";
include('header.php');
$table_variable = "movie_$resource_type";
$id_variable = $table_variable."_id";

$mri = getResourceIdByName($resource_type);
	while ($mri_res = $mri->fetch_assoc()) {
		$mri_id = $mri_res['movie_resources_id'];
		// echo "<p>MRI_ID: $mri_id</p>";
	}

$result = getResourceDetails ($resource_type,$resource_id);
	while ($row = $result->fetch_assoc()) {
		$name_variable = $table_variable;
	if ($resource_type == "actor" || $resource_type == "director" || $resource_type == "writer") {
		$name_variable .= "_full_name";
	}
		$resource_name = $row[$name_variable];
		echo "<h2>$resource_name</h2>";
		// echo "<p>getting resource_name</p>";
		// print_r($row);
	}

$movie_xd = getMovieForResource($mri_id,$resource_id); 
	while ($mov_res = $movie_xd->fetch_assoc()){
		// echo "<p>getting movie_id for resource</p>";
		$movie_id = $mov_res['movie_id'];

		$movie_all = getMovieDetails($movie_id);
		while ($vie_res = $movie_all->fetch_assoc()) {
		$movie_title = $vie_res['movie_title'];
		echo "<p><a href='movie.php?movie=$movie_id'>$movie_title</a></p>";
	}
	}


include('footer.php');
?>