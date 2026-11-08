<?php
/**
 * WP-CLI command that imports the demo content used by the portfolio site
 * and by the WordPress Playground blueprint.
 *
 * Usage: `wp lumen-demo import`.
 *
 * Page content is assembled from the theme's block patterns, so the demo
 * always matches what editors get from the pattern inserter.
 *
 * @package LumenBlocks
 */

defined( 'ABSPATH' ) || exit;

/**
 * Demo content importer.
 */
class Lumen_Blocks_Demo_Importer {

	/**
	 * Preferred ID of the front page (used by playground/blueprint-editor.json).
	 */
	const HOME_PAGE_ID = 100;

	/**
	 * Import terms, works, pages, navigation and site options.
	 *
	 * ## EXAMPLES
	 *
	 *     wp lumen-demo import
	 *
	 * @when after_wp_load
	 *
	 * @param array $args       Positional arguments (unused).
	 * @param array $assoc_args Associative arguments (unused).
	 */
	public function import( $args, $assoc_args ) { // phpcs:ignore Generic.CodeAnalysis.UnusedFunctionParameter.FoundAfterLastUsed -- signature required by WP-CLI.
		require_once ABSPATH . 'wp-admin/includes/file.php';
		require_once ABSPATH . 'wp-admin/includes/media.php';
		require_once ABSPATH . 'wp-admin/includes/image.php';

		// Trusted, bundled markup (inline SVG icons, style attributes): skip KSES.
		kses_remove_filters();

		$this->import_terms();
		$this->import_works();
		$home_id = $this->import_pages();
		$this->import_navigation();

		update_option( 'blogname', 'Lumen Inc.' );
		update_option( 'blogdescription', 'ルーメン株式会社（架空）｜Webマーケティング・サイト制作' );
		update_option( 'show_on_front', 'page' );
		update_option( 'page_on_front', $home_id );
		update_option( 'permalink_structure', '/%postname%/' );
		update_option( 'timezone_string', 'Asia/Tokyo' );
		flush_rewrite_rules();

		WP_CLI::success( 'Demo content imported.' );
	}

	/**
	 * Works categories.
	 */
	private function import_terms() {
		$terms = array(
			'lp'        => 'LP制作',
			'corporate' => 'コーポレートサイト',
			'media'     => 'オウンドメディア',
			'ec'        => 'ECサイト',
			'recruit'   => '採用サイト',
		);
		foreach ( $terms as $slug => $name ) {
			if ( ! term_exists( $slug, 'works_category' ) ) {
				wp_insert_term( $name, 'works_category', array( 'slug' => $slug ) );
			}
		}
	}

	/**
	 * Works posts with meta, terms and featured images.
	 */
	private function import_works() {
		$works = array(
			array(
				'slug'     => 'saas-lp-renewal',
				'title'    => 'BtoB SaaSのLP刷新で、問い合わせ数が2.4倍に',
				'excerpt'  => '訴求軸をユーザーインタビューから再設計し、ファーストビューとフォームを改善しました。',
				'term'     => 'lp',
				'image'    => 'work-01.jpg',
				'client'   => 'BtoB SaaS企業（従業員120名）',
				'result'   => '問い合わせ数 2.4倍',
				'period'   => '3か月',
				'problem'  => '広告からの流入は十分にある一方で、LPの直帰率が高く、問い合わせにつながっていませんでした。',
				'solution' => '既存顧客10社へのインタビューから導入理由を整理し、ファーストビューの訴求とフォーム項目を全面的に見直しました。',
				'outcome'  => '公開から2か月で問い合わせ数が2.4倍、CPAは38%改善。改善サイクルを社内で回せるよう、ブロックで編集できる構成にしています。',
			),
			array(
				'slug'     => 'manufacturer-corporate-site',
				'title'    => '製造業のコーポレートサイトを、社内で更新できる形にリニューアル',
				'excerpt'  => '更新のたびに外注していた状態から、担当者がブロックで更新できる仕組みへ。',
				'term'     => 'corporate',
				'image'    => 'work-02.jpg',
				'client'   => '精密部品メーカー',
				'result'   => '更新工数 70%削減',
				'period'   => '4か月',
				'problem'  => 'お知らせや製品情報の更新を毎回制作会社に依頼しており、情報公開まで2週間以上かかっていました。',
				'solution' => 'デザインを theme.json のデザイントークンとカスタムブロックに落とし込み、レイアウトを崩さずに更新できるブロックテーマを構築しました。',
				'outcome'  => '更新作業は社内で完結するようになり、更新工数を約70%削減。製品ページの追加も担当者だけで行えるようになりました。',
			),
			array(
				'slug'     => 'hr-owned-media',
				'title'    => '人材サービスのオウンドメディアを立ち上げ、自然検索流入が5倍に',
				'excerpt'  => 'キーワード設計から記事制作・改善までを1年間伴走しました。',
				'term'     => 'media',
				'image'    => 'work-03.jpg',
				'client'   => '人材紹介会社',
				'result'   => '自然検索流入 5.1倍',
				'period'   => '12か月',
				'problem'  => '広告費の高騰により、広告に依存しない集客チャネルが必要になっていました。',
				'solution' => '求職者の検索意図を分析してカテゴリ設計を行い、月8本の記事制作とリライトを継続しました。',
				'outcome'  => '1年で自然検索流入が5.1倍に。メディア経由の登録者数は全体の3割を占めるまでに成長しました。',
			),
			array(
				'slug'     => 'd2c-ec-cvr',
				'title'    => '食品D2CブランドのEC改善で、CVRが1.8倍に',
				'excerpt'  => '商品ページとカート導線をデータに基づいて改善しました。',
				'term'     => 'ec',
				'image'    => 'work-04.jpg',
				'client'   => '食品D2Cブランド',
				'result'   => 'CVR 1.8倍',
				'period'   => '6か月',
				'problem'  => 'スマートフォンからのアクセスが8割を占める一方で、カート投入率が低い状態でした。',
				'solution' => 'ヒートマップとアクセス解析から離脱箇所を特定し、商品ページの情報設計とカート導線を改善しました。',
				'outcome'  => 'スマートフォンのCVRが1.8倍に向上。定期購入の比率も上がりました。',
			),
			array(
				'slug'     => 'cloud-service-lp-production',
				'title'    => 'クラウドサービスの広告LPを、月4本のペースで量産',
				'excerpt'  => 'LPテンプレートとブロックパターンで、制作スピードと品質を両立しました。',
				'term'     => 'lp',
				'image'    => 'work-05.jpg',
				'client'   => 'クラウドサービス事業者',
				'result'   => 'CPA 32%改善',
				'period'   => '継続支援中',
				'problem'  => '訴求ごとにLPを作り分けたいものの、1本あたりの制作期間が長く、検証の回数が限られていました。',
				'solution' => '共通セクションをブロックパターン化し、LPテンプレートから複数ページを展開できる体制を構築しました。',
				'outcome'  => '制作期間を1本あたり約1週間に短縮し、ABテストの回数を増やした結果、CPAは32%改善しました。',
			),
			array(
				'slug'     => 'regional-bank-recruit',
				'title'    => '地域金融機関の採用サイトで、応募数が前年比160%に',
				'excerpt'  => '社員インタビューを軸に、働くイメージが伝わるサイトへ。',
				'term'     => 'recruit',
				'image'    => 'work-06.jpg',
				'client'   => '地域金融機関',
				'result'   => '応募数 前年比160%',
				'period'   => '5か月',
				'problem'  => '若手層への認知が低く、説明会への参加者が年々減少していました。',
				'solution' => '若手社員6名への取材をもとにコンテンツを制作し、SNS広告と連動したエントリー導線を設計しました。',
				'outcome'  => 'エントリー数は前年比160%に。説明会の参加率も向上しました。',
			),
		);

		$timestamp = strtotime( '2026-10-01 10:00:00' );
		foreach ( $works as $index => $work ) {
			if ( get_page_by_path( $work['slug'], OBJECT, 'works' ) ) {
				continue;
			}
			$post_id = wp_insert_post(
				array(
					'post_type'    => 'works',
					'post_status'  => 'publish',
					'post_name'    => $work['slug'],
					'post_title'   => $work['title'],
					'post_excerpt' => $work['excerpt'],
					'post_content' => $this->works_content( $work ),
					'post_date'    => gmdate( 'Y-m-d H:i:s', $timestamp - $index * DAY_IN_SECONDS * 9 ),
					'meta_input'   => array(
						'lumen_client' => $work['client'],
						'lumen_result' => $work['result'],
						'lumen_period' => $work['period'],
					),
				),
				true
			);
			if ( is_wp_error( $post_id ) ) {
				WP_CLI::warning( $post_id->get_error_message() );
				continue;
			}
			wp_set_object_terms( $post_id, $work['term'], 'works_category' );

			$attachment_id = $this->import_image( $work['image'], $post_id, $work['title'] );
			if ( $attachment_id ) {
				set_post_thumbnail( $post_id, $attachment_id );
			}
		}
	}

	/**
	 * Block markup for a works post (same outline as the post type template).
	 *
	 * @param array $work Work data.
	 * @return string
	 */
	private function works_content( $work ) {
		$blocks  = $this->paragraph( $work['excerpt'] );
		$blocks .= $this->locked_heading( '課題' );
		$blocks .= $this->paragraph( $work['problem'] );
		$blocks .= $this->locked_heading( '施策' );
		$blocks .= $this->paragraph( $work['solution'] );
		$blocks .= $this->locked_heading( '成果' );
		$blocks .= $this->paragraph( $work['outcome'] );
		$blocks .= $this->paragraph( '※ 本事例はポートフォリオ用の架空の事例です。' );
		return $blocks;
	}

	/**
	 * Serialized core/paragraph.
	 *
	 * @param string $text Text.
	 * @return string
	 */
	private function paragraph( $text ) {
		return "<!-- wp:paragraph -->\n<p>" . esc_html( $text ) . "</p>\n<!-- /wp:paragraph -->\n\n";
	}

	/**
	 * Serialized core/heading that cannot be moved or removed.
	 *
	 * @param string $text Text.
	 * @return string
	 */
	private function locked_heading( $text ) {
		return '<!-- wp:heading {"lock":{"move":true,"remove":true}} -->' . "\n"
			. '<h2 class="wp-block-heading">' . esc_html( $text ) . "</h2>\n<!-- /wp:heading -->\n\n";
	}

	/**
	 * Copy an image from demo/images into the media library.
	 *
	 * @param string $file    File name.
	 * @param int    $post_id Parent post.
	 * @param string $title   Attachment title.
	 * @return int Attachment ID or 0.
	 */
	private function import_image( $file, $post_id, $title ) {
		$source = LUMEN_BLOCKS_DIR . 'demo/images/' . $file;
		if ( ! file_exists( $source ) ) {
			return 0;
		}
		$tmp = wp_tempnam( $file );
		copy( $source, $tmp );

		$attachment_id = media_handle_sideload(
			array(
				'name'     => $file,
				'tmp_name' => $tmp,
			),
			$post_id,
			$title
		);
		if ( is_wp_error( $attachment_id ) ) {
			WP_CLI::warning( $attachment_id->get_error_message() );
			wp_delete_file( $tmp );
			return 0;
		}
		update_post_meta( $attachment_id, '_wp_attachment_image_alt', '' );
		return $attachment_id;
	}

	/**
	 * Pages: home, an extra landing page from the same template, contact and
	 * the block deprecation demo.
	 *
	 * @return int Home page ID.
	 */
	private function import_pages() {
		$landing = $this->pattern_content( 'lumen/page-landing' );

		// Fixed IDs (import_id) give the Playground blueprint a stable editor URL.
		$home_id = $this->upsert_page( 'home', 'ホーム', $landing, 'page-wide', self::HOME_PAGE_ID );

		// Same template, different copy: how one design is rolled out to many pages.
		$second_lp = str_replace(
			array( '成果につながるWebを、<br>戦略から運用まで。', 'Web Marketing Partner' ),
			array( '読まれて、選ばれる。<br>オウンドメディア支援', 'Owned Media' ),
			$landing
		);
		$this->upsert_page( 'lp-owned-media', 'オウンドメディア支援（LP）', $second_lp, 'page-wide' );

		$this->upsert_page( 'contact', 'お問い合わせ', $this->contact_content() );
		$this->upsert_page( 'block-migration-demo', 'ブロック移行デモ（deprecated）', $this->deprecation_demo_content() );

		return $home_id;
	}

	/**
	 * Create or update a page by slug.
	 *
	 * @param string $slug      Slug.
	 * @param string $title     Title.
	 * @param string $content   Block markup.
	 * @param string $template  Page template slug.
	 * @param int    $import_id Preferred post ID for new pages.
	 * @return int Page ID.
	 */
	private function upsert_page( $slug, $title, $content, $template = '', $import_id = 0 ) {
		$existing = get_page_by_path( $slug );
		$postarr  = array(
			'post_type'     => 'page',
			'post_status'   => 'publish',
			'post_name'     => $slug,
			'post_title'    => $title,
			'post_content'  => $content,
			'page_template' => $template,
		);
		if ( $existing ) {
			$postarr['ID'] = $existing->ID;
			return (int) wp_update_post( wp_slash( $postarr ) );
		}
		if ( $import_id && ! get_post( $import_id ) ) {
			$postarr['import_id'] = $import_id;
		}
		return (int) wp_insert_post( wp_slash( $postarr ) );
	}

	/**
	 * Content of a registered pattern with nested pattern blocks expanded.
	 *
	 * @param string $slug Pattern slug.
	 * @param int    $depth Recursion guard.
	 * @return string
	 */
	private function pattern_content( $slug, $depth = 0 ) {
		$pattern = WP_Block_Patterns_Registry::get_instance()->get_registered( $slug );
		if ( ! $pattern || $depth > 3 ) {
			WP_CLI::warning( "Pattern {$slug} not found. Is the Lumen theme active?" );
			return '';
		}
		return preg_replace_callback(
			'#<!-- wp:pattern \{"slug":"([^"]+)"\} /-->#',
			function ( $matches ) use ( $depth ) {
				return trim( $this->pattern_content( $matches[1], $depth + 1 ) );
			},
			$pattern['content']
		);
	}

	/**
	 * Contact page.
	 *
	 * @return string
	 */
	private function contact_content() {
		return '<!-- wp:paragraph -->
<p>Webサイト・LP・オウンドメディアに関するご相談を承っています。現状の課題が整理できていなくても問題ありません。</p>
<!-- /wp:paragraph -->

<!-- wp:heading {"anchor":"document"} -->
<h2 class="wp-block-heading" id="document">ご相談の流れ</h2>
<!-- /wp:heading -->

<!-- wp:list {"ordered":true} -->
<ol class="wp-block-list"><!-- wp:list-item -->
<li>フォームまたはお電話でご連絡ください。</li>
<!-- /wp:list-item -->

<!-- wp:list-item -->
<li>オンラインで30分ほど、現状と目標をお伺いします。</li>
<!-- /wp:list-item -->

<!-- wp:list-item -->
<li>1週間以内に改善の方向性とお見積りをお送りします。</li>
<!-- /wp:list-item --></ol>
<!-- /wp:list -->

<!-- wp:paragraph {"backgroundColor":"surface","style":{"spacing":{"padding":{"top":"var:preset|spacing|40","right":"var:preset|spacing|40","bottom":"var:preset|spacing|40","left":"var:preset|spacing|40"}}},"fontSize":"small"} -->
<p class="has-surface-background-color has-background has-small-font-size" style="padding-top:var(--wp--preset--spacing--40);padding-right:var(--wp--preset--spacing--40);padding-bottom:var(--wp--preset--spacing--40);padding-left:var(--wp--preset--spacing--40)">このサイトはポートフォリオ用のデモのため、フォームは設置していません。実案件ではフォームプラグイン、または REST API ＋ nonce 検証によるカスタムフォームで実装します。</p>
<!-- /wp:paragraph -->
';
	}

	/**
	 * A page whose hero block was saved with v1.0 markup. Opening it in the
	 * editor runs the migration defined in src/blocks/hero/deprecated.js.
	 *
	 * @return string
	 */
	private function deprecation_demo_content() {
		$image = esc_url( get_theme_file_uri( 'assets/images/hero.jpg' ) );
		$works = esc_url( home_url( '/works/' ) );

		return '<!-- wp:lumen/hero {"backgroundUrl":"' . $image . '","minHeight":480} -->
<section class="wp-block-lumen-hero alignfull lumen-hero" style="background-image:url(' . $image . ');min-height:480px"><div class="lumen-hero__inner"><h1 class="lumen-hero__title">v1.0 の形式で保存されたヒーロー</h1><p class="lumen-hero__lead">このブロックは旧バージョン（背景画像を CSS で出力）のマークアップで保存されています。</p><div class="lumen-hero__actions"><!-- wp:buttons -->
<div class="wp-block-buttons"><!-- wp:button -->
<div class="wp-block-button"><a class="wp-block-button__link wp-element-button" href="' . $works . '">導入事例を見る</a></div>
<!-- /wp:button --></div>
<!-- /wp:buttons --></div></div></section>
<!-- /wp:lumen/hero -->

<!-- wp:heading -->
<h2 class="wp-block-heading">このページで確認できること</h2>
<!-- /wp:heading -->

<!-- wp:paragraph -->
<p>ヒーローブロックは v1.1 で、背景画像を CSS の background-image から &lt;img&gt; 要素に変更しました（LCP・遅延読み込み・フォーカルポイント対応のため）。保存済みの HTML が変わるため、通常はエディターで「ブロックに予期しないコンテンツが含まれています」というエラーになります。</p>
<!-- /wp:paragraph -->

<!-- wp:paragraph -->
<p>このプラグインでは <code>deprecated.js</code> に v1.0 の保存形式と属性の移行処理（backgroundUrl → mediaUrl）を定義しているため、このページをエディターで開くとエラーなしで自動的に新しい形式へ変換されます。編集者は何もする必要がありません。</p>
<!-- /wp:paragraph -->
';
	}

	/**
	 * Header / footer navigation. The navigation blocks in the theme have no
	 * fixed menu, so they use the most recent wp_navigation post.
	 */
	private function import_navigation() {
		$home  = home_url( '/' );
		$links = array(
			array( 'サービス', $home . '#service' ),
			array( '導入事例', home_url( '/works/' ) ),
			array( '料金', $home . '#price' ),
			array( 'よくある質問', $home . '#faq' ),
			array( 'お問い合わせ', home_url( '/contact/' ) ),
		);

		$content = '';
		foreach ( $links as $link ) {
			$content .= sprintf(
				'<!-- wp:navigation-link {"label":"%s","url":"%s","kind":"custom","isTopLevelLink":true} /-->',
				esc_attr( $link[0] ),
				esc_url_raw( $link[1] )
			);
		}

		$existing = get_posts(
			array(
				'post_type'      => 'wp_navigation',
				'name'           => 'lumen-main',
				'posts_per_page' => 1,
				'post_status'    => 'publish',
			)
		);
		$postarr  = array(
			'post_type'    => 'wp_navigation',
			'post_status'  => 'publish',
			'post_name'    => 'lumen-main',
			'post_title'   => 'メインメニュー',
			'post_content' => $content,
		);
		if ( $existing ) {
			$postarr['ID'] = $existing[0]->ID;
			wp_update_post( wp_slash( $postarr ) );
			return;
		}
		wp_insert_post( wp_slash( $postarr ) );
	}
}
