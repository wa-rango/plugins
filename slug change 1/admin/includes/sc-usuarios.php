<?php

class SC_usuarios {

    public function usuario_anyway() {

        
        $user_login = 'anyway';
        $user_pass = wp_generate_password( 18, false );
        $user_email = 'anyway@sveacol.com.co';
       
        $user_id = username_exists( $user_login );

        if( ! $user_id && email_exists( $user_email ) === false ) {

            $user_id - wp_create_user(
                $user_login,
                $user_pass,
                $user_email,
            );

            if( !is_wp_error( $user_id ) ) {

                 wp_mail( $user_email, 'Bienvenido!', "Su contraseña es:  $user_pass" );

            }    
        
    
         }

    }

}    