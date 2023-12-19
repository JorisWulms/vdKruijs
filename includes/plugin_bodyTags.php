<?php
$getBodyTags = mysqli_query($res1 ,"SELECT additionalTagBody
								FROM settings_general 
								WHERE id = 1");
// HEADER TAGS LIKE VERIFICATION STUFF							
if (mysqli_num_rows($getBodyTags)){
	$resBodyTags = mysqli_fetch_assoc($getBodyTags);
	echo $resBodyTags['additionalTagBody'];
}