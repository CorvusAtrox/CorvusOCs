<html>
<title>Type List</title>
<style>
body {
    background-color: #9EDA71;
}

.shug { display:block;text-align:center;width:50%;margin-right:200px;}
.split-para      { display:block;margin:10px;}
.split-para span { display:block;float:right;width:50%;margin-left:10px;}
</style>
<?php

$off = $_COOKIE['off'];
$jin = file_get_contents("ocdata.json") or die("Unable to open file!");
$data = json_decode($jin, true);

$el = count($data);

$nar = [];

for ($j = 0; $j < $el; $j++){
	if(array_key_exists('Types', $data[$j])){
		$nar = array_merge($nar,$data[$j]['Types']);
	}
}

sort($nar);

$ct = array_count_values($nar);

foreach ($ct as $key => $value) {
	echo "<p style='color:black'>$key: </p>";
	for ($j = 0; $j < $el; $j++){
		if(in_array($key, $data[$j]['Types'])){
			#if(array_key_exists('Gender', $data[$j])){
			#	echo "<br>".$data[$j]['Name'].": ".$data[$j]['Gender'];
			#}
			echo "<br>".$data[$j]['Name'];
			if(array_key_exists('Ethnicity', $data[$j])){
				echo ": ".implode(" ",$data[$j]['Ethnicity']);
			}
		}
}
}

?>
</html>