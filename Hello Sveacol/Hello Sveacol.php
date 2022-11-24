<?php
/*
Plugin Name: Hello Sveacol
Plugin URI: Http://Sveacol.com
Description: This plugin says hello to all our customers
Version: 1.0
Author: Alejandro Arango Arias
Author URI: http://Sveacol.com
License: GPL2
license URI: https://www.gnu.org/licenses/gpl-2.0.html
Text Domain: Hello Sveacol
Domain Patch: /lenguages
*/
function Hello_Sveacol_get_lyric() {
	/** These are the lyrics to Hello Sveacol */
	$lyrics = "Hello, Sveacol
Well, Hello, Ready to be the queen of the place today?
Did you visit our page? https://apresnailcolombia.com/ promotions in Chau Legend
Did you visit our page? https://www.tonescolombia.com/ Shine in the darkness!";

	// Here we split it into lines.
	$lyrics = explode( "\n", $lyrics );

	// And then randomly choose a line.
	return wptexturize( $lyrics[ mt_rand( 0, count( $lyrics ) - 1 ) ] );
}

// This just echoes the chosen line, we'll position it later.
function Hello_Sveacol() {
	$chosen = Hello_Sveacol_get_lyric();
	$lang   = '';
	if ( 'en_' !== substr( get_user_locale(), 0, 3 ) ) {
		$lang = ' lang="en"';
	}

	printf(
		'<p id="Sveacol"><span class="screen-reader-text">%s </span><span dir="ltr"%s>%s</span></p>',
		__( 'Quote from Hello Sveacol song, by Jerry Herman:' ),
		$lang,
		$chosen
	);
}

// Now we set that function up to execute when the admin_notices action is called.
add_action( 'admin_notices', 'Hello_Sveacol' );

// We need some CSS to position the paragraph.
function Sveacol_css() {
	echo "
	<style type='text/css'>
	#dolly {
		float: right;
		padding: 5px 10px;
		margin: 0;
		font-size: 12px;
		line-height: 1.6666;
	}
	.rtl #Sveacol {
		float: left;
	}
	.block-editor-page #Sveacol {
		display: none;
	}
	@media screen and (max-width: 782px) {
		#Sveacol,
		.rtl #Sveacol {
			float: none;
			padding-left: 0;
			padding-right: 0;
		}
	}
	</style>
	";
}

add_action( 'admin_head', 'Sveacol_css' );
