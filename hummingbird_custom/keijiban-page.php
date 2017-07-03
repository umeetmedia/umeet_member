<?php
    
    /*
     
     Template Name: 簡易掲示板
     
     */
    
    ?>






<?php get_header(); ?>
<?php get_template_part( 'parts_homeheader' ); ?>
<div id="content">

  <div id="inner-content" class="wrap cf">
<main id="main" class="m-all t-all d-5of7 cf" role="main">
<?php get_template_part( 'parts_add_top' ); ?>

  <?php
if ( post_password_required() ) {
  return;
}
?>
  
<h2><span style="text-align:center;"> <?php the_title_attribute(); ?></span> </h2>  
  
<?php if ( have_comments() ) : ?>
<h3 id="comments-title" class="h2"><i class="fa fa-comments-o fa-lg"></i>  <?php comments_number( __( '投稿はまだありません。', 'moaretrotheme' ), __( '<span>1</span> 個のコメント', 'moaretrotheme' ), __( '<span>%</span> 件のコメント', 'moaretrotheme' ) );?></h3>
<section class="commentlist" id="comments">
  
  
  
  
  
  
  
  
  
  <?php



  $comments_arg=array('post_id'=>$post->ID,);
  wp_list_comments( array(
    'reply_text'        => __('返信する', 'moaretrotheme'),
    'reverse_children' => 'true'
  ),get_comments($comments_arg) );
?>
  
  
</section>
<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : ?>
<nav class="navigation comment-navigation" role="navigation">
  <div class="comment-nav-prev"><?php previous_comments_link( __( '&larr; 前の投稿', 'moaretrotheme' ) ); ?></div>
  <div class="comment-nav-next"><?php next_comments_link( __( '次の投稿 &rarr;', 'moaretrotheme' ) ); ?></div>
</nav>
<?php endif; ?>
<?php if ( ! comments_open() ) : ?>
<?php endif; ?>
<?php endif; ?>

  
  
<?php
$comments_arg=array(
  'post_id'=>$post->ID,
);
$list_arg=array(
/*wp_list_commentsのパラメータ*/
);
wp_list_comments(array(),get_comments($comments_arg));

?>

<div id="commentform">
<?php get_template_part( 'keijibancomments' ); ?>
</div>
  
<?php get_template_part( 'parts_add_bottom' ); ?>
</main>
<?php get_sidebar(); ?>
</div>
</div>
<?php get_footer(); ?>

<style>
 .comment{list-style:none;
 	margin-bottom: 20px;
	border:0.2px solid gray;
  }
  
.comment
{
    position:relative;
    -webkit-box-shadow:0 1px 4px rgba(0, 0, 0, 0.3), 0 0 40px rgba(0, 0, 0, 0.1) inset;
       -moz-box-shadow:0 1px 4px rgba(0, 0, 0, 0.3), 0 0 40px rgba(0, 0, 0, 0.1) inset;
            box-shadow:0 1px 4px rgba(0, 0, 0, 0.3), 0 0 40px rgba(0, 0, 0, 0.1) inset;
}
.comment:before, .comment:after
{
    content:"";
    position:absolute;
    z-index:-1;
    -webkit-box-shadow:0 0 20px rgba(0,0,0,0.8);
    -moz-box-shadow:0 0 20px rgba(0,0,0,0.8);
    box-shadow:0 0 20px rgba(0,0,0,0.8);
    top:50%;
    bottom:0;
    left:10px;
    right:10px;
    -moz-border-radius:100px / 10px;
    border-radius:100px / 10px;
}
.comment:after
{
    right:10px;
    left:auto;
    -webkit-transform:skew(8deg) rotate(3deg);
       -moz-transform:skew(8deg) rotate(3deg);
        -ms-transform:skew(8deg) rotate(3deg);
         -o-transform:skew(8deg) rotate(3deg);
            transform:skew(8deg) rotate(3deg);
}
  
 
  
</style>

