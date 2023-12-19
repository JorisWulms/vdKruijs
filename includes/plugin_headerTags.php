<?php
$getHeaderTags = mysqli_query($res1 ,"SELECT additionalTagHeader
								FROM settings_general 
								WHERE id = 1");
// HEADER TAGS LIKE VERIFICATION STUFF							
if (mysqli_num_rows($getHeaderTags)){
	$resHeaderTags = mysqli_fetch_assoc($getHeaderTags);
	echo $resHeaderTags['additionalTagHeader'];
}