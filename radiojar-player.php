<?php

/*
Plugin Name: Radiojar Player
Description: Radiojar player plugin for WordPress. Insert with shortcode [rj-player]
Author: Radiojar
Version: 0.1.0
Author URI: https://www.radiojar.com/
Text Domain: radiojar-player
License:     GPL2
License URI: https://www.gnu.org/licenses/gpl-2.0.html
*/

defined( 'ABSPATH' ) or die( 'Nope, not accessing this' );

require 'save-settings.php';

add_action( 'admin_menu', 'rjp_plugin_menu' );
function rjp_plugin_menu() {
    add_menu_page( 'Radiojar Player', 'Radiojar Player', 'manage_options', 'rjp-options', 'rjp_options',plugin_dir_url( __FILE__ )."radiojar-white.png" );
}

function rjp_options() {
    include 'player/settings.php';
}

add_action( 'admin_init', 'rjp_mysettings' );
function rjp_mysettings() {
    register_setting( 'rjp-settings-group', 'station_id' );
    register_setting( 'rjp-settings-group', 'autoplay' );
    register_setting( 'rjp-settings-group', 'player' );
    register_setting( 'rjp-settings-group', 'default_image' );
    register_setting( 'rjp-settings-group', 'navigation' );
    register_setting( 'rjp-settings-group', 'container' );
}

function rjp_player_func($atts){ 	
	$station_id = (get_option('station_id') != '') ? get_option('station_id') : 'uf6x8w5f81ac' ;
	$autoplay = (get_option('autoplay') != '') ? get_option('autoplay') : 'true' ;
	$player = (get_option('player') != '') ? get_option('player') : '1' ;
	$default_image = get_option('default_image');
	$navigation = get_option('navigation');
	$container_id = (get_option('container') != '') ? get_option('container') : 'main' ;
	
	?>
	<?php
	$file = dirname(__FILE__). "/player". $player .".php";
	
    ob_start();
    include $file;
    $template = ob_get_contents();
    ob_end_clean();
    return $template;
	
}
add_shortcode('rj-player','rjp_player_func');
add_filter('widget_text','do_shortcode');

function rjp_my_styles() {
         // enqueue style
        wp_enqueue_style('radiojar', '//www.radiojar.com/wrappers/api-plugins/v1/css/player.css');         
        if (get_option('navigation') == 6){
			if(!wp_script_is( 'jquery' )) {
				wp_enqueue_script('jquery');
			}
			// ajaxify.js with modify from Ajaxify WordPress Site(AWS) plugin
			wp_enqueue_script('history-js', plugin_dir_url(__FILE__) . 'js/history.js', array('jquery'));
			wp_enqueue_script('ajaxify-js',  plugin_dir_url(__FILE__) . 'js/ajaxify.js', array('jquery'));
	
			$ajaxify_data = array(
				'rootUrl' 		=> site_url() . '/',
				'container_id' 	=> get_option('container'),
			);
			
			wp_localize_script('ajaxify-js', 'ajaxify_data', $ajaxify_data);
		
			}
			
			
		}		
add_action('wp_enqueue_scripts', 'rjp_my_styles');



// admin script and styles

function rjp_enqueue_custom_admin_style() {
        wp_enqueue_style( 'custom_wp_admin_css', plugin_dir_url( __FILE__ ). '/admin-style.css');
        wp_enqueue_style( 'rj_admin_css', '//www.radiojar.com/wrappers/api-plugins/v1/css/player.css');
		wp_enqueue_script( 'admin-rj-script', '//www.radiojar.com/wrappers/api-plugins/v1/radiojar-min.js', array( 'jquery' ) );	
}
add_action( 'admin_enqueue_scripts', 'rjp_enqueue_custom_admin_style' );



function rjp_adminjs()
{?>
<script type='text/javascript'>
	var $ = window.jQuery
		if ($('#nav1').is(':checked')) {
			$("#nav2").show();
		}
		else {
			$("#nav2").hide();
		}
		if ($('#rd3').is(':checked')) {
			$("#player3").show();
		}
		else {
			$("#player3").hide();
		}

		$('input[type="radio"]').click(function () {
			if ($(this).attr("value") == "3") {
				$("#player3").show();
			}
			else if ($(this).attr("value") == "2" || $(this).attr("value") == "1"){
				$("#player3").hide();
			}
		});

		$('input[type="checkbox"]').click(function () {
			if ($('#nav1').is(':checked')) {
				$("#nav2").show();
			}
			else {
				$("#nav2").hide();
			}
		});
</script>
<?php
}
add_action('admin_footer', 'rjp_adminjs');
