<?php
$getLanguages = mysqli_query($res1,"SELECT *
									FROM text_languages
									WHERE visible = 1");
									
while($resLanguages = mysqli_fetch_assoc($getLanguages)){
	echo '<a href="index.php?lang='.$resLanguages['id'].'">'.$resLanguages['text_language'].'</a>';
}