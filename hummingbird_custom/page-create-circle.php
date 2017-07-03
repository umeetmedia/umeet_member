<?php
/*
 * Template Name:サークル新規作成フォーム
 * */
?>
<?php get_header(); ?>
<?php get_template_part( 'parts_homeheader' ); ?>

<div id="content">
<div id="inner-content" class="wrap cf">
<main id="main" class="m-all t-all d-5of7 cf" role="main">

  
  
  
  <h3>
	一覧は<a href="http://todai-umeet.com/circles/">こちら</a>
  </h3>
  
  
  
  <?php
    //画面上で編集したいフィールドはform関数の第一パラメーターに配列として渡します。
    $pod_circle = pods( 'circle' );
    $fields = array('circle-name','description', 'eye-catch','email','url','twitter','facebook');
    echo $pod_circle->form($fields, '登録する');
  ?>
  
  
  
  
  
  
</main>
<?php get_sidebar(); ?>
</div>
</div>
<?php get_footer(); ?>
