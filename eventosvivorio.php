<?php
/*
Plugin Name: Eventos Vivo Rio
Plugin URI:  http://siswebmobile.com.br
Description: Events exclusive in project Vivo Rio
Version:     1.0
Author:      Roberto Soares de Melo
Author URI:  http://siswebmobile.com.br
License:     GPL2
License URI: https://www.gnu.org/licenses/gpl-2.0.html
Domain Path: /languages
Text Domain: Vivorio
 
{Plugin Name} is free software: you can redistribute it and/or modify
it under the terms of the GNU General Public License as published by
the Free Software Foundation, either version 2 of the License, or
any later version.
 
{Plugin Name} is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
GNU General Public License for more details.
 
You should have received a copy of the GNU General Public License
along with {Plugin Name}. If not, see {License URI}.
 
*/
//NAO ACESSIVEL
if(!defined('ABSPATH')){
    exit();
}

function oncologiafilter_install() {
 
    // Trigger our function that registers the custom post type
 
    // Clear the permalinks after the post type has been registered
    flush_rewrite_rules();
 
}

register_activation_hook( __FILE__, 'eventosvivorio_install' );

function dwwp_add_filtro_link() {
    //adicionar um menu no topo do admin wp
	global $wp_admin_bar;
        $url = plugins_url();
	$wp_admin_bar->add_menu( array(
		'id'    => 'eventos_vivorio',
		'title' => 'Eventos Vivo Rio',
		'href'  => $url.'/eventosvivorio/admin.php',
        'target' => '_blank'
	) );
        //URL de arquivo dentro do plugin
        //plugins_url() .'/oncologiafilter/js/scripts.js
}
add_action( 'wp_before_admin_bar_render', 'dwwp_add_filtro_link' ); 
