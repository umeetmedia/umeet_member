<?php

// 子テーマのstyle.cssを後から読み込む
add_action( 'wp_enqueue_scripts', 'theme_enqueue_styles' );
function theme_enqueue_styles() {
    wp_enqueue_style( 'style', get_template_directory_uri() . '/style.css' );
    wp_enqueue_style( 'child-style',
        get_stylesheet_directory_uri() . '/style.css',
        array('style')
    );
}


// MOREタグの下に広告を表示
add_filter('the_content', 'adMoreReplace');
function adMoreReplace($contentData) {
if (is_mobile()){
$adTags = <<< EOF

<div class="add more">
<!--ここにスマホ用の広告コードをはりつけてください。-->
	
</div>

EOF;
} else{
$adTags = <<< EOF

<div class="add more">
<!--ここにPC用・タブレット用の広告コードをはりつけてください。-->

</div>
  
EOF;
}
    $contentData = preg_replace('/<span id="more-[0-9]+"><\/span>/', $adTags, $contentData);
    $contentData = str_replace('<p></p>', '', $contentData);
    $contentData = str_replace('<p><br />', '<p>', $contentData);
    return $contentData;
}

//ブログカード用に
//サイトドメインを取得
function get_this_site_domain(){
  //ドメイン情報を$results[1]に取得する
  preg_match( '/https?:\/\/(.+?)\//i', admin_url(), $results );
  return $results[1];
}
 
//本文抜粋を取得する関数（綺麗な抜粋文を作成するため）
//使用方法：http://nelog.jp/get_the_custom_excerpt
function get_the_custom_excerpt($content, $length) {
  $length = ($length ? $length : 70);//デフォルトの長さを指定する
  $content =  preg_replace('/<!--more-->.+/is',"",$content); //moreタグ以降削除
  $content =  strip_shortcodes($content);//ショートコード削除
  $content =  strip_tags($content);//タグの除去
  $content =  str_replace("&nbsp;","",$content);//特殊文字の削除（今回はスペースのみ）
  $content =  mb_substr($content,0,$length);//文字列を指定した長さで切り取る
  return $content;
}
 
//本文中のURLをブログカードタグに変更する
function url_to_blog_card($the_content) {
  if ( is_singular() ) {//投稿ページもしくは固定ページのとき
    //1行にURLのみが期待されている行（URL）を全て$mに取得
    $res = preg_match_all('/^(<p>)?(<a.+?>)?https?:\/\/'.preg_quote(get_this_site_domain()).'\/[-_.!~*\'()a-zA-Z0-9;\/?:\@&=+\$,%#]+(<\/a>)?(<\/p>)?(<br ? \/>)?$/im', $the_content,$m);
    //マッチしたURL一つ一つをループしてカードを作成
    foreach ($m[0] as $match) {
      $url = strip_tags($match);//URL
      $id = url_to_postid( $url );//IDを取得（URLから投稿ID変換）
      if ( !$id ) continue;//IDを取得できない場合はループを飛ばす
      $post = get_post($id);//IDから投稿情報の取得
      $title = $post->post_title;//タイトルの取得
      $date = mysql2date('Y-m-d H:i', $post->post_date);//投稿日の取得
      $excerpt = get_the_custom_excerpt($post->post_content, 90);//抜粋の取得
      $thumbnail = get_the_post_thumbnail($id, 'thumb100', array('style' => 'width:100px;height:100px;', 'class' => 'blog-card-thumb-image'));//サムネイルの取得（要100×100のサムネイル設定）
      if ( !$thumbnail ) {//サムネイルが存在しない場合
        $thumbnail = '<img src="'.get_template_directory_uri().'/images/no-image.png" style="width:100px;height:100px;" />';
      }
      //取得した情報からブログカードのHTMLタグを作成
      $tag = '<div class="blog-card"><div class="blog-card-thumbnail"><a href="'.$url.'" class="blog-card-thumbnail-link">'.$thumbnail.'</a></div><div class="blog-card-content"><div class="blog-card-title"><a href="'.$url.'" class="blog-card-title-link">'.$title.'</a></div><div class="blog-card-excerpt">'.$excerpt.'</div></div><div class="blog-card-footer clear"><span class="blog-card-date">'.$date.'</span></div></div>';
      //本文中のURLをブログカードタグで置換
      $the_content = preg_replace('{'.preg_quote($match).'}', $tag , $the_content, 1);
    }
  }
  return $the_content;//置換後のコンテンツを返す
}
add_filter('the_content','url_to_blog_card');//本文表示をフック





//自分の画像だけ出るようにする（投稿者）
//http://liginc.co.jp/programmer/archives/4054 を参考にした
add_filter('query_string', "set_media_query");
 
function set_media_query($query_string){
    global $pagenow,$current_user; // media-upload.php 、upload.php
 
    // メディアライブラリ系の処理以外は何もしない
    if($pagenow != 'media-upload.php' && $pagenow != 'upload.php') {
        return $query_string;
    }
 
    get_currentuserinfo();
 
    // 編集者以上だったら何もしない
    if($current_user->user_level >= 5) {
        return $query_string;
    }
 
    wp_parse_str($query_string, $qv);
 
    // メディア以外のqueryの場合も何もしない
    if($qv['post_type'] != 'attachment') {
        return $query_string;
    }
 
    // 条件に自分の画像を追加
    $add_query_string = array(
        'author' => $current_user->ID
    );
 
    $new_query_vars = array_merge($add_query_string,$qv);
 
    $query_var = array();
    foreach ($new_query_vars as $key => $value) {
        $query_var[] = $key.'='.$value;
    }
 
    return join('&', $query_var);
 
}

//ソースのWordpressバージョン非表示
remove_action('wp_head','wp_generator');

function replace_post_title($title) {
	global $post;
	//post_typeを判定(post, page, カスタム投稿)
	if( $post->post_type == 'any' ){
		if(!empty($_POST['circles'])){
			//カスタムフィールドを展開する
			foreach ($_POST['circles'] as $key => $value) {
				//タイトルに付けたいフィールド名を指定する。
				if($key == 'circle-name'){
					$title .= $value;
				}
			}
		}
	}
	return $title;
}
add_filter('title_save_pre', 'replace_post_title');


//会員登録フォームでPOSTした内容を取得し、$_POST[‘user_login’] に $_POST[‘user_email’] を代入
//メールアドレスをユーザー名にも設定する

function my_user_postregister($tml) {
    if ( 'register' == $tml->request_action ) {
        if ( 'POST' == $_SERVER['REQUEST_METHOD'] ) {
            $_POST['user_login'] = $_POST['user_email'];
        }
    }
}
 
add_action( 'tml_request', 'my_user_postregister');

//ユーザー登録時のエラーを消す
function my_user_register_valid($errors) {
    $rep1 = array();
    $rep2 = array();
 
    /* エラー表記を消す例 */
    array_push($rep1, "<strong>エラー</strong>: ");
    array_push($rep2, "");
    array_push($rep1, "<strong>ERROR</strong>: ");
    array_push($rep2, "");
 
    /* 英語表記を変更する例 */
    array_push($rep1, "Please enter your password twice.");
    array_push($rep2, "パスワードを2回入力してください。");
    array_push($rep1, "Please enter the same password in the two password fields.");
    array_push($rep2, "パスワードは同じものを2回入力してください");
 
    /* ユーザー名という表記を消す例 */
    array_push($rep1, "メールアドレスを入力してください。");
    array_push($rep2, '<span class="deletedmsg"></span>');
    array_push($rep1, "ユーザー名");
    array_push($rep2, "メールアドレス");
 
    $custom_error = new WP_Error();
    foreach ( $errors -> errors as $key => $val ) {
        $tmp = str_replace($rep1,$rep2,$val[0]);
        $custom_error -> add($key, $tmp);
    }
    return $custom_error;
}
add_filter( 'registration_errors', 'my_user_register_valid', 10 );


/*ログイン画面のラベル文章変更*/
function change_username_text($text){

       if(in_array($GLOBALS['pagenow'], array('wp-login.php'))){

         if ($text == 'ユーザー名'){$text = 'メールアドレス';}

            }

                return $text;

         }

add_filter( 'gettext', 'change_username_text' );



/**
 * get_social_avatar
 * ソーシャルログインユーザー用アバター画像
 * @param string $img イメージタグ
 * @param string $id_or_email ユーザーIDもしくはEメールアドレス
 * @param numeric $size 画像サイズ
 * @param string $default デフォルト画像URL
 * @param string $atl alt
 * @return string イメージタグ
 */


//Dashiconsを使用できる状態にする
//http://webshufu.com/wp-visual-icon-fonts/　を参考
add_action( 'wp_enqueue_scripts', 'load_dashicons' );
function load_dashicons() {
wp_enqueue_style( 'dashicons' );
}

//外部確認プラグインのURLが作用する時間をデフォルトより延長する
//コードはhttp://liginc.co.jp/web/wp/plug-in/156859より
function my_ppp_nonce_life(){
    return 60 * 60 * 2000;
}
add_filter('ppp_nonce_life', 'my_ppp_nonce_life');


//1件目の記事取得
function isFirst(){
    global $wp_query;
    return ($wp_query->current_post === 0);
}



//ライター一覧で、60字以上の場合省略...を入れる
function profiletrimwidth($str, $length=60, $append="...") {
    if (mb_strlen($str) > $length) {
        $str = mb_substr($str, 0, $length, 'UTF-8');

        return $str .  $append;
    }

    return $str;
}


//プロフィールページに学部を追加

    add_action( 'show_user_profile', 'show_extra_profile_fields' );
    add_action( 'edit_user_profile', 'show_extra_profile_fields' );

    function show_extra_profile_fields( $user ) { ?>
        <h3>Extra profile information</h3>
        <table class="form-table">
            <tr>
                <th><label for="faculty">所属</label></th>
                <td>
                    <select name="faculty" id="faculty" >
                    
                    <option value="教養部" <?php selected( '教養学部', get_the_author_meta( 'faculty', $user->ID ) ); ?>>教養部</option>
                    
                        <option value="文学部" <?php selected( '文学部', get_the_author_meta( 'faculty', $user->ID ) ); ?>>文学部</option>
                      
                        
                            <option value="経済学部" <?php selected( '経済学部', get_the_author_meta( 'faculty', $user->ID ) ); ?>>経済学部</option>
                        
                         <option value="法学部" <?php selected( '法学部', get_the_author_meta( 'faculty', $user->ID ) ); ?>>法学部</option>
                         
                         <option value="工学部" <?php selected( '工学部', get_the_author_meta( 'faculty', $user->ID ) ); ?>>工学部</option>

                        
        <option value="理学部" <?php selected( '理学部', get_the_author_meta( 'faculty', $user->ID ) ); ?>>理学部</option>                 
                        
                         <option value="薬学部" <?php selected( '薬学部', get_the_author_meta( 'faculty', $user->ID ) ); ?>>薬学部</option>
                        
                            <option value="農学部" <?php selected( '農学部', get_the_author_meta( 'faculty', $user->ID ) ); ?>>農学部</option>
                        
                        <option value="医学部" <?php selected( '医学部', get_the_author_meta( 'faculty', $user->ID ) ); ?>>医学部</option>
					  
					  <option value="運動会" <?php selected( '運動会', get_the_author_meta( 'faculty', $user->ID ) ); ?>>団体(運動会)</option>
					  
					  <option value="サークル" <?php selected( 'サークル', get_the_author_meta( 'faculty', $user->ID ) ); ?>>団体(サークル)</option>
					  
					  <option value="学生団体" <?php selected( '学生団体', get_the_author_meta( 'faculty', $user->ID ) ); ?>>団体(学生団体)</option>
					  
					  <option value="ゼミ" <?php selected( 'ゼミ', get_the_author_meta( 'faculty', $user->ID ) ); ?>>団体(ゼミ)</option>
                        

                        
                        
                    </select>
                </td>
            </tr>
        </table>
    <?php }

    add_action( 'personal_options_update', 'save_extra_profile_fields' );
    add_action( 'edit_user_profile_update', 'save_extra_profile_fields' );

    function save_extra_profile_fields( $user_id ) {
        if ( !current_user_can( 'edit_user', $user_id ) )
            return false;
        update_usermeta( $user_id, 'faculty', $_POST['faculty'] );
    }


//gianismに関して、プロフィール画像を取得する
function get_social_avatar( $img, $id_or_email, $size, $default, $alt ) {
  
	
	
	
	
	
	
  
    $_wpg_facebook_id = get_the_author_meta( '_wpg_facebook_id', $id_or_email );
    $_wpg_twitter_screen_name = get_the_author_meta( '_wpg_twitter_screen_name', $id_or_email );
    // Facebookのとき
    if ( $_wpg_facebook_id ) {
        $img = '<img src="https://graph.facebook.com/' . esc_attr( $_wpg_facebook_id ) . '/picture?type=square" alt="' . esc_attr( $alt ) .'" width="' . esc_attr( $size ) .'" height="' . esc_attr( $size ) .'" class="avatar photo" />';
    }
    // Twitterのとき
    elseif ( $_wpg_twitter_screen_name ) {
        if ( false === ( $profile_image_url = get_transient( 'twitter_avatar_' . $_wpg_twitter_screen_name ) ) ) {
            if ( class_exists( 'Twitter_Controller' ) ) {
                $wp_gianism_option = get_option( 'wp_gianism_option' );
                $Twitter_Controller = new Twitter_Controller( array(
                    "tw_screen_name" => $id_or_email,
                    "tw_consumer_key" => $wp_gianism_option['tw_consumer_key'],
                    "tw_consumer_secret" => $wp_gianism_option['tw_consumer_secret'],
                    "tw_access_token" => $wp_gianism_option['tw_access_token'],
                    "tw_access_token_secret" => $wp_gianism_option['tw_access_token_secret'],
                ) );
                $t = $Twitter_Controller->request( 'users/show', array(
                    'screen_name' => $_wpg_twitter_screen_name
                ) );
            } else {
                $twitter = \Gianism\Service\Twitter::get_instance();
                $t = $twitter->call_api( 'users/show', array(
                    'screen_name' => $_wpg_twitter_screen_name
                ) );
            }
            $profile_image_url = $t->profile_image_url;
            set_transient( 'twitter_avatar_' . $_wpg_twitter_screen_name, $profile_image_url, 60 * 60 * 1 );
        }
        if ( $profile_image_url ) {
            $img = '<img src="' . esc_url( $profile_image_url ) . '" alt="' . esc_attr( $alt ) .'" width="' . esc_attr( $size ) .'" height="' . esc_attr( $size ) . '" class="avatar photo" />';
        }
    }
    return $img;
}
add_filter( 'get_avatar', 'get_social_avatar', 10, 5 );
add_filter( 'ppp_nonce_life', 'my_nonce_life' );
function my_nonce_life() {
    return 60 * 60 * 24 * 10; // 10 days
}

//Custom CSS Widget
add_action('admin_menu', 'custom_css_hooks');
add_action('save_post', 'save_custom_css');
add_action('wp_head','insert_custom_css');
function custom_css_hooks() {
	add_meta_box('custom_css', 'Custom CSS', 'custom_css_input', 'post', 'normal', 'high');
	add_meta_box('custom_css', 'Custom CSS', 'custom_css_input', 'page', 'normal', 'high');
}
function custom_css_input() {
	global $post;
	echo '<input type="hidden" name="custom_css_noncename" id="custom_css_noncename" value="'.wp_create_nonce('custom-css').'" />';
	echo '<textarea name="custom_css" id="custom_css" rows="5" cols="30" style="width:100%;">'.get_post_meta($post->ID,'_custom_css',true).'</textarea>';
}
function save_custom_css($post_id) {
	if (!wp_verify_nonce($_POST['custom_css_noncename'], 'custom-css')) return $post_id;
	if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) return $post_id;
	$custom_css = $_POST['custom_css'];
	update_post_meta($post_id, '_custom_css', $custom_css);
}
function insert_custom_css() {
	if (is_page() || is_single()) {
		if (have_posts()) : while (have_posts()) : the_post();
			echo '<style type="text/css">'.get_post_meta(get_the_ID(), '_custom_css', true).'</style>';
		endwhile; endif;
		rewind_posts();
	}
}
