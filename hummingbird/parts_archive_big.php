<div class="post-list-big cf">
<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
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
<?php endwhile; ?>
<?php else : ?>
<article id="post-not-found" class="hentry cf">
<header class="article-header">
<h1>まだ投稿がありません。</h1>
</header>
<section class="entry-content">
<p>表示する記事がみつかりませんでした。</p>
</section>
</article>
<?php endif; ?>
</div>