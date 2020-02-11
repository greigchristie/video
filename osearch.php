<?php

/**
██ ███    ██  ██████ ██      ██    ██ ██████  ███████ ███████
██ ████   ██ ██      ██      ██    ██ ██   ██ ██      ██
██ ██ ██  ██ ██      ██      ██    ██ ██   ██ █████   ███████
██ ██  ██ ██ ██      ██      ██    ██ ██   ██ ██           ██
██ ██   ████  ██████ ███████  ██████  ██████  ███████ ███████
*/



include('db_movie.php');

/**
██    ██  █████  ██████  ██  █████  ██████  ██      ███████ ███████
██    ██ ██   ██ ██   ██ ██ ██   ██ ██   ██ ██      ██      ██
██    ██ ███████ ██████  ██ ███████ ██████  ██      █████   ███████
 ██  ██  ██   ██ ██   ██ ██ ██   ██ ██   ██ ██      ██           ██
  ████   ██   ██ ██   ██ ██ ██   ██ ██████  ███████ ███████ ███████
*/



$searchterm = "";
$get_title = "";
$get_year = "";
$get_type = "";
$get_imdb = "";
$append = "false";

if (isset($_POST['title'])) {
	$get_title = $_POST['title'];
	$get_title = str_replace(' ', '+', $get_title);
	if ($get_title != "") {
	$searchterm .= "t=$get_title";
	$append = "true";
	}
}
if (isset($_POST['year'])) {
	$get_year = $_POST['year'];
	if ($get_year != "") {
		if ($append == "true") {
		$searchterm .= "&";
		}
	$searchterm .= "y=$get_year";
	$append = "true";
	}
}
if (isset($_POST['type'])) {
	$get_type = $_POST['type'];
	if ($get_type != "") {
		if ($append == "true") {
		$searchterm .= "&";
		}
	$searchterm .= "type=$get_type";
	$append = "true";
	}
}
if (isset($_POST['imdb'])) {
	$get_imdb = $_POST['imdb_id'];
	if ($get_imdb != "") {
		if ($append == "true") {
		$searchterm .= "&";
		}
	$searchterm .= "i=$get_imdb";
	$append = "true";
	}
}

// echo "<p>$searchterm</p>";

$omdbjson = curlThis($searchterm);

$results = json_decode($omdbjson);

if (isset($results->Title)) {



//print_r($results);

$title = $results->Title;
$sort_title = $title;
	if (preg_match('/^The (.*)/', $title, $mat)) {
		// print_r($mat);
		if (isset($mat[1])) {
		$sort_title = $mat[1]. ", The";
		}
	}
$year = $results->Year;
	if (strpos($year,'–')) {
//	if (preg_match("/–/",$year)){
		$year_split = explode( '–',$year);
//		print_r($year_split);
		$year = $year_split[0];
	}
$rating = $results->Rated;
$released = $results->Released;
	$released = date("Y-m-d", strtotime($released));
$runtime = $results->Runtime;
	$runtime = str_replace(' min','',$runtime);
$genre = $results->Genre;
$director = $results->Director;
$writer = $results->Writer;
$actors = $results->Actors;
$plot = $results->Plot;
$language = $results->Language;
$country = $results->Country;
$imdb_score = $results->imdbRating;
	$imdb_score = round($imdb_score);
$imdb_id = $results->imdbID;
$type = $results->Type;


/**
██   ██ ████████ ███    ███ ██
██   ██    ██    ████  ████ ██
███████    ██    ██ ████ ██ ██
██   ██    ██    ██  ██  ██ ██
██   ██    ██    ██      ██ ███████
*/



include('pre_header.php');
echo "<title>Add $type - $title ($year)</title>";
include('header.php');


echo "<form action='add_movie.php' method='post'>\n";
echo "<div class='row'>\n";
echo "<div class='col-xs-1'><label>Title </label></div>\n";
echo "<div class='col-xs-3'><input type='text' id='title' name='title' value=\"$title\" size='70'></input><input type='hidden' name='sort_title' value=\"$sort_title\"></div>\n";
echo "<div class='col-xs-8'></div>\n";
echo "</div>\n";
echo "<div class='row'>\n";
echo "<div class='col-xs-1'><label>Year </label></div>\n";
echo "<div class='col-xs-3'><input type='text' id='year' name='year' value='$year'></input></div>\n";
echo "<div class='col-xs-8'></div>\n";
echo "</div>\n";
echo "<div class='row'>\n";
echo "<div class='col-xs-1'><label>Rating </label></div>\n";
echo "<div class='col-xs-3'><input type='text' id='rating' name='rating' value='$rating'></input></div>\n";
echo "<div class='col-xs-8'></div>\n";
echo "</div>\n";
echo "<div class='row'>\n";
echo "<div class='col-xs-1'><label>Released </label></div>\n";
echo "<div class='col-xs-3'><input type='text' id='released' name='released' value='$released'></input></div>\n";
echo "<div class='col-xs-8'></div>\n";
echo "</div>\n";
echo "<div class='row'>\n";
echo "<div class='col-xs-1'><label>Runtime </label></div>\n";
echo "<div class='col-xs-3'><input type='text' id='runtime' name='runtime' value='$runtime'></input></div>\n";
echo "<div class='col-xs-8'></div>\n";
echo "</div>\n";
echo "<div class='row'>\n";
echo "<div class='col-xs-1'><label>Genre </label></div>\n";
echo "<div class='col-xs-3'><input type='text' id='genre' name='genre' value='$genre' size='70'></input></div>\n";
echo "<div class='col-xs-8'></div>\n";
echo "</div>\n";
echo "<div class='row'>\n";
echo "<div class='col-xs-1'><label>Director(s) </label></div>\n";
echo "<div class='col-xs-3'><input type='text' id='director' name='director' value='$director' size='70'></input></div>\n";
echo "<div class='col-xs-8'></div>\n";
echo "</div>\n";
echo "<div class='row'>\n";
echo "<div class='col-xs-1'><label>Writer </label></div>\n";
echo "<div class='col-xs-3'><input type='text' id='writer' name='writer' value=\"$writer\" size='70'></input></div>\n";
echo "<div class='col-xs-8'></div>\n";
echo "</div>\n";
echo "<div class='row'>\n";
echo "<div class='col-xs-1'><label>Actors </label></div>\n";
echo "<div class='col-xs-3'><input type='text' id='actors' name='actors' value=\"$actors\" size='70'></input></div>\n";
echo "<div class='col-xs-8'></div>\n";
echo "</div>\n";
echo "<div class='row'>\n";
echo "<div class='col-xs-1'><label>Plot </label></div>\n";
echo "<div class='col-xs-6'><textarea rows='8' cols='80' type='text' id='plot' name='plot'>$plot</textarea></div>\n";
echo "<div class='col-xs-5'></div>\n";
echo "</div>\n";
echo "<div class='row'>\n";
echo "<div class='col-xs-1'><label>Language </label></div>\n";
echo "<div class='col-xs-3'><input type='text' id='language' name='language' value='$language' size='70'></input></div>\n";
echo "<div class='col-xs-8'></div>\n";
echo "</div>\n";
echo "<div class='row'>\n";
echo "<div class='col-xs-1'><label>Country </label></div>\n";
echo "<div class='col-xs-3'><input type='text' id='country' name='country' value='$country'></input></div>\n";
echo "<div class='col-xs-8'></div>\n";
echo "</div>\n";
echo "<div class='row'>\n";
echo "<div class='col-xs-1'><label>I_Score </label></div>\n";
echo "<div class='col-xs-3'><input type='text' id='imdb_score' name='imdb_score' value='$imdb_score'></input></div>\n";
echo "<div class='col-xs-8'></div>\n";
echo "</div>\n";
echo "<div class='row'>\n";
echo "<div class='col-xs-1'><label>IMDB ID </label></div>\n";
echo "<div class='col-xs-3'><input type='text' id='imdb_id' name='imdb_id' value='$imdb_id'></input></div>\n";
echo "<div class='col-xs-8'></div>\n";
echo "</div>\n";
echo "<div class='row'>\n";
echo "<div class='col-xs-1'><label>Type </label></div>\n";
echo "<div class='col-xs-3'><input type='text' id='type' name='type' value='$type'></input></div>\n";
echo "<div class='col-xs-8'></div>\n";
echo "</div>\n";
echo "<div class='row'>\n";
echo "<div class='col-xs-1'><label>Region </label></div>\n";
echo "<div class='col-xs-3 form-check form-check-inline'>";
echo "<fieldset>\n";
$format_result = getAllResourceValuesByName('region');
echo buildResourceCheckBoxGroup('region',$format_result);
echo "</fieldset>\n";
echo "</div>\n";
echo "<div class='col-xs-8'></div>\n";
echo "</div>\n";
echo "<div class='row'>\n";
echo "<div class='col-xs-1'><label>Format </label></div>\n";
echo "<div class='col-xs-3 form-check'>";
echo "<fieldset>\n";
$format_result = getAllResourceValuesByName('format');
//echo buildResourceDropDown('format',$format_result);
//echo buildResourceRadioGroup('format',$format_result);
echo buildResourceCheckBoxGroup('format',$format_result);
echo "</fieldset>\n";
echo "</div>\n";
echo "<div class='col-xs-8'></div>\n";
echo "</div>\n";
echo "<div class='row'>\n";
echo "<div class='col-xs-1'><label>Shelfmark </label></div>\n";
echo "<div class='col-xs-3'><input type='text' id='shelfmark' name='shelfmark'></input></div>\n";
echo "<div class='col-xs-8'></div>\n";
echo "</div>\n";
if ($type == "series") {
echo "<div class='row'>\n";
echo "<div class='col-xs-1'><label>No. Seasons </label></div>\n";
echo "<div class='col-xs-3'><input type='text' id='season' name='season'></input></div>\n";
echo "<div class='col-xs-8'></div>\n";
echo "</div>\n";
echo "<div class='row'>\n";
echo "<div class='col-xs-1'><label>Episodes </label></div>\n";
echo "<div class='col-xs-6'><textarea rows='7' cols='70' id='episode' name='episode'></textarea></div>\n";
echo "<div class='col-xs-5'></div>\n";
echo "</div>\n";
}
echo "<div class='row'>\n";
echo "<div class='col-xs-1'><label>Notes </label></div>\n";
echo "<div class='col-xs-6'><textarea rows='7' cols='70' id='notes' name='notes'></textarea></div>\n";
echo "<div class='col-xs-5'></div>\n";
echo "</div>\n";
echo "<div class='row'>\n";
echo "<div class='col-xs-1'><label>Status </label></div>\n";
echo "<div class='col-xs-3 form-check'>";
echo "<fieldset>\n";
$status_result = getAllResourceValuesByName('status');
//echo buildResourceDropDown('format',$format_result);
echo buildResourceRadioGroup('status',$status_result);
// echo buildResourceCheckBoxGroup('format',$format_result);
echo "</fieldset>\n";
echo "</div>\n";
echo "<div class='row'>";
echo "</div>";
echo "<div class='row'>\n";
echo "<div class='col-xs-1'></div>\n";
echo "<div class='col-xs-3'><input type='submit' id='submit' name='Submit' value='Add $type'></input></div>\n";
echo "<div class='col-xs-8'></div>\n";
echo "</div>\n";


echo "</div>\n";
echo "</form>\n";
}
else {
echo "<h2>Movie not found</h2>";
}
?>

<?php

/**
███████ ██    ██ ███    ██  ██████ ████████ ██  ██████  ███    ██ ███████
██      ██    ██ ████   ██ ██         ██    ██ ██    ██ ████   ██ ██
█████   ██    ██ ██ ██  ██ ██         ██    ██ ██    ██ ██ ██  ██ ███████
██      ██    ██ ██  ██ ██ ██         ██    ██ ██    ██ ██  ██ ██      ██
██       ██████  ██   ████  ██████    ██    ██  ██████  ██   ████ ███████
*/

$apikey = getenv('OMDB_TOKEN');

function curlThis($searchterm) {
$url = "http://www.omdbapi.com/?$searchterm&plot=full&apikey=$apikey";

      // echo "service url<pre>";
       // echo $url."<br />";
      // echo "</pre>";
//  Initiate curl
$ch = curl_init();
// Disable SSL verification
curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
// Will return the response, if false it print the response
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
//curl_setopt($ch, CURLOPT_USERAGENT, 'everythingMusic/2.0 +http://every-thing.co.uk');
// Set the url
curl_setopt($ch, CURLOPT_URL,$url);
// Execute
$result=curl_exec($ch);

// Closing
curl_close($ch);
//var_dump($result);
return $result;
}

function buildResourceDropDown($resource_type,$resource_type_result) {
	$dropDown = "<select name='$resource_type'>\n";
	$table_variable = "movie_" . $resource_type;
	$search_variable = $table_variable;
	if ($resource_type == "actor" || $resource_type == "director" || $resource_type == "writer") {
		$search_variable = $table_variable . "_full_name";
	}
	while ($row = $resource_type_result->fetch_assoc())
		{
			$resource_id = $row['id'];
			$resource_name = $row[$search_variable];

			$dropDown .= "<option value='$resource_id'>$resource_name</option>\n";
		}
		$dropDown .=  "</select>\n";

		return $dropDown;
}

function buildResourceCheckBoxGroup ($resource_type,$resource_type_result) {
	$checkbox = "";
	$id_variable = "movie_" . $resource_type . "_id";
	$search_variable = "movie_" . $resource_type;

	if ($resource_type == "actor" || $resource_type == "director" || $resource_type == "writer") {
		$search_variable = $search_variable . "_full_name";
		}
	while ($row = $resource_type_result->fetch_assoc())
		{
			$resource_id = $row[$id_variable];
			$resource_name = $row[$search_variable];
			$checkbox .= "<label for='$resource_name' class='form-check-label'>$resource_name</label>\n";
			$checkbox .= "<input type='checkbox' id='$resource_type' name='".$resource_type."[]' value='$resource_id' class='form-check-input'> \n";

		}

	return $checkbox;
}

function buildResourceRadioGroup ($resource_type,$resource_type_result) {
	$radio = "";
	$id_variable = "movie_" . $resource_type . "_id";
	$search_variable = "movie_" . $resource_type;

	if ($resource_type == "actor" || $resource_type == "director" || $resource_type == "writer") {
		$search_variable = $search_variable . "_full_name";
		}
	while ($row = $resource_type_result->fetch_assoc())
		{
			$resource_id = $row[$id_variable];
			$resource_name = $row[$search_variable];
			$radio .= "<label for='$resource_name' class='form-check-label'>$resource_name</label>\n";
			$radio .= "<input type='radio' id='$resource_type' name='".$resource_type."' value='$resource_id' class='form-check-input'> \n";

		}

	return $radio;
}
?>
