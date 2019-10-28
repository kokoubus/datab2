<?php

$con = mysqli_connect("", "root");
mysqli_select_db($con, "bacteria");
$sql = "select Name from protein_sequenz where name like '". $_POST['anfang']."%'";
$res = mysqli_query($con, $sql);
$num = mysqli_num_rows($res);

if($num == 0)
	echo "No organismus found! <br> 
Please make another search!";
else 
	echo $num . "organismus found <br/>"; 
while($dsatz = mysqli_fetch_assoc($res))
	echo $dsatz["Name"] . "<br/>";
?>
