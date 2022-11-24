<?php
/*
Plugin Name: slug change
Plugin URI: Http://slug change.com
Description: This plugin automatically updates the slug field of your wordpress pages
Version: 1.0
Author: Alejandro Arango Arias
Author URI: http://slugchange.com
License: GPL2
license URI: https://www.gnu.org/licenses/gpl-2.0.html
Text Domain: slug change
Domain Patch: /lenguages
*/
if( ! function_exists('sc_install') ) {
    function sc_install(){
    //Accion a ejecutar
//    require_once 'activador.php';
    }
}

if( ! class_exists('SC_Mi_Class') ) {
    class  SC_Mi_Class {
        
    }
}

function sc_deactivation() {
    // Accion a ejecutar
    flush_rewrite_rules();
}

function sc_desinstall() {
    // Borrar Tablas en la base de datos
    // Quitar alguna configuraciones
    // u Opciones 
}

register_activation_hook( __FILE__, 'sc_install' );
register_deactivation_hook( __FILE__, 'sc_deactivation' );

require_once plugin_dir_path(__FILE__) . 'lib/helpers.php';

if( !function_exists('sc_options_page') ) {
    
    // Linea 1000
    add_action('admin_menu', 'sc_options_page', 9);
    
    // Linea 5000
    add_action('admin_menu', 'sc_options_page2', 5);
    
    function sc_options_page2() {
        
    }
    
    function sc_options_page() {
    
        $menus = [];
        $submenus = [];

        $menus[] = [
            'PageTitle' => 'SC Pruebas',
            'menuTitle' => 'SC Pruebas',
            'capacibility' => 'manage_options',
            'menuSlug' => 'sc_pruebas',
            'functionName' => 'sc_pruebas_page_display',
            'iconUrl' => plugin_dir_url(__FILE__) . 'img/sveacol-20-wp.svg',
            'position' => 15,
        ];

          $submenus[] = [
            'parentSlug' => 'sc_pruebas',
            'PageTitle' => 'Titulo submenu 1',
            'menuTitle' => 'Titulo submenu 1',
            'capacibility' => 'manage_options',
            'menuSlug' => 'submenu1_sc_pruebas',
            'functionName' => 'submenu1_sc_pruebas_page_display',
        ];
        
      ( $menus );
      ( $submenus );
        
    }
    
}

if( ! function_exists( 'sc_pruebas_page_display' ) ) {

    function sc_pruebas_page_display() {
        
        ?>

        <?php if( current_user_can('manage_options') ) : ?>
        <!-- HTML -->
    
        <div class="wrap">

            <form action="" method="post">

                <input type="text" placeholder="Texto">

                <?php submit_button('Enviar'); ?>    
                
            </form>

        </div>

        <?php else: ?>

        <p>
            No tienes acceso a esta sección
        </p>

        <?php endif; ?>

        <?php
    
     }
    
}

if( ! function_exists( 'submenu1_sc_pruebas_page_display' ) ) {

    function submenu1_sc_pruebas_page_display() {
        
        ?>

        <?php if( current_user_can('manage_options') ) : ?>
        <!-- HTML -->
       
        <div class="wrap">
            
            <h1>Esta es la pagina del submenu 1 de MP Pruebas </h1>

            <form action="" method="post">

                <input type="text" placeholder="Texto">

                <?php submit_button('Enviar'); ?>    
                
            </form>

        </div>

        <?php else: ?>

        <p>
            No tienes acceso a esta sección
        </p>

        <?php endif; ?>

        <?php
    
     }
    
}

add_filter( 'the_title', 'sc_filtro_titulo', 10 , 2 );

function sc_filtro_titulo( $title, $post_id ) {
    
    return "El titulo: $title, Ha sido filtrado y el ID es: $post_id ";
   
}

do_action( 'save_post', $post->ID, $post );

    
add_action('save_post', 'wporg_custom', 10, 2);
    
function funcion_callback_save_post( $post_id, $post ) {
    
    if( wp_is_post_revision( $post_id ) ) {
        return;
    }
    
    $autor_id = $post->post_autor;
    $name_autor = get_the_author_meta( 'display_name', $autor_id );
    $email_autor = get_the_author_meta( 'user_email', $autor_id );
    $title = $post->title;
    $permalink = get_permalink( $post_id );
    
    // Valores para el envio del email 
    $para [] = sprintf( '%s <%s>', $name_autor, $email_autor );
    $asunto = sprintf( 'Publicacion guardada: %s' , $title );
    $mensaje = sprintf( 'Felicitaciones, %s! su publicacion "%s" ha sido guardada,' . "\n\n", $name_autor, $title);
    $mensaje .= sprintf( 'Ver publicacion: %s', $permalink );
    $headers[] = '';
                       
    wp_mail( $para, $asunto, $mensaje, $headers);
    
}

add_action( 'publish_mis_publicaciones', 'notificacion_email_post_publicado', 10, 2);
    
function notificacion_email_post_publicado( $post_id, $post ) {
    
    $autor_id = $post->post_autor;
    $name_autor = get_the_author_meta( 'display_name', $autor_id );
    $email_autor = get_the_author_meta( 'user_email', $autor_id );
    $title = $post->title;
    $permalink = get_permalink( $post_id );
    
    // Valores para el envio del email 
    $para [] = sprintf( '%s <%s>', $name_autor, $email_autor );
    $asunto = sprintf( 'Publicacion guardada: %s' , $title );
    $mensaje = sprintf( 'Felicitaciones, %s! su publicacion "%s" ha sido guardada,' . "\n\n", $name_autor, $title);
    $mensaje .= sprintf( 'Ver publicacion: %s', $permalink );
    $headers[] = '';
                       
    wp_mail( $para, $asunto, $mensaje, $headers);
    
}

add_action( 'comment_post', 'notificacion_email_comentarios', 10, 2);

function notificacion_email_comentarios( $comment_ID,  $comment_aproved ) {
    $comment_approved = "";
    if( 1 === $comment_approved ) {
 
        
        
    }
    
}