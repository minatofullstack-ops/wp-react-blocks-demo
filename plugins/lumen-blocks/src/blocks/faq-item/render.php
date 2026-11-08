<?php
/**
 * Server-side rendering of lumen/faq-item.
 *
 * Accessible disclosure pattern: a real <button> with aria-expanded /
 * aria-controls toggles a labelled region. State is handled by the
 * Interactivity API store "lumen/faq" (see ../faq/view.js).
 *
 * @package LumenBlocks
 *
 * @var array    $attributes Block attributes.
 * @var string   $content    Rendered answer (inner blocks).
 * @var WP_Block $block      Block instance.
 */

defined( 'ABSPATH' ) || exit;

$lumen_question = isset( $attributes['question'] ) ? (string) $attributes['question'] : '';
if ( '' === trim( wp_strip_all_tags( $lumen_question ) ) ) {
	return;
}

$lumen_allowed = array(
	'strong' => array(),
	'em'     => array(),
	'br'     => array(),
);
$lumen_id      = wp_unique_id( 'lumen-faq-' );
$lumen_open    = ! empty( $attributes['openByDefault'] );
$lumen_wrapper = get_block_wrapper_attributes( array( 'class' => 'lumen-faq-item' ) );
?>
<div <?php echo $lumen_wrapper; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- escaped by get_block_wrapper_attributes(). ?>
	data-wp-interactive="lumen/faq"
	<?php echo wp_interactivity_data_wp_context( array( 'isOpen' => $lumen_open ) ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- escaped by the API. ?>
	data-wp-class--is-open="context.isOpen">
	<h3 class="lumen-faq-item__heading">
		<button
			type="button"
			class="lumen-faq-item__toggle"
			id="<?php echo esc_attr( $lumen_id ); ?>-button"
			aria-controls="<?php echo esc_attr( $lumen_id ); ?>-panel"
			data-wp-bind--aria-expanded="context.isOpen"
			data-wp-on--click="actions.toggle">
			<span class="lumen-faq-item__mark" aria-hidden="true">Q</span>
			<span class="lumen-faq-item__question"><?php echo wp_kses( $lumen_question, $lumen_allowed ); ?></span>
			<span class="lumen-faq-item__icon" aria-hidden="true"></span>
		</button>
	</h3>
	<div
		class="lumen-faq-item__panel"
		id="<?php echo esc_attr( $lumen_id ); ?>-panel"
		role="region"
		aria-labelledby="<?php echo esc_attr( $lumen_id ); ?>-button"
		data-wp-bind--hidden="!context.isOpen">
		<span class="lumen-faq-item__mark is-answer" aria-hidden="true">A</span>
		<div class="lumen-faq-item__answer">
			<?php echo $content; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- rendered inner blocks. ?>
		</div>
	</div>
</div>
