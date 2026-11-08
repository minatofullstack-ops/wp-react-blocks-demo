<?php
/**
 * Editor-only assets that are not tied to a single block.
 *
 * @package LumenBlocks
 */

defined( 'ABSPATH' ) || exit;

/**
 * Enqueue the "導入事例の情報" document panel (React, PluginDocumentSettingPanel)
 * on the works edit screen. It edits registered post meta through the REST API,
 * which takes care of authentication (REST nonce) and capability checks.
 */
function lumen_blocks_enqueue_editor_assets() {
	$screen = function_exists( 'get_current_screen' ) ? get_current_screen() : null;
	if ( ! $screen || 'works' !== $screen->post_type ) {
		return;
	}

	$asset_file = LUMEN_BLOCKS_DIR . 'build/editor/works-meta.asset.php';
	if ( ! file_exists( $asset_file ) ) {
		return;
	}
	$asset = require $asset_file;

	wp_enqueue_script(
		'lumen-works-meta',
		LUMEN_BLOCKS_URL . 'build/editor/works-meta.js',
		$asset['dependencies'],
		$asset['version'],
		true
	);
	wp_set_script_translations( 'lumen-works-meta', 'lumen-blocks', LUMEN_BLOCKS_DIR . 'languages' );
}
add_action( 'enqueue_block_editor_assets', 'lumen_blocks_enqueue_editor_assets' );
