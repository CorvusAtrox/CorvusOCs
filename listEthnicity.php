<html>
<title>Ball List</title>
<style>
body {
    background-color: #00FF00;
}

.shug { display:block;text-align:center;width:50%;margin-right:200px;}
.split-para      { display:block;margin:10px;}
.split-para span { display:block;float:right;width:50%;margin-left:10px;}
</style>
<?php

error_reporting(E_ALL & ~E_NOTICE & ~E_WARNING);

$off = $_COOKIE['off'];
$jin = file_get_contents("ocdata.json") or die("Unable to open file!");
$data = json_decode($jin, true);

$el = count($data);

$nar = [];

for ($j = 0; $j < $el; $j++){
	if(array_key_exists('Ethnicity', $data[$j])){
		$nar = array_merge($nar,$data[$j]['Ethnicity']);
	}
}

sort($nar);

$ct = array_count_values($nar);

foreach ($ct as $key => $value) {
	echo "<p style='color:black'>$key: </p>";
	for ($j = 0; $j < $el; $j++){
		if(in_array($key, $data[$j]['Ethnicity'])){
			echo "<br>".$data[$j]['Name'];
			if(array_key_exists('Orientation', $data[$j])){
				echo ": ".implode(" ",$data[$j]['Orientation']);
			}
		}
}
}

?>
</html>