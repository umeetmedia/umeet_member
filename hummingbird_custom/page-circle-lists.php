<?php
/*
 * Template Name:サークルリスト
 * */
?>
<?php get_header(); ?>
<?php get_template_part( 'parts_homeheader' ); ?>

<div id="content">
<div id="inner-content" class="wrap cf">
<main id="main" class="m-all t-all d-5of7 cf" role="main">


  
<h4>新規登録は<a href="http://todai-umeet.com/create-cricle/">こちら</a>からどうぞ</h4>

  
<div id="circle-lists">

<?php
    $circles = pods('circle', array(
                              'limit' => 10,
                              ));
while ($circles->fetch()) {
    
    //サークル個別ページへのリンクつける
  echo '<a href="http://todai-umeet.com/circle-page?id=';
    echo $circles->display('id');
    echo '">';
    
    
    echo '<div class="circle">';
    
    //アイキャッチ
    
    echo '<div class="eye-catch">';
    echo '<img src="';
    echo $circles->display('eye-catch');
    echo '"/>';
    echo '</div><!--eye-catch-->';
    
    //サークル名
    echo '<div class="circle-name"><h3>';
    echo $circles->display('circle-name');
    echo '</h3></div><!--circle-name-->';
    
    //紹介文
    echo '<div class="description">';
    echo wp_trim_words( $circles->display('description'), 50 ); //長いテキストを省略
    //echo $circles->display('description');
    echo '</div><!--description-->';
    
    echo '</div><!--circle-->';
    
    echo '</a>'; //サークル個別ページへのリンク
}
echo $circles->pagination(array('type' => 'advanced'));
?>

</div><!--circle-lists-->

    </main>
<?php get_sidebar(); ?>
</div>
</div>
<?php get_footer(); ?>