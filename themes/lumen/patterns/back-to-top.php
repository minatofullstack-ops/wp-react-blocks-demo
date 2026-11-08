<?php
/**
 * Title: トップページへ戻るボタン
 * Slug: lumen/back-to-top
 * Inserter: no
 *
 * @package Lumen
 */

?>
<!-- wp:buttons {"layout":{"type":"flex","justifyContent":"center"}} -->
<div class="wp-block-buttons"><!-- wp:button {"className":"is-style-outline"} -->
<div class="wp-block-button is-style-outline"><a class="wp-block-button__link wp-element-button" href="<?php echo esc_url( home_url( '/' ) ); ?>">トップページへ戻る</a></div>
<!-- /wp:button --></div>
<!-- /wp:buttons -->
