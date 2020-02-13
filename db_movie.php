<?php
/**
██████  ██████          ███    ███  ██████  ██    ██ ██ ███████    ██████  ██   ██ ██████
██   ██ ██   ██         ████  ████ ██    ██ ██    ██ ██ ██         ██   ██ ██   ██ ██   ██
██   ██ ██████          ██ ████ ██ ██    ██ ██    ██ ██ █████      ██████  ███████ ██████
██   ██ ██   ██         ██  ██  ██ ██    ██  ██  ██  ██ ██         ██      ██   ██ ██
██████  ██████  ███████ ██      ██  ██████    ████   ██ ███████ ██ ██      ██   ██ ██
*/


// all the database calls for new movies app. mostly prepared statements. some functions use standard OO mysqli calls if i need to pass the table name as a variable

/**
███████ ███████ ██      ███████  ██████ ████████ ███████
██      ██      ██      ██      ██         ██    ██
███████ █████   ██      █████   ██         ██    ███████
     ██ ██      ██      ██      ██         ██         ██
███████ ███████ ███████ ███████  ██████    ██    ███████
*/



function getMovieDetails($movie_id) {
	include('connected.php');

	/* create a prepared statement */
	if ($stmt = $con->prepare("SELECT * from movie where movie_id = ?")) {

	/* bind parameters for markers */
	$stmt->bind_param("i", $movie_id);

	/* execute query */
	$stmt->execute();

	/* instead of bind_result: */
	$result = $stmt->get_result();

	return($result);
	/* close statement */
	$stmt->close();
    }

	/* close connection */
	$con->close();
	}

function getMovieForResource($resource_type,$resource_id) {
	include('connected.php');

	/* create a prepared statement */
	if ($stmt = $con->prepare("SELECT movie_id from movie_link_many where movie_resource_type_id = ? and movie_resource_id = ?")) {

	/* bind parameters for markers */
	$stmt->bind_param("ii", $resource_type,$resource_id);

	/* execute query */
	$stmt->execute();

	/* instead of bind_result: */
	$result = $stmt->get_result();

	return($result);
	/* close statement */
	$stmt->close();
    }

	/* close connection */
	$con->close();

	}

function getAllMovies() {
	include('connected.php');

	/* create a prepared statement */
	if ($stmt = $con->prepare("SELECT * from movie order by movie_sort_title")) {

	/* bind parameters for markers */
	//$stmt->bind_param("i", $movie_id);

	/* execute query */
	$stmt->execute();

	/* instead of bind_result: */
	$result = $stmt->get_result();

	return($result);
	/* close statement */
	$stmt->close();
    }

	/* close connection */
	$con->close();

	}

	function getAllMoviesForResourceType($movie_resource_type_id, $movie_resource_id) {
		include('connected.php');

		/* create a prepared statement */
		if ($stmt = $con->prepare("select movie.movie_id, movie.movie_title, movie.movie_year, movie_link_many.movie_resource_id from movie, movie_link_many where movie.movie_id = movie_link_many.movie_id and movie_link_many.movie_resource_type_id = ? and movie_link_many.movie_resource_id = ?")) {

		/* bind parameters for markers */
		$stmt->bind_param("ii", $movie_resource_type_id, $movie_resource_id);

		/* execute query */
		$stmt->execute();

		/* instead of bind_result: */
		$result = $stmt->get_result();

		return($result);
		/* close statement */
		$stmt->close();
	    }

		/* close connection */
		$con->close();

		}
		function getAllMoviesForResourceTypeSortIdDesc($movie_resource_type_id, $movie_resource_id) {
			include('connected.php');

			/* create a prepared statement */
			if ($stmt = $con->prepare("select movie.movie_id, movie.movie_title, movie.movie_year, movie_link_many.movie_resource_id from movie, movie_link_many where movie.movie_id = movie_link_many.movie_id and movie_link_many.movie_resource_type_id = ? and movie_link_many.movie_resource_id = ? order by movie.movie_id desc")) {

			/* bind parameters for markers */
			$stmt->bind_param("ii", $movie_resource_type_id, $movie_resource_id);

			/* execute query */
			$stmt->execute();

			/* instead of bind_result: */
			$result = $stmt->get_result();

			return($result);
			/* close statement */
			$stmt->close();
		    }

			/* close connection */
			$con->close();

			}

function getResourceList() {
	include('connected.php');

	/* create a prepared statement */
	if ($stmt = $con->prepare("SELECT * from movie_resources")) {

	/* bind parameters for markers */
	//$stmt->bind_param("i", $movie_id);

	/* execute query */
	$stmt->execute();

	/* instead of bind_result: */
	$result = $stmt->get_result();

	return($result);
	/* close statement */
	$stmt->close();
    }

	/* close connection */
	$con->close();
	}

function getResourceIdByName($resource_name) {
	include('connected.php');
	// echo "<h3>gRIBN: $resource_name</h3>";
	/* create a prepared statement */
	if ($stmt = $con->prepare("SELECT movie_resources_id from movie_resources where movie_resource_type = ?")) {

	/* bind parameters for markers */
	$stmt->bind_param("s", $resource_name);

	/* execute query */
	$stmt->execute();

	/* instead of bind_result: */
	$result = $stmt->get_result();
	// var_dump($result);
	return($result);
	/* close statement */
	$stmt->close();
    }

	/* close connection */
	$con->close();
	}

function getAllResourceValuesByName($resource_name) {
	include('connected.php');
		$table_variable = "movie_".$resource_name;
	$sql = "SELECT * FROM $table_variable";
//	echo "<em>$sql</em><br>";
		$result = $con->query($sql);
		return $result;
}

function getMovieResourceByTypeMovieId($resource_id,$movie_id) {
	include('connected.php');

	/* create a prepared statement */
	if ($stmt = $con->prepare("SELECT * FROM movie_link_many WHERE movie_resource_type_id = ? AND movie_id = ?")) {

	/* bind parameters for markers */
	$stmt->bind_param("ii", $resource_id,$movie_id);

	/* execute query */
	$stmt->execute();

	/* instead of bind_result: */
	$result = $stmt->get_result();

	return($result);
	/* close statement */
	$stmt->close();
    }

	/* close connection */
	$con->close();
	}


function getResourceDetails ($itemType,$itemValue) {
	include('connected.php');
		$table_variable = "movie_".strtolower($itemType);

		$search_variable = $table_variable."_id";
		if (strpos($itemValue, ",")){
		$sql = "SELECT * FROM $table_variable WHERE $search_variable in ($itemValue)";
		} else {
		$itemValue = str_replace("'","",$itemValue);
		$sql = "SELECT * FROM $table_variable WHERE $search_variable = '$itemValue'";
		}
//		echo "<em>$sql</em><br>";
		$result = $con->query($sql);
		// print_r($result);
		return $result;
}

/**
██ ███    ██ ███████ ███████ ██████  ████████ ███████
██ ████   ██ ██      ██      ██   ██    ██    ██
██ ██ ██  ██ ███████ █████   ██████     ██    ███████
██ ██  ██ ██      ██ ██      ██   ██    ██         ██
██ ██   ████ ███████ ███████ ██   ██    ██    ███████
*/



 function checkValueExistsGetIdOrInsertNew($itemType,$itemValue,$movieId) {
 	include('connected.php');

 	$itemType = mysqli_real_escape_string($con, $itemType);
 	$itemValue = mysqli_real_escape_string($con, $itemValue);


 	$table_variable = "movie_".$itemType;
 	$id_variable = $table_variable."_id";
 	$search_variable = $table_variable;

 	if ($itemType == "actor" || $itemType == "director" || $itemType == "writer") {
 		$search_variable = $table_variable . "_full_name";
 	}



 	//Check if the particular item is already in the relevant table
 	$sql = "SELECT $id_variable FROM $table_variable WHERE $search_variable = '$itemValue'";
 	// echo "<em>$sql</em><br>";
 		$result = $con->query($sql);
 		// print_r($result);
 		$row_cnt = $result->num_rows;


 		if ($row_cnt == 0) {
 			// DO INSERT
 			$item_add = "INSERT INTO $table_variable ($search_variable) VALUES ('$itemValue')";
 			// echo "$item_add<br>";
 //			$inserted = mysqli_query($con, $item_add);
 			$inserted = $con->query($item_add);
 			if (!$inserted){
 			echo "error will robinson!!<br>Album Info not added.".mysqli_error($con);
 			exit;
 			} else {
 			$item_id = $con->insert_id;
 			}
 			return $item_id;
 		} else {
 			//GET & RETURN EXISTING VALUE
 			while ($row = $result->fetch_assoc())
 			{
 				$item_id = $row[$id_variable];
 				return $item_id;
 			}
 		}


 }

function addMovie($title,$sort_title,$year,$release_date,$runtime,$plot,$imdb_score,$imdb_id,$shelfmark,$notes,$status) {
	include('connected.php');
	$date_added = date("Y-m-d H:i:s");
			//PREPARE MOVIE INSERT STATEMENT
	$insert = 'INSERT INTO movie (movie_title,movie_sort_title,movie_year,movie_release_date,movie_runtime,movie_plot,movie_imdb_rating,movie_imdb_id,movie_shelfmark,movie_note,movie_status,movie_date_added) VALUES (?,?,?,?,?,?,?,?,?,?,?,?)';
	$insertStmt = $con->prepare($insert);
	//EXECUTE INSERT
	$insertStmt->bind_param('ssisisisssis', $title, $sort_title, $year, $release_date, $runtime, $plot, $imdb_score, $imdb_id, $shelfmark, $notes, $status, $date_added);
    	$insertStmt->execute();
    	$movieId = $con->insert_id;
	return $movieId;
}

function addSeries($title, $sort_title, $year, $release_date, $runtime, $plot, $imdb_score, $imdb_id, $shelfmark, $season, $episode, $notes, $status) {
	include('connected.php');
	$date_added = date("Y-m-d H:i:s");
			//PREPARE MOVIE INSERT STATEMENT
	$insert = 'INSERT INTO movie (movie_title,movie_sort_title,movie_year,movie_release_date,movie_runtime,movie_plot,movie_imdb_rating,movie_imdb_id,movie_shelfmark,movie_season,movie_episodes,movie_note,movie_status,movie_date_added) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?)';
	$insertStmt = $con->prepare($insert);
	//EXECUTE INSERT
	$insertStmt->bind_param('ssisisisssssis', $title, $sort_title, $year, $release_date, $runtime, $plot, $imdb_score, $imdb_id, $shelfmark, $season, $episode, $notes, $status, $date_added);
    	$insertStmt->execute();
    	$movieId = $con->insert_id;
    	$error = $con->error;
    	echo "$error";
	return $movieId;
}



function addToManyLink ($movie_id,$resource_type_id,$resource_id) {
	include('connected.php');
				//PREPARE ADD RESOURCE ID INSERT STATEMENT
//				echo "<p>IN MANY: $movie_id - $resource_type_id - $resource_id</p>";

	$insert = 'INSERT INTO movie_link_many (movie_id,movie_resource_type_id,movie_resource_id) VALUES (?,?,?)';
	$insertStmt = $con->prepare($insert);
	//EXECUTE INSERT
	$insertStmt->bind_param('iii', $movie_id,$resource_type_id,$resource_id);
    	$insertStmt->execute();
    	$movieId = $con->insert_id;
	return $movieId;
}

/**
██    ██ ██████  ██████   █████  ████████ ███████ ███████
██    ██ ██   ██ ██   ██ ██   ██    ██    ██      ██
██    ██ ██████  ██   ██ ███████    ██    █████   ███████
██    ██ ██      ██   ██ ██   ██    ██    ██           ██
 ██████  ██      ██████  ██   ██    ██    ███████ ███████
*/



?>
