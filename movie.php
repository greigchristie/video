<?php
/**
███    ███  ██████  ██    ██ ██ ███████    ██████  ██   ██ ██████
████  ████ ██    ██ ██    ██ ██ ██         ██   ██ ██   ██ ██   ██
██ ████ ██ ██    ██ ██    ██ ██ █████      ██████  ███████ ██████
██  ██  ██ ██    ██  ██  ██  ██ ██         ██      ██   ██ ██
██      ██  ██████    ████   ██ ███████ ██ ██      ██   ██ ██
*/


include('pre_header.php');
$movie_id = "";
if (isset($_GET['movie'])) {
	$movie_id = $_GET['movie'];
	}
include('db_movie.php');

if ($movie_id == "") {
	include('header.php');
	echo "<title>movie.php - NOPE</title>";
	echo "nope";
	} else {
//		echo "<title>movie.php - $movie_id</title>";
//include('header.php');

/**
██████   ██████      ███    ███  ██████  ██    ██ ██ ███████
██   ██ ██    ██     ████  ████ ██    ██ ██    ██ ██ ██
██   ██ ██    ██     ██ ████ ██ ██    ██ ██    ██ ██ █████
██   ██ ██    ██     ██  ██  ██ ██    ██  ██  ██  ██ ██
██████   ██████      ██      ██  ██████    ████   ██ ███████
*/



	$movie_details = getMovieDetails($movie_id);
	while ($row = $movie_details->fetch_assoc())
		{

			$movie_title = $row['movie_title'];
			$movie_year = $row['movie_year'];
			$movie_released = $row['movie_release_date'];
			$movie_runtime = $row['movie_runtime'];
			$movie_plot = $row['movie_plot'];
			$movie_shelfmark = $row['movie_shelfmark'];
			$movie_season = $row['movie_season'];
			$movie_episodes = $row['movie_episodes'];
			$imdb_id = $row['movie_imdb_id'];
			$imdb_score = $row['movie_imdb_rating'];
			$movie_note = $row['movie_note'];
		echo "<title>$movie_title ($movie_year)</title>";
		include('header.php');

		/**
		██   ██ ████████ ███    ███ ██
		██   ██    ██    ████  ████ ██
		███████    ██    ██ ████ ██ ██
		██   ██    ██    ██  ██  ██ ██
		██   ██    ██    ██      ██ ███████
		*/


			echo "<h2>$movie_title ($movie_year)</h2>\n";
			echo "<div class='row'>";
			echo "<div class='col-xs-6'>";
			echo "<strong>Release date:</strong> <em>$movie_released</em>";
			echo "</div>";
			echo "<div class='col-xs-6'>";
			echo "&nbsp;";
			echo "</div>";
			echo "</div>\n";
			echo "<div class='row'>";
			echo "<div class='col-xs-6'>";
			echo "<strong>Runtime:</strong> $movie_runtime mins";
			echo "</div>";
			echo "<div class='col-xs-6'>";
			echo "&nbsp;";
			echo "</div>";
			echo "</div>\n";
			echo "<div class='row'>";
			echo "<div class='col-xs-6'>";
			echo "<strong>Plot:</strong> $movie_plot";
			echo "</div>";
			echo "<div class='col-xs-6'>";
			echo "&nbsp;";
			echo "</div>";
			echo "</div>\n";
			echo "<div class='row'>";
			echo "<div class='col-xs-6'>";
			echo "<strong>Shelfmark:</strong> $movie_shelfmark";
			echo "</div>";
			echo "<div class='col-xs-6'>";
			echo "&nbsp;";
			echo "</div>";
			echo "</div>\n";
			echo "<div class='row'>";
			echo "<div class='col-xs-6'>";
			echo "<strong>Note:</strong> $movie_note";
			echo "</div>";
			echo "<div class='col-xs-6'>";
			echo "&nbsp;";
			echo "</div>";
			echo "</div>\n";
			echo "<div class='row'>";
			echo "<div class='col-xs-6'>";
			echo "<a href='https://www.imdb.com/title/$imdb_id'>$movie_title@imdb.com</a>";
			echo "</div>";
			echo "<div class='col-xs-6'>";
			echo "&nbsp;";
			echo "</div>";
			echo "</div>\n";
			echo "<div class='row'>";
			echo "<div class='col-xs-6'>";
			echo "<strong>IMDB Score:</strong> $imdb_score";
			echo "</div>";
			echo "<div class='col-xs-6'>";
			echo "&nbsp;";
			echo "</div>";
			echo "</div>\n";
		}

		/**
		██████   ██████      ██████  ███████ ███████  ██████  ██    ██ ██████   ██████ ███████ ███████
		██   ██ ██    ██     ██   ██ ██      ██      ██    ██ ██    ██ ██   ██ ██      ██      ██
		██   ██ ██    ██     ██████  █████   ███████ ██    ██ ██    ██ ██████  ██      █████   ███████
		██   ██ ██    ██     ██   ██ ██           ██ ██    ██ ██    ██ ██   ██ ██      ██           ██
		██████   ██████      ██   ██ ███████ ███████  ██████   ██████  ██   ██  ██████ ███████ ███████
		*/


	$resources = getResourceList();

	while ($resso = $resources->fetch_assoc())
		{
			$resource_id = $resso['movie_resources_id'];
			$resource_name = $resso['movie_resource_type'];
//			$resource_table_name = "movie_".strtolower($resource_name);
			echo "<div class='row'>";
			echo "<div class='col-xs-6'>";
			echo "<h3>$resource_name</h3>";
			echo "</div>";
			echo "<div class='col-xs-6'>";
			echo "&nbsp;";
			echo "</div>";
			echo "</div>\n";


			$res_id = "";
			$movie_resource_id = getMovieResourceByTypeMovieId($resource_id,$movie_id);
			$mri_cnt = mysqli_num_rows($movie_resource_id);

			while ($settee = $movie_resource_id->fetch_assoc()) {
				$res_id .= "'".$settee['movie_resource_id']."',";

					}

			$res_id = rtrim($res_id,',');
//			echo "<p>$res_id</p>";
			if ($mri_cnt != 0) {
				$mri = getResourceDetails($resource_name,$res_id);
				$mri_link = "";
				while ($mri_res = $mri->fetch_assoc()) {
						$resource_name_low = strtolower($resource_name);
						$mri_search_variable = "movie_". $resource_name_low;
						$mri_id_variable = "movie_". $resource_name_low . "_id";
						if ($resource_name_low == "actor" || $resource_name_low == "director" || $resource_name_low == "writer") {
						$mri_search_variable = $mri_search_variable . "_full_name";
						}

						$mri_id = $mri_res[$mri_id_variable];
						$mri_name = $mri_res[$mri_search_variable];
						if ($resource_name == "Type") {$mri_name = ucfirst($mri_name);};
						$mri_link .= "<a href='resource.php?resource=".$resource_name_low."&resource_id=$mri_id' class='btn btn-info'>$mri_name</a> ";
					}
					$mri_link = rtrim($mri_link,', ');
					echo "<div class='row'>";
					echo "<div class='col-xs-6'>";
					echo $mri_link."<br>";
					echo "</div>";
					echo "<div class='col-xs-6'>";
					echo "&nbsp;";
					echo "</div>";
					echo "</div>";
			} else {
				echo "No $resource_name found.";
			}



		}
	} //end check not empty movie id

	include('footer.php');
?>
