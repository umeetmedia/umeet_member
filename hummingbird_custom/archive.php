<?php get_header(); ?>
<div id="content">
<div id="inner-content" class="wrap cf">
<main id="main" class="m-all t-all d-5of7 cf" role="main">
<div class="archivettl">
<?php if (is_category()) { ?>
<h1 class="archive-title h2">
<span class="gf"><?php _e( 'CATEGORY', 'moaretrotheme' ); ?></span> <?php single_cat_title(); ?>
</h1>
  
  <!--カテゴリーが海外支部なら地図を表示-->
  <?php if(is_category(33)) : ?>
  
  <?php echo "<iframe src='https://www.google.com/maps/d/embed?mid=zDncWHscSdgI.kNxohx6816l8' width='640' height='480'></iframe>";
						  ?>
  
  <?php endif; ?>
  
<?php } elseif (is_tag()) { ?>
<h1 class="archive-title h2">
<span class="gf"><?php _e( 'TAG', 'moaretrotheme' ); ?></span> <?php single_tag_title(); ?>
</h1>
<?php } elseif (is_author()) {
global $post;
$author_id = $post->post_author;
?>
  
  
  
<div class="voice cf l ">
<figure class="icon"><?php echo get_avatar(get_the_author_id(), 150); ?></figure>
  
  <div class="voicecomment" ><?php the_author_meta('description', $author_id); ?></div>
</div>

  
<h1>  
「<?php the_author_meta('display_name', $author_id); ?>」の記事
</h1>
  
  

<?php } elseif (is_day()) { ?>
<h1 class="archive-title h2"><?php the_time('Y年n月j日'); ?></h1>
<?php } elseif (is_month()) { ?>
<h1 class="archive-title h2"><?php the_time('Y年n月'); ?></h1>
<?php } elseif (is_year()) { ?>
<h1 class="archive-title h2"><?php the_time('Y年'); ?></h1>
<?php } ?>
</div>
<?php if (category_description() && !is_paged()) : ?>
<div class="taxonomy-description"><?php echo category_description(); ?></div>
<?php endif; ?>

<?php $toplayout = get_option('opencage_archivelayout');?>
<?php if ( $toplayout == "toplayout-big" ) : ?>
<?php get_template_part( 'parts_archive_big' ); ?>
<?php elseif ( $toplayout == 'toplayout-card' ) : ?>
<?php get_template_part( 'parts_archive_card' ); ?>
<?php else : ?>
<?php get_template_part( 'parts_archive_simple' ); ?>
<?php endif;?>

<?php
if (is_author()) { 

?>
<div role="form" class="wpcf7" id="wpcf7-f2803-p4745-o1" lang="ja" dir="ltr">
<div class="screen-reader-response"></div>
<form action="/article/4745/#wpcf7-f2803-p4745-o1" method="post" class="wpcf7-form" novalidate="novalidate">
<div style="display: none;">
<input type="hidden" name="_wpcf7" value="2803" />
<input type="hidden" name="_wpcf7_version" value="4.4" />
<input type="hidden" name="_wpcf7_locale" value="ja" />
<input type="hidden" name="_wpcf7_unit_tag" value="wpcf7-f2803-p4745-o1" />
<input type="hidden" name="_wpnonce" value="92c5537ebe" />
</div>
<div class="article-contact">
<h4>この人にメッセージを送る▼</h4>
<div id="form-parts">
<p>メールアドレス (任意)<br />
    <span class="wpcf7-form-control-wrap your-email"><input type="email" name="your-email" value="" size="40" class="wpcf7-form-control wpcf7-text wpcf7-email wpcf7-validates-as-email" aria-invalid="false" /></span> </p>
<p>メッセージ<br />
    <span class="wpcf7-form-control-wrap your-message"><textarea name="your-message" cols="40" rows="2" class="wpcf7-form-control wpcf7-textarea" aria-invalid="false"></textarea></span> </p>
<p><input type="submit" value="送信" class="wpcf7-form-control wpcf7-submit" /></p>
</div>
<p><!--form-parts-->
</div>
<div class="wpcf7-response-output wpcf7-display-none"></div></form></div>';
<?php
}
?>


<?php pagination(); ?>

</main>
<?php get_sidebar(); ?>
</div>
</div>
<?php get_footer(); ?>
