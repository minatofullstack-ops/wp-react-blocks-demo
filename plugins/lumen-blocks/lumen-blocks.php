<?php
/**
 * Plugin Name:       Lumen Blocks
 * Plugin URI:        https://github.com/minatofullstack-ops/wp-react-blocks-demo
 * Description:       ルーメン株式会社（架空）サイト用のカスタムブロック集と「導入事例」投稿タイプ。ポートフォリオ用デモ。
 * Version:           1.0.0
 * Requires at least: 6.8
 * Requires PHP:      7.4
 * Author:            minatofullstack-ops
 * License:           GPL-2.0-or-later
 * License URI:       https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain:       lumen-blocks
 * Domain Path:       /languages
 *
 * @package LumenBlocks
 */

defined( 'ABSPATH' ) || exit;

define( 'LUMEN_BLOCKS_VERSION', '1.0.0' );
define( 'LUMEN_BLOCKS_DIR', plugin_dir_path( __FILE__ ) );
define( 'LUMEN_BLOCKS_URL', plugin_dir_url( __FILE__ ) );

require_once LUMEN_BLOCKS_DIR . 'includes/post-types.php';
require_once LUMEN_BLOCKS_DIR . 'includes/blocks.php';
require_once LUMEN_BLOCKS_DIR . 'includes/editor.php';

if ( defined( 'WP_CLI' ) && WP_CLI ) {
	require_once LUMEN_BLOCKS_DIR . 'includes/class-demo-importer.php';
	WP_CLI::add_command( 'lumen-demo', 'Lumen_Blocks_Demo_Importer' );
}

/**
 * Flush rewrite rules on activation so /works/ works immediately.
 */
function lumen_blocks_activate() {
	lumen_blocks_register_post_types();
	flush_rewrite_rules();
}
register_activation_hook( __FILE__, 'lumen_blocks_activate' );

/**
 * Load translations (strings are authored in Japanese; other locales can be added under /languages).
 */
function lumen_blocks_load_textdomain() {
	load_plugin_textdomain( 'lumen-blocks', false, dirname( plugin_basename( __FILE__ ) ) . '/languages' );
}
add_action( 'init', 'lumen_blocks_load_textdomain', 0 );
