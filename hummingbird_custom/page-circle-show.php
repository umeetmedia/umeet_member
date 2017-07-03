<?php
/*
 * Template Name:サークル個別ページ
 * */
?>
<?php get_header(); ?>
<?php get_template_part( 'parts_homeheader' ); ?>

<div id="content">
<div id="inner-content" class="wrap cf">
<main id="main" class="m-all t-all d-5of7 cf" role="main">


<div id="circle-page-show">
<?php
    
    //サークルID取得
  $id = $_GET['id'];
  
//アイキャッチ
    echo '<div class="eye-catch">';
    echo '<img src="';
    $imagearray =  get_post_meta( $id, 'eye-catch', true );
    echo $imagearray["guid"];
    echo '"/>';
    echo '</div><!--eye-catch-->';

    
    
    //サークル名
    echo '<div class="circle-name"><h3>';
    echo get_post_meta( $id, 'circle-name', 'input' );

    echo '</h3></div><!--circle-name-->';
    
   //SNS拡散
   if(function_exists("wp_social_bookmarking_light_output_e")){wp_social_bookmarking_light_output_e();}
    
    
    //紹介文
    echo '<div class="description">';
    echo get_post_meta( $id, 'description', 'rich' );
    echo '</div><!--description-->';
    
    
    echo '<table><tbody><tr><th>メールアドレス</th><td>';
    
    //クリックでメールソフトを起動(mailto)
    echo '<a href="mailto:';
    echo get_post_meta( $id, 'email', true );
    echo '">';
    echo get_post_meta( $id, 'email', 'input' );
    echo '</a>';
    
    
    echo '</td></tr><tr><th>サイトURL</th><td>';
    echo '<a href="';
    echo get_post_meta( $id, 'url', true );
    echo '">';
    echo get_post_meta( $id, 'url', 'input' );
    echo '</a>';
    
   
    echo '</td></tr><tr><th>twitter</th><td>';
    
    echo '<a href="';
    echo get_post_meta( $id, 'twitter', true );
    echo '">';
    echo get_post_meta( $id, 'twitter', 'input' );
    echo '</a>';
    
    
    echo '</td></tr><tr><th>facebook</th><td>';
    
    echo '<a href="';
    echo get_post_meta( $id, 'facebook', true );
    echo '">';
    
    echo get_post_meta( $id, 'facebook', 'input' );
    
    echo '</a>';

    
    echo '</td></tr></tbody></table>';
?>  
  
 
  
</div><!--circle-page-show-->

    </main>
<?php get_sidebar(); ?>
</div>
</div>
<?php get_footer(); ?>