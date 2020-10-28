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
    <?php 
    if ( is_singular( 'post' ) ) : ?>
        <h1 class="entry-title"><?php the_title(); ?></h1>
        <h6 class="entry-date">
            <?php 
                printf(
                    __( 'Posted on %s', 'kaneh-theme'),
                    esc_html( get_the_date() )
                );
            ?>
        </h6>
    <?php 
    endif; 
    ?>

    <div class="post-inner entry-content">
        <?php the_content( __( 'Continue reading', 'andrewcarl' ) ); ?>
    </div>

</article>