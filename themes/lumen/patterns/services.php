<?php
/**
 * Title: サービス紹介
 * Slug: lumen/services
 * Categories: lumen-sections
 * Keywords: service, サービス, 特徴, カード
 * Description: 見出し＋サービスカード3列のセクション。カードは「サービスカード」ブロックで追加・並べ替えできます。
 * Viewport Width: 1440
 *
 * @package Lumen
 */

?>
<!-- wp:group {"anchor":"service","align":"full","style":{"spacing":{"padding":{"top":"var:preset|spacing|70","bottom":"var:preset|spacing|70"}}},"layout":{"type":"constrained"}} -->
<div id="service" class="wp-block-group alignfull" style="padding-top:var(--wp--preset--spacing--70);padding-bottom:var(--wp--preset--spacing--70)"><!-- wp:group {"className":"lumen-section-heading","layout":{"type":"constrained"}} -->
<div class="wp-block-group lumen-section-heading"><!-- wp:paragraph {"align":"center","className":"is-style-lumen-eyebrow"} -->
<p class="has-text-align-center is-style-lumen-eyebrow">Service</p>
<!-- /wp:paragraph -->

<!-- wp:heading {"textAlign":"center"} -->
<h2 class="wp-block-heading has-text-align-center">集客から成果まで、<br>一気通貫で支援します</h2>
<!-- /wp:heading -->

<!-- wp:paragraph {"align":"center","textColor":"muted"} -->
<p class="has-text-align-center has-muted-color has-text-color">戦略設計・制作・運用改善を一つのチームで担当。<br>担当者が変わっても品質が落ちない仕組みでお届けします。</p>
<!-- /wp:paragraph --></div>
<!-- /wp:group -->

<!-- wp:lumen/service-cards {"align":"wide"} -->
<div class="wp-block-lumen-service-cards alignwide lumen-service-cards has-3-columns"><!-- wp:lumen/service-card -->
<article class="wp-block-lumen-service-card lumen-service-card"><span class="lumen-service-card__icon"><svg class="lumen-icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="28" height="28" fill="none" stroke="currentColor" stroke-width="1.75" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true" focusable="false"><path d="M3 3v18h18"></path><path d="M7 14l4-4 3 3 5-6"></path><path d="M15 7h4v4"></path></svg></span><h3 class="lumen-service-card__title">Web戦略設計</h3><p class="lumen-service-card__text">アクセス解析・競合調査・ユーザーインタビューから、成果につながるサイト構成とKPIを設計します。</p><a class="lumen-service-card__link" href="<?php echo esc_url( home_url( '/works/category/corporate/' ) ); ?>">詳しく見る<span aria-hidden="true">→</span></a></article>
<!-- /wp:lumen/service-card -->

<!-- wp:lumen/service-card {"icon":"design"} -->
<article class="wp-block-lumen-service-card lumen-service-card"><span class="lumen-service-card__icon"><svg class="lumen-icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="28" height="28" fill="none" stroke="currentColor" stroke-width="1.75" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true" focusable="false"><path d="M12 20h9"></path><path d="M16.5 3.5a2.1 2.1 0 0 1 3 3L7 19l-4 1 1-4Z"></path></svg></span><h3 class="lumen-service-card__title">LP・サイト制作</h3><p class="lumen-service-card__text">デザインカンプを忠実に再現し、担当者がブロックで更新できるWordPressサイトとして納品します。</p><a class="lumen-service-card__link" href="<?php echo esc_url( home_url( '/works/category/lp/' ) ); ?>">詳しく見る<span aria-hidden="true">→</span></a></article>
<!-- /wp:lumen/service-card -->

<!-- wp:lumen/service-card {"icon":"media"} -->
<article class="wp-block-lumen-service-card lumen-service-card"><span class="lumen-service-card__icon"><svg class="lumen-icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="28" height="28" fill="none" stroke="currentColor" stroke-width="1.75" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true" focusable="false"><path d="M4 4h16v12H4Z"></path><path d="M8 20h8"></path><path d="M12 16v4"></path><path d="M8 8h8"></path><path d="M8 12h5"></path></svg></span><h3 class="lumen-service-card__title">オウンドメディア運用</h3><p class="lumen-service-card__text">記事企画・取材・SEO改善までを継続的に運用。読まれて問い合わせにつながるメディアを育てます。</p><a class="lumen-service-card__link" href="<?php echo esc_url( home_url( '/works/category/media/' ) ); ?>">詳しく見る<span aria-hidden="true">→</span></a></article>
<!-- /wp:lumen/service-card --></div>
<!-- /wp:lumen/service-cards --></div>
<!-- /wp:group -->
