<?php
include('pre_header.php');
echo "<title>Everything - most recent series</title>";
include('header.php');
include('db_movie.php');

// Resource type type has id 8 and series has id 2. hardcoded for now can use calls based on text values if needed.
$result = getAllMoviesForResourceTypeSortIdDesc(8,2);

while ($row = $result->fetch_assoc()) {
	$movie_title= $row['movie_title'];
	$movie_id= $row['movie_id'];
	echo "<div class='row'>";
	echo "<p><a href='movie.php?movie=$movie_id'>$movie_title</a></p>";
	echo "</div>";
}
include('footer.php');
?>
