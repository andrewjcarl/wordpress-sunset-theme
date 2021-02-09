<?php

$next_post = get_next_post();
$prev_post = get_previous_post();

if ( $next_post || $prev_post ) {

	$pagination_classes = '';

	if ( ! $next_post ) {
		$pagination_classes = ' only-one only-prev';
	} elseif ( ! $prev_post ) {
		$pagination_classes = ' only-one only-next';
	}

	?>

	<nav class="pagination-single section-inner<?php echo esc_attr( $pagination_classes ); ?>" aria-label="<?php esc_attr_e( 'Post', 'twentytwenty' ); ?>" role="navigation">
		<h3>More like this</h3>
		<div class="pagination-single-inner">

			<?php
			if ( $prev_post ) {
			?>
				<article class="previous-post loop-article">
					<h3>
						<a href="<?php echo esc_url( get_permalink( $prev_post->ID ) ); ?>">
							<?php echo wp_kses_post( get_the_title( $prev_post->ID ) ); ?>
						</a>
					</h3>
					<?php echo esc_html( get_the_excerpt( $prev_post->ID ) ); ?>
				</article>
			<?php
			}

			if ( $next_post ) {
			?>
				<article class="next-post loop-article">
					<h3>
						<a href="<?php echo esc_url( get_permalink( $next_post->ID ) ); ?>">
							<?php echo wp_kses_post( get_the_title( $next_post->ID ) ); ?>
						</a>
					</h3>
					<?php echo esc_html( get_the_excerpt( $next_post->ID ) ); ?>
				</article>
			<?php
			}
			?>

		</div><!-- .pagination-single-inner -->
	</nav><!-- .pagination-single -->

	<?php
}
