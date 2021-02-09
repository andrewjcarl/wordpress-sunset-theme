<section id="home-intro" class="header-card">

    <div class="banner">
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
    </div>

    <div class="card-inner">
        <h1>Hello, I'm Andrew.</h1>
        <h3>I am a San Diego-based freelance Wordpress and WooCommerce developer.</h3> 
        <h3>In the past I managed software engineers and shipped renewable energy with SolarCity and Tesla.</h3>
    </div>

</section>

<section id="home-loop">

    <h3 class="section-title">I also write things on occasion.</h3>

    <div class="loop columns">
    <?php 
        $posts = get_posts( array( 
            'posts_per_page'    => 10,
            'post_type'         => 'post',
            'post_status'       => 'publish',
            'sort_order'        => 'asc'
        ) );

        if ( $posts ) :
            foreach( $posts as $post ) :
                setup_postdata( $post );
                get_template_part( 'template-parts/content-excerpt' );
            endforeach;
            wp_reset_postdata();
        endif;
    ?>
    </div>

</section>