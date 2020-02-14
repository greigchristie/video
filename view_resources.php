<?php
include('db_movie.php');
include('pre_header.php');
echo "<title>All Resource Types</title>";
include('header.php');

//get list of doResources
$result = getResourceList();

while ($row = $result->fetch_assoc()) {
  $resource_id = $row['movie_resources_id'];
  $resource_name = $row['movie_resource_type'];
  $resource_name_low = strtolower($resource_name);
  echo "<div class='row'>";
    echo "<div class='col-xs-1'>";
    echo "$resource_name";
    echo "</div>";
    echo "<div class='col-xs-1'>";
    echo "<a href = 'view_resource.php?resource=$resource_name_low' class='btn btn-info'>View</a>";
    echo "</div>";
    echo "<div class='col-xs-10'>";
    echo "&nbsp;";
    echo "</div>";
  echo "</div>\n";
  echo "<div class='row'>&nbsp;</div>";
}

include('footer.php');
?>
