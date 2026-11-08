<?php
/**
 * Title: 導入事例一覧へ戻るボタン
 * Slug: lumen/back-to-works
 * Inserter: no
 *
 * Used by templates. PHP patterns let templates output URLs that respect the
 * site address (sub-directory installs, WordPress Playground, etc.).
 *
 * @package Lumen
 */

?>
<!-- wp:buttons {"layout":{"type":"flex","justifyContent":"center"},"style":{"spacing":{"margin":{"top":"var:preset|spacing|60"}}}} -->
<div class="wp-block-buttons" style="margin-top:var(--wp--preset--spacing--60)"><!-- wp:button {"className":"is-style-outline"} -->
<div class="wp-block-button is-style-outline"><a class="wp-block-button__link wp-element-button" href="<?php echo esc_url( get_post_type_archive_link( 'works' ) ? get_post_type_archive_link( 'works' ) : home_url( '/' ) ); ?>">導入事例一覧へ戻る</a></div>
<!-- /wp:button --></div>
<!-- /wp:buttons -->
