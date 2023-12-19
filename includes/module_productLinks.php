<?php
$go = $array[2];

$res = mysqli_query($res1 ,"SELECT * FROM shops");

while($row = mysqli_fetch_assoc($res)){
	if ($row['BID']==$go){
		mysqli_query($res1 ,"UPDATE shops SET kliks = kliks + 1 WHERE BID='".$row['BID']."'");
		header('Location:'.$row['affiliatelink']);
		exit();
	}
}

?>