<?php
/**
 * Lumen block theme.
 *
 * The theme is presentation only: templates, template parts, patterns and
 * design tokens. Content structures (custom blocks, the works post type) live
 * in the Lumen Blocks plugin so that content survives a theme change.
 *
 * @package Lumen
 */

defined( 'ABSPATH' ) || exit;

define( 'LUMEN_THEME_VERSION', wp_get_theme()->get( 'Version' ) );

/**
 * Theme supports and editor styles.
 */
function lumen_setup() {
	load_theme_textdomain( 'lumen', get_template_directory() . '/languages' );

	add_theme_support( 'editor-styles' );
	add_editor_style(
		array(
			'assets/fonts/noto-sans-jp.css',
			'assets/css/theme.css',
		)
	);

	// Patterns are curated by the theme (patterns/ directory).
	remove_theme_support( 'core-block-patterns' );
}
add_action( 'after_setup_theme', 'lumen_setup' );

/**
 * Front-end styles.
 */
function lumen_enqueue_assets() {
	wp_enqueue_style(
		'lumen-noto-sans-jp',
		get_theme_file_uri( 'assets/fonts/noto-sans-jp.css' ),
		array(),
		LUMEN_THEME_VERSION
	);
	wp_enqueue_style(
		'lumen-theme',
		get_theme_file_uri( 'assets/css/theme.css' ),
		array(),
		LUMEN_THEME_VERSION
	);
}
add_action( 'wp_enqueue_scripts', 'lumen_enqueue_assets' );

/**
 * Preload the latin + kana subsets that every page uses.
 */
function lumen_preload_fonts() {
	printf(
		'<link rel="preload" href="%s" as="font" type="font/woff2" crossorigin>' . "\n",
		esc_url( get_theme_file_uri( 'assets/fonts/inter/inter-latin-wght-normal.woff2' ) )
	);
}
add_action( 'wp_head', 'lumen_preload_fonts', 1 );

/**
 * Pattern categories shown in the inserter.
 */
function lumen_register_pattern_categories() {
	register_block_pattern_category(
		'lumen-sections',
		array(
			'label'       => __( 'ルーメン：セクション', 'lumen' ),
			'description' => __( 'ページに挿入できるブランド用セクション。', 'lumen' ),
		)
	);
	register_block_pattern_category(
		'lumen-pages',
		array(
			'label'       => __( 'ルーメン：ページ', 'lumen' ),
			'description' => __( '新規ページの雛形（LP・会社案内など）。', 'lumen' ),
		)
	);
}
add_action( 'init', 'lumen_register_pattern_categories' );

/**
 * Block style variations that complement theme.json.
 */
function lumen_register_block_styles() {
	register_block_style(
		'core/group',
		array(
			'name'  => 'lumen-card',
			'label' => __( 'カード', 'lumen' ),
		)
	);
	register_block_style(
		'core/paragraph',
		array(
			'name'  => 'lumen-eyebrow',
			'label' => __( '英字ラベル', 'lumen' ),
		)
	);
}
add_action( 'init', 'lumen_register_block_styles' );

/**
 * The theme expects the Lumen Blocks plugin. Remind administrators politely.
 */
function lumen_plugin_notice() {
	if ( defined( 'LUMEN_BLOCKS_VERSION' ) || ! current_user_can( 'activate_plugins' ) ) {
		return;
	}
	printf(
		'<div class="notice notice-warning"><p>%s</p></div>',
		esc_html__( 'Lumen テーマのブロック（ヒーロー・導入事例など）を使うには、プラグイン「Lumen Blocks」を有効化してください。', 'lumen' )
	);
}
add_action( 'admin_notices', 'lumen_plugin_notice' );
