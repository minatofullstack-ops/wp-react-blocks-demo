<?php
/**
 * Custom post type "works" (導入事例), its taxonomy and post meta.
 *
 * Everything is registered with show_in_rest so the block editor,
 * block bindings and the dynamic "導入事例" block can use it.
 *
 * @package LumenBlocks
 */

defined( 'ABSPATH' ) || exit;

/**
 * Post meta keys exposed to the editor (sidebar panel) and block bindings.
 *
 * @return array<string, array{label: string, description: string}>
 */
function lumen_blocks_works_meta_fields() {
	return array(
		'lumen_client' => array(
			'label'       => __( 'クライアント（業種）', 'lumen-blocks' ),
			'description' => __( '例：BtoB SaaS企業', 'lumen-blocks' ),
		),
		'lumen_result' => array(
			'label'       => __( '成果ハイライト', 'lumen-blocks' ),
			'description' => __( '例：問い合わせ数 2.4倍', 'lumen-blocks' ),
		),
		'lumen_period' => array(
			'label'       => __( '支援期間', 'lumen-blocks' ),
			'description' => __( '例：6か月', 'lumen-blocks' ),
		),
	);
}

/**
 * Register the post type, taxonomy and meta.
 */
function lumen_blocks_register_post_types() {
	register_post_type(
		'works',
		array(
			'labels'        => array(
				'name'               => __( '導入事例', 'lumen-blocks' ),
				'singular_name'      => __( '導入事例', 'lumen-blocks' ),
				'add_new'            => __( '新規追加', 'lumen-blocks' ),
				'add_new_item'       => __( '導入事例を追加', 'lumen-blocks' ),
				'edit_item'          => __( '導入事例を編集', 'lumen-blocks' ),
				'view_item'          => __( '導入事例を表示', 'lumen-blocks' ),
				'all_items'          => __( '導入事例一覧', 'lumen-blocks' ),
				'search_items'       => __( '導入事例を検索', 'lumen-blocks' ),
				'not_found'          => __( '導入事例が見つかりません。', 'lumen-blocks' ),
				'not_found_in_trash' => __( 'ゴミ箱に導入事例はありません。', 'lumen-blocks' ),
			),
			'public'        => true,
			'has_archive'   => 'works',
			'rewrite'       => array(
				'slug'       => 'works',
				'with_front' => false,
			),
			'menu_position' => 20,
			'menu_icon'     => 'dashicons-portfolio',
			'show_in_rest'  => true,
			'supports'      => array( 'title', 'editor', 'excerpt', 'thumbnail', 'custom-fields', 'revisions' ),

			// New posts start from a fixed outline. The section headings are locked
			// (cannot be moved or removed) while the body stays freely editable.
			'template'      => array(
				array(
					'core/paragraph',
					array( 'placeholder' => __( '案件の概要を入力…', 'lumen-blocks' ) ),
				),
				array(
					'core/heading',
					array(
						'content' => __( '課題', 'lumen-blocks' ),
						'lock'    => array(
							'move'   => true,
							'remove' => true,
						),
					),
				),
				array( 'core/paragraph', array( 'placeholder' => __( 'クライアントが抱えていた課題…', 'lumen-blocks' ) ) ),
				array(
					'core/heading',
					array(
						'content' => __( '施策', 'lumen-blocks' ),
						'lock'    => array(
							'move'   => true,
							'remove' => true,
						),
					),
				),
				array( 'core/paragraph', array( 'placeholder' => __( '実施した施策…', 'lumen-blocks' ) ) ),
				array(
					'core/heading',
					array(
						'content' => __( '成果', 'lumen-blocks' ),
						'lock'    => array(
							'move'   => true,
							'remove' => true,
						),
					),
				),
				array( 'core/paragraph', array( 'placeholder' => __( '得られた成果…', 'lumen-blocks' ) ) ),
			),
		)
	);

	register_taxonomy(
		'works_category',
		'works',
		array(
			'labels'            => array(
				'name'          => __( '事例カテゴリー', 'lumen-blocks' ),
				'singular_name' => __( '事例カテゴリー', 'lumen-blocks' ),
				'all_items'     => __( 'すべてのカテゴリー', 'lumen-blocks' ),
				'edit_item'     => __( 'カテゴリーを編集', 'lumen-blocks' ),
				'add_new_item'  => __( 'カテゴリーを追加', 'lumen-blocks' ),
			),
			'hierarchical'      => true,
			'public'            => true,
			'show_admin_column' => true,
			'show_in_rest'      => true,
			'rewrite'           => array(
				'slug'       => 'works/category',
				'with_front' => false,
			),
		)
	);

	foreach ( lumen_blocks_works_meta_fields() as $key => $field ) {
		register_post_meta(
			'works',
			$key,
			array(
				'type'              => 'string',
				'label'             => $field['label'],
				'description'       => $field['description'],
				'single'            => true,
				'default'           => '',
				'show_in_rest'      => true,
				'sanitize_callback' => 'sanitize_text_field',
				'auth_callback'     => static function ( $allowed, $meta_key, $post_id ) {
					return current_user_can( 'edit_post', $post_id );
				},
			)
		);
	}
}
add_action( 'init', 'lumen_blocks_register_post_types' );
