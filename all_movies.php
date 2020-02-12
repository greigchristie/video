<?php
include('pre_header.php');
echo "<title>all_movies.php</title>";
include('header.php');
include('db_movie.php');

$result = getAllMovies();

while ($row = $result->fetch_assoc()) {
	$movie_title= $row['movie_title'];
	$movie_id= $row['movie_id'];
	echo "<div class='row'>";
	echo "<p><a href='movie.php?movie=$movie_id'>$movie_title</a></p>";
	echo "</div>";
}
include('footer.php');
?>