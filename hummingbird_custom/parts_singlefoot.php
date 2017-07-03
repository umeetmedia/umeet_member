<?php
/*
 * Template Name:記事個別ページの記事下のプロフィールとか諸諸
 * */
?>

<div class="np-post">
<div class="navigation">
<div class="prev np-post-list">
<?php $nextpost = get_adjacent_post(false, '', false); if ($nextpost) : ?>
<a href="<?php echo get_permalink($nextpost->ID); ?>" class="cf">
<figure class="eyecatch"><?php echo get_the_post_thumbnail($nextpost->ID,'thumbnail'); ?></figure>
<span class="ttl"><?php echo esc_attr($nextpost->post_title); ?></span>
</a>
<?php else:?>
<div class="home_link">
<a href="<?php echo home_url(); ?>"><figure class="eyecatch"><i class="fa fa-home"></i></figure><span class="ttl">トップページへ</span></a>
</div>
<?php endif; ?>
</div>


</div>
</div>

<?php //プラグインYARPPを使っている場合はプラグインの設定画面から「カスタム > yarpp-template-relative.php」を選ぶとプラグインのレコメンド機能を実装できます。 ;?>
<?php // if(function_exists('related_posts')): ?>
<?php // related_posts(); ?>
<?php // else :?>
<?php // include( TEMPLATEPATH . '/related-entries.php' ); ?>
<?php // endif;?>

<div class="authorbox wow animated bounceIn" data-wow-delay="0.5s">
<?php if(get_the_author_meta('description')) : ?>
<div class="inbox">
<div class="profile cf">
<h2 class="h_ttl"><span class="gf">ABOUT</span>この記事をかいた人</h2>
<?php echo get_avatar(get_the_author_meta('ID'), 150); ?>
<p class="name author"><?php the_author_posts_link(); ?></p>




  
<div class="profile_description">

<?php the_author_meta("description" ); ?>

 <br/> 
  <?php
//メッセージアイコンを表示
echo '<a href="';
echo get_bloginfo(url).'/?author='.get_the_author_meta('ID');
echo '">';
?>
<i class="fa fa-envelope-o" style="color:#219ace;"></i>
</a>  
  
  </div>
 
 


  
<div class="author_sns gf">
<ul>
<?php if(get_the_author_meta('user_url')) : ?>
<li><a href="<?php the_author_meta( 'user_url' ); ?>" target="_blank"><i class="fa fa-globe"></i>WebSite</a></li>
<?php endif ;?>
<?php if(get_the_author_meta('twitter')) : ?>
<li><a href="<?php the_author_meta( 'twitter' ); ?>" rel="nofollow" target="_blank"><i class="fa fa-twitter fa-lg"></i>Twitter</a></li>
<?php endif ;?>
<?php if(get_the_author_meta('facebook')) : ?>
<li><a href="<?php the_author_meta( 'facebook' ); ?>" rel="nofollow" target="_blank"><i class="fa fa-facebook fa-lg"></i>Facebook</a></li>
<?php endif ;?>
<?php if(get_the_author_meta('googleplus')) : ?>
<li><a href="<?php the_author_meta( 'googleplus' ); ?>" rel="nofollow" target="_blank"><i class="fa fa-google-plus fa-lg"></i>Google+</a></li>
<?php endif ;?>
</ul>
</div>
</div>

</div>
<?php endif; ?>
</div>  
  

<div role="form" class="wpcf7" id="wpcf7-f9247-p9248-o1" lang="ja" dir="ltr">
<div class="screen-reader-response"></div>
<form action="/article/4745/#wpcf7-f9247-p9248-o1" method="post" class="wpcf7-form" novalidate="novalidate">
<div style="display: none;">
<input type="hidden" name="_wpcf7" value="9247" />
<input type="hidden" name="_wpcf7_version" value="4.4" />
<input type="hidden" name="_wpcf7_locale" value="ja" />
<input type="hidden" name="_wpcf7_unit_tag" value="wpcf7-f9247-p9248-o1" />
<input type="hidden" name="_wpnonce" value="7ff06f3c23" />
</div>
<div class="article-contact">
<h4 class="h_ttl">この記事に感想を送る▼</h4>
<div id="form-parts">
<p>メールアドレス (必須)<br />
    <span class="wpcf7-form-control-wrap your-email"><input type="email" name="your-email" value="" size="40" class="wpcf7-form-control wpcf7-text wpcf7-email wpcf7-validates-as-email　wpcf7-validates-as-required" aria-invalid="false" /></span> </p>
<p>メッセージ<br />
    <span class="wpcf7-form-control-wrap your-message"><textarea name="your-message" cols="40" rows="2" class="wpcf7-form-control wpcf7-textarea" aria-invalid="false"></textarea></span> </p>
<p><input type="submit" value="送信" class="wpcf7-form-control wpcf7-submit" /></p>
</div>
<p><!--form-parts-->
</div>
<div class="wpcf7-response-output wpcf7-display-none"></div></form></div>

