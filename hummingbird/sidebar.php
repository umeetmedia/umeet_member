<div id="sidebar1" class="sidebar m-all t-all d-2of7 last-col cf" role="complementary">

<?php if ( is_active_sidebar( 'addbanner-pc-side' ) && !wp_is_mobile() ) : ?>
<div class="add">
<?php dynamic_sidebar( 'addbanner-pc-side' ); ?>
</div>
<?php endif; ?>

<?php if ( is_active_sidebar( 'addbanner-sp-side' ) && wp_is_mobile() ) : ?>
<div class="add">
<?php dynamic_sidebar( 'addbanner-sp-side' ); ?>
</div>
<?php endif; ?>

<?php if ( is_active_sidebar( 'sidebar2' ) && wp_is_mobile()) : ?>
<div id="no-scrollfix" class="mobile add">
<?php dynamic_sidebar( 'sidebar2' ); ?>
</div>
<?php endif; ?>

<?php if ( is_active_sidebar( 'sidebar1' ) ) : ?>
<?php dynamic_sidebar( 'sidebar1' ); ?>
<?php endif; ?>

<?php if ( is_active_sidebar( 'sidebar2' ) && !wp_is_mobile() ) : ?>
<script type="text/javascript">
(function($) {
	$(document).ready(function() {
		
		var windowWidth = $(window).width();
		var windowSm = 1100;
		if (windowSm <= windowWidth) {
		
			/*
			Ads Sidewinder
			by Hamachiya2. http://d.hatena.ne.jp/Hamachiya2/20120820/adsense_sidewinder
			*/
			var main = $('#main'); // メインカラムのID
			var side = $('#sidebar1'); // サイドバーのID
			var wrapper = $('#scrollfix'); // 広告を包む要素のID
	
			var w = $(window);
			var wrapperHeight = wrapper.outerHeight();
			var wrapperTop = wrapper.offset().top;
			var sideLeft = side.offset().left;
	
			var sideMargin = {
				top: side.css('margin-top') ? side.css('margin-top') : 0,
				right: side.css('margin-right') ? side.css('margin-right') : 0,
				bottom: side.css('margin-bottom') ? side.css('margin-bottom') : 0,
				left: side.css('margin-left') ? side.css('margin-left') : 0
			};
	
			var winLeft;
			var pos;
	
			var scrollAdjust = function() {
				sideHeight = side.outerHeight();
				mainHeight = main.outerHeight();
				mainAbs = main.offset().top + mainHeight;
				var winTop = w.scrollTop();
				winLeft = w.scrollLeft();
				var winHeight = w.height();
				var nf = (winTop > wrapperTop) && (mainHeight > sideHeight) ? true : false;
				pos = !nf ? 'static' : (winTop + wrapperHeight) > mainAbs ? 'absolute' : 'fixed';
				if (pos === 'fixed') {
					side.css({
						position: pos,
						top: '',
						bottom: winHeight - wrapperHeight,
						left: sideLeft - winLeft,
						margin: 0
					});
	
				} else if (pos === 'absolute') {
					side.css({
						position: pos,
						top: mainAbs - sideHeight,
						bottom: '',
						left: sideLeft,
						margin: 0
					});
	
				} else {
					side.css({
						position: pos,
						marginTop: sideMargin.top,
						marginRight: sideMargin.right,
						marginBottom: sideMargin.bottom,
						marginLeft: sideMargin.left
					});
				}
			};
	
			var resizeAdjust = function() {
				side.css({
					position:'static',
					marginTop: sideMargin.top,
					marginRight: sideMargin.right,
					marginBottom: sideMargin.bottom,
					marginLeft: sideMargin.left
				});
				sideLeft = side.offset().left;
				winLeft = w.scrollLeft();
				if (pos === 'fixed') {
					side.css({
						position: pos,
						left: sideLeft - winLeft,
						margin: 0
					});
	
				} else if (pos === 'absolute') {
					side.css({
						position: pos,
						left: sideLeft,
						margin: 0
					});
				}
			};
			w.on('load', scrollAdjust);
			w.on('scroll', scrollAdjust);
			w.on('resize', resizeAdjust);
		}
	});
})(jQuery);
</script>
<div id="scrollfix" class="add cf">
<?php dynamic_sidebar( 'sidebar2' ); ?>
</div>
<?php endif; ?>

</div>