<?php
// pagination function

	function pagination($current_page, $total_pages, $per_page) {
	if ($current_page < 1) { $current_page = 1; }
	$self = $_SERVER['PHP_SELF'];
	$context = str_replace('/sites/video/', '', $self); //linux
	$prev_page = $current_page - 1;
	$next_page = $current_page + 1;
	$prev_ten = $current_page - 10;
	$next_ten = $current_page + 10;
	if ($current_page <= 1) { $prev_page = 1;}
	if ($current_page <= 10) { $prev_ten = 1;}
	if ($current_page >= $total_pages) { $next_page = $total_pages;}
	if ($current_page >= ($total_pages - 10)) { $next_ten = $total_pages;}


	$pagination = "<div class='pagination'>";
	$pagination .= "<span class='paginate_item'><a href='$context?page=1'><i class='fa fa-fast-backward'></i> </a></span>";
	$pagination .= "<span class='paginate_item'><a href='$context?page=$prev_ten'><i class='fa fa-backward'></i> </a></span>";
	$pagination .= "<span class='paginate_item'><a href='$context?page=$prev_page'><i class='fa fa-step-backward'></i> </a></span>";
	$pagination .= "<span class='pagination_active'> $current_page </span></span>";
	$pagination .= "<span class='paginate_item'><a href='$context?page=$next_page'><i class='fa fa-step-forward'></i> </a></span>";
	$pagination .= "<span class='paginate_item'><a href='$context?page=$next_ten'><i class='fa fa-forward'></i> </a></span>";
	$pagination .= "<span class='paginate_item'><a href='$context?page=$total_pages'><i class='fa fa-fast-forward'></i> </a></span>";
	$pagination .= "</div>";

	return $pagination;
	}
?>
