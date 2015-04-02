<?php
session_start();
include ('config.php');
$OutputMsg = "";
if(isset($_POST['NewUser'])) {
	$Name=$_POST['NewUser'];
} else {
	$Name = "";
}
if(isset($_POST['UserPass'])) {
	$Pass = $_POST['UserPass'];
} else {
	$Pass = "";
}
if(isset($_POST['UserPass2'])) {
	$Pass2 = $_POST['UserPass2'];
} else {
	$Pass2 = "";
}
if(isset($_SESSION['user'])) {
	$Admin = $_SESSION['user'];
} else {
	$Admin = "";
}

if (!empty($Name)) {
		$NameCheck = sprintf("SELECT * FROM accounts WHERE Name='%s'",
		mysql_real_escape_string($Name));
	$result = mysql_query($NameCheck);
	if (!$result) {
		$OutputMsg = "<strong>FEHLER:</strong> Konnte Abfrage ($NameCheck) <br>nicht erfolgreich ausfuehren von DB: <br>" . mysql_error();;
	}
	
	if (mysql_num_rows($result) >= 1) {
		$OutputMsg = "Account Existiert bereits";
	} else {
		if (!$Admin) {
			$ErstellerName = $Name;
			$CheckGesperrt = 1;
			$_POST['level'] = 1;
		} else {
			if ($_SESSION['Admin'] >= "1337") {
				$ErstellerName = $Admin;
				$CheckGesperrt = 0;
			} else {
				$ErstellerName = $Admin;
				$CheckGesperrt = 1;
				$_POST['level'] = 1;
			}
		}
		if (empty($Pass)) {
			exit(ABBRUCH2);
		} 
		if($Pass != $Pass2) {
			$OutputMsg = "Die Passw&ouml;rter stimmen nicht &uuml;berein";
		} else {
			$adduser = "INSERT INTO accounts SET
				Name   = '" . mysql_real_escape_string($Name) . "',
				Passwd   = '" . mysql_real_escape_string(md5($Pass)) . "',
				Accountlevel   = '" . mysql_real_escape_string($_POST['level']) . "',
				ErstelltAm   = '" . mysql_real_escape_string($Now) . "',
				ErstelltVon   = '" . mysql_real_escape_string($ErstellerName) . "',
				gesperrt	= '" . mysql_real_escape_string($CheckGesperrt) . "'";
			$ausgabe = mysql_query($adduser);
			if (!$ausgabe) {
				$OutputMsg = "<strong>FEHLER:</strong> Konnte Abfrage ($adduser) <br>nicht erfolgreich ausfuehren von DB: <br>" . mysql_error();
			} else {
			
			$OutputMsg = "Ihr Account wurde erstellt, Sie k&ouml;nnen nun zum <a href='index.php'>Index</a> zur&uuml;ck";
			$_SESSION['Pass']=$PassCheck;
			$_SESSION['Admin']=$_POST['level'];
			$_SESSION['Closed']=$CheckGesperrt;
			$_SESSION['user']=$Name;
			sleep(3);
			header('Location: index.php');
			}
		}
	}
}
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
  		<form action="register.php" method="post">
			<table width="75%" border="1" align="center" cellpadding="3" cellspacing="1">
				<tr>
					<td width="100%"><h5>Registration</h5><?php echo $OutputMsg;?></td>
				</tr>
				<tr>
					<td width="100%"><label>Dein Name: <input type="text" name="NewUser" size="25" value=""></label></td>
				</tr>
				<tr>
					<td width="100%"><label>Password: <input type="password" name="UserPass" size="25" value=""></label></td>
				</tr>
				<tr>
					<td width="100%"><label>Erneut das Password: <input type="password" name="UserPass2" size="25" value=""></label></td>
				</tr>
				<tr>
					<td width="100%"><input type="submit" value="Register!"></td>
				</tr>
			</table>
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
