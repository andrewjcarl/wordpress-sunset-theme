<?php
/**
 * The archive template file 
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package WordPress
 * @subpackage sunset-theme
 * @since 1.0.0
 */

get_header();

$archive_title    = get_the_archive_title();
$archive_subtitle = get_the_archive_description();

?>

<main id="site-content" role="main">

    <section class="header-card entry-content">
        <div class="card-inner">
            <h3><?php echo $archive_title; ?></h3>
            <?php
            //  Category description 
            if ( isset( $archive_subtitle ) ) :
                echo $archive_subtitle; 
            endif;
            ?>
        </div>
    </section>

    <section class="loop">
        <?php 
        if ( have_posts() ) :
            while ( have_posts() ) {
                the_post();
                get_template_part( 'template-parts/content-excerpt', get_post_type() );
            }
        endif;
        ?>
    </section>

    <section>
        <?php get_template_part( 'template-parts/pagination' ); ?>
    </section>

</main>

<?php 
get_footer(); 
?>