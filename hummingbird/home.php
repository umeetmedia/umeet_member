<?php get_header(); ?>
<?php get_template_part( 'parts_homeheader' ); ?>
<div id="content">
<div id="inner-content" class="wrap cf">
<?php if ( is_front_page() || is_home() ) : ?>
<?php		  
$args = array(
    'posts_per_page' => 16,
    'offset' => 0,
    'tag' => 'pickup',
    'orderby' => 'post_date',
    'order' => 'DESC',
    'post_type' => array('post','page'),
    'post_status' => 'publish',
    'suppress_filters' => true,
    'ignore_sticky_posts' => true,
    'no_found_rows' => true
);
$the_query = new WP_Query( $args );
if ( $the_query->have_posts() ) {
	?>

<script type="text/javascript">
jQuery(function( $ ) {
	$('.bxslider2').bxSlider({
		minSlides: 2,
		maxSlides: 6,
		slideWidth: 175,
		slideMargin: 10,
		moveSlides: 1,
		auto: true,
		autoHover: true,
		pause: 5000,
		nextText: '>',
		prevText: '<'
	});
	$(window).load(function(){
	    $("#top_carousel ul li").css("opacity", "100");
	});
});
</script>

<div id="top_carousel" class="animated fadeInUp">
<ul class="bxslider2">

<?php while ( $the_query->have_posts() ) {
$the_query->the_post();
?>
<li style="opacity:0;"><a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title_attribute(); ?>">
<?php
$cat = get_the_category();
$cat = $cat[0];
?>
<?php if ( has_post_thumbnail()) : ?>
<figure class="eyecatch">
<?php the_post_thumbnail('home-thum'); ?>
<span class="osusume-label cat-id-<?php echo $cat->cat_ID;?>"><?php echo $cat->name; ?></span>
</figure>
<?php else: ?>
<figure class="eyecatch noimg">
<img src="<?php echo get_template_directory_uri(); ?>/library/images/noimg.png">
<span class="osusume-label cat-id-<?php echo $cat->cat_ID;?>"><?php echo $cat->name; ?></span>
</figure>
<?php endif; ?>
<h2 class="h2 entry-title"><?php the_title(); ?></h2>
</a></li>
<?php } ; ?>
</ul>
</div>
<?php }
wp_reset_postdata();
?>
<?php endif; ?>

<main id="main" class="m-all t-all d-5of7 cf" role="main">
<?php get_template_part( 'parts_add_top' ); ?>

<?php
	$toplayout = get_option('opencage_toppage_archivelayout');
	$toplayoutsp = get_option('opencage_toppage_sp_archivelayout');
?>
<?php if (is_mobile()) :?>
	<?php if ( $toplayoutsp == "toplayout-big" ) : ?>
	<?php get_template_part( 'parts_archive_big' ); ?>
	<?php elseif ( $toplayoutsp == 'toplayout-card' ) : ?>
	<?php get_template_part( 'parts_archive_card' ); ?>
	<?php else : ?>
	<?php get_template_part( 'parts_archive_simple' ); ?>
	<?php endif;?>
<?php else : ?>
	<?php if ( $toplayout == "toplayout-big" ) : ?>
	<?php get_template_part( 'parts_archive_big' ); ?>
	<?php elseif ( $toplayout == 'toplayout-card' ) : ?>
	<?php get_template_part( 'parts_archive_card' ); ?>
	<?php else : ?>
	<?php get_template_part( 'parts_archive_simple' ); ?>
	<?php endif;?>
<?php endif;?>

<?php pagination(); ?>
<?php get_template_part( 'parts_add_bottom' ); ?>
</main>
<?php get_sidebar(); ?>
</div>
</div>
<?php get_footer(); ?>