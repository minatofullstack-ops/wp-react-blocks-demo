<?php
/**
 * Server-side rendering of lumen/works (導入事例一覧).
 *
 * Dynamic because the output depends on other posts: new case studies appear
 * automatically, and the card markup can be redesigned without touching any
 * saved page.
 *
 * @package LumenBlocks
 *
 * @var array    $attributes Block attributes.
 * @var string   $content    Block content.
 * @var WP_Block $block      Block instance.
 */

defined( 'ABSPATH' ) || exit;

$lumen_count    = isset( $attributes['count'] ) ? max( 1, min( 12, (int) $attributes['count'] ) ) : 3;
$lumen_columns  = isset( $attributes['columns'] ) ? max( 1, min( 4, (int) $attributes['columns'] ) ) : 3;
$lumen_category = isset( $attributes['category'] ) ? sanitize_key( $attributes['category'] ) : '';
$lumen_excerpt  = ! isset( $attributes['showExcerpt'] ) || (bool) $attributes['showExcerpt'];

$lumen_query_args = array(
	'post_type'           => 'works',
	'post_status'         => 'publish',
	'posts_per_page'      => $lumen_count,
	'no_found_rows'       => true,
	'ignore_sticky_posts' => true,
);

if ( '' !== $lumen_category ) {
	// phpcs:ignore WordPress.DB.SlowDBQuery.slow_db_query_tax_query -- small, cached query on a dedicated taxonomy.
	$lumen_query_args['tax_query'] = array(
		array(
			'taxonomy' => 'works_category',
			'field'    => 'slug',
			'terms'    => $lumen_category,
		),
	);
}

$lumen_query = new WP_Query( $lumen_query_args );

$lumen_wrapper = get_block_wrapper_attributes(
	array(
		'class' => 'lumen-works has-' . $lumen_columns . '-columns',
	)
);
?>
<div <?php echo $lumen_wrapper; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- escaped by get_block_wrapper_attributes(). ?>>
	<?php if ( $lumen_query->have_posts() ) : ?>
		<ul class="lumen-works__list">
			<?php
			while ( $lumen_query->have_posts() ) :
				$lumen_query->the_post();
				$lumen_terms  = get_the_terms( get_the_ID(), 'works_category' );
				$lumen_client = get_post_meta( get_the_ID(), 'lumen_client', true );
				$lumen_result = get_post_meta( get_the_ID(), 'lumen_result', true );
				?>
				<li class="lumen-works__item">
					<article class="lumen-work-card">
						<div class="lumen-work-card__thumb">
							<?php
							if ( has_post_thumbnail() ) {
								the_post_thumbnail(
									'medium_large',
									array(
										'alt'     => '',
										'loading' => 'lazy',
									)
								);
							}
							?>
						</div>
						<div class="lumen-work-card__body">
							<?php if ( $lumen_terms && ! is_wp_error( $lumen_terms ) ) : ?>
								<p class="lumen-work-card__category"><?php echo esc_html( $lumen_terms[0]->name ); ?></p>
							<?php endif; ?>
							<h3 class="lumen-work-card__title">
								<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
							</h3>
							<?php if ( $lumen_client ) : ?>
								<p class="lumen-work-card__client"><?php echo esc_html( $lumen_client ); ?></p>
							<?php endif; ?>
							<?php if ( $lumen_excerpt && has_excerpt() ) : ?>
								<p class="lumen-work-card__excerpt"><?php echo esc_html( get_the_excerpt() ); ?></p>
							<?php endif; ?>
							<?php if ( $lumen_result ) : ?>
								<p class="lumen-work-card__result">
									<span class="lumen-work-card__result-label"><?php esc_html_e( '成果', 'lumen-blocks' ); ?></span>
									<?php echo esc_html( $lumen_result ); ?>
								</p>
							<?php endif; ?>
						</div>
					</article>
				</li>
			<?php endwhile; ?>
		</ul>
		<?php wp_reset_postdata(); ?>
	<?php else : ?>
		<p class="lumen-works__empty"><?php esc_html_e( '表示できる導入事例がまだありません。', 'lumen-blocks' ); ?></p>
	<?php endif; ?>
</div>
