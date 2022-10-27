<?php 

function evn_render_services() {

    wp_enqueue_style( 'service-icons', get_stylesheet_directory_uri() . '/css/service-icons.css' ); 
    ob_start();
    ?>
        <div class="services-cont"> 
        
            <div id="web-development" class="service"> 
                <?php echo evn_webdev_svg(); ?>
                <h3> <?php _e('Web Development', 'evn');?> </h3>
            </div>
            <div id="web-design" class="service"> 
                <?php echo evn_webdesignalt_svg(); ?>
                <h3> <?php _e('Web Design', 'evn');?> </h3>
            </div>
            <div id="interactive-graphics" class="service"> 
                <?php echo evn_graphics_svg(); ?>
                <h3> <?php _e('Interactive Graphics', 'evn');?> </h3>
            </div>
            <div id="analytics" class="service"> 
                <?php echo evn_analytics_svg(); ?>
                <h3> <?php _e('Analytics', 'evn');?> </h3>
            </div>
            <div id="e-commerce" class="service"> 
                <?php echo evn_ecommerce_svg(); ?>
                <h3> <?php _e('E-Commerce', 'evn');?> </h3>
            </div>
            <div id="documentation" class="service"> 
                <?php echo evn_documentation_svg(); ?>
                <h3> <?php _e('Documentation', 'evn');?> </h3>
            </div>
    </div>    
<?php 
    $content = ob_get_contents();
    ob_end_clean();
    return $content;
}

add_shortcode('evn_render_services', 'evn_render_services');
