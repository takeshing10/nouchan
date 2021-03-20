<?php

//アップデート通知非表示
remove_action( 'load-update-core.php', 'wp_update_plugins' );
add_filter( 'pre_site_transient_update_plugins', create_function( '$a', "return null;" ) );
add_filter('pre_site_transient_update_core', create_function('$a', "return  null;"));

// SSL対応
function fix_ssl_attachment_url($url) {
	$url = preg_replace("/^http:/", "https:", $url);
    return $url;
}
add_filter("wp_get_attachment_url", "fix_ssl_attachment_url");

// jpg resize
add_filter( 'jpeg_quality', function( $arg ){ return 100; } );


/*

    管理画面

*/
function remove_admin_menus() {

        global $menu;
        // unsetで非表示にするメニューを指定
        unset($menu[2]);        // ダッシュボード
        unset($menu[5]);        // 投稿
        //unset($menu[10]);       // メディア
        unset($menu[25]);       // コメント
        

        if (!current_user_can('administrator')) {
            unset($menu[20]);
            unset($menu[70]);
            unset($menu[75]);
            unset($menu[75]);
            unset($menu[60]);       // 外観
            unset($menu[65]);       // プラグイン
            unset($menu[70]);       // ユーザー
            unset($menu[75]);       // ツール
            unset($menu[80]);       // 設定
            unset($menu[20]);       // 固定ページ
            
            // form
            remove_menu_page( 'edit.php?post_type=mw-wp-form' );
        }
    
}
add_action('admin_menu', 'remove_admin_menus');


function add_page_to_admin_menu() {
    add_menu_page( 'プロフィール設定', 'プロフィール設定', 'manage_options', 'post.php?post=12&action=edit', '', 'dashicons-admin-comments', 20);

}
add_action( 'admin_menu', 'add_page_to_admin_menu' );


/*

    画像サイズ拡張

*/
add_image_size('s640', 640, 640, false);
add_image_size('s1400', 1400, 1400, false);
add_image_size('s2560', 2560, 2560, false);



// wp_head_remove
remove_action('wp_head','feed_links', 2 );
remove_action('wp_head','feed_links_extra', 3 );
remove_action('wp_head','rsd_link' );
remove_action('wp_head','wlwmanifest_link' );
remove_action('wp_head','adjacent_posts_rel_link_wp_head', 10, 0 );
remove_action('wp_head','locale_stylesheet' );
remove_action('publish_future_post','clib.jsheck_and_publish_future_post', 10, 1 );
remove_action('wp_head','noindex', 1 );
remove_action('wp_head','wp_print_styles', 8 );
remove_action('wp_head','wp_print_head_scripts', 9 );
remove_action('wp_head','wp_generator' );
remove_action('wp_head','rel_canonical' );
remove_action('wp_head','wp_shortlink_wp_head', 10, 0 );
remove_action('template_redirect','wp_shortlink_header', 11, 0 );
remove_action('init','check_theme_switched', 99 );
remove_action('after_switch_theme','_wp_sidebars_changed' );
remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
remove_action( 'wp_print_styles', 'print_emoji_styles', 10 );
remove_action('wp_head','rest_output_link_wp_head');
remove_action('wp_head','wp_oembed_add_discovery_links');
remove_action('wp_head','wp_oembed_add_host_js');
add_filter( 'show_admin_bar', '__return_false' );
add_filter( 'wp_resource_hints', 'remove_dns_prefetch', 10, 2 );

remove_action('wp_head','wp_enqueue_scripts', 1 );
remove_action('wp_print_footer_scripts','_wp_footer_scripts' );
remove_action('wp_footer','wp_print_footer_scripts', 20 );


function remove_dns_prefetch( $hints, $relation_type ) {
if ( 'dns-prefetch' === $relation_type ) {
return array_diff( wp_dependencies_unique_hosts(), $hints );
}
return $hints;
}

// 記事の自動整形を無効化
remove_filter('the_content', 'wpautop');
// 抜粋の自動整形を無効化
remove_filter('the_excerpt', 'wpautop');


/*

    カスタムjs, css

*/
function post_custom_scripts(){
    global $post;
    
    echo '
        <script src="../wp-content/themes/2019/assets/admin/admin.js"></script>
        <link rel="stylesheet" href="../wp-content/themes/2019/assets/admin/admin.css">
    ';
}
add_action('admin_print_footer_scripts', 'post_custom_scripts');


/*

    タームオブジェクト

*/
function get_term_obj($id, $t){
    $_term = get_the_terms($id, $t);
    return $_term;
}


/*
*
    open_date
*
*/
function is_open_date($s_date, $e_date = 299901011100){
    date_default_timezone_set('Asia/Tokyo');
    
    $current_date = date('YmdHi');
    if(!empty($_GET['c_date'])){
        $current_date = $_GET['c_date'];
    }
    
    $diff_current_date = strtotime($current_date);
        
    $diff_s_date = strtotime($s_date);
    $diff_e_date = strtotime($e_date);
    
    $is_open = ($diff_current_date >= $diff_s_date && $diff_e_date > $diff_current_date)? true: false;
    
    return $is_open;
}


function get_post_date($d){
    $_date = date('Y-m-d', strtotime($d));
    return $_date;
}


function get_weeks($d, $lang){
    date_default_timezone_set('Asia/Tokyo');
    if($lang): $weeks = ['日', '月', '火', '水', '木', '金', '土'];
    else: $weeks = ['SUN', 'MON', 'TUE', 'WED', 'THU', 'FRI', 'SAT'];
    endif;
    $w = $weeks[date('w', strtotime($d))];

    return $w;
}




/*--------------------------------------------------
*
    Tiny MCE Style
*
--------------------------------------------------*/

//TinyMCE Advanced独自ボタン追加
//　ビジュアルエディタで任意クラスを付与
function _my_tinymce($initArray) {
$style_formats = array(
    array(
        'title' => '小見出し',
        'block' => 'h4',
        'classes' => 's_title'
    )
);
$initArray['style_formats'] = json_encode($style_formats);
return $initArray;
}
add_filter('tiny_mce_before_init', '_my_tinymce', 10000);

function wpdocs_theme_add_editor_styles() {
  add_editor_style('custom-editor-style.css');
}
add_action('admin_init', 'wpdocs_theme_add_editor_styles');





/*
*
    collection
*
*/
function add_work_post_list_column($columns){
    $columns['pic'] = '画像';
    return $columns;
}

function add_work_post_list_data($column_name, $post_id){
    global $post;

    if ('pic' == $column_name ){
        $repeater = get_field('p_repeater', $post_id);
        $img;
        
        $num = 0;
        foreach($repeater as $r){
        if($num == 0){
        $radio = $r['radio'];
        if($radio == 'img'){
            $img = $r['p_img'];
            $img = wp_get_attachment_image_src($img, 'thumbnail');
            $num += 1;
        }
        }}
        echo '<img src="' . $img[0] . '" alt="">';
    }
}
add_filter( 'manage_edit-work_columns', 'add_work_post_list_column' );
add_action( 'manage_work_posts_custom_column', 'add_work_post_list_data', 10, 2);


function sort_work_posts_columns($columns){
    global $post_type;
    if($post_type == 'work'){
        $columns = array(
            'cb' => '<input type="checkbox" />',
            'title' => 'タイトル',
            'pic' => '画像',
            'date' => '日時'
        );
    }
    
    return $columns;
}
add_filter('manage_posts_columns', 'sort_work_posts_columns');




?>