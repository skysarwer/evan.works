<?php

function evn_do_homepage_hero() {
    ob_start(); ?>

    <div class="homepage-hero">
        <div class="content-wrap homepage-content">
            <div>
                <h1><?php _e('Websites built on <br/> strong foundations', 'evn');?></h1>
                <p><?php _e('Hi, my name is Evan. I build systems that are tailor fit to the needs of the individuals that I work with.', 'evn');?></p>
                <p><?php _e('I love solving complex problems in pursuit of ambitious designs.  I strive to provide work that is scalable, practical and which endures the test of time.', 'evn');?></p>
                <button class="cta"><?php _e('Work with me', 'evn');?></button>
            </div>
        </div>
    </div>
    <?php echo ob_get_clean();
}