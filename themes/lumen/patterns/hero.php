<?php
/**
 * Title: ヒーロー（メインビジュアル）
 * Slug: lumen/hero
 * Categories: lumen-sections
 * Keywords: hero, メインビジュアル, ファーストビュー
 * Description: 背景画像・キャッチコピー・CTAボタン2つのファーストビュー。
 * Viewport Width: 1440
 *
 * @package Lumen
 */

?>
<!-- wp:lumen/hero {"focalPoint":{"x":0.7,"y":0.5},"dimRatio":40} -->
<section class="wp-block-lumen-hero alignfull lumen-hero has-base-color has-ink-background-color has-text-color has-background" style="min-height:640px"><img class="lumen-hero__media" src="<?php echo esc_url( get_theme_file_uri( 'assets/images/hero.jpg' ) ); ?>" alt="" style="object-position:70% 50%"/><span class="lumen-hero__overlay" aria-hidden="true" style="opacity:0.4"></span><div class="lumen-hero__inner"><p class="lumen-hero__eyebrow">Web Marketing Partner</p><h1 class="lumen-hero__title">成果につながるWebを、<br>戦略から運用まで。</h1><p class="lumen-hero__lead">LP制作・コーポレートサイト・オウンドメディア運用まで。<br>データに基づく設計と、更新しやすいWordPressで事業の成長に伴走します。</p><div class="lumen-hero__actions"><!-- wp:buttons -->
<div class="wp-block-buttons"><!-- wp:button {"backgroundColor":"accent","textColor":"ink"} -->
<div class="wp-block-button"><a class="wp-block-button__link has-ink-color has-accent-background-color has-text-color has-background wp-element-button" href="<?php echo esc_url( home_url( '/contact/' ) ); ?>">無料で相談する</a></div>
<!-- /wp:button -->

<!-- wp:button {"className":"is-style-outline"} -->
<div class="wp-block-button is-style-outline"><a class="wp-block-button__link wp-element-button" href="<?php echo esc_url( home_url( '/works/' ) ); ?>">導入事例を見る</a></div>
<!-- /wp:button --></div>
<!-- /wp:buttons --></div></div></section>
<!-- /wp:lumen/hero -->
