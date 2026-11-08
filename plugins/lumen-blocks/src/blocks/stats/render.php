<?php
/**
 * Server-side rendering of lumen/stats.
 *
 * The final numbers are rendered by PHP, so they are visible to search
 * engines, screen readers and visitors without JavaScript. The view module
 * (view.js, Interactivity API) only animates the visible digits.
 *
 * @package LumenBlocks
 *
 * @var array    $attributes Block attributes.
 * @var string   $content    Block content.
 * @var WP_Block $block      Block instance.
 */

defined( 'ABSPATH' ) || exit;

$lumen_items    = isset( $attributes['items'] ) && is_array( $attributes['items'] ) ? $attributes['items'] : array();
$lumen_duration = isset( $attributes['duration'] ) ? max( 0, min( 5000, (int) $attributes['duration'] ) ) : 1600;

if ( empty( $lumen_items ) ) {
	return;
}

$lumen_wrapper = get_block_wrapper_attributes(
	array(
		'class' => 'lumen-stats has-' . count( $lumen_items ) . '-items',
	)
);
?>
<div <?php echo $lumen_wrapper; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- escaped by get_block_wrapper_attributes(). ?> data-wp-interactive="lumen/stats">
	<dl class="lumen-stats__list">
		<?php
		foreach ( $lumen_items as $lumen_item ) :
			$lumen_value     = isset( $lumen_item['value'] ) ? (float) $lumen_item['value'] : 0;
			$lumen_decimals  = isset( $lumen_item['decimals'] ) ? max( 0, min( 2, (int) $lumen_item['decimals'] ) ) : 0;
			$lumen_prefix    = isset( $lumen_item['prefix'] ) ? (string) $lumen_item['prefix'] : '';
			$lumen_suffix    = isset( $lumen_item['suffix'] ) ? (string) $lumen_item['suffix'] : '';
			$lumen_label     = isset( $lumen_item['label'] ) ? (string) $lumen_item['label'] : '';
			$lumen_formatted = number_format( $lumen_value, $lumen_decimals );
			$lumen_context   = array(
				'target'   => $lumen_value,
				'decimals' => $lumen_decimals,
				'duration' => $lumen_duration,
				'display'  => $lumen_formatted,
			);
			?>
			<div class="lumen-stats__item" <?php echo wp_interactivity_data_wp_context( $lumen_context ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- escaped by the API. ?> data-wp-init="callbacks.init">
				<dt class="lumen-stats__label"><?php echo wp_kses_post( $lumen_label ); ?></dt>
				<dd class="lumen-stats__value">
					<span class="screen-reader-text"><?php echo esc_html( $lumen_prefix . $lumen_formatted . $lumen_suffix ); ?></span>
					<span aria-hidden="true">
						<?php if ( '' !== $lumen_prefix ) : ?>
							<span class="lumen-stats__affix"><?php echo esc_html( $lumen_prefix ); ?></span>
						<?php endif; ?>
						<span class="lumen-stats__number" data-wp-text="context.display"><?php echo esc_html( $lumen_formatted ); ?></span>
						<?php if ( '' !== $lumen_suffix ) : ?>
							<span class="lumen-stats__affix"><?php echo esc_html( $lumen_suffix ); ?></span>
						<?php endif; ?>
					</span>
				</dd>
			</div>
		<?php endforeach; ?>
	</dl>
</div>
