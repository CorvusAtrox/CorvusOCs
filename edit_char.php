<html>
<body>
<?php 

	$off = $_COOKIE['off'];
	$jin = file_get_contents("ocdata.json") or die("Unable to open file!");
	$data = json_decode($jin, true);

	$_POST = array_filter($_POST);
	if($_POST['charname']){
		$data[$off]['Name'] = $_POST['charname'];	
	}
	if($_POST['gender']){
		$data[$off]['Gender'] = $_POST['gender'];	
	}
	if($_POST['species']){
		$data[$off]['Species'] = $_POST['species'];	
	}
	if($_POST["types"]){
		$data[$off]['Types'] = array_filter($_POST["types"]);
		if(empty($data[$off]['Types'][0])){
			unset($data[$off]['Types']);
		}
	}
	if($_POST["ori"]){
		$data[$off]['Orientation'] = array_filter($_POST["ori"]);
		if(empty($data[$off]['Orientation'][0])){
			unset($data[$off]['Orientation']);
		}
	}
	if($_POST["eth"]){
		$data[$off]['Ethnicity'] = array_filter($_POST["eth"]);
		if(empty($data[$off]['Ethnicity'][0])){
			unset($data[$off]['Ethnicity']);
		}
	}
	if($_POST['region']){
		$data[$off]['Region'] = $_POST['region'];	
	}
	if($_POST['pri']){
		$data[$off]['Priority'] = $_POST['pri'];	
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
?>

</body>
</html>