<?php
require_once ('prefs.php');
require_once (DIR_SYSTEM . 'includes/database.php');
require_once (DIR_SYSTEM . 'includes/settings.php');
require_once (DIR_SYSTEM . 'includes/function.php');

$item_per_page  = 9; //item to display per page
$catID 			= $_POST["category"];

//Get page number from Ajax
if(isset($_POST["page"])){
    $page_number = filter_var($_POST["page"], FILTER_SANITIZE_NUMBER_INT, FILTER_FLAG_STRIP_HIGH); //filter number
    if(!is_numeric($page_number)){die('Invalid page number!');} //incase of invalid page number
}else{
    $page_number = 1; //if there's no page number, set it to 1
}

//get total number of records from database
$getTotalBlogs = mysqli_query($res1,"SELECT * FROM import_products");
$totalBlogs = mysqli_num_rows($getTotalBlogs); //hold total records in variable

//break records into pages
$total_pages = ceil($totalBlogs/$item_per_page);

//position of records
$page_position = (($page_number-1) * $item_per_page);
// To generate links, we call the pagination function here.
echo paginate_function($item_per_page, $page_number, $totalBlogs, $total_pages);
//Limit our results within a specified range.
$getBlogs = mysqli_query($res1,"SELECT * FROM import_products 
								LIMIT $page_position, $item_per_page");
								
//Display records fetched from database.
while($resBlogs = mysqli_fetch_assoc($getBlogs)){ //fetch values
	echo '<a class="productBlock" href="'.$resBlogs['product_url'].'" target="_blank" rel="nofollow">';
		echo '<span class="productTitle">'.$resBlogs['product_name'].'</span>';
		echo '<span class="productImageContainer"><img src="'.$resBlogs['product_img'].'" /></span>';
		echo '<span class="productPrice">&euro; '.$resBlogs['product_price'].'</span>';
	echo '</a>';
}

// To generate links, we call the pagination function here.
echo paginate_function($item_per_page, $page_number, $totalBlogs, $total_pages);

					
