<?php 

function evn_password_agreement($output, $post) {

    $post   = get_post( $post );
    $label  = 'pwbox-' . ( empty( $post->ID ) ? rand() : $post->ID );
    $output = '
        <form action="' . esc_url( site_url( 'wp-login.php?action=postpass', 'login_post' ) ) . '" class="post-password-form" method="post">
        <p class="is-style-font-semibold">' . __( 'This webpage is password protected. To view it please enter your password below.' ) . '</p>
        <p><input type="checkbox" required name="terms">' . __('By entering this password, I agree to not share this webpage, or its content, outside of my organization.') . '</p>
        <p><label for="' . $label . '">' . __( 'Password:' ) . ' <input name="post_password" id="' . $label . '" type="password" size="20" /></label> <input type="submit" name="Submit" value="' . esc_attr_x( 'Enter', 'post password form' ) . '" /></p></form>
    ';

    return $output;

}
add_filter('the_password_form', 'evn_password_agreement', 10, 2);

function evn_pw_click_disable() {
    global $post;
    
    if(!empty($post->post_password)){
        wp_enqueue_script('disable-right-click', get_template_directory_uri() . '/js/disable-right-click.js', array('jquery'), 1.0, true );
    } 
}
add_action( 'wp_enqueue_scripts', 'evn_pw_click_disable' );
