<?php
	$getPhotos = mysqli_query($res1, "SELECT * FROM galerij");
	
	while($resPhotos = mysqli_fetch_assoc($getPhotos)){
		echo '<a class="thumb" style="background:url(images/gallery/'.urldecode($resPhotos['url']).') center center no-repeat;" data-lightbox="portfolio" href="images/gallery/'.urldecode($resPhotos['url']).'"></a>';
	}