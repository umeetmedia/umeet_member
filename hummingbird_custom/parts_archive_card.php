<div class="post-list-card hentry cf">

<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
  
  
  
  
  
  <?php
//1件目の記事
//function.phpでisFirst関数を定義
if (isFirst()) { ?>


  <article id="post-<?php the_ID(); ?>" <?php post_class( 'cf' ); ?> role="article">
<header class="entry-header article-header">
<p class="byline entry-meta vcard">
<?php
$cat = get_the_category();
$cat = $cat[0];
?>
<span class="date gf updated"><?php the_time('Y.m.d'); ?></span>
<span class="cat-name cat-id-<?php echo $cat->cat_ID;?>"><?php echo $cat->name; ?></span>
<span class="author" style="display: none;"><?php the_author(); ?></span>
</p>
<h1 class="h2 entry-title"><a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a></h1>
<?php if ( has_post_thumbnail()) : ?>
<figure class="eyecatch">
<a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title_attribute(); ?>"><?php the_post_thumbnail('single-thum'); ?></a>
</figure>
<?php endif; ?>
</header>

<section class="entry-content cf">
<?php the_excerpt(); ?>
<div class="readmore">
<a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title_attribute(); ?>">続きを読む</a>
</div>
</section>
</article>
  
  
  
  

<?php }
//2件目以降
else { ?>


  <article class="post-list cf animated fadeInUp" role="article">
<a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title_attribute(); ?>">

<?php
$cat = get_the_category();
$cat = $cat[0];
?>

<?php if ( has_post_thumbnail()) : ?>
<figure class="eyecatch">
<?php the_post_thumbnail('home-thum'); ?>
<span class="cat-name cat-id-<?php echo $cat->cat_ID;?>"><?php echo $cat->name; ?></span>
</figure>
<?php else: ?>
<figure class="eyecatch noimg">
<img src="<?php echo get_template_directory_uri(); ?>/library/images/noimg.png">
<span class="cat-name cat-id-<?php echo $cat->cat_ID;?>"><?php echo $cat->name; ?></span>
</figure>
<?php endif; ?>

<section class="entry-content cf">
<h1 class="h2 entry-title"><?php the_title(); ?></h1>

<p class="byline entry-meta vcard">
<span class="date gf updated"><?php the_time('Y.m.d'); ?></span>
<span class="author" style="display: none;"><?php the_author(); ?></span>
</p>

<div class="description"><?php the_excerpt(); ?></div>

</section>
</a>
</article>
  
  
  
  
  
<?php }
?>
  
  
  
  
  
  
  
  
  
  
  
  
  
  



  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
<?php endwhile; ?>


<?php elseif(is_search()): ?>
<article id="post-not-found" class="hentry cf">
<header class="article-header">
<h1>記事が見つかりませんでした。</h1>
</header>

<section class="entry-content">

<p>お探しのキーワードで記事が見つかりませんでした。別のキーワードで再度お探しいただくか、カテゴリ一覧からお探し下さい。</p>

<div class="search">
<h2>キーワード検索</h2>
<?php get_search_form(); ?>
</div>


<div class="cat-list cf">
<h2>カテゴリーから探す</h2>
<ul>
<?php $args = array(
'title_li' => '',
); ?>
<?php wp_list_categories($args); ?>
</ul>
</div>

</section>

</article>

<?php else : ?>

<article id="post-not-found" class="hentry cf">
<header class="article-header">
<h1>まだ投稿がありません！</h1>
</header>
<section class="entry-content">
<p>表示する記事がまだありません。</p>
</section>
</article>

<?php endif; ?>
</div>
