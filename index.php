<!DOCTYPE html>
<html>
<title>OC Stuff</title>
<style>
body {
    background-color: #9EDA71;
}

.shug { display:block;text-align:center;width:50%;margin-right:200px;}
.split-para      { display:block;margin:10px;}
.split-para span { display:block;float:right;width:50%;margin-left:10px;}
</style>
<body>
<?php

error_reporting(E_ALL & ~E_NOTICE & ~E_WARNING);

$myfile = fopen("ocdata.json", "r") or die("Unable to open file!");
$jin = fread($myfile,filesize("ocdata.json"));
$poke = json_decode($jin, true);

$kanto = file("kanto.txt");
$tkan = array_map('trim',$kanto);

$namae = "";
$species = "";
$gender = "";
$types = ["",""];
$orientation = ["",""];
$region = "";
$pri = "";

$off = 0;

if(isset($_COOKIE["off"])){
	$off = $_COOKIE["off"];
} else {
	setCookie("off",$off);
}
	echo $off;

if(array_key_exists('Name', $poke[$off])){
	$namae = $poke[$off]['Name'];
}

if(array_key_exists('Gender', $poke[$off])){
	$gender = $poke[$off]['Gender'];
}

if(array_key_exists('Species', $poke[$off])){
	$species = $poke[$off]['Species'];
	$snum = array_search($poke[$off]['Species'],$tkan) + 1;
	$snum = str_pad($snum, 3, '0', STR_PAD_LEFT);
}

if(array_key_exists('Types', $poke[$off])){
	$mnum = sizeof($poke[$off]['Types']);
	for($m = 0; $m < $mnum; $m++){
		$types[$m] = $poke[$off]['Types'][$m];
	}
}

if(array_key_exists('Orientation', $poke[$off])){
	$mnum = sizeof($poke[$off]['Orientation']);
	for($m = 0; $m < $mnum; $m++){
		$ori[$m] = $poke[$off]['Orientation'][$m];
	}
}

if(array_key_exists('Ethnicity', $poke[$off])){
	$mnum = sizeof($poke[$off]['Ethnicity']);
	for($m = 0; $m < $mnum; $m++){
		$eth[$m] = $poke[$off]['Ethnicity'][$m];
	}
}

if(array_key_exists('Region', $poke[$off])){
	$region = $poke[$off]['Region'];
}

if(array_key_exists('Priority', $poke[$off])){
	$pri = $poke[$off]['Priority'];
}

?>


<form action="ran_mon.php" method="post">
<p class="shug"><input type="submit" value="Random"></p>
</form>
<p class="shug">
<input type="button" onClick="start()" value = "|<"/>
<input type="button" onClick="indDec(100)" value = "-100"/>
<input type="button" onClick="indDec(50)" value = "-50"/>
<input type="button" onClick="indDec(20)" value = "-20"/>
<input type="button" onClick="indDec(10)" value = "-10"/>
<input type="button" onClick="indDec(5)" value = "-5"/>
<input type="button" onClick="indDec(2)" value = "-2"/>
<input type="button" onClick="indDec(1)" value = "-1"/>
<br>
<input type="button" onClick="indInc(1)" value = "1"/>
<input type="button" onClick="indInc(2)" value = "2"/>
<input type="button" onClick="indInc(5)" value = "5"/>
<input type="button" onClick="indInc(10)" value = "10"/>
<input type="button" onClick="indInc(20)" value = "20"/>
<input type="button" onClick="indInc(50)" value = "50"/>
<input type="button" onClick="indInc(100)" value = "100"/>
<input type="button" onClick="addEntry()" value = ">|"/>
</p>

<form action="edit_char.php" method="post">
<h4><span>
Name: <input type="text" id="charname" name="charname" style="border:0px;background-color:#9EDA71;" size="17" onchange="turnText('charname')" value="<?= $namae ?>" />
<?php
	if($snum != 0){
		if(!file_exists('icons/'. $snum .'.png')){
			file_put_contents('icons/'. $snum .'.png', file_get_contents('http://www.greenchu.de/sprites/icons/'. $snum .'.png'));
		}
		echo "<img src='icons/". $snum .".png' border=0>";
	}
?>
Mon Species: <input type="text" id="species" name="species" style="border:0px;background-color:#9EDA71;" size="12" onchange="turnText('species')" value="<?= $species ?>" />
Gender: <input type="text" id="gender" name="gender" style="border:0px;background-color:#9EDA71;" size="10" onchange="turnText('gender')" value="<?= $gender ?>" />
Type: 
<input type="text" id="type1" name="types[]" style="border:0px;background-color:#9EDA71;" size="10" onchange="turnText('type1')" value="<?= $types[0] ?>" />
<input type="text" id="type2" name="types[]" style="border:0px;background-color:#9EDA71;" size="10" onchange="turnText('type2')" value="<?= $types[1] ?>" />
<br>
Orientation: 
<input type="text" id="ori1" name="ori[]" style="border:0px;background-color:#9EDA71;" size="10" onchange="turnText('ori1')" value="<?= $ori[0] ?>" />
<input type="text" id="ori2" name="ori[]" style="border:0px;background-color:#9EDA71;" size="10" onchange="turnText('ori2')" value="<?= $ori[1] ?>" />
Ethnicity: 
<input type="text" id="eth1" name="eth[]" style="border:0px;background-color:#9EDA71;" size="10" onchange="turnText('eth1')" value="<?= $eth[0] ?>" />
<input type="text" id="eth2" name="eth[]" style="border:0px;background-color:#9EDA71;" size="10" onchange="turnText('eth2')" value="<?= $eth[1] ?>" />
<input type="text" id="eth3" name="eth[]" style="border:0px;background-color:#9EDA71;" size="10" onchange="turnText('eth3')" value="<?= $eth[2] ?>" />
<!--
Region: <input type="text" id="region" name="region" style="border:0px;background-color:#9EDA71;" size="10" onchange="turnText('region')" value="<?= $region ?>" />
Priority: <input type="text" id="pri" name="pri" style="border:0px;background-color:#9EDA71;" size="10" onchange="turnText('pri')" value="<?= $pri ?>" />
-->
<p class="shug"><input type="submit" value="Edit">
</form>
</p>

<form action="speciesSort.php" method="post">
<p class="shug"><input type="submit" value="Species Sort"></p>
</form>
<form action="listGenders.php" method="post">
<p class="shug"><input type="submit" value="List Genders">
</form>
<form action="listTypes.php" method="post">
<p class="shug"><input type="submit" value="List Types">
</form>
<form action="listEthnicity.php" method="post">
<p class="shug"><input type="submit" value="List Ethnicities">
</form>

<?php
	if($snum != 0){
		foreach(["Dual", "Single"] as $sc){
			if(file_exists('commissions/'.$sc.'/'. $namae .'.png')){
				echo "<br><img src='commissions/".$sc."/". $namae .".png' border=0>";
			}
		}
		if ($namae == "Akim'bleer"){
			echo "<br><img src='commissions/Dual/Akimbleer.png' border=0>";
		}
	}
?>

<script>
function dec() {
	o = parseInt(getCookie('off'));
	if(o > 0){
		setCookie("off",o-1);
	}
	window.location.reload();
}
function dec10() {
	o = parseInt(getCookie('off'));
	if(o > 9){
		setCookie("off",o-10);
	} else {
		setCookie("off",0);
	}
	window.location.reload();
}
function dec100() {
	o = parseInt(getCookie('off'));
	if(o > 99){
		setCookie("off",o-100);
	} else {
		setCookie("off",0);
	}
	window.location.reload();
}
function dec1000() {
	o = parseInt(getCookie('off'));
	if(o > 999){
		setCookie("off",o-1000);
	} else {
		setCookie("off",0);
	}
	window.location.reload();
}
function indInc(p1) {
	o = parseInt(getCookie('off'));
	setCookie("off",o+p1);
	//document.cookie = "off=1";
	window.location.reload();
}
function indDec(p1) {
	o = parseInt(getCookie('off'));
	o = parseInt(getCookie('off'));
	if(o > p1-1){
		setCookie("off",o-p1);
	} else {
		setCookie("off",0);
	}
	window.location.reload();
}
function start() {
	setCookie("off",0);
	window.location.reload();
}
function cookRes() {
	setCookie("off",0);
	window.location.reload();
}

function turnText(x) {
	var x = document.getElementById(x);
    x.style.backgroundColor = "yellow";
}

function nameSearch(){
	var x = document.getElementById("sname").value;
	var request = new XMLHttpRequest();
	request.open("GET", "pokedata.json", false);
	request.send(null)
	var obj = JSON.parse(request.responseText);
	var count = Object.keys(obj).length;
	document.getElementById("demo").innerHTML = count;
	for(i = 0; i < count; i++){
		if(obj[i].Name.toLowerCase() === x.toLowerCase()){
			setCookie("off",i);
			break;
		} else if(i == (count-1)){
			setCookie("off",i+1);
			break;
		}
	}
	//document.getElementById("demo").innerHTML = getCookie("off");
	window.location.reload();
}
function levelJump(){
	var x = document.getElementById("slv").value;
	var request = new XMLHttpRequest();
	request.open("GET", "pokedata.json", false);
	request.send(null)
	var obj = JSON.parse(request.responseText);
	var count = Object.keys(obj).length;
	for(i = 0; i < count; i++){
		if(parseInt(obj[i].Lv) >= parseInt(x)){
			setCookie("off",i);
			break;
		} else if(i == (count-1)){
			setCookie("off",i+1);
			break;
		}
	}
	//document.getElementById("demo").innerHTML = getCookie("off");
	window.location.reload();
}

function addEntry(){
	var request = new XMLHttpRequest();
	request.open("GET", "ocdata.json", false);
	request.send(null)
	var obj = JSON.parse(request.responseText);
	var count = Object.keys(obj).length;
	setCookie("off",count-1);
	window.location.reload();
}

function ranMon(){
	var request = new XMLHttpRequest();
	request.open("GET", "pokedata.json", false);
	request.send(null);
	var obj = JSON.parse(request.responseText);
	var count = Object.keys(obj).length;
	var ran = Math.floor((Math.random() * count) + 1);
	setCookie("off",ran);
	window.location.reload();
}

//Functions from W3Schools

function setCookie(cname,cvalue) {
    document.cookie = cname+"="+cvalue;
}

function getCookie(cname) {
    var name = cname + "=";
    var ca = document.cookie.split(';');
    for(var i=0; i<ca.length; i++) {
        var c = ca[i];
        while (c.charAt(0)==' ') {
            c = c.substring(1);
        }
        if (c.indexOf(name) == 0) {
            return c.substring(name.length, c.length);
        }
    }
    return "";
}
</script>

</body>
</html>