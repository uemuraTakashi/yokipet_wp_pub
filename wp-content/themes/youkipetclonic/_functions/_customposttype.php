<?php
define("CUSTOM_POST_USE",true);

if(CUSTOM_POST_USE) {
	add_action('init', 'addPosts');
	function addPosts()
	{

		/* 投稿設定 */
		$post_status = array(
			array(
				'title' => 'お知らせ',
				'slug'=> 'news',
				'supports' => array('author','title','editor','post-formats'),
				'taxonomy' => 'news_category'
			),
			array(
				'title' => 'コラム',
				'slug'=> 'column',
				'supports' => array('author','title','editor','post-formats'),
				'taxonomy' => 'column_category'
			),
		);


		/*カスタム投稿の設定*/
		$custom_posts = array(
			'public' => true,
			'publicly_queryable' => true,
			'show_ui' => true,
			'show_in_nav_menus' => true,
			'query_var' => true,
			'rewrite' => true,
			'capability_type' => 'post',
			'hierarchical' => true,
			//'menu_position' => 3,
			'supports' => array('title','editor','post-formats'),
			'has_archive' => true,
			'menu_icon' => 'dashicons-welcome-write-blog',
		);

		/*タクソノミーの設定*/
		$tax = array(
			'label' => 'カテゴリー',
			'labels' => array(
				'name' => 'カテゴリー',
				'singular_name' => 'カテゴリー',
				'search_items' => 'カテゴリーを検索',
				'popular_items' => 'よく使われているカテゴリー',
				'all_items' => 'すべてのカテゴリー',
				'parent_item' => '親のカテゴリー',
				'edit_item' => 'カテゴリーの編集',
				'update_item' => '更新',
				'add_new_item' => '新規カテゴリーを追加',
				'new_item_name' => '新しいカテゴリー',
			),
			'public' => true,
			'show_ui' => true,
			'show_in_nav_menus' => true,
			'hierarchical' => true,
			'rewrite' => array('slug' => $val['slug']),
			'query_var' => true,
			'has_archive' => true
		);

		foreach($post_status as $val):
			$labels = array(
				'name' => _x($val['title'], 'post type general name'),
				'singular_name' => _x($val['title'], 'post type singular name'),
				'add_new' => _x($val['title'].'を追加', 'book'),
				'add_new_item' => __('新しい'.$val['title'].'を追加'),
				'edit_item' => __($val['title'].'を編集'),
				'new_item' => __($val['title']),
				'view_item' => __('投稿を表示'),
				'search_items' => __($val['title'].'を探す'),
				'not_found' =>  __($val['title'].'はありません'),
				'not_found_in_trash' => __('ゴミ箱に'.$val['title'].'はありません'),
				'parent_item_colon' => ''
			);
			$custom_posts['labels'] = $labels;
			$custom_posts['supports'] = $val['supports'];
			register_post_type($val['slug'],$custom_posts);
			if($val['taxonomy']):
				register_taxonomy($val['taxonomy'] , $val['slug'] , $tax);
			endif;
		endforeach;
	}
}