<?php

//////////////////////////////////////////////////////////////////////////////////
//アップデート情報非表示
//////////////////////////////////////////////////////////////////////////////////
function update_nag_hide() {
    remove_action( 'admin_notices', 'update_nag', 3 );
}
add_action( 'admin_init', 'update_nag_hide' );

//////////////////////////////////////////////////////////////////////////////////
//管理画面用CSS
//////////////////////////////////////////////////////////////////////////////////
function my_admin_css() {
	echo "\n" . '<link rel="stylesheet" type="text/css" href="' .get_bloginfo('template_directory'). '/editor-style.css' . '" />' . "\n";
}
add_action('admin_head','my_admin_css');

//////////////////////////////////////////////////////////////////////////////////
//管理画面メニュー変更（削除）
//////////////////////////////////////////////////////////////////////////////////
function remove_menus() {
    remove_menu_page('edit.php'); // 投稿
    remove_menu_page("separator3"); // セパレーター
	remove_menu_page('edit-comments.php'); // コメント
	remove_menu_page('wp-sitemanager/wp-sitemanager.php'); // WP SiteManager
	remove_menu_page('tools.php'); // ツール
}
add_action('admin_menu', 'remove_menus');

//////////////////////////////////////////////////////////////////////////////////
//管理画面メニュー変更（並び替え）
//////////////////////////////////////////////////////////////////////////////////
function custom_menu_order($menu_old) {
    if (!$menu_old) return true;

    return array(
        'index.php', // ダッシュボード
        'edit.php?post_type=news', // お知らせ（カスタムポスト）
        'edit.php?post_type=column', // コラム（カスタムポスト）
        'edit.php?post_type=page', // 固定ページ
        'separator1', // 区切り線１

        'upload.php', // メディア
        'themes.php', // テーマ
        'plugins.php', // プラグイン
        'users.php', // ユーザー
        'options-general.php', // 設定
        'separator2', // 区切り線２

        'edit.php?post_type=mw-wp-form', // MW WP Form
        'admin.php?page=ai1wm_export', // All-in-One WP Migration
        'edit.php?post_type=acf-field-group', // カスタムフィールド
        'separator-last', // 区切り線３
    );
}
add_filter('custom_menu_order', 'custom_menu_order');
add_filter('menu_order', 'custom_menu_order');

//////////////////////////////////////////////////////////////////////////////////
//管理バーの不要項目削除
//////////////////////////////////////////////////////////////////////////////////

function remove_bar_menus( $wp_admin_bar ) {
    //$wp_admin_bar->remove_menu('wp-logo'); // W ロゴ
    //$wp_admin_bar->remove_menu('site-name'); // サイト名
    $wp_admin_bar->remove_menu('view-site'); // サイト名 -> サイトを表示
    $wp_admin_bar->remove_node('my-sites-comments');
    $wp_admin_bar->remove_menu('comments'); // コメント
    $wp_admin_bar->remove_menu('new-content'); // 新規
    $wp_admin_bar->remove_menu('new-post'); // 新規 -> 投稿
    $wp_admin_bar->remove_menu('new-media'); // 新規 -> メディア
    $wp_admin_bar->remove_menu('new-link'); // 新規 -> リンク
    $wp_admin_bar->remove_menu('new-page'); // 新規 -> 固定ページ
    $wp_admin_bar->remove_menu('new-user'); // 新規 -> ユーザー
    $wp_admin_bar->remove_menu('updates'); // 更新
    //$wp_admin_bar->remove_menu('my-account'); // マイアカウント
    //$wp_admin_bar->remove_menu('user-info'); // マイアカウント -> プロフィール
    //$wp_admin_bar->remove_menu('edit-profile'); // マイアカウント -> プロフィール編集
    //$wp_admin_bar->remove_menu('logout'); // マイアカウント -> ログアウト
}
add_action('admin_bar_menu', 'remove_bar_menus', 201);

//////////////////////////////////////////////////////////////////////////////////
//カスタムメニュー有効
//////////////////////////////////////////////////////////////////////////////////
add_theme_support('menus');
register_nav_menus(array(
    'Navigation' => 'グローバルナビゲーション'
));


//////////////////////////////////////////////////////////////////////////////////
//SEO設定ページを追加
//////////////////////////////////////////////////////////////////////////////////
class SEO_Settings_Page {
    public static $option_name = 'options_seo';
    private $options;
    function __construct() {
        add_action( 'admin_menu', array( $this, 'add_submenu_page' ) );
        add_action( 'admin_init', array( $this, 'page_init' ) );
}

/*** 設定画面の追加 ***/
public function add_submenu_page() {
    add_options_page(
        'SEO設定', // Page title
        'SEO設定', // Menu title
        'manage_options', // Capability
        'menu-slug-options-ogp', // Menu slug
        array( $this, 'create_page' ) /*, $icon_url, $position*/
    );
}

/*** 画面の出力 ***/
public function create_page() {
    if ( !current_user_can( 'manage_options' ) ) {
        wp_die( __( 'You do not have sufficient permissions to access this page.' ) );
    }

    // Set class property
    $this->options = get_option( self::$option_name );
    ?>
    <div class="wrap">
        <h1>SEO設定</h1>
        <form method="post" action="options.php">
        <?php
            // This prints out all hidden setting fields.
            settings_fields( 'options_seo_group' );
            do_settings_sections( 'menu-slug-options-seo' );
            submit_button();
        ?>
        </form>
    </div>
    <?php
}

    /*** 設定の追加 ***/
    public function page_init() {
        register_setting(
            'options_seo_group', // Option group
            self::$option_name, // Option name
            array( $this, 'sanitize' ) // Sanitize
        );

        add_settings_section(
            'options_seo_common', // ID
            '共通', // Title
            null,
            'menu-slug-options-seo' // Page (Menu slug)
        );

        add_settings_section(
            'options_ogp_facebook', // ID
            'Facebook', // Title
            array( $this, 'print_section_fb_callback' ), // Callback
            'menu-slug-options-ogp' // Page (Menu slug)
        );

        add_settings_field(
            'og_type', // ID
            'og:type', // Title 
            array( $this, 'type_callback' ), // Callback
            'menu-slug-options-ogp', // Page (Menu slug)
            'options_ogp_common' // Section
        );

        add_settings_field(
            'og_image', // ID
            'og:image(URL)', // Title 
            array( $this, 'image_callback' ), // Callback
            'menu-slug-options-ogp', // Page (Menu slug)
            'options_ogp_common' // Section
        );

        add_settings_field(
            'og_fb_app_id', // ID
            'fb:app_id', // Title 
            array( $this, 'fb_app_id_callback' ), // Callback
            'menu-slug-options-ogp', // Page (Menu slug)
            'options_ogp_facebook' // Section
        );

        add_settings_field(
            'og_fb_admins', // ID
            'fb:admins', // Title 
            array( $this, 'fb_admins_callback' ), // Callback
            'menu-slug-options-ogp', // Page (Menu slug)
            'options_ogp_facebook' // Section
        );
    }

    public function sanitize( $input ) {
        $new_input = array();
        if ( isset( $input['og_type'] ) ) {
            $new_input['og_type'] = $input['og_type'];
        }

        if ( isset( $input['og_image'] ) ) {
            $new_input['og_image'] = esc_url( $input['og_image'] );
        }

        if ( isset( $input['og_fb_app_id'] ) ) {
            $new_input['og_fb_app_id'] = esc_attr( $input['og_fb_app_id'] );
        }

        if ( isset( $input['og_image'] ) ) {
            $new_input['og_fb_admins'] = esc_attr( $input['og_fb_admins'] );
        }

        return $new_input;
    }

    /*** セクション説明. ***/
    function print_section_fb_callback() {
        print 'fb:app_id または fb:admins';
    }

    /**
     * Get the settings option array and print one of its values.
     */
    function type_callback() {
        print "\n" . '<select id="og_type" name="'. self::$option_name . '[og_type]">' . "\n";

        $og_type = isset( $this->options['og_type'] ) ? $this->options['og_type'] : '';

        if ( $og_type == 'blog' ) {
            $selected_value = 'selected';
        } else {
            $selected_value = '';
        }
        print '    <option value="blog" label="blog" ' . $selected_value. '>blog</option>' . "\n";
        if ( $og_type == "website" ) {
            $selected_value = 'selected';
        } else {
            $selected_value = '';
        }
        print '    <option value="website" label="website" ' . $selected_value. '>website</option>' . "\n";
        print '</select>' . "\n";
    }

    /**
     * Get the settings option array and print one of its values.
     */
    function image_callback() {
        printf(
            '<input type="text" id="og_image" name="' . self::$option_name . '[og_image]" value="%s" />',
            isset( $this->options['og_image'] ) ? esc_url( $this->options['og_image']) : ''
        );
        print "\n";
    }

    /**
     * Get the settings option array and print one of its values.
     */
    function fb_app_id_callback() {
        printf(
            '<input type="text" id="og_fb_app_id" name="' . self::$option_name . '[og_fb_app_id]" value="%s" />',
            isset( $this->options['og_fb_app_id'] ) ? esc_attr( $this->options['og_fb_app_id']) : ''
        );
    }

    /**
     * Get the settings option array and print one of its values.
     */
    function fb_admins_callback() {
        printf(
            '<input type="text" id="og_fb_admins" name="' . self::$option_name . '[og_fb_admins]" value="%s" />',
            isset( $this->options['og_fb_admins'] ) ? esc_attr( $this->options['og_fb_admins']) : ''
        );
        print "\n";
    }
}

if ( is_admin() ) {
    $ogp_settings_page = new SEO_Settings_Page();
}