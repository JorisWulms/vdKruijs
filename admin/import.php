<?php
$getXmlFeed = mysqli_query($res1,"SELECT xmlFeed FROM settings_general");
$resXmlFeed = mysqli_fetch_assoc($getXmlFeed);

$xml=simplexml_load_file($resXmlFeed['xmlFeed']) or die("Error: Cannot create object");
mysqli_query($res1 ,"TRUNCATE TABLE import_products");
foreach($xml->children() as $products) {
	/*foreach($products as $key => $value){
		echo $key.'->'.$value.'<br>';
		foreach ($value->children() as $subkey => $subvalue) {
			echo '-->'.$subvalue.'<br>';
		}
		
	}*/
	mysqli_query($res1 ,"INSERT INTO import_products (product_name,product_price,product_url,product_img,product_desc,product_property)
	VALUES ('".$products->name."','".$products->price."','".$products->URL."','".$products->images->image."','".$products->description."','".$products->properties->property."')");
}