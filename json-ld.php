<?php
//JSON-LDに関する記述
//https://developers.google.com/search/docs/data-types/articles
//http://schema.org/NewsArticle
 ?>
<script type="application/ld+json">
{
  "@context": "http://schema.org",
  "@type": "NewsArticle",
  "mainEntityOfPage":{
    "@type":"WebPage",
    "@id":"<?php the_permalink(); ?>" // パーマリンクを取得
  },
  "headline": "<?php the_title();?>", // ページタイトルを取得
  "image": {
    "@type": "ImageObject",
<?php
// アイキャッチ画像URLを取得
$image_id = get_post_thumbnail_id();
$image = wp_get_attachment_image_src($image_id, true);
if ($image) {
  $image_url = $image[0];
  $size = get_image_width_and_height($image_url);
  $width = $size ? $size['width'] : 800;
  $height = $size ? $size['height'] : 800;
  //サムネイルの幅が小さすぎる場合は仕様（696px以上）に合わせる
  if ($width < 696) {
    $height = round($height * (696/$width));
    $width = 696;
  }
} else {
  $image_url = get_template_directory_uri().'/images/no-image-large.png';
  $width = 800;
  $height = 451;
} ?>
    "url": "<?php echo $image_url;?>",
    "width": <?php echo $width; ?>,
    "height": <?php echo $height; ?>
  },
  "datePublished": "<?php echo (get_the_time('c') ? get_the_time('c') : get_the_modified_time('c')); ?>", // 記事投稿時間（分岐しているのbbPressのトピック対策）
  "dateModified": "<?php echo get_the_modified_time('c'); ?>", // 記事更新時間
  "author": {
    "@type": "Person",
    "name": "<?php echo (get_the_author_meta('nickname') ? get_the_author_meta('nickname') : get_bloginfo('name')); ?>" // 投稿者ニックネーム
  },
  "publisher": {
    "@type": "Organization",
    "name": "<?php bloginfo('name'); ?>", // サイト名
<?php
$image_url = get_amp_logo_url();
if ($image_url) {//ロゴ画像がある場合
  $size = get_image_width_and_height($image_url);
  $width = $size ? $size['width'] : 600;
  $height = $size ? $size['height'] : 60;
  //ロゴの幅が大きすぎる場合は仕様の範囲内（600px）にする
  if ($width > 600) {
    $height = round($height * (600/$width));
    $width = 600;
  }
  //ロゴの高さが大きすぎる場合は仕様の範囲内（60px）にする
  if ($height > 60) {
    $width = round($width * (60/$height));
    $height = 60;
  }
} else {//ロゴ画像がない場合
  $image_url = get_template_directory_uri().'/images/no-amp-logo.png';
  $width = 206;
  $height = 60;
}?>
    "logo": {
      "@type": "ImageObject",
      "url": "<?php echo $image_url; ?>", // ロゴ画像
      "width": <?php echo $width; ?>,
      "height": <?php echo $height; ?>
    }
  },
  "description": "<?php echo get_the_description(); ?>…" // 抜粋
}
</script>