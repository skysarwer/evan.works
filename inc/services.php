<?php 

function evn_render_services() {

    wp_enqueue_style( 'service-icons', get_stylesheet_directory_uri() . '/css/service-icons.css' ); 
    ob_start();
    ?>
        <div class="services-cont"> 
        
            <div  id="web-development" class="service"> 
                <button class="tooltip-trigger">
                    <?php echo evn_webdev_svg(); ?>
                    <h3> <?php _e('Web Development', 'evn');?> </h3>
                </button>
                <div class="tooltip d-t d-l m-l m-t">
                    <h3> <?php _e('Web Development', 'evn');?> </h3>
                    <div class="tooltip-content">
                        <?php echo evn_webdev_svg(); ?> 
                        <div>                      
                            <p>Hey hey hey hey hey hey hey </p>
                            <p>Hey hey hey hey hey hey hey </p>
                            <p>Hey hey hey hey hey hey hey </p>
                        </div>
                    </div>
                </div>
            </div >
            <div id="web-design" class="service"> 
                <button class="tooltip-trigger">
                    <?php echo evn_webdesignalt_svg(); ?>
                    <h3> <?php _e('Web Design', 'evn');?> </h3>
                </button>
                <div class="tooltip d-t d-m m-r m-t">
                    <h3> <?php _e('Web Design', 'evn');?> </h3>
                    <div class="tooltip-content">
                        <?php echo evn_webdesignalt_svg(); ?>
                        <div>
                            <p>I can work with you to build thorough, high quality designs, informed by your existing brand assets, that integrate seemlessly with your page building workflow.</p>
                        </div>
                    </div>
                </div>
            </div >
            <div  id="interactive-graphics" class="service"> 
                <?php echo evn_graphics_svg(); ?>
                <h3> <?php _e('Interactive Graphics', 'evn');?> </h3>
                <div class="tooltip d-b m-b d-r m-l">
                    <h3> <?php _e('Interactive Graphics', 'evn');?> </h3>
                    <div class="tooltip-content">
                        <?php echo evn_graphics_svg(); ?>
                        <div>
                            <p>Hey hey hey hey hey hey hey </p>
                            <p>Hey hey hey hey hey hey hey </p>
                            <p>Hey hey hey hey hey hey hey </p>
                        </div>
                    </div>
                </div>
            </div >
            <div  id="analytics" class="service"> 
                <?php echo evn_analytics_svg(); ?>
                <h3> <?php _e('Analytics', 'evn');?> </h3>
                <div class="tooltip  d-b m-b m-r d-l">
                    <div class="tooltip-content">
                        <?php echo evn_analytics_svg(); ?>
                        <div>
                            <p>Hey hey hey hey hey hey hey </p>
                            <p>Hey hey hey hey hey hey hey </p>
                            <p>Hey hey hey hey hey hey hey </p>
                        </div>
                    </div>
                </div>
            </div >
            <div  id="e-commerce" class="service"> 
                <?php echo evn_ecommerce_svg(); ?>
                <h3> <?php _e('E-Commerce', 'evn');?> </h3>
                <div class="tooltip d-b m-b m-l d-m">
                    <h3> <?php _e('E-Commerce', 'evn');?> </h3>
                    <div class="tooltip-content">
                        <?php echo evn_ecommerce_svg(); ?>
                        <div>
                            <p>Hey hey hey hey hey hey hey </p>
                            <p>Hey hey hey hey hey hey hey </p>
                            <p>Hey hey hey hey hey hey hey </p>
                        </div>
                    </div>
                </div>
            </div >
            <div  id="documentation" class="service"> 
                <?php echo evn_documentation_svg(); ?>
                <h3> <?php _e('Documentation', 'evn');?> </h3>
                <div class="tooltip d-b m-b m-r d-r">
                    <h3> <?php _e('Documentation', 'evn');?> </h3>
                    <div class="tooltip-content">
                        <?php echo evn_documentation_svg(); ?>
                        <div>
                            <p>Hey hey hey hey hey hey hey </p>
                            <p>Hey hey hey hey hey hey hey </p>
                            <p>Hey hey hey hey hey hey hey </p>
                        </div>
                    </div>
                </div>
            </div>
    </div>    
<?php 
    $content = ob_get_contents();
    ob_end_clean();
    return $content;
}

add_shortcode('evn_render_services', 'evn_render_services');
