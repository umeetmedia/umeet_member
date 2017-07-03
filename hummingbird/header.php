<!doctype html>
<!--[if lt IE 7]><html <?php language_attributes(); ?> class="no-js lt-ie9 lt-ie8 lt-ie7"><![endif]-->
<!--[if (IE 7)&!(IEMobile)]><html <?php language_attributes(); ?> class="no-js lt-ie9 lt-ie8"><![endif]-->
<!--[if (IE 8)&!(IEMobile)]><html <?php language_attributes(); ?> class="no-js lt-ie9"><![endif]-->
<!--[if gt IE 8]><!--> <html <?php language_attributes(); ?> class="no-js"><!--<![endif]-->

<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<title><?php wp_title(''); ?></title>
<meta name="HandheldFriendly" content="True">
<meta name="MobileOptimized" content="320">
<meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no">

<?php if ( get_theme_mod( 'opencage_appleicon' ) ) : ?>
<link rel="apple-touch-icon" href="<?php echo get_theme_mod( 'opencage_appleicon' ); ?>">
<?php else : ?>
<link rel="apple-touch-icon" href="<?php echo get_template_directory_uri(); ?>/library/images/apple-touch-icon.png">
<?php endif; ?>
<?php if ( get_theme_mod( 'opencage_favicon' ) ) : ?>
<link rel="icon" href="<?php echo get_theme_mod( 'opencage_favicon' ); ?>">
<?php else : ?>
<link rel="icon" href="<?php echo get_template_directory_uri(); ?>/library/images/favicon.png">
<?php endif; ?>

<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>">

<!--[if IE]>
<?php if ( get_theme_mod( 'opencage_favicon_ie' ) ) : ?>
<link rel="shortcut icon" href="<?php echo get_theme_mod( 'opencage_favicon_ie' ); ?>">
<?php else : ?>
<link rel="shortcut icon" href="<?php echo get_template_directory_uri(); ?>/library/images/favicon.ico">
<?php endif; ?>
<![endif]-->
<!--[if lt IE 9]>
<script src="//html5shiv.googlecode.com/svn/trunk/html5.js"></script>
<script src="//css3-mediaqueries-js.googlecode.com/svn/trunk/css3-mediaqueries.js"></script>
<![endif]-->

<?php get_template_part( 'head' ); ?>

<?php wp_head(); ?>

<?php if (is_single())
{
$article_css = get_post_meta($post->ID,article_css,true);
    if($article_css)
    {
    echo <<<EOS
<style type="text/css">
$article_css
</style>
EOS;
    }
}
?>
</head>

<body <?php body_class(); ?>>

<div id="container" class="<?php echo esc_html(get_option('post_options_ttl'));?> <?php echo esc_html(get_option('post_options_date'));?><?php if ( get_option( 'side_options_right' ) ) : ?> sidebarleft<?php endif; ?>">

<?php if(!is_singular( 'post_lp' ) ): ?>
<header class="header<?php if ( get_option('side_options_headercenter') || wp_is_mobile() ) : ?> headercenter<?php endif; ?>" role="banner">
<div id="inner-header" class="wrap cf<?php if ( get_option( 'side_options_description' ) ) : ?> descriptionnone<?php endif; ?>">
<?php if ( !get_option( 'side_options_description' ) ) : ?><p class="site_description"><?php bloginfo('description'); ?></p><?php endif; ?>
<div id="logo" class="gf">
<?php if ( is_home() || is_front_page() ) : ?>
<?php if ( get_theme_mod( 'opencage_logo' ) ) : ?>
<h1 class="h1 img"><a href="<?php echo home_url(); ?>" rel="nofollow"><img src="<?php echo get_theme_mod( 'opencage_logo' ); ?>" alt="<?php bloginfo('name'); ?>"></a></h1>
<?php else : ?>
<h1 class="h1 text"><a href="<?php echo home_url(); ?>" rel="nofollow"><?php bloginfo('name'); ?></a></h1>
<?php endif; ?>
<?php else: ?>
<?php if ( get_theme_mod( 'opencage_logo' ) ) : ?>
<p class="h1 img"><a href="<?php echo home_url(); ?>"><img src="<?php echo get_theme_mod( 'opencage_logo' ); ?>" alt="<?php bloginfo('name'); ?>"></a></p>
<?php else : ?>
<p class="h1 text"><a href="<?php echo home_url(); ?>"><?php bloginfo('name'); ?></a></p>
<?php endif; ?>
<?php endif; ?>
</div>

<nav id="g_nav" role="navigation">
<?php if(get_option('side_options_header_search')):?>
<?php get_search_form(); ?>
<?php endif; ?>

<?php wp_nav_menu(array(
     'container' => false,
     'container_class' => 'menu cf',
     'menu' => __( 'グローバルナビ' ),
     'menu_class' => 'nav top-nav cf',
     'theme_location' => 'main-nav',
     'before' => '',
     'after' => '',
     'link_before' => '',
     'link_after' => '',
     'depth' => 0,
     'fallback_cb' => ''
)); ?>
</nav>
<button id="drawerBtn" class="nav_btn"></button>
<script type="text/javascript">
jQuery(function( $ ){
var menu = $('#g_nav'),
    menuBtn = $('#drawerBtn'),
    body = $(document.body),     
    menuWidth = menu.outerWidth();                
     
    menuBtn.on('click', function(){
    body.toggleClass('open');
        if(body.hasClass('open')){
            body.animate({'left' : menuWidth }, 300);            
            menu.animate({'left' : 0 }, 300);                    
        } else {
            menu.animate({'left' : -menuWidth }, 300);
            body.animate({'left' : 0 }, 300);            
        }             
    });
});    
</script>

</div>
</header>
<?php breadcrumb(); ?>
<?php endif; ?>
