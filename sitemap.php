<?php
	if ($_SERVER['REQUEST_URI']!="/sitemap.xml"){
		header('Location: /sitemap.xml');
	}
	
	$absolute_path = getcwd();

	require $absolute_path . '/includes/phpInputFilter/class.inputfilter.php';
	require $absolute_path . '/includes/phpmailer/class.phpmailer.php';
	require $absolute_path . '/includes/prefs.php';
	require $absolute_path . '/includes/session.inc.php';
	require $absolute_path . '/includes/function.php';
	require $absolute_path . '/includes/database.php';
	require $absolute_path . '/includes/settings.php';


    // PHP google_sitemap Generator

    require_once( "google_sitemap.class.php" );

    // these day may be retrieved from DB

	$res = mysqli_query($res1,"SELECT * FROM sitetree LEFT OUTER JOIN sitetree_language ON sitetree_language.id=sitetree.id WHERE sitetree.parent=0 AND visible=1 AND sitetree_language.language_id=2");

	while ($row = mysqli_fetch_object($res)) {
		if ($row->rewrite=="index"){
			$cats[] = array(
								"loc" => SITEURL,
								"changefreq" => "weekly",
								"freq" => "0.8",
							);

		}else{
			global $res1;
			$cats[] = array(
                        "loc" => SITEURL.$row->rewrite.".html",
                        "changefreq" => "weekly",
                        "freq" => "0.8",
                    );
				
			$dbc = mysqli_query($res1,"SELECT * FROM sitetree LEFT OUTER JOIN sitetree_language ON sitetree_language.id=sitetree.id WHERE sitetree.parent=".$row->id." AND sitetree_language.language_id=2 AND visible=1");
			$count = mysqli_num_rows($dbc);
			if ($count!=0){
				while ($subrow = mysqli_fetch_object($dbc)) {
					$cats[] = array(
								"loc" => SITEURL.$subrow->rewrite.".html",
								"changefreq" => "weekly",
								"freq" => "0.8",
							);

				}
			}	
		}
	}
	
	$blogcats = mysqli_query($res1,"SELECT * FROM blog_cat_language ORDER BY naam") or die(mysqli_error());

	while ($row = mysqli_fetch_object($blogcats)) {
		$cats[] = array(
                        "loc" => SITEURL.BLOG_PATH."/".$row->rewrite.".html",
                        "changefreq" => "weekly",
                        "freq" => "0.8",
                    );
	}
	
	$blogs = mysqli_query($res1,"SELECT * FROM blogs_language ORDER BY naam") or die(mysqli_error());

	while ($row = mysqli_fetch_object($blogs)) {
		$cats[] = array(
                        "loc" => SITEURL.BLOG_PATH."/".$row->rewrite.".html",
                        "changefreq" => "weekly",
                        "freq" => "0.8",
                    );
	}
	
	$linksyscats = mysqli_query($res1,"SELECT * FROM linksys_cat ORDER BY title") or die(mysqli_error());

	while ($row = mysqli_fetch_object($linksyscats)) {
		$cats[] = array(
                        "loc" => SITEURL.LINKSYS_PATH."/".$row->rewrite.".html",
                        "changefreq" => "weekly",
                        "freq" => "0.8",
                    );
	}	
	
	$linksyslinks = mysqli_query($res1,"SELECT * FROM linksys_link ORDER BY title") or die(mysqli_error());

	while ($row = mysqli_fetch_object($linksyslinks)) {
		$cats[] = array(
                        "loc" => SITEURL.LINKSYS_PATH."/".$row->rewrite.".html",
                        "changefreq" => "weekly",
                        "freq" => "0.8",
                    );
	}	
	
   $site_map_container = new google_sitemap();

    for ( $i=0; $i < count( $cats ); $i++ )
    {
        $value = $cats[ $i ];

        $site_map_item = new google_sitemap_item( $value[ 'loc' ], "", $value[ 'changefreq' ], $value[ 'freq' ] );

        $site_map_container->add_item( $site_map_item );
    }

    header( "Content-type: application/xml; charset=\"".$site_map_container->charset . "\"", true );
    header( 'Pragma: no-cache' );

    print $site_map_container->build();
?>