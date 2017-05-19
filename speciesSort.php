<?php

$narum = [""];

$off = $_COOKIE['off'];
$jin = file_get_contents("ocdata.json") or die("Unable to open file!");
$data = json_decode($jin, true);

$dex = file("NatLine Dex.txt");
$tdex=array_map('trim',$dex);

$el = count($data);

for ($j = 0; $j < $el; $j++){
	$data[$j]['LNum'] = array_search($data[$j]['Species'],$tdex);
}

usort($data, 'mySort');

for ($j = 0; $j < $el; $j++){
	unset($data[$j]['LNum']);
}

$jen = json_encode($data);
		//echo $jen;
		
		$len = strlen($jen); 
		$new_json = "";
		for($c = 0; $c < $len; $c++) 
		{ 
			$char = $jen[$c];
			if($c+1 < $len){
				$nchar = $jen[$c+1];
			}
			switch($nchar) 
			{ 
				case '{': 
					$new_json .= $char . "\n";
					break; 
				default: 
					$new_json .= $char; 
					break;                    
			} 
		} 
		
		$myfile = fopen("ocdata.json.new", "w") or die("Unable to open file!");
		fwrite($myfile, $new_json);
		fclose($myfile);
		rename("ocdata.json.new","ocdata.json");
	
	header('Location: index.php');
	die();

	
function mySort($a, $b)
{
	$diff = (int)$a['LNum'] - (int)$b['LNum'];
	if($diff == 0){ 	
		return strcmp($a['Name'],$b['Name']); 
	} else {
		return $diff;
	}  
}
?>