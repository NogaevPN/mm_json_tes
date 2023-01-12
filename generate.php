<?php

$ar = [];

for($i = 0; $i < 1000000; $i++) {
	$ar[] = [
		"offerId" => 1000 + $i,
		"productTitle" => "title$i",
		"vendorId" => mt_rand(1, 30),
		"price" => mt_rand(5, 200),
	];
}
file_put_contents("test.json", json_encode($ar));
