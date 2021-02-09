<?php
/**
 *  Template for displaying author information
 * 
 *  @since 1.0.0
 */

if ( (bool) get_the_author_meta( 'description' ) ) : 
?>

    <div class="entry-author">

        <div class="banner">
            <span></span>
            <span></span>
            <span></span>
            <span></span>
            <span></span>
        </div>
        
        <div class="entry-author-inner">
            
            <div class="entry-author-image">
                <img src="<?php echo esc_url( get_template_directory_uri() . '/assets/images/self-alt.jpg'); ?>" />
            </div>
            
            <div class="entry-author-social">
                <nav class="nav-author-social">
                    <ul class="menu-vertical">
                        <li>
                            <a href="https://github.com/andrewjcarl" target="_blank">
                                <?php echo get_theme_svg('github','social'); ?>
                                Github
                            </a>
                        </li>
                        <li>
                            <a href="https://www.linkedin.com/in/andrew-carl-47860120/" target="_blank">
                                <?php echo get_theme_svg('linkedin', 'social'); ?>
                                LinkedIn
                            </a>
                        </li>
                    </ul>
                </nav>
            </div>

            <div class="entry-author-content">    
                <div class="entry-author-title">
                    <h3>
                        <?php printf( __( 'About %s', 'andrewcarl' ), esc_html( get_the_author_meta( 'nickname' ) ) ); ?>
                    </h3>
                </div>
                <div class="entry-author-description">
                    <?php echo wp_kses_post( wpautop( get_the_author_meta( 'description' ) ) ); ?>
                </div>
            </div>
        </div>
    </div>

<?php
endif;
?>