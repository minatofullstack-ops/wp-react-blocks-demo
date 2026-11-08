<?php
/**
 * Title: お問い合わせ導線
 * Slug: lumen/contact-cta
 * Categories: lumen-sections
 * Keywords: cta, お問い合わせ, 資料請求, contact
 * Description: お問い合わせ・資料請求へ誘導するCTAバナー。ページ末尾に配置します。
 * Viewport Width: 1440
 *
 * @package Lumen
 */

?>
<!-- wp:group {"anchor":"contact","align":"full","style":{"spacing":{"padding":{"top":"var:preset|spacing|60","bottom":"var:preset|spacing|70"}}},"layout":{"type":"constrained"}} -->
<div id="contact" class="wp-block-group alignfull" style="padding-top:var(--wp--preset--spacing--60);padding-bottom:var(--wp--preset--spacing--70)"><!-- wp:lumen/cta {"align":"wide","gradient":"brand"} -->
<section class="wp-block-lumen-cta alignwide lumen-cta has-base-color has-primary-background-color has-brand-gradient-background has-text-color has-background"><div class="lumen-cta__body"><p class="lumen-cta__eyebrow">Contact</p><h2 class="lumen-cta__title">まずは30分の無料相談から</h2><p class="lumen-cta__text">現状のサイト・広告の数字を拝見し、改善の優先順位をその場でお伝えします。<br>オンライン相談・資料請求はいずれも無料です。</p></div><div class="lumen-cta__actions"><!-- wp:buttons -->
<div class="wp-block-buttons"><!-- wp:button {"backgroundColor":"accent","textColor":"ink"} -->
<div class="wp-block-button"><a class="wp-block-button__link has-ink-color has-accent-background-color has-text-color has-background wp-element-button" href="<?php echo esc_url( home_url( '/contact/' ) ); ?>">無料相談を予約する</a></div>
<!-- /wp:button -->

<!-- wp:button {"className":"is-style-outline"} -->
<div class="wp-block-button is-style-outline"><a class="wp-block-button__link wp-element-button" href="<?php echo esc_url( home_url( '/contact/#document' ) ); ?>">資料をダウンロード</a></div>
<!-- /wp:button --></div>
<!-- /wp:buttons --></div></section>
<!-- /wp:lumen/cta --></div>
<!-- /wp:group -->
