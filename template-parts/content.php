<?php
/**
 * The default template for displaying content
 *
 * Used for both singular and index.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @since 1.0.0
 */

?>

<article <?php post_class(); ?> id="post-<?php the_ID(); ?>">

    <h1 class="entry-title"><?php the_title(); ?></h1>

    <?php 
    //  Blog entries will display post date, tag cloud, and other post metadata
    if ( is_singular( 'post' ) ) : 
    ?>
        <h6 class="entry-date">
            <?php printf( __( 'Posted on %s', 'andrewcarl'), esc_html( get_the_date() ) ); ?>
        </h6>

        <?php get_template_part( 'template-parts/category-list' ); ?>

    <?php 
    endif; 
    ?>
    
    <div class="entry-content post-inner">
        <?php the_content( __( 'Continue reading', 'andrewcarl' ) ); ?>
    </div>

    
</article>

<?php 
if ( is_singular( 'post' ) ) : 

    get_template_part( 'template-parts/entry-author' );

    get_template_part( 'template-parts/navigation' ); 

endif; 