<?php 
$categories = get_the_category();

if ( ! empty( $categories) ) :
?>
    <div class="entry-categories">
        <?php 
        foreach( $categories as $category ) : 
        ?>
            <a class="category-<?php echo strtolower($category->name); ?>" href="<?php echo esc_url( get_term_link( $category->term_id ) ); ?>"><?php echo $category->name; ?></a>
        <?php
        endforeach;
        ?>
    </div>
<?php
endif;

?>