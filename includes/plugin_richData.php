<?php
// Get richdata from database
$getRichdata = mysqli_query($res1 ,"SELECT * FROM settings_richdata");
$resRichdata = mysqli_fetch_assoc($getRichdata);

// If active is enabled, otherwise do nothing
if($resRichdata['active']){
	// Get all social media profiles
	$sameAs = '';
	$socialMediaArray = array();
	if(!empty($resRichdata['sameAs_facebook']))
		$socialMediaArray[] = $resRichdata['sameAs_facebook'];
	if(!empty($resRichdata['sameAs_twitter']))
		$socialMediaArray[] = $resRichdata['sameAs_twitter'];
	if(!empty($resRichdata['sameAs_google']))
		$socialMediaArray[] = $resRichdata['sameAs_google'];
	
	
	// Create address part if all adress fields are set.
	$address = '';
	if(!empty($resRichdata['streetAddress']) && !empty($resRichdata['addressLocality']) && !empty($resRichdata['postalCode']) && !empty($resRichdata['addressCountry'])){
		$address = 
		'"address": {
				"@type": "PostalAddress",
				"streetAddress": "'.$resRichdata['streetAddress'].'",
				"addressLocality": "'.$resRichdata['addressLocality'].'",
				"postalCode": "'.$resRichdata['postalCode'].'",
				"addressCountry": "'.$resRichdata['addressCountry'].'"
		},';
	}
	
	// Enter socialmedia profiles in sameAs string. Do not give the last one a ','
	if(!empty($socialMediaArray)){
		
		$total = count($socialMediaArray);
		$sameAsString = '';
		$x = 1;
		foreach($socialMediaArray as $socialMedia){
			
			if($x == $total){
				$sameAsString .= '"'.$socialMedia.'"';
			}else{
				$sameAsString .= '"'.$socialMedia.'",
				';
			}
			$x++;
		}
		
		$sameAs = 
		'"sameAs" : [
				'.$sameAsString.'
		]';
	}
	
	// Return the actual data
	echo '
		<script type="application/ld+json">
		{
			"@context": "https://schema.org",
			"@type": "Organization",
			"url": "'.SITEURL.'",
			"logo": "'.LOGO.'",
			'.$address.'
			"contactPoint" : [{
				"@type" : "ContactPoint",
				'.(!empty($resRichdata['addressCountry']) ? '"telephone" : "'.$resRichdata['addressCountry'].'",' : '').'
				"email" : "'.SITEMAIL.'",
				'.(!empty($resRichdata['contacturl']) ? '"url" : "'.$resRichdata['contacturl'].'",' : '').'
				"contactType" : "customer service"
			}],
			'.$sameAs.'
		}
		</script>

		<script type="application/ld+json">
		{
			"@context" : "https://schema.org",
			"@type" : "WebSite",
			"name" : "'.SITENAAM.'",
			'.(!empty($resRichdata['alternateName']) ? '"alternateName" : "'.$resRichdata['alternateName'].'",' : '').'
			"url" : "'.SITEURL.'"
		}
		</script>
	';
}
