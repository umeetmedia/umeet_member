<?php
    /*
     Template Name:ライター一覧
     */
    ?>
<?php get_header(); ?>
<?php get_template_part( 'parts_homeheader' ); ?>
<div id="content">
<div id="inner-content" class="wrap cf">
<main id="main" class="m-all t-all d-5of7 cf" role="main" itemscope itemprop="mainContentOfPage" itemtype="http://schema.org/Blog">
<?php get_template_part( 'parts_add_top' ); ?>

<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
<article id="post-<?php the_ID(); ?>" <?php post_class( 'cf' ); ?> role="article" itemscope itemtype="http://schema.org/BlogPosting">
<header class="article-header entry-header animated fadeInDown">
<h1 class="page-title entry-title" itemprop="headline"><?php the_title(); ?></h1>
<?php if ( has_post_thumbnail() && !get_option( 'post_options_eyecatch' ) ) :?>
<figure class="eyecatch animated fadeInUp">
<?php the_post_thumbnail('single-thum'); ?>
</figure>
<?php endif; ?>
<?php if ( !get_option( 'sns_options_hide' ) &&!is_home() && !is_front_page() && get_option( 'sns_options_page' )) : ?>
<?php get_template_part( 'parts_sns_short' ); ?>
<?php endif; ?>
</header>
<section class="entry-content cf" itemprop="articleBody">
<?php the_content(); ?>
<!--投稿者一覧を表示-->
<?php $users =get_users( array('orderby'=>'post_count', 'order'=>DESC) );
    echo '<div class="writers">';
    foreach($users as $user):
    $uid = $user->ID;
    $userData = get_userdata($uid);
    echo '<div class="writer-profile">';
    echo '<figure class="eyecatch">';
    echo get_avatar($uid, 300); 
    echo '</figure>';
    echo '<div class="profiletxt">';
    echo '<p class="name">'.$user->display_name.'</p>';
    echo '<div class="description">'. profiletrimwidth(esc_attr($userData->user_description)).'</div>';
//学部を表示
//echo '<span class="faculty-name">';
//the_author_meta('faculty');
//echo '</span>'; 

echo '<div class="button"><a href="'.get_bloginfo(url).'/?author='.$uid.'">'.$user->display_name.'の記事一覧</a></div>';
    echo '</div>';
    echo '</div>';
    endforeach;
    echo '</div>'; ?>
</section>
<?php if ( !get_option( 'sns_options_hide' ) &&!is_home() && !is_front_page() && get_option( 'sns_options_page' )) : ?>
<footer class="article-footer">
<div class="sharewrap wow animated bounceIn" data-wow-delay="0.5s">
<?php if ( get_option( 'sns_options_text' ) ) : ?>
<h3><?php echo get_option( 'sns_options_text' ); ?></h3>
<?php endif; ?>
<?php get_template_part( 'parts_sns' ); ?>
</div>
</footer>
<?php endif; ?>
</article>
<?php endwhile; endif; ?>
<?php get_template_part( 'parts_add_bottom' ); ?>
</main>
<?php get_sidebar(); ?>
</div>
</div>
<?php get_footer(); ?>
