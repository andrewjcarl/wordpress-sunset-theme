<section id="home-intro">
    <div class="banner">
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
    </div>
    <div class="content-padding">

        <h1>Hello, I'm Andrew.</h1>

        <h3>
            I am a San Diego-based freelance Wordpress and WooCommerce developer.  
            In the past I managed software engineers and shipped renewable energy with SolarCity and Tesla. 
        </h3>

        <h3>
            Drop me a line if you’re interested in working with me.
        </h3>

    </div>
</section>

<section id="home-loop">
    <h3>I also write things on occasion.</h3>

    <div class="loop">
    <?php 
        $posts = get_posts(array( 
            'posts_per_page'    => 10,
            'post_type'         => 'post',
            'post_status'       => 'publish',
            'sort_order'        => 'asc'
        ));

        if ( $posts ) :
            foreach( $posts as $post ) :
                setup_postdata( $post );
                $url = get_the_permalink();
                ?>
                    <div class="loop-single">
                        <h3>
                            <a href="<?php echo esc_url($url); ?>"><?php the_title(); ?></a>
                        </h3>
                        <div class="post-date">
                            <?php echo sprintf(__('Posted on %s', 'andrewcarl'), get_the_date()); ?>
                        </div>
                        <aside>
                            <?php the_excerpt(); ?>
                        </aside>
                        <a class="arrow-button">
                            <?php get_theme_svg('long-arrow-right-light', 'font-awesome'); ?>
                        </a>
                    </div>
                <?php
            endforeach;
            wp_reset_postdata();
        endif;
    ?>
    </div>

</section>