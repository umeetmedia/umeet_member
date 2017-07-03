<?php get_header(); ?>
<?php
	global $wp_query;
	$postid = $wp_query->post->ID;
	$tai = get_post_meta($postid, 'singlepostlayout_radio', true);
?>
<?php if ($tai == 'フルサイズ（1カラム）') : ?>
<?php get_template_part( 'singleparts_full' ); ?>
<?php else : ?>

<div id="content">
<div id="inner-content" class="wrap cf">

<main id="main" class="m-all t-all d-5of7 cf" role="main">
<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
<article id="post-<?php the_ID(); ?>" <?php post_class('cf'); ?> role="article">
<header class="article-header entry-header animated fadeInDown">
<p class="byline entry-meta vcard cf">
<?php
$cat = get_the_category();
$cat = $cat[0];
?>
<span class="date gf entry-date updated"><?php the_time('Y.m.d'); ?></span>
<span class="cat-name cat-id-<?php echo $cat->cat_ID;?>"><?php echo $cat->name; ?></span>
<span class="writer" style="display: none;"><span class="name author"><span class="fn"><?php the_author(); ?></span></span></span>
</p>
<h1 class="entry-title single-title" itemprop="headline" rel="bookmark"><?php the_title(); ?></h1>
<?php if ( has_post_thumbnail() && !get_option( 'post_options_eyecatch' ) ) :?>
<figure class="eyecatch animated fadeInUp">
<?php the_post_thumbnail('single-thum'); ?>
</figure>
<?php endif; ?>
<?php if ( !get_option( 'sns_options_hide' ) ) : ?>
<?php get_template_part( 'parts_sns_short' ); ?>
<?php endif; ?>
</header>


  
<?php if ( is_active_sidebar( 'addbanner-sp-titleunder' ) ) : ?>
<?php if ( wp_is_mobile() ) : ?>
<div class="add titleunder">
<?php dynamic_sidebar( 'addbanner-sp-titleunder' ); ?>
</div>
<?php endif; ?>
<?php endif; ?>

<section class="entry-content cf">

<?php if ( is_active_sidebar( 'addbanner-pc-titleunder' ) && !wp_is_mobile()) : ?>
<div class="add titleunder">
<?php dynamic_sidebar( 'addbanner-pc-titleunder' ); ?>
</div>
<?php endif; ?>

<?php the_content();
wp_link_pages( array(
'before'      => '<div class="page-links cf"><ul>',
'after'       => '</ul></div>',
'link_before' => '<li><span>',
'link_after'  => '</span></li>',
'nextpagelink'     => __('Next page'),
'previouspagelink' => __('Previous page'),
) );    
?>
  
 <?php related_posts(); ?>

<?php if ( is_active_sidebar( 'addbanner-pc-contentfoot' ) && !is_mobile() ) : ?>
<div class="add">
<?php dynamic_sidebar( 'addbanner-pc-contentfoot' ); ?>
</div>
<?php endif; ?>

</section>

<?php if ( is_active_sidebar( 'addbanner-sp-contentfoot' ) && is_mobile() ) : ?>
<div class="add">
<?php dynamic_sidebar( 'addbanner-sp-contentfoot' ); ?>
</div>
<?php endif; ?>

<footer class="article-footer">
  
<!-- 広告 -->
<?php if ( is_mobile() ) : ?>
<?php endif; ?>

<?php wp_social_bookmarking_light_output_e(null, get_permalink(), the_title("", "", false)); ?>
  
<?php echo get_the_category_list(); ?>
<?php the_tags( '<p class="tags">', '', '</p>' ); ?>

<?php if ( get_option( 'fbbox_options_url' ) ) : ?>
<div class="fb-likebtn wow animated bounceIn cf" data-wow-delay="0.5s">
<?php $fburl = get_option( 'fbbox_options_url' );?>
<div id="fb-root"></div>
<script>(function(d, s, id) {
var js, fjs = d.getElementsByTagName(s)[0];
if (d.getElementById(id)) return;
js = d.createElement(s); js.id = id;
js.src = "//connect.facebook.net/ja_JP/sdk.js#xfbml=1&version=v2.4&appId=271985329478941";
fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>
<figure class="eyecatch">
<?php if ( has_post_thumbnail() ): ?>
<?php the_post_thumbnail('home-thum'); ?>
<?php else: ?>
<img src="<?php echo get_template_directory_uri(); ?>/library/images/noimg.png">
<?php endif; ?>
</figure>
<div class="rightbox"><div class="fb-like fb-button" data-href="<?php echo $fburl;?>" data-layout="button_count" data-action="like" data-show-faces="false" data-share="false"></div><div class="like_text"><p><i class="fa fa-thumbs-up"></i>いいねで最新記事をお届け</p>
<?php if( !is_mobile() ): ?><p class="small">facebookページへのlikeで定期購読できます</p><?php endif; ?></div></div></div>
<?php endif; ?>

<?php if ( !get_option( 'sns_options_hide' ) ) : ?>
<div class="sharewrap wow animated bounceIn" data-wow-delay="0.5s">
<?php if ( get_option( 'sns_options_text' ) ) : ?>
<h3><?php echo get_option( 'sns_options_text' ); ?></h3>
<?php endif; ?>
<?php get_template_part( 'parts_sns' ); ?>
</div>
<?php endif; ?>

<?php if ( is_active_sidebar( 'cta' ) ) : ?>
<div class="cta-wrap  wow animated bounceIn" data-wow-delay="0.7s">
<?php dynamic_sidebar( 'cta' ); ?>
</div>
<?php endif; ?>
</footer>
</article>

<?php get_template_part( 'parts_singlefoot' ); ?>

<?php endwhile; ?>
<?php endif; ?>
  
  <div class="fb-comments" data-href="<?php the_permalink(); ?>" data-width="470" data-num-posts="10"></div>
  
</main>
<?php get_sidebar(); ?>
</div>
</div>
<?php endif; wp_reset_query(); //ワンカラム条件分岐END ?>
<?php get_footer(); ?>


<!--この人にメッセージを送るフォーム開閉-->
<script>
jQuery(function($) {
	$("#form-parts").css("display","none");
	
	$(".article-contact h4").on("click", function() {
		$("#form-parts").slideToggle();
	  $('#form-parts').css('display', 'inline');
	});
 
  
});
  
</script>
<!--この人にメッセージを送るフォーム開閉-->
