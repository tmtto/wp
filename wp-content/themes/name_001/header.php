<!DOCTYPE html>
<html lang="ja">
<head prefix="og: http://ogp.me/ns#">
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no">
 
<?php if(is_tag() || is_date() || is_search() || is_404()) : ?>
<meta name="robots" content="noindex">
<?php endif; ?>
 
<?php
if( is_single() && !is_home() || is_page() && !is_front_page()) {
  //タイトル
  $title = get_the_title();
  //ディスクリプション
  if(!empty($post->post_excerpt)) {
    $description = str_replace(array("\r\n", "\r", "\n", "&nbsp;"), '', strip_tags($post->post_excerpt));
  } elseif(!empty($post->post_content)) {
    $description = str_replace(array("\r\n", "\r", "\n", "&nbsp;"), '', strip_tags($post->post_content));
    $description_count = mb_strlen($description, 'utf8');
    if($description_count > 120) {
      $description = mb_substr($description, 0, 120, 'utf8').'…';
    }
  } else {
    $description = '';
  }
  //キーワード
  if (has_tag()) {
    $tags = get_the_tags();
    $kwds = array();
    $i = 0;
    foreach($tags as $tag){
      $kwds[] = $tag->name;
      if($i === 4) {
        break;
      }
      $i++;
    }
    $keywords = implode(',',$kwds);
  }  else {
    $keywords = '';
  }
  //ページタイプ
  $page_type = 'article';
  //ページURL
  $page_url = get_the_permalink();
  //OGP用画像
  if(!empty(get_post_thumbnail_id())) {
    $ogp_img_data = wp_get_attachment_image_src(get_post_thumbnail_id(),'full');
    $ogp_img = $ogp_img_data[0];
  }
 
} else { //ループのページ(home・カテゴリ・タグなど)
  //先に投稿・固定ページ以外の詳細な条件分岐
  if(is_category()) {
    $title = single_cat_title("", false).'の記事一覧';
    if(!empty(category_description())) {
      $description = strip_tags(category_description());
    } else {
      $description = 'カテゴリー『'.single_cat_title("", false).'』の記事一覧ページです。';
    }
  } elseif(is_tag()) {
    $title = single_cat_title("", false).'の記事一覧';
    if(!empty(tag_description())) {
      $description = strip_tags(tag_description());
    } else {
      $description = 'タグ『'.single_cat_title("", false).'』の記事一覧ページです。';
    }
  } elseif(is_year()) {
    $title = get_the_time("Y年").'の記事一覧';
    $description = '『'.get_the_time("Y年").'』に投稿された記事の一覧ページです。';//指定したい場合は個別に入力
  } elseif(is_month()) {
    $title = get_the_time("Y年m月").'の記事一覧';
    $description = '『'.get_the_time("Y年m月").'』に投稿された記事の一覧ページです。';//指定したい場合は個別に入力
  } elseif(is_day()) {
    $title = get_the_time("Y年m月d日").'の記事一覧';
    $description = '『'.get_the_time("Y年m月d日").'』に投稿された記事の一覧ページです。';//指定したい場合は個別に入力
  } elseif(is_author()) {
    $author_id = get_query_var('author');
    $author_name = get_the_author_meta( 'display_name', $author_id );
    $title = $author_name.'が投稿した記事一覧';
    $description = '『'.$author_name.'』が書いた記事の一覧ページです。';
  } else {
    $title = '';
    $description = get_bloginfo( 'description' );
  }
 
  //キーワード
  $allcats = get_categories();
  if(!empty($allcats)) {
    $kwds = array();
    $i = 0;
    foreach($allcats as $allcat) {
      $kwds[] = $allcat->name;
      if($i === 4) {
        break;
      }
      $i++;
    }
    $keywords = implode( ',',$kwds );
  } else {
    $keywords = '';
  }
 
  //ページタイプ
  $page_type = 'website';
 
  //ページURL
  $http = empty($_SERVER['HTTPS']) ? 'http://' : 'https://';
  $page_url = $http.$_SERVER["HTTP_HOST"].$_SERVER["REQUEST_URI"];
}
 
 
//OGP用画像
if(empty($ogp_img)) {
  $ogp_img = get_template_directory_uri().'/images/ogp_img.jpg';//サイト全てに共通の画像へのパス
}
 
//タイトル
if(!empty($title)) {
  $output_title = $title.' | '.get_bloginfo('name');
} else {
  $title = get_bloginfo('name');
  $output_title = get_bloginfo('name');
}
?>
 
<!--メタデータをHTML上に出力-->
<title><?php echo $output_title; ?></title>
<meta name="description" content="<?php echo $description; ?>">
<meta name="keywords" content="<?php echo $keywords; ?>">
<meta property="og:type" content="<?php echo $page_type; ?>">
<meta property="og:locale" content="ja_JP">
<meta property="og:title" content="<?php echo $title; ?>">
<meta property="og:url" content="<?php echo $page_url; ?>">
<meta property="og:description" content="<?php echo $description; ?>">
<meta property="og:image" content="<?php echo $ogp_img; ?>">
<meta property="og:site_name" content="<?php bloginfo( 'name' ); ?>">
  
<!--アイコン-->
<link rel="shortcut icon" href="<?php echo get_template_directory_uri(); ?>/images/favicon.svg">
<link rel="apple-touch-icon" href="<?php echo get_template_directory_uri(); ?>/images/apple-touch-icon.png">
<link rel="icon" type="image/png" size="256x256" href="<?php echo get_template_directory_uri(); ?>/images/android-chrome.png">

<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Noto+Sans+JP:wght@400;500;700&display=swap" rel="stylesheet">
<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
<link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/css/swiper-bundle.min.css">
<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<header>
  <div class="header_wrap">
      <div class="h_menu">
        <!-- TAB・SPメニュー -->
        <div id="sp_menu">
          <!-- ロゴ -------->
          <div class="header_logo_wrap">
            <a class="form_logo" href="<?php echo esc_url( home_url( '/' ) ); ?>" title=""><img src="<?php echo get_template_directory_uri(); ?>/images/header_logo.svg" alt="会社名" style="width: 110px;"></a>
          </div>
          <div id="toggle">
            <div id="toggle-box">
                <span></span>
                <span></span>
                <span></span>
            </div>
          </div>
          <div id="nav-content">
            <nav>
              <ul>
                <li class="nav-item"><a href="<?php echo esc_url( home_url( '/' ) ); ?>">TOP</a></li>
                <li class="nav-item"><a href="<?php echo esc_url( home_url( '/menu' ) ); ?>">MENU.料金</a></li>
                <li class="nav-item"><a href="<?php echo esc_url( home_url( '/access' ) ); ?>">店舗案内.アクセス</a></li>
                <li class="nav-item"><a href="<?php echo esc_url( home_url( '/news' ) ); ?>"> NEWS</a></li>
                <li class="nav-item"><a href="<?php echo esc_url( home_url( '/booking' ) ); ?>">予約</a></li>
              </ul>
            </nav>
          </div>
        </div>
        <!-- PCメニュー -->
        <div id="pc_menu">
          <div class="nav_menu_wrap">
            <div class="header_logo_wrap">
              <!-- ロゴ -------->
              <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="top_logo_img_wrap"><img src="<?php echo get_template_directory_uri(); ?>/images/header_logo.svg" alt="会社名" style="width: 150px;"></a>
            </div>
        </div>
      </div>
    </div>
  </div>
</header>
<div id="main">