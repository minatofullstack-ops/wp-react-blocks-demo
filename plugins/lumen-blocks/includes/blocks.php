<?php
/**
 * Block registration.
 *
 * All block metadata lives in block.json. `wp-scripts build --blocks-manifest`
 * compiles every block.json into build/blocks-manifest.php so WordPress can
 * register the whole collection without reading each JSON file on every request.
 *
 * @package LumenBlocks
 */

defined( 'ABSPATH' ) || exit;

/**
 * Register every block found in build/blocks.
 */
function lumen_blocks_register_blocks() {
	$blocks_dir = LUMEN_BLOCKS_DIR . 'build/blocks';
	$manifest   = LUMEN_BLOCKS_DIR . 'build/blocks-manifest.php';

	if ( ! file_exists( $manifest ) ) {
		// The plugin was cloned from Git but `npm run build` has not been run yet.
		return;
	}

	// WordPress 6.8+.
	if ( function_exists( 'wp_register_block_types_from_metadata_collection' ) ) {
		wp_register_block_types_from_metadata_collection( $blocks_dir, $manifest );
		return;
	}

	// WordPress 6.7 fallback.
	if ( function_exists( 'wp_register_block_metadata_collection' ) ) {
		wp_register_block_metadata_collection( $blocks_dir, $manifest );
	}
	$manifest_data = require $manifest;
	foreach ( array_keys( $manifest_data ) as $block_type ) {
		register_block_type( $blocks_dir . '/' . $block_type );
	}
}
add_action( 'init', 'lumen_blocks_register_blocks' );

/**
 * Add a dedicated inserter category so editors find the brand blocks quickly.
 *
 * @param array[] $categories Registered block categories.
 * @return array[]
 */
function lumen_blocks_block_category( $categories ) {
	array_unshift(
		$categories,
		array(
			'slug'  => 'lumen',
			'title' => __( 'ルーメン', 'lumen-blocks' ),
			'icon'  => null,
		)
	);
	return $categories;
}
add_filter( 'block_categories_all', 'lumen_blocks_block_category' );
