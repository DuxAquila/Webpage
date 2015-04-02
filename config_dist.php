<?php
$SQLHost = "localhost";
$SQLUser = "User";
$SQLPasswort = "Passwd";
$SQLDB = "User_DB";
$Now = date("Y-m-d H:i:s");

mysql_connect($SQLHost, $SQLUser, $SQLPasswort) or die ('Keine Verbindung moeglich:' . mysql_error());
mysql_select_db($SQLDB) or die ('Die Datenbank existiert nicht:' . mysql_error());
?>
