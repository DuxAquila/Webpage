<?php
/**
 * Grundeinstellungen für WordPress
 *
 * Zu diesen Einstellungen gehören:
 *
 * * MySQL-Zugangsdaten,
 * * Tabellenpräfix,
 * * Sicherheitsschlüssel
 * * und ABSPATH.
 *
 * Mehr Informationen zur wp-config.php gibt es auf der
 * {@link https://codex.wordpress.org/Editing_wp-config.php wp-config.php editieren}
 * Seite im Codex. Die Zugangsdaten für die MySQL-Datenbank
 * bekommst du von deinem Webhoster.
 *
 * Diese Datei wird zur Erstellung der wp-config.php verwendet.
 * Du musst aber dafür nicht das Installationsskript verwenden.
 * Stattdessen kannst du auch diese Datei als wp-config.php mit
 * deinen Zugangsdaten für die Datenbank abspeichern.
 *
 * @package WordPress
 */

// ** MySQL-Einstellungen ** //
/**   Diese Zugangsdaten bekommst du von deinem Webhoster. **/

/**
 * Ersetze datenbankname_hier_einfuegen
 * mit dem Namen der Datenbank, die du verwenden möchtest.
 */
define('DB_NAME', 'db_332067_2');

/**
 * Ersetze benutzername_hier_einfuegen
 * mit deinem MySQL-Datenbank-Benutzernamen.
 */
define('DB_USER', 'USER332067');

/**
 * Ersetze passwort_hier_einfuegen mit deinem MySQL-Passwort.
 */
define('DB_PASSWORD', 'b87c9RcBM');

/**
 * Ersetze localhost mit der MySQL-Serveradresse.
 */
define('DB_HOST', 'duxaquila.lima-db.de');

/**
 * Der Datenbankzeichensatz, der beim Erstellen der
 * Datenbanktabellen verwendet werden soll
 */
define('DB_CHARSET', 'utf8mb4');

/**
 * Der Collate-Type sollte nicht geändert werden.
 */
define('DB_COLLATE', '');

/**#@+
 * Sicherheitsschlüssel
 *
 * Ändere jeden untenstehenden Platzhaltertext in eine beliebige,
 * möglichst einmalig genutzte Zeichenkette.
 * Auf der Seite {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * kannst du dir alle Schlüssel generieren lassen.
 * Du kannst die Schlüssel jederzeit wieder ändern, alle angemeldeten
 * Benutzer müssen sich danach erneut anmelden.
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         '93kKlDkKwnc$1X^X&c,uRoQbQB!AE[AW#g=qCO!s$5~4Tu*ZEfeuXe<wIanP3j<l');
define('SECURE_AUTH_KEY',  '*7/B3gl_B-L ,=0nnD/i;)FyXmK (rf:q_`=r^yhMw*PMJN5{|zGSDtX{FGFTV{i');
define('LOGGED_IN_KEY',    'xxP^(/*K[>?duJ`O,OBT-`qA]W,rkO&P*H&SiV/+:qWC/`C[Hk7 .i_Mw*ptO^^t');
define('NONCE_KEY',        'da%vve+*a,ai:/guCYQ Qv[1t>3!@@7M@6F$=u#&[oyPv)PZ(@?:,zHtg7&x6(m6');
define('AUTH_SALT',        ')!?+YAKgo{RF<Fy$uO+@Kg|LpqZvrh9>6SJR=f1Bii.60E-u|#C`:#?+<b48WxJf');
define('SECURE_AUTH_SALT', '182h$%ZG*Gp@!1?]+iA4GV/MMm-{#r7cc QJ+9%M$[v5vIk~;ma!o472)W*lBlDt');
define('LOGGED_IN_SALT',   'yp(.%g%gu^^NIastjIg*4H<.ItmRL=Q#~o;,9btCFOb*kqz_X/_v/:>]BW!P(5$W');
define('NONCE_SALT',       '1bwwm18X*lpF|Ju^)Pxtg~gOTV&]wfKYA:[=%1aJnMde@y^;X`jx7J~Qdp*;A_py');
define('WP_SITEURL', 'http://duxaquila.lima-city.de');
define('WP_HOME', 'http://duxaquila.lima-city.de');

/**#@-*/

/**
 * WordPress Datenbanktabellen-Präfix
 *
 * Wenn du verschiedene Präfixe benutzt, kannst du innerhalb einer Datenbank
 * verschiedene WordPress-Installationen betreiben.
 * Bitte verwende nur Zahlen, Buchstaben und Unterstriche!
 */
$table_prefix  = 'wp_';

/**
 * Für Entwickler: Der WordPress-Debug-Modus.
 *
 * Setze den Wert auf „true“, um bei der Entwicklung Warnungen und Fehler-Meldungen angezeigt zu bekommen.
 * Plugin- und Theme-Entwicklern wird nachdrücklich empfohlen, WP_DEBUG
 * in ihrer Entwicklungsumgebung zu verwenden.
 *
 * Besuche den Codex, um mehr Informationen über andere Konstanten zu finden,
 * die zum Debuggen genutzt werden können.
 *
 * @link https://codex.wordpress.org/Debugging_in_WordPress
 */
define('WP_DEBUG', false);

/* Das war’s, Schluss mit dem Bearbeiten! Viel Spaß beim Bloggen. */
/* That's all, stop editing! Happy blogging. */

/** Der absolute Pfad zum WordPress-Verzeichnis. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Definiert WordPress-Variablen und fügt Dateien ein.  */
require_once(ABSPATH . 'wp-settings.php');
