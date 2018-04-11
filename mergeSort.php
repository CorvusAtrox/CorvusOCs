<html>
<title>Hand Sort</title>
<style>
body {
    background-color: #9EDA71;
}

.shug { display:block;text-align:center;width:30%;margin-right:200px;}
.split-para      { display:block;margin:10px;}
.split-para span { display:block;float:right;width:75%;margin-left:10px;}
</style>
<?php


$off = $_COOKIE['off'];
$jin = file_get_contents("ocdata.json") or die("Unable to open file!");
$data = json_decode($jin, true);

$el = count($data);

$kanto = file("kanto.txt");
$tkan = array_map('trim',$kanto);

$left = $data[0];
$right = $data[1];
$lnum = array_search($left['Species'],$tkan) + 1;
$lnum = str_pad($lnum, 3, '0', STR_PAD_LEFT);
$rnum = array_search($right['Species'],$tkan) + 1;
$rnum = str_pad($rnum, 3, '0', STR_PAD_LEFT);

echo "<p class='split-para'>";
echo $left['Name'] . " <img src='icons/". $lnum .".png' border=0>";
echo "<span>";
echo $right['Name'] . " <img src='icons/". $rnum .".png' border=0>";
echo "</span></p>";
?>

<p class='split-para'><button id="left">Left</button> <span><button id="right">Right</button></p>

<p class="shug"><button id="update">Update</button></p>

<form action="index.php" method="post">
<p class="shug"><input type="submit" value="Back">
</form>

</html>