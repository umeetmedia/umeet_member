<div id="page-top">
	<a href="#header" title="ページトップへ"><i class="fa fa-chevron-up"></i></a>
</div>
<?php if(!is_singular( 'post_lp' ) ): ?>
<div id="footer-top" class="wow animated fadeIn cf">
	<div class="inner wrap">
		<?php if ( is_active_sidebar( 'footer1' ) ) : ?>
			<div class="m-all t-1of2 d-1of3">
			<?php dynamic_sidebar( 'footer1' ); ?>
			</div>
		<?php endif; ?>
		
		<?php if ( is_active_sidebar( 'footer2' ) ) : ?>
			<div class="m-all t-1of2 d-1of3">
			<?php dynamic_sidebar( 'footer2' ); ?>
			</div>
		<?php endif; ?>
		
		<?php if ( is_active_sidebar( 'footer3' ) ) : ?>
			<div class="m-all t-1of2 d-1of3">
			<?php dynamic_sidebar( 'footer3' ); ?>
			</div>
		<?php endif; ?>
	</div>
</div>
<?php endif; ?>

<footer id="footer" class="footer" role="contentinfo">
	<div id="inner-footer" class="wrap cf">
		<nav role="navigation">
			<?php wp_nav_menu(array(
			'container' => 'div',
			'container_class' => 'footer-links cf',
			'menu' => __( 'Footer Links' ),
			'menu_class' => 'footer-nav cf',
			'theme_location' => 'footer-links',
			'before' => '',
			'after' => '',
			'link_before' => '',
			'link_after' => '',
			'depth' => 0,
			'fallback_cb' => ''
			)); ?>
		</nav>
		<p class="source-org copyright">&copy;Copyright<?php echo date('Y'); ?> <a href="<?php echo home_url(); ?>" rel="nofollow"><?php bloginfo( 'name' ); ?></a>.All Rights Reserved.</p>
	</div>
</footer>
</div>
<?php wp_footer(); ?>
<!-- ユニバーサルタグ -->
<script type="text/javascript">
  (function () {
    var tagjs = document.createElement("script");
    var s = document.getElementsByTagName("script")[0];
    tagjs.async = true;
    tagjs.src = "//s.yjtag.jp/tag.js#site=0TMp0Ho";
    s.parentNode.insertBefore(tagjs, s);
  }());
</script>
<noscript>
  <iframe src="//b.yjtag.jp/iframe?c=0TMp0Ho" width="1" height="1" frameborder="0" scrolling="no" marginheight="0" marginwidth="0"></iframe>
</noscript>
</body>
</html>
