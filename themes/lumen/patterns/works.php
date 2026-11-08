<?php
/**
 * Title: 導入事例（最新3件）
 * Slug: lumen/works
 * Categories: lumen-sections
 * Keywords: works, 事例, 実績
 * Description: 投稿タイプ「導入事例」の最新記事を自動表示するセクション。
 * Viewport Width: 1440
 *
 * @package Lumen
 */

?>
<!-- wp:group {"anchor":"works","align":"full","style":{"spacing":{"padding":{"top":"var:preset|spacing|70","bottom":"var:preset|spacing|70"}}},"layout":{"type":"constrained"}} -->
<div id="works" class="wp-block-group alignfull" style="padding-top:var(--wp--preset--spacing--70);padding-bottom:var(--wp--preset--spacing--70)"><!-- wp:group {"className":"lumen-section-heading","layout":{"type":"constrained"}} -->
<div class="wp-block-group lumen-section-heading"><!-- wp:paragraph {"align":"center","className":"is-style-lumen-eyebrow"} -->
<p class="has-text-align-center is-style-lumen-eyebrow">Works</p>
<!-- /wp:paragraph -->

<!-- wp:heading {"textAlign":"center"} -->
<h2 class="wp-block-heading has-text-align-center">導入事例</h2>
<!-- /wp:heading -->

<!-- wp:paragraph {"align":"center","textColor":"muted"} -->
<p class="has-text-align-center has-muted-color has-text-color">業種も課題もさまざま。共通しているのは「数字で語れる成果」です。</p>
<!-- /wp:paragraph --></div>
<!-- /wp:group -->

<!-- wp:lumen/works {"align":"wide"} /-->

<!-- wp:buttons {"layout":{"type":"flex","justifyContent":"center"},"style":{"spacing":{"margin":{"top":"var:preset|spacing|50"}}}} -->
<div class="wp-block-buttons" style="margin-top:var(--wp--preset--spacing--50)"><!-- wp:button {"className":"is-style-outline"} -->
<div class="wp-block-button is-style-outline"><a class="wp-block-button__link wp-element-button" href="<?php echo esc_url( home_url( '/works/' ) ); ?>">導入事例をもっと見る</a></div>
<!-- /wp:button --></div>
<!-- /wp:buttons --></div>
<!-- /wp:group -->
