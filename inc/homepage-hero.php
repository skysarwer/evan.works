<?php

function evn_do_homepage_hero() {
    ob_start(); ?>

    <div class="homepage-hero">
        <div class="content-wrap">
            <div class="homepage-content">

                <div>
                    <h1><?php _e('Hi, my name is Evan', 'evn');?></h1>
                    <p><?php _e('I build professional websites, tailor fit to the needs of both the people that I work with and their end users.', 'evn');?></p>
                    <p><?php _e('I love solving complex problems in pursuit of ambitious designs. I strive to provide work that is scalable, practical and user friendly.', 'evn');?></p>
                    <button class="cta" type="button" data-a11y-dialog-show="contact_cta"><?php _e('Work with me', 'evn');?> <?php echo evn_cta_arrow_svg();?></button>
                    <a class="button" href="#primary"><?php _e('Learn more', 'evn');?> <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" aria-hidden="true" focusable="false" fill="transparent" stroke="currentColor"><path stroke="none" d="M0 0h24v24H0z"></path><polyline points="9 6 15 12 9 18"></polyline></svg></a>
                </div>
                <figure id="portrait">
                    <img src="<?php echo get_theme_file_uri('img/evan_b_portrait.jpg');?>"  alt="Portrait of Evan Buckiewicz" srcset="<?php echo get_theme_file_uri('img/evan_b_portrait-scaled.jpg');?>" draggable="false">
                </figure>
            </div>
            <div class="homepage-bottom">
                <div class="content-wrap">
                    <div class="social-media">
                        <a class="icon" href="https://linkedin.com/in/evanbuckiewicz" target="_blank" title="LinkedIN"><?php echo evn_svg_linkedin();?><span class="screen-reader-text">LinkedIN</span></a>
                        <a class="icon" href="https://github.com/skysarwer" target="_blank" title="Github"><?php echo evn_svg_github();?><span class="screen-reader-text">Github</span></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php echo ob_get_clean();
}