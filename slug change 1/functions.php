function post_callback() {
    // do something
}
add_action( 'init', 'post_callback' );

function post_custom( $post_id, $post ) {
    // do something
}