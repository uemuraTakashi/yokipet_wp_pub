<?php

//archivesのaタグに件数を含める
function filter_to_archives_link( $link_html, $url, $text, $format, $before, $after ) {
  if ( 'html' === $format ) {
    $link_html = "<li>$before<a href='$url'>$text$after</a></li>";
  }
  return $link_html;
}
add_filter( 'get_archives_link', 'filter_to_archives_link', 10, 6 );

//autherページのリダイレクト
function authorUrlRewrite(){
  add_rewrite_rule('^column/author/([^/]*)/?$' , 'index.php?post_type=column&author_name=$matches[1]','top');
}
add_action( 'init', 'authorUrlRewrite' );

//カスタムサムネイルサイズ
add_image_size('thumbAutherThumbnail',200,200,true); //staff_auther