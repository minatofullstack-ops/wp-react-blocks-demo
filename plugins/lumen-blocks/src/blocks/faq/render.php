<?php
/**
 * Server-side rendering of lumen/faq.
 *
 * The parent owns the interactive region (keyboard navigation between
 * questions) and optionally prints FAQPage structured data built from its
 * child items, so the JSON-LD always matches what is on the page.
 *
 * @package LumenBlocks
 *
 * @var array    $attributes Block attributes.
 * @var string   $content    Rendered inner blocks (lumen/faq-item).
 * @var WP_Block $block      Block instance.
 */

defined( 'ABSPATH' ) || exit;

$lumen_wrapper = get_block_wrapper_attributes( array( 'class' => 'lumen-faq' ) );
?>
<div <?php echo $lumen_wrapper; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- escaped by get_block_wrapper_attributes(). ?> data-wp-interactive="lumen/faq" data-wp-on--keydown="actions.onKeydown">
	<?php echo $content; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- rendered inner blocks. ?>
</div>
<?php
if ( ! empty( $attributes['outputSchema'] ) ) {
	$lumen_entities = array();

	foreach ( $block->inner_blocks as $lumen_item ) {
		if ( 'lumen/faq-item' !== $lumen_item->name || empty( $lumen_item->attributes['question'] ) ) {
			continue;
		}
		$lumen_answer = '';
		foreach ( $lumen_item->inner_blocks as $lumen_answer_block ) {
			$lumen_answer .= $lumen_answer_block->render();
		}
		$lumen_entities[] = array(
			'@type'          => 'Question',
			'name'           => wp_strip_all_tags( $lumen_item->attributes['question'] ),
			'acceptedAnswer' => array(
				'@type' => 'Answer',
				'text'  => trim( wp_strip_all_tags( $lumen_answer ) ),
			),
		);
	}

	if ( $lumen_entities ) {
		printf(
			'<script type="application/ld+json">%s</script>',
			wp_json_encode(
				array(
					'@context'   => 'https://schema.org',
					'@type'      => 'FAQPage',
					'mainEntity' => $lumen_entities,
				),
				JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES | JSON_HEX_TAG | JSON_HEX_AMP
			)
		);
	}
}
