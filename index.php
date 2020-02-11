<?php

include('pre_header.php');
echo "<title>OMDB Search</title>";
include('header.php');

echo "<form action='osearch.php' method='post'>";
echo "<div class='row'>";
echo "<div class='col-xs-1'><label>Title </label></div>";
echo "<div class='col-xs-3'><input type='text' id='title' name='title' size='70'></input></div>";
echo "<div class='col-xs-8'></div>";
echo "</div>";
echo "<div class='row'>";
echo "<div class='col-xs-1'><label>Year </label></div>";
echo "<div class='col-xs-3'><input type='text' id='year' name='year' size='70'></input></div>";
echo "</div>";
echo "<div class='row'>";
echo "<div class='col-xs-1'><label>Type </label></div>";
echo "<div class='col-xs-3'><input type='text' id='type' name='type' size='70'></input></div>";
echo "<div class='col-xs-8'></div>";
echo "</div>";
echo "<div class='row'>";
echo "<div class='col-xs-1'><label>IMDB id </label></div>";
echo "<div class='col-xs-3'><input type='text' id='imdb_id' name='imdb_id' size='70'></input></div>";
echo "<div class='col-xs-8'></div>";
echo "</div>";
echo "<div class='row'>";
echo "<div class='col-xs-1'></div>";
echo "<div class='col-xs-3'><input type='submit' value='Search' /></div>";
echo "<div class='col-xs-8'></div>";
echo "</div>";
echo "</form>";

include('footer.php');

?>