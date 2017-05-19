<html>
<title>Random</title>
<style>
body {
    background-color: #00FF00;
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

$strt = false;
$mn = 0;
$mx = ($el - 1);

$html = file_get_contents('https://www.random.org/integers/?num=1&min='. $mn .'&max='. $mx .'&col=1&base=10&format=plain&rnd=new');

$shug = (int)$html;

echo $shug;

if($shug > 0){

	setCookie("off",$shug);
	setCookie("firs",$_POST['from']);
	setCookie("las",$_POST['to']);

	header('Location: index.php');
	die();
}
?>
</html>