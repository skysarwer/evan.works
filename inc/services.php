<?php 

function evn_render_service($title, $svg, $content, $tooltip_class) {
    $slug = str_replace(' ', '-', strtolower($title));
    ob_start(); ?>
        <div id="<?php echo $slug;?>" class="service"> 
            <!--- Disable tooltip for now 
            <button class="tooltip-trigger">
                <?php echo $svg; ?>
                <h3> <?php echo $title;?> </h3>
            </button>
            <div class="tooltip <?php echo $tooltip_class;?>">
                <h3> <?php echo $title;?> </h3>
                <div class="tooltip-content">
                    <?php echo $svg; ?>
                    <div>
                        <?php echo $content; ?>
                    </div>
                </div>
            </div>-->
            <div class="tooltip-trigger">
                <?php echo $svg; ?>
                <h3> <?php echo $title;?> </h3>
            </div>
        </div >
    <?php
    $content = ob_get_contents();
    ob_end_clean();
    return $content;
}

function evn_render_services() {
    
    wp_enqueue_style( 'service-icons', get_stylesheet_directory_uri() . '/css/service-icons.css' ); 

    $all_services = array(
        'Web Development' => array(
            'svg' => evn_webdev_svg(),
            'content' => '                      
                <p>Hey hey hey hey hey hey hey </p>
                <p>Hey hey hey hey hey hey hey </p>
                <p>Hey hey hey hey hey hey hey </p>
            ',
            'tooltip_class' => 'd-t d-l m-l m-t',
        ),
        'Web Design' => array(
            'svg' => evn_webdesignalt_svg(),
            'content' => '
                <p>I can work with you to build thorough, high quality designs, informed by your existing brand assets, that integrate seemlessly with your page building workflow.</p>
            ',
            'tooltip_class' => 'd-t d-m m-r m-t',
        ),
        'Interactive Graphics' => array(
            'svg' => evn_graphics_svg(),
            'content' => '<div>                      
                <p>Hey hey hey hey hey hey hey </p>
                <p>Hey hey hey hey hey hey hey </p>
                <p>Hey hey hey hey hey hey hey </p>
            </div>',
            'tooltip_class' => 'd-b m-b d-r m-l',
        ),
        'Analytics' => array(
            'svg' => evn_analytics_svg(),
            'content' => '<div>                      
                <p>Hey hey hey hey hey hey hey </p>
                <p>Hey hey hey hey hey hey hey </p>
                <p>Hey hey hey hey hey hey hey </p>
            </div>',
            'tooltip_class' => 'd-b m-b m-r d-l',
        ),
        'E-Commerce' => array(
            'svg' => evn_ecommerce_svg(),
            'content' => '<div>                      
                <p>Hey hey hey hey hey hey hey </p>
                <p>Hey hey hey hey hey hey hey </p>
                <p>Hey hey hey hey hey hey hey </p>
            </div>',
            'tooltip_class' => 'd-b m-b m-l d-m',
        ),
        'Documentation' => array(
            'svg' => evn_documentation_svg(),
            'content' => '<div>                      
                <p>Hey hey hey hey hey hey hey </p>
                <p>Hey hey hey hey hey hey hey </p>
                <p>Hey hey hey hey hey hey hey </p>
            </div>',
            'tooltip_class' => 'd-b m-b m-r d-r',
        ),
    );

    ob_start();
    ?>
        <div class="services-cont"> 
        
            <?php foreach ($all_services as $service => $data) {
                echo evn_render_service($service, $data['svg'], $data['content'], $data['tooltip_class']);
            }?>
            
        </div>    
<?php 
    $content = ob_get_contents();
    ob_end_clean();
    return $content;
}

add_shortcode('evn_render_services', 'evn_render_services');
