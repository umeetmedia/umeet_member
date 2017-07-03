<div class="author-newpost cf">
	<h2 class="h_ttl"><span class="gf">NEW POST</span>このライターの最新記事</h2>
		<ul>
<?php
  $author_id = get_the_author_meta( 'ID' );
  $args = array(
  'post_type' => 'post',
  'author' => $author_id,
  'showposts' => 4, /* 表示個数 */
); ?>
<?php $loop = new WP_Query( $args ); ?>
<?php while ($loop->have_posts()) : $loop->the_post(); ?>
			<li>
				<a href="<?php the_permalink() ?>">
						<figure class="eyecatch">
<?php if(has_post_thumbnail()) { ?>
<?php the_post_thumbnail('home-thum'); ?>
<?php } else { ?>
						<img src="<?php echo get_template_directory_uri(); ?>/library/images/noimg.png" />
<?php } ?>
						</figure>
						<span class="cat-name"><?php $cat = get_the_category(); ?><?php $cat = $cat[0]; ?><?php echo get_cat_name($cat->term_id); ?></span>
					<time class="date gf"><?php the_time( 'Y.n.j' ); ?></time>
					<h3 class="ttl">
	<?php if(mb_strlen($post->post_title)>38) { $title= mb_substr($post->post_title,0,38) ; echo $title. "…" ;
	} else {echo $post->post_title;}?>
					</h3>
				</a>
</li>
<?php endwhile; ?>
<?php wp_reset_query();?>
		</ul>
</div>