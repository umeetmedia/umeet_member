<?php
    /*
     Template Name: 本の感想投稿用テンプレート
     */
    ?>

<?php get_header(); ?>
<?php get_template_part( 'parts_homeheader' ); ?>
<div id="content">
<div id="inner-content" class="wrap cf">
<main id="main" class="m-all t-all d-5of7 cf" role="main">
<?php get_template_part( 'parts_add_top' ); ?>

  <div class="book-thumb">
  <h2 class="book-publis-title"><?php the_title(); ?></h2>
  <div class="book-img"><?php the_post_thumbnail();?></div>
  </div>
 
  <style>
	 .book-thumb{position:relative; width:100%;}
  .book-publis-title{position:absolute;
	font-size:2em;
	  text-shadow: 1px 1px 5px rgba(0, 0, 0, 0.5);

	  
	  color:#fff;
	  text-align:center;
	  margin-right:30%;
	  margin-left:30%;
	}
	</style>
<?php
    $pod_book = pods( 'book' );
    $fields = array(
                    'post_title' => array( 'label' => 'タイトル', 'required' => true),
                    'post_content' => array( 'label' => '感想','required' => true),
                    );
    echo $pod_book->form($fields, '感想を送る',' http://todai-umeet.com/thank-you/'); //あとでthank you urlを追加する(3つめのパラメータ)
    ?>



<?php get_template_part( 'parts_add_bottom' ); ?>
</main>
<?php get_sidebar(); ?>
</div>
</div>
<?php get_footer(); ?>