<?php
/**
 * Il file base di configurazione di WordPress.
 *
 * Questo file viene utilizzato, durante l’installazione, dallo script
 * di creazione di wp-config.php. Non è necessario utilizzarlo solo via web
 * puoi copiare questo file in «wp-config.php» e riempire i valori corretti.
 *
 * Questo file definisce le seguenti configurazioni:
 *
 * * Impostazioni del database
 * * Chiavi segrete
 * * Prefisso della tabella
 * * ABSPATH
 *
 * * @link https://wordpress.org/documentation/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** Impostazioni database - È possibile ottenere queste informazioni dal proprio fornitore di hosting ** //
/** Il nome del database di WordPress */
define( 'DB_NAME', 'newtheme' );

/** Nome utente del database */
define( 'DB_USER', 'root' );

/** Password del database */
define( 'DB_PASSWORD', 'root' );

/** Hostname del database */
define( 'DB_HOST', 'localhost' );

/** Charset del Database da utilizzare nella creazione delle tabelle. */
define( 'DB_CHARSET', 'utf8mb4' );

/** Il tipo di collazione del database. Da non modificare se non si ha idea di cosa sia. */
define( 'DB_COLLATE', '' );

/**#@+
 * Chiavi univoche di autenticazione e di sicurezza.
 *
 * Modificarle con frasi univoche differenti!
 * È possibile generare tali chiavi utilizzando {@link https://api.wordpress.org/secret-key/1.1/salt/ servizio di chiavi-segrete di WordPress.org}
 *
 * È possibile cambiare queste chiavi in qualsiasi momento, per invalidare tutti i cookie esistenti.
 * Ciò forzerà tutti gli utenti a effettuare nuovamente l'accesso.
 *
 * @since 2.6.0
 */
define( 'AUTH_KEY',         '_]v1g!Gb-lN/2rn0qq(A|iEx$1~:qM5^Yn(+A%A9&#;[ 5jEIBAgTu{gwo/~B?((' );
define( 'SECURE_AUTH_KEY',  'oVPyA[gERM~PMBM_!1h8q6s?med&]=_YPhD{<{.ISQ3:=z_T ;D.i2 d^/|/^zUD' );
define( 'LOGGED_IN_KEY',    '7n|iai%/cVOW=$ppZ@Z$;Atf :?%T24R_Zi(i?Gs@!jxghzb1]lHHVfjSinc{h0$' );
define( 'NONCE_KEY',        'E!Y*,U/T0`s2~aeZ>Uj,z@a7#@!b@V*n^FEtm!p~=`RRpek=9PGCpHm[Z&}f?UK9' );
define( 'AUTH_SALT',        'D9*T5M@}-Lch`5<Z&p<.fO)r#sH<U#*{d|JRnJ@Pzmp@^&>gO!hm5$#/7D|N-(s#' );
define( 'SECURE_AUTH_SALT', 'b?P>PK ^gye&j,IIT.(F;PHH.:Bf@wDPpUstjHE-P`0/FI}i;jLShQ%r]TGbQ*9#' );
define( 'LOGGED_IN_SALT',   'Tu=Pa>zyA$/Go,-NtTF1.n&ePF2ReFW@7)Hz}nocXz-8mTd>bmb_ruD8Za*b_N^%' );
define( 'NONCE_SALT',       'xEa^1hCsx`)ur!GT]tMIY7i~O&J/^D_6oF[_Mp=Tmzy*B&yAI[ZM5`!z%@.*}Zb:' );

/**#@-*/

/**
 * Prefisso tabella del database WordPress.
 *
 * È possibile avere installazioni multiple su di un unico database
 * fornendo a ciascuna installazione un prefisso univoco. Solo numeri, lettere e trattini bassi!
 */
$table_prefix = 'wp_';

/**
 * Per gli sviluppatori: modalità di debug di WordPress.
 *
 * Modificare questa voce a TRUE per abilitare la visualizzazione degli avvisi durante lo sviluppo
 * È fortemente raccomandato agli svilupaptori di temi e plugin di utilizare
 * WP_DEBUG all’interno dei loro ambienti di sviluppo.
 *
 * Per informazioni sulle altre costanti che possono essere utilizzate per il debug,
 * leggi la documentazione
 *
 * @link https://wordpress.org/documentation/article/debugging-in-wordpress/
 */
define( 'WP_DEBUG', false );

/* Aggiungere qualsiasi valore personalizzato tra questa riga e la riga "Finito, interrompere le modifiche". */



/* Finito, interrompere le modifiche! Buona pubblicazione. */

/** Path assoluto alla directory di WordPress. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Imposta le variabili di WordPress ed include i file. */
require_once ABSPATH . 'wp-settings.php';


define( 'WP_DEBUG', true );
define( 'WP_DEBUG_LOG', true );
define( 'WP_DEBUG_DISPLAY', true );