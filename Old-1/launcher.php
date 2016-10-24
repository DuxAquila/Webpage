<?php
include ('config.php');

if(isset($_GET['ID'])) {
	$ID=$_GET['ID'];
} else {
	die("-1");
}
if(isset($_GET['addon'])) {
	$addon =($_GET['addon']);
} else {
	$addon = "0";
}
$sql = sprintf("SELECT * FROM wow_launcher WHERE Kennung='%s'",
            mysql_real_escape_string($ID));
$result = mysql_query($sql);
if (!$result) {
    die("FEHLER: Konnte Abfrage ($sql) nicht erfolgreich ausf&uuml;hren von DB: " . mysql_error());
}

if (mysql_num_rows($result) == 0) {
	$sql = "INSERT INTO wow_launcher SET
			Kennung   = '" . mysql_real_escape_string($ID) . "',
			aufrufe   = '" . mysql_real_escape_string("1") . "',
			fistlogin   = '" . mysql_real_escape_string($Now) . "',
			Addons   = '" . mysql_real_escape_string($addon) . "',
			LetzterLogin	= '" . mysql_real_escape_string($Now) . "'";
	
	$result = mysql_query($sql);
	if (!$result) {
		die("FEHLER: Konnte Abfrage ($sql) <br>nicht erfolgreich ausfuehren von DB: <br>" . mysql_error());
	}
	exit("Danke dass sie den Launcher nutzen ");
}

while ($row = mysql_fetch_array($result, MYSQL_BOTH)) {
    $aufrufe = $row["aufrufe"];
}
mysql_free_result($result);
$v = 1;
$aufrufe_New = $aufrufe + $v;
$LastLogin = sprintf("UPDATE wow_launcher SET LetzterLogin='%s', aufrufe='%s' ,Addons='%s' WHERE Kennung='%s'",
           mysql_real_escape_string($Now),
	   mysql_real_escape_string($aufrufe_New),
	   mysql_real_escape_string($addon),
           mysql_real_escape_string($ID));

		   $sql = mysql_query($LastLogin);
if (!$sql) {
	echo "FEHLER: Konnte Abfrage ($LastLogin) <br>nicht erfolgreich ausfuehren von DB: <br>" . mysql_error();
	exit(ABBRUCH);
} else {
	exit("Danke dass sie den Launcher schon zum " . $aufrufe_New . ". mal Benutzen");
}

?>