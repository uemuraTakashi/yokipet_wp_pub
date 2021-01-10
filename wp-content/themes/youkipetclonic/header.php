<!doctype html>
<html>
<head>
<meta charset="utf-8" />
<meta name="format-detection" content="telephone=no" />

<title>
  <?php
    /* カテゴリ階層があれば|で区切る */
    global $page, $paged;
    wp_title( '|', true, 'right' );

    // ブログのタイトル表示
    bloginfo( 'name' );

    // ホームなら、ブログの説明表示
    $site_description = get_bloginfo( 'description', 'display' );
    if ( $site_description && ( is_home() || is_front_page() ) )
	echo " | $site_description";

    // 必要であればページ数表示
    if ( $paged >= 2 || $page >= 2 )
	echo ' | ' . sprintf( __( 'Page %s', 'twentyeleven' ), max( $paged, $page ) );
  ?>
</title>
<meta name="description" content="ようきペットクリニックは広島県広島市の動物病院、ペットクリニックです。常に患者さまの気持ちに寄り添うあたたかな治療を、スタッフ一同心掛けています。" />
<meta name="keywords" content="広島県,広島市,動物病院,ペットクリニック,しつけ,健康診断,犬,猫" />

<meta name="viewport" content="width=device-width, initial-scale=1" />

<head prefix="og: http://ogp.me/ns# fb: http://ogp.me/ns/ fb# prefix属性: http://ogp.me/ns/ prefix属性#">
<meta property="og:url" content="<?php $http = is_ssl() ? 'https' : 'http' . '://'; $url = $http . $_SERVER["HTTP_HOST"] . $_SERVER["REQUEST_URI"]; echo $url; ?>" />
<meta property="og:type" content="<?php if($_SERVER["REQUEST_URI"] == "/"){echo "website";}else{echo "article";}?>" />
<meta property="og:title" content="<?php
    /* カテゴリ階層があれば|で区切る */
    global $page, $paged;
    wp_title( '|', true, 'right' );

    // ブログのタイトル表示
    bloginfo( 'name' );

    // ホームなら、ブログの説明表示
    $site_description = get_bloginfo( 'description', 'display' );
    if ( $site_description && ( is_home() || is_front_page() ) )
	echo " | $site_description";

    // 必要であればページ数表示
    if ( $paged >= 2 || $page >= 2 )
	echo ' | ' . sprintf( __( 'Page %s', 'twentyeleven' ), max( $paged, $page ) );
  ?>" />
<meta property="og:description" content="<?php if($_SERVER["REQUEST_URI"] == "/"){echo "website";}else{echo "article";}?>" />
<meta property="og:site_name" content="ようきペットクリニック" />
<meta property="og:image" content="<?php bloginfo('template_directory'); ?>/assets/img/template/og.jpg" />

<link href="<?php bloginfo('stylesheet_url'); ?>" rel="stylesheet" type="text/css" />
<link href="<?php bloginfo('template_directory'); ?>/assets/js/libs/slick.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js" charset="utf-8"></script>
<script type="text/javascript" src="<?php bloginfo('template_directory'); ?>/assets/js/libs/jquery-3.3.1.min.js" charset="utf-8"></script>
<script type="text/javascript" src="<?php bloginfo('template_directory'); ?>/assets/js/libs/slick.min.js" charset="utf-8"></script>
<script type="text/javascript" src="<?php bloginfo('template_directory'); ?>/assets/js/script/common.js" charset="utf-8"></script>

<link rel="icon" href="<?php echo get_template_directory_uri(); ?>/assets/img/template/favicon.ico" type="image/vnd.microsoft.icon" />
<link rel="shortcut icon" href="<?php echo get_template_directory_uri(); ?>/assets/img/template/favicon.ico" type="image/vnd.microsoft.icon" />
<link rel="apple-touch-icon" sizes="152x152" href="<?php echo get_template_directory_uri(); ?>/assets/images/template/favicon.png" />

<?php wp_head(); ?>

<!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-146772074-1"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'UA-146772074-1');
</script>

</head>

<body>

<header class="globalHeader">
  <div class="globalHeader__inner">
    <h1 class="globalHeader__siteTitle">
      <a href="<?php echo home_url(); ?>">
        ようきペットクリニック
      </a>
    </h1>
    <nav class="globalNavigation">
      <div class="globalNavigation__wrap">
        <ul>
          <li><a href="<?php if( is_front_page() ){ }else{ echo home_url(); } ?>#message" class="js--anchorClose js--anchorscroll">Message</a></li>
          <li><a href="<?php if( is_front_page() ){ }else{ echo home_url(); } ?>#clinic" class="js--anchorClose js--anchorscroll">Clinic</a></li>
          <li><a href="<?php if( is_front_page() ){ }else{ echo home_url(); } ?>#medical" class="js--anchorClose js--anchorscroll">Medical</a></li>
          <li><a href="<?php if( is_front_page() ){ }else{ echo home_url(); } ?>#staff" class="js--anchorClose js--anchorscroll">Staff</a></li>
          <li><a href="<?php if( is_front_page() ){ }else{ echo home_url(); } ?>#contact" class="js--anchorClose js--anchorscroll">Contact</a></li>
          <li class="coloum"><a href="<?php echo home_url(); ?>/column/">Column</a></li>
          <li class="news">
            <span>News</span>
            <a href="<?php echo home_url(); ?>/news/"></a>
          </li>
        </ul>
      </div><!--//.globalNavigation__wrap-->
      <div class="globalNavigation__spButton js--spMenuToggle"><span></span></div>
    </nav><!--//#navigation-->
  </div>
</header><!--//.globalHeader-->
