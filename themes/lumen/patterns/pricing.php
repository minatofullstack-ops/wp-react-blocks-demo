<?php
/**
 * Title: 料金表（レイアウト固定）
 * Slug: lumen/pricing
 * Categories: lumen-sections
 * Keywords: price, 料金, プラン, 料金表
 * Description: 3プランの料金表。templateLock "contentOnly" でレイアウトを保護し、文言・金額・リンクだけ編集できます。
 * Viewport Width: 1440
 *
 * @package Lumen
 */

?>
<!-- wp:group {"anchor":"price","align":"full","templateLock":"contentOnly","style":{"spacing":{"padding":{"top":"var:preset|spacing|70","bottom":"var:preset|spacing|70"}}},"backgroundColor":"surface","layout":{"type":"constrained"}} -->
<div id="price" class="wp-block-group alignfull has-surface-background-color has-background" style="padding-top:var(--wp--preset--spacing--70);padding-bottom:var(--wp--preset--spacing--70)"><!-- wp:group {"className":"lumen-section-heading","layout":{"type":"constrained"}} -->
<div class="wp-block-group lumen-section-heading"><!-- wp:paragraph {"align":"center","className":"is-style-lumen-eyebrow"} -->
<p class="has-text-align-center is-style-lumen-eyebrow">Price</p>
<!-- /wp:paragraph -->

<!-- wp:heading {"textAlign":"center"} -->
<h2 class="wp-block-heading has-text-align-center">料金プラン</h2>
<!-- /wp:heading -->

<!-- wp:paragraph {"align":"center","textColor":"muted"} -->
<p class="has-text-align-center has-muted-color has-text-color">目的と体制に合わせて選べる3つのプラン（税別・架空の参考価格）。</p>
<!-- /wp:paragraph --></div>
<!-- /wp:group -->

<!-- wp:columns {"align":"wide","className":"lumen-pricing","style":{"spacing":{"blockGap":{"left":"var:preset|spacing|40"}}}} -->
<div class="wp-block-columns alignwide lumen-pricing"><!-- wp:column {"className":"is-style-lumen-card lumen-plan"} -->
<div class="wp-block-column is-style-lumen-card lumen-plan"><!-- wp:heading {"level":3,"className":"lumen-plan__name"} -->
<h3 class="wp-block-heading lumen-plan__name">LP制作</h3>
<!-- /wp:heading -->

<!-- wp:paragraph {"className":"lumen-plan__price"} -->
<p class="lumen-plan__price"><strong>30</strong>万円〜</p>
<!-- /wp:paragraph -->

<!-- wp:paragraph {"textColor":"muted","fontSize":"small"} -->
<p class="has-muted-color has-text-color has-small-font-size">広告・キャンペーン用の1ページLPを最短3週間で。</p>
<!-- /wp:paragraph -->

<!-- wp:list {"className":"lumen-check-list"} -->
<ul class="wp-block-list lumen-check-list"><!-- wp:list-item -->
<li>構成案・ワイヤーフレーム</li>
<!-- /wp:list-item -->

<!-- wp:list-item -->
<li>デザイン・レスポンシブ実装</li>
<!-- /wp:list-item -->

<!-- wp:list-item -->
<li>フォーム・計測タグ設定</li>
<!-- /wp:list-item --></ul>
<!-- /wp:list -->

<!-- wp:buttons -->
<div class="wp-block-buttons"><!-- wp:button {"width":100,"className":"is-style-outline"} -->
<div class="wp-block-button has-custom-width wp-block-button__width-100 is-style-outline"><a class="wp-block-button__link wp-element-button" href="<?php echo esc_url( home_url( '/contact/' ) ); ?>">相談する</a></div>
<!-- /wp:button --></div>
<!-- /wp:buttons --></div>
<!-- /wp:column -->

<!-- wp:column {"className":"is-style-lumen-card lumen-plan is-featured","backgroundColor":"ink","textColor":"base"} -->
<div class="wp-block-column is-style-lumen-card lumen-plan is-featured has-base-color has-ink-background-color has-text-color has-background"><!-- wp:paragraph {"className":"lumen-plan__badge"} -->
<p class="lumen-plan__badge">おすすめ</p>
<!-- /wp:paragraph -->

<!-- wp:heading {"level":3,"className":"lumen-plan__name"} -->
<h3 class="wp-block-heading lumen-plan__name">サイト制作＋運用</h3>
<!-- /wp:heading -->

<!-- wp:paragraph {"className":"lumen-plan__price"} -->
<p class="lumen-plan__price"><strong>120</strong>万円〜</p>
<!-- /wp:paragraph -->

<!-- wp:paragraph {"fontSize":"small"} -->
<p class="has-small-font-size">コーポレートサイトを、社内で更新できる形で。</p>
<!-- /wp:paragraph -->

<!-- wp:list {"className":"lumen-check-list"} -->
<ul class="wp-block-list lumen-check-list"><!-- wp:list-item -->
<li>ブロックテーマ・カスタムブロック開発</li>
<!-- /wp:list-item -->

<!-- wp:list-item -->
<li>更新マニュアル・操作レクチャー</li>
<!-- /wp:list-item -->

<!-- wp:list-item -->
<li>公開後3か月の改善サポート</li>
<!-- /wp:list-item --></ul>
<!-- /wp:list -->

<!-- wp:buttons -->
<div class="wp-block-buttons"><!-- wp:button {"backgroundColor":"accent","textColor":"ink","width":100} -->
<div class="wp-block-button has-custom-width wp-block-button__width-100"><a class="wp-block-button__link has-ink-color has-accent-background-color has-text-color has-background wp-element-button" href="<?php echo esc_url( home_url( '/contact/' ) ); ?>">相談する</a></div>
<!-- /wp:button --></div>
<!-- /wp:buttons --></div>
<!-- /wp:column -->

<!-- wp:column {"className":"is-style-lumen-card lumen-plan"} -->
<div class="wp-block-column is-style-lumen-card lumen-plan"><!-- wp:heading {"level":3,"className":"lumen-plan__name"} -->
<h3 class="wp-block-heading lumen-plan__name">メディア運用</h3>
<!-- /wp:heading -->

<!-- wp:paragraph {"className":"lumen-plan__price"} -->
<p class="lumen-plan__price"><strong>25</strong>万円〜／月</p>
<!-- /wp:paragraph -->

<!-- wp:paragraph {"textColor":"muted","fontSize":"small"} -->
<p class="has-muted-color has-text-color has-small-font-size">記事制作とSEO改善を毎月継続して。</p>
<!-- /wp:paragraph -->

<!-- wp:list {"className":"lumen-check-list"} -->
<ul class="wp-block-list lumen-check-list"><!-- wp:list-item -->
<li>記事企画・制作（月4本〜）</li>
<!-- /wp:list-item -->

<!-- wp:list-item -->
<li>検索順位・CVのレポート</li>
<!-- /wp:list-item -->

<!-- wp:list-item -->
<li>月次の改善ミーティング</li>
<!-- /wp:list-item --></ul>
<!-- /wp:list -->

<!-- wp:buttons -->
<div class="wp-block-buttons"><!-- wp:button {"width":100,"className":"is-style-outline"} -->
<div class="wp-block-button has-custom-width wp-block-button__width-100 is-style-outline"><a class="wp-block-button__link wp-element-button" href="<?php echo esc_url( home_url( '/contact/' ) ); ?>">相談する</a></div>
<!-- /wp:button --></div>
<!-- /wp:buttons --></div>
<!-- /wp:column --></div>
<!-- /wp:columns --></div>
<!-- /wp:group -->
