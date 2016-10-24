<?php session_start();
include ('config.php');
$Output2 = "";
$Output1 = "";
if(empty($_SESSION['user'])) {
	header('Location: index.php');
}
if($_SESSION['Admin'] <= "5") {
	header('Location: index.php');
}
if(isset($_POST['change'])) {
	$ID = $_POST['UserID'];
	if(!empty($_POST['NewPasswd'])) {
		$NewPasswd = md5($_POST['NewPasswd']);
	} else{
		$NewPasswd = "";
	}
	$NewLevel = $_POST['NewLevel'];
	if(!empty($ID)) {
		$Query = sprintf("SELECT * FROM accounts WHERE id='%s'",
			mysql_real_escape_string($ID));
		$result = mysql_query($Query);
		
		if (mysql_num_rows($result) == 0) {
			$Output2 = "Die ID " . $ID . " wurde nicht gefunden";
			goto main;
		}
		
		while ($row = mysql_fetch_array($result, MYSQL_BOTH)) {
	    	$PassCheck = $row["Passwd"];
	    	$Gesperrt = $row["gesperrt"];
	    	$AccLevel = $row["Accountlevel"];
		}
		mysql_free_result($result);
		if(empty($NewPasswd)) {
			$NewPasswd = $PassCheck;
		}
		if(empty($NewLevel)) {
			$NewLevel = $AccLevel;
		}
		$adduser = sprintf("UPDATE accounts SET Passwd='%s', Accountlevel='%s' WHERE id='%s'",
					mysql_real_escape_string($NewPasswd),
					mysql_real_escape_string($NewLevel),
					mysql_real_escape_string($ID));
		$ausgabe = mysql_query($adduser);
		
		if(!$ausgabe) {
			$Output2 = "Fehler" . $adduser . "<br>" . mysql_error();
		}
		mysql_free_result($ausgabe);
		$Output2 = "Der Account mit der ID: " .  $ID . " Wurde erfolgreich bearbeitet";
	}
}
if(isset($_POST['lock'])) {
	$ID = $_POST['UserID'];
	if(!empty($ID)) {
		$Query = sprintf("SELECT * FROM accounts WHERE id='%s'",
			mysql_real_escape_string($ID));
		$result = mysql_query($Query);
	
		if (mysql_num_rows($result) == 0) {
			$Output2 = "Die ID " . $ID . " wurde nicht gefunden";
			goto main;
		}
	
		while ($row = mysql_fetch_array($result, MYSQL_BOTH)) {
		   	$PassCheck = $row["Passwd"];
		   	$Gesperrt = $row["gesperrt"];
		   	$AccLevel = $row["Accountlevel"];
		}
		mysql_free_result($result);
		if($Gesperrt == "0") {
				$UpdateString = sprintf("UPDATE accounts SET gesperrt='1' WHERE id='%s'",
					mysql_real_escape_string($ID));
				$Update = mysql_query($UpdateString);
				if(!$Update) {
					$Output2 = "Fehler" . $UpdateString . "<br>" . mysql_error();
				} else {
					$Output2 = "Die ID " . $ID . " wurde erfolgreich gesperrt";
				}
		} else {
			$Output2 = "Die ID " . $ID . " ist bereits gesperrt";
		}
	}
}
if(isset($_POST['unlock'])) {
	$ID = $_POST['UserID'];
	if(!empty($ID)) {
		$Query = sprintf("SELECT * FROM accounts WHERE id='%s'",
			mysql_real_escape_string($ID));
		$result = mysql_query($Query);
	
		if (mysql_num_rows($result) == 0) {
			$Output2 = "Die ID " . $ID . " wurde nicht gefunden";
			goto main;
		}
	
		while ($row = mysql_fetch_array($result, MYSQL_BOTH)) {
		   	$PassCheck = $row["Passwd"];
		   	$Gesperrt = $row["gesperrt"];
		   	$AccLevel = $row["Accountlevel"];
		}
		mysql_free_result($result);
		if($Gesperrt == "1") {
				$UpdateString = sprintf("UPDATE accounts SET gesperrt='0' WHERE id='%s'",
					mysql_real_escape_string($ID));
				$Update = mysql_query($UpdateString);
				if(!$Update) {
					$Output2 = "Fehler" . $UpdateString . "<br>" . mysql_error();
				} else {
					$Output2 = "Die ID " . $ID . " wurde erfolgreich entesperrt";
				}
		} else {
			$Output2 = "Die ID " . $ID . " ist nicht gesperrt";
		}
	}
}
if(isset($_POST['remove'])) {
	$ID = $_POST['UserID'];
	if(!empty($ID)) {
		$Query = sprintf("SELECT * FROM accounts WHERE id='%s'",
			mysql_real_escape_string($ID));
		$result = mysql_query($Query);
	
		if (mysql_num_rows($result) == 0) {
			$Output2 = "Die ID " . $ID . " wurde nicht gefunden";
			goto main;
		}
		mysql_free_result($result);
		
		$DelString = sprintf("DELETE FROM accounts WHERE id='%s'",
					mysql_real_escape_string($ID));
		
		$Remove = mysql_query($DelString);
		
		if(!$Remove) {
			$Output2 = "Fehler" . $DelString . "<br>" . mysql_error();
		} else {
			$Output2 = "Die ID " . $ID . " wurde erfolgreich Gelöscht";
		}
	}
}
if(isset($_POST['NewAccountCreate'])) {
	if($_SESSION['Admin'] >= "2"){
		$NewUser = $_POST['NewAccount'];
		$NewUserPasswd = md5($_POST['NewPasswd']);
		$NewUserRank = $_POST['NewAdminRank'];
		$Admin = $_SESSION['user'];
		
		if(empty($NewUser)) {
			$Output1 = "Kein Name angegeben";
			$Abbruch = "1";
		} elseif(empty($NewUserPasswd)) {
			$Output1 = "Kein Passwort angegeben";
			$Abbruch = "1";
		} elseif (empty($NewUserRank)) {
			$NewUserRank = "1";
		} 
		
		if($Abbruch != "1"){
			if($NewUserRank > $_SESSION['Admin']) {
				$NewUserRank = $_SESSION['Admin'];
			}
			$adduser = "INSERT INTO accounts SET
				Name   = '" . mysql_real_escape_string($NewUser) . "',
				Passwd   = '" . mysql_real_escape_string($NewUserPasswd) . "',
				Accountlevel   = '" . mysql_real_escape_string($NewUserRank) . "',
				ErstelltAm   = '" . mysql_real_escape_string($Now) . "',
				ErstelltVon   = '" . mysql_real_escape_string($Admin) . "'";
			$result = mysql_query($adduser);
			if(!$result) {
				$Output1 = "Fehler " . mysql_error();
			} else {
				$Output1 = "Account " . $NewUser . " wurde erstellt";
			}		}
	}
}
main:
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html lang="en-US" xml:lang="en" dir="ltr" xmlns="http://www.w3.org/1999/xhtml">
  <head>
    <meta http-equiv="content-type" content="application/xhtml+xml; charset=UTF-8" />
    <meta content="IE=EmulateIE7" http-equiv="X-UA-Compatible" />
    <title>Dux Aquila </title>
    <link type="image/x-icon" href="http://duxaquila.info/images/favicon.ico" rel="shortcut icon" />
    <link type="image/x-icon" href="http://duxaquila.info/images/favicon.ico" rel="icon" />
    <link media="screen" type="text/css" href="style.css" rel="stylesheet" />
    <!--[if IE 6]><link rel="stylesheet" href="style.ie6.css" type="text/css" media="screen" /><![endif]-->
    <!--[if IE 7]><link rel="stylesheet" href="style.ie7.css" type="text/css" media="screen" /><![endif]-->
    <script src="script.js" type="text/javascript"></script>
  <script type="text/javascript">
function make_spoiler() {
   var s = document;
   while( s.lastChild && s.lastChild.nodeType == 1 ) s = s.lastChild;
   var spoilerElement = s.previousSibling.previousSibling;
   if(spoilerElement.nextSibling.className != 'bbcode_spoiler')
      return;
   spoilerElement.nextSibling.style.display = 'none';
   var button = document.createElement('input');
   button.type='button'; button.value = 'show';
   button.className = 'button';
   button.onclick=function() {
      var spoiler = this.parentNode.nextSibling;
      if(spoiler.style.display == '') {
          spoiler.style.display = 'none'; this.value = 'show';
      } else {
          spoiler.style.display = ''; this.value = 'hide';
      }
   }
   spoilerElement.appendChild(button);
}
</script>
</head>
  <body>
    <div id="art-page-background-simple-gradient">
      <div id="art-page-background-gradient"></div>
    </div>
    <div id="art-page-background-glare">
      <div id="art-page-background-glare-image"></div>
    </div>
    <div id="art-main">
      <div class="art-sheet">
        <div class="art-sheet-tl"></div>
        <div class="art-sheet-tr"></div>
        <div class="art-sheet-bl"></div>
        <div class="art-sheet-br"></div>
        <div class="art-sheet-tc"></div>
        <div class="art-sheet-bc"></div>
        <div class="art-sheet-cl"></div>
        <div class="art-sheet-cr"></div>
        <div class="art-sheet-cc"></div>
        <div class="art-sheet-body">
          <div class="art-nav">
            <div class="l"></div>
            <div class="r"></div>
            <ul class="art-menu">
              <li> <a class="active" href="index.php"><span class="l"></span><span
                    class="r"></span><span class="t">Home</span></a> </li>
              <li> <a href="#"><span class="l"></span><span class="r"></span><span
                    class="t">Projekte</span></a>
                <ul>
                  <li><a href="#">Laenalith Launcher</a>
                    <ul>
                      <li><a href="https://github.com/DuxAquila/Launcher">GitHub</a></li>
                      <li><a href="https://github.com/DuxAquila/Launcher/issues">Bug
                          Tracker</a></li>
                      <li><a href="http://duxaquila.info/Keybinder/Leanalith/Launcher.exe">Download</a></li>
                    </ul>
                  </li>
                  <li><a href="#">Stromkosten</a>
                    <ul>
                      <li><a href="https://github.com/DuxAquila/Stromkosten">GitHub</a></li>
                      <li><a href="https://github.com/DuxAquila/Stromkosten/issues">Bug
                          Tracker</a></li>
                      <li><a href="http://duxaquila.info/Keybinder/Stromkosten/Stromkosten.exe">Download</a></li>
                    </ul>
                  </li>
                  <li><a href="#">Laenalith Launcher VB</a>
                    <ul>
                      <li><a href="https://github.com/DuxAquila/Launcher_VB">GitHub</a></li>
                      <li><a href="https://github.com/DuxAquila/Launcher_VB/issues">Bug
                          Tracker</a></li>
                      <li><a href="http://duxaquila.info/Keybinder/LauncherVB/Setup.exe">Download</a></li>
                    </ul>
                  </li>
                </ul>
              </li>
            </ul>
          </div>
          <div class="art-header">
            <div class="art-header-jpeg"></div>
            <script src="swfobject.js" type="text/javascript"></script>
            <div id="art-flash-area">
              <div id="art-flash-container"> <object width="900" height="225" id="art-flash-object"
                  classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000"> <param
                    value="images/flash.swf" name="movie" /> <param value="high"
                    name="quality" /> <param value="exactfit" name="scale" /> <param
                    value="transparent" name="wmode" /> <param value="color1=0xFFFFFF&amp;alpha1=.10&amp;framerate1=12"
                    name="flashvars" /> <param value="true" name="swfliveconnect" />
                  <param value="false" name="play" /> <param value="false" name="loop" />
                  <!--[if !IE]>--> <object width="900" height="225" data="images/flash.swf"
                    type="application/x-shockwave-flash"> <param value="high" name="quality" />
                    <param value="exactfit" name="scale" /> <param value="transparent"
                      name="wmode" /> <param value="color1=0xFFFFFF&amp;alpha1=.10&amp;framerate1=12"
                      name="flashvars" /> <param value="true" name="swfliveconnect" />
                    <param value="false" name="play" /> <param value="false" name="loop" />
                    <!--<![endif]-->
                    <div class="art-flash-alt"><a href="http://www.adobe.com/go/getflashplayer"><img
                          alt="Get Adobe Flash player" src="http://www.adobe.com/images/shared/download_buttons/get_flash_player.gif" /></a></div>
                    <!--[if !IE]>--> </object>
                  <!--<![endif]--> </object> </div>
            </div>
            <script type="text/javascript">swfobject.switchOffAutoHideShow();swfobject.registerObject("art-flash-object", "9.0.0", "expressInstall.swf");</script>
            <div class="art-logo">
              <h1 class="art-logo-name" id="name-text"><a href="#"><img width="80"
                    height="52" src="../images/site_logo.png" /></a></h1>
              <div class="art-logo-text" id="slogan-text">Life 4 Coding</div>
            </div>
          </div>
          <div class="art-content-layout">
            <div class="art-content-layout-row">
              <div class="art-layout-cell art-sidebar1">
                <div class="art-vmenublock">
                  <div class="art-vmenublock-body">
                    <div class="art-vmenublockheader">
                      <div class="l"></div>
                      <div class="r"></div>
                      <div class="t">Navigation</div>
                    </div>
                    <div class="art-vmenublockcontent">
                      <div class="art-vmenublockcontent-body">
                        <!-- block-content -->
                        <ul class="art-vmenu">
                         <li> <a href="index.php"><span class="l"></span><span
                                class="r"></span><span class="t">Home</span></a>
                          </li>
                          <li> <a target="_new" href="https://github.com/DuxAquila"><span
                                class="l"></span><span class="r"></span><span class="t">GitHub</span></a>
                          </li>
							<?php include('menu.php'); ?>
						  </ul>
                        <!-- /block-content -->
                        <div class="cleared"></div>
                      </div>
                    </div>
                    <div class="cleared"></div>
                  </div>
                </div>
                <div class="art-block">
                  <div class="art-block-cl"></div>
                  <div class="art-block-cr"></div>
                  <div class="art-block-cc"></div>
                  <div class="art-block-body">
                    <div class="cleared"></div>
                  </div>
                </div>
              </div>
              <div class="art-layout-cell art-content">
                <div class="art-post">
                  <div class="art-post-body">
                    <div class="art-post-inner art-article">
                      <h2 class="art-postheader"> Register </h2>
                      <div class="art-postcontent">
                        <!-- article-content -->
<h2>Accountverwaltung</h2>
<h3> <li>Account erstellen</li></h3>    
<p>Hier kann man ein neuen Account anlegen</p>
<h1> <?php echo $Output1; ?></h1>
<form action="admin.php" method="post" name="Erstellen" tarpost="_self">
<table width="50%" border="1" cellspacing="2" cellpadding="2">
  <tr>
    <td width="21%">Name</td>
    <td width="79%">
            <input type="text" name="NewAccount" size="50%" />
    </td>
  </tr>
  <tr>
    <td>Passwort</td>
    <td width="79%">
            <input type="password" name="NewPasswd" size="50%" />
    </td>
  </tr>
  <tr>
    <td>Adminrank</td>
    <td width="79%">
            <input name="NewAdminRank" type="text" size="50%" />
    </td>
  </tr>
</table>
<p> <input type="submit" name="NewAccountCreate" value="Senden" /></p>
</form>
<h3>Account verwalten </h3>
<p> Hier kann man den Account verwalten</p>
<p>Userliste:</p><div class="bbcode_spoiler">
<table width="80%" cellpadding="0" cellspacing="2" border="2">
<tr>
    <th>ID</th>
    <th>Name</th>
    <th>Account Level</th>
	<th>Letzter Login</th>
	<th>Gesperrt</th>
</tr>
<?php 	$sql = sprintf("SELECT * FROM accounts");
	$result = mysql_query($sql);
	if (!$result) {
	    echo "Konnte Abfrage ($sql) nicht erfolgreich ausf&uuml;hren von DB: " . mysql_error();
	    exit;
	}


	if (mysql_num_rows($result) == 0) {
		echo "FEHLER: Ausgabe ist leer!";
		exit;
	}

	while ($row = mysql_fetch_array($result)) {
	if("$row[gesperrt]") {
		$GesperrtTrue = "Ja";
	} else {
		$GesperrtTrue = "Nein";
	}
	if("$row[LetzterLogin]") {
		$LetzterLogin = "$row[LetzterLogin]";
	} else {
		$LetzterLogin = "Nie";
	}

	echo '<tr>'."\r\n";

    echo '<td>'."$row[id]".'</td>'."\r\n";
    echo '<td>'."$row[Name]".'</td>'."\r\n";
    echo '<td>'."$row[Accountlevel]".'</td>'."\r\n";
    echo '<td>'."$LetzterLogin".'</td>'."\r\n";
    echo '<td>'."$GesperrtTrue".'</td>'."\r\n";

    echo '<tr>'."\r\n";  
	}
	?>
	</table></p>  </div><script type="text/javascript">make_spoiler();</script>
</p>
<h1> <?php echo $Output2; ?></h1>
<form action="admin.php" method="post" name="Erstellen" tarpost="_self">
<table width="62%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="50%">ID:* </td>
    <td width="50%" align="center"><input name="UserID" type="text" /></td>
  </tr>
  <tr>
    <td width="50%">Passwort:</td>
    <td width="50%" align="center"><input name="NewPasswd" type="text" /></td>
  </tr>
  <tr>
    <td width="50%">Level:<br /></td>
    <td width="50%" align="center"><input name="NewLevel" type="text" /></td>
  </tr>
</table>
<input type="submit" name="change" value="&Auml;ndern!"/> 
<input type="submit" name="lock" value="Sperren!"/>
<input type="submit" name="unlock" value="Entsperren!"/>
<input type="submit" name="remove" value="L&ouml;schen!"/>

</form>
                        </p>
                        <div class="cleared"></div>
                        <div class="art-content-layout overview-table">
                          <div class="art-content-layout-row">
                            <div class="art-layout-cell">
                              <div class="overview-table-inner">
                             </div>
                            </div>
                            <!-- end cell -->
                            <div class="art-layout-cell">
                              <div class="overview-table-inner"> </div>
                            </div>
                            <!-- end cell -->
                            <!-- end cell --> </div>
                          <!-- end row --> </div>
                        <!-- end table -->
                        <!-- /article-content --> </div>
                      <div class="cleared"></div>
                    </div>
                    <div class="cleared"></div>
                  </div>
                </div>
                <div class="cleared"></div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="cleared"></div>
      <div class="art-footer">
        <div class="art-footer-inner">
          <div class="art-footer-text">
            <p><br />
              Copyright © 2013 ---. All Rights Reserved.</p>
          </div>
        </div>
        <div class="art-footer-background"></div>
      </div>
      <div class="cleared"></div>
    </div>
    <div class="cleared"></div>
    <p class="art-page-footer"></p>
    <script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-42092895-1', 'duxaquila.info');
  ga('send', 'pageview');

</script>
  </body>
</html>
