<?php
/* ---------------------------------------
CSS読み込み
--------------------------------------- */
function add_files(){
  // CSS読み込み
  wp_register_style('style', get_stylesheet_directory_uri().'/style.css');
  wp_enqueue_style('commoncss', get_template_directory_uri() . '/css/common.css');
  wp_enqueue_style('pc', get_template_directory_uri() . '/css/pc.css');
  wp_enqueue_style('tab_sp', get_template_directory_uri() . '/css/tab_sp.css');
  wp_enqueue_style('sp', get_template_directory_uri() . '/css/sp.css');
}
add_action('wp_enqueue_scripts','add_files');

/* ---------------------------------------
JS読み込み
--------------------------------------- */
function register_script(){ //読み込むJSを登録する
  wp_register_script('sp_menu', get_template_directory_uri().'/js/sp_menu.js', array('jquery'));
}
function add_script(){ //登録したJSを以下の順番で読み込む
register_script();
  wp_enqueue_script('sp_menu', '', array(), '1.0', false);
}
add_action('wp_print_scripts','add_script');
// カスタムメニューを有効化
add_theme_support( 'menus' );
 
 
 
// カスタムメニューの「場所」を設定
register_nav_menu( 'header-nav', 'ヘッダーのナビゲーション' );
register_nav_menu( 'footer-nav', 'フッターのナビゲーション' );

// タイトルタグ出力
function mytheme_set() {
  add_theme_support( 'title-tag' );
}
add_action( 'after_setup_theme', 'mytheme_set' );

// アイキャッチ画像の有効化
add_theme_support('post-thumbnails');

/* ページネーション
---------------------------------------------------------- */
/**
* ページネーションHTML出力
*
* $limit      ページあたりの表示上限数
* $post_typed 投稿タイプのスラッグ
*/
function pagenation($limit = NULL, $post_typed = 'posts') {
  global $wp_rewrite;
  global $paged;
  global $wp_query;

  // 検索条件
  $query = array();
  if ($limit != NULL) {
      $query['posts_per_page'] = $limit;
  }
  if (count($query) != 0) {
      $wp_query->query($query);
  }

  $wp_query->query(array(
      'post_type' => $post_typed,
  ));
  $paginate_base = get_pagenum_link();

  if( strpos( $paginate_base, '?' ) || !$wp_rewrite->using_permalinks() ) {
      $paginate_format = '';
      $paginate_base = add_query_arg( 'paged', '%#%' );
  } else {
      $paginate_format = (substr( $paginate_base, -1, 1 ) == '/' ? '' : '/') . user_trailingslashit('page/%#%/','paged');
      $paginate_base .= '%_%';
  }


  if( $paged < 2 ) {
      $paged = 1;
  }
  $args = array(
      'base' => $paginate_base,
      'format' => $paginate_format,
      'total' => $wp_query->max_num_pages,
      'current' => $paged,
      'show_all' => false,
      'prev_next' => true,
      'prev_text' => '&laquo;',
      'next_text' => '&raquo;',
      'type' => 'array',
  );
  $pagenate_array = paginate_links($args);

  // 配列がある場合のみ
  if (is_array($pagenate_array) == TRUE) {
      $pagenate .= '<div class="wp-pagenavi">';
      foreach ($pagenate_array as $key => $value) {

          if (preg_match('/current/', $value) == TRUE) {
              $class = '';
          }
          else {
              $class = '';
          }

          // $value = "<span class=\"{$class}\">".$value.'</span>';
          // リンク追加
          $pagenate .= $value;
      }

      $pagenate .= '</div>';
      echo $pagenate;
  }
}