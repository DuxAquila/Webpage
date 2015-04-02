<?php 
	if (!empty($_SESSION['user'])) {
		if (!$_SESSION['Closed'] == "1") {
			echo '<li><a href="index.php?page=user-settings"><span class="l"></span><span class="r"></span><span class="t">Account Settings</span></a></li>
				<li><a href="index.php?page=view"><span class="l"></span><span class="r"></span><span class="t">&Uuml;bersicht</span></a></li>
				<li><a href="logout.php"><span class="l"></span><span class="r"></span><span class="t">Abmelden</span></a></li>';
			if($_SESSION['Admin'] > "6") {
				echo '<li><a href="index.php?page=admin"><span class="l"></span><span class="r"></span><span class="t">Administration</span></a></li>';
			}
		}
	} else {
		echo '<li><a href="login.php"><span class="l"></span><span class="r"></span><span class="t">Anmelden</span></a></li>
			<li><a href="register.php"><span class="l"></span><span class="r"></span><span class="t">Registrieren</span></a></li>';
	}
?> 