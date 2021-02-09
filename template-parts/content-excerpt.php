<?php
$url = get_the_permalink();
$post_thumbnail = '';

if ( has_post_thumbnail() ) {
    $post_thumbnail = get_the_post_thumbnail( get_the_ID(), 'medium_size_h' );
}

?>

<article <?php post_class(); ?> id="post-<?php the_ID(); ?>">

    <?php 
    if ( ! empty( $post_thumbnail ) ) {
        echo $post_thumbnail;
    }
    ?>

    <?php get_template_part( 'template-parts/category-list' ); ?>

    <div class="article-inner">
        <h3 class="entry-title">
            <a href="<?php echo esc_url( $url ); ?>"><?php the_title(); ?></a>
        </h3>

        <div class="post-date">
            <?php echo sprintf( __( 'Posted on %s', 'andrewcarl' ), get_the_date() ); ?>
        </div>

        <aside>
            <?php the_excerpt(); ?>
        </aside>
    </div>

</article>