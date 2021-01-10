<?php
/**
 * Template Name: コラム--一覧
 */
get_header(); ?>

<section class="globalContainer post post--list page--column">

  <div class="page__titleblock">
    <h2>Column</h2>
    <p>ようきペットクリニックのスタッフブログです</p>
  </div><!--//.page__titleblock-->

  <section class="pageContensts columns--two">

    <div class="postContents">

      <?php if(is_author()):
        $userId = get_query_var('author');
        $user = get_userdata($userId);
        $position = get_field( 'staff_position', "user_{$userId}" );
      ?>
      <div class="post__titleblock">
        <h3><?php echo $user->display_name; ?>（<?php echo $position; ?>）の投稿一覧</h3>
      </div><!--//.post__titleblock-->
      <?php endif; ?>

      <article class="articlePost">

        <!--記事がある場合：-->
        <?php if (have_posts()) :  $paged = (get_query_var('paged')) ? get_query_var('paged') : 1; ?>
        <?php query_posts($query_string.'&posts_per_page=10&paged='.$paged);?>
        <ul class="articlePost__list">
          <?php
          while (have_posts()) : the_post();
          $terms = get_the_terms( $post->ID, 'column_category' );
          foreach ($terms as $term){
            $termName = $term -> slug;
            $termTitle = $term -> name;
          }
          ?>
          <li class="category--<?php echo esc_html( $termName ); ?>">
            <time><?php the_time('Y/m/d');?></time>
            <span><a href="<?php echo home_url(); ?>/column_category/<?php echo esc_html( $termName ); ?>"><?php echo esc_html( $termTitle ); ?></a></span>
            <p><?php if(mb_strlen($post->post_title)>36) { $title= mb_substr($post->post_title,0,36) ; echo $title. … ; } else { echo $post->post_title; } ?></p>
            <a href="<?php the_permalink(); ?>" class="mainlink"></a>
          </li>
          <?php endwhile; ?>
        </ul>
        <?php get_template_part('pagenavi');?>

        <?php else: ?>
        <!--記事がない場合：-->
        <p>該当の記事がありません。</p>

        <?php endif; ?>
        <?php wp_reset_query();?>
      </article><!--//.articlePost-->

      <?php if(is_author()): ?>
      <div class="post__authorblock">
        <figure>
          <?php
            $autherthumb = get_field( 'staff_images', "user_{$userId}");
            $size = 'thumbAutherThumbnail';
            $thumb = $autherthumb['sizes'][ $size ]; // 指定したサイズのサムネイルのURL
          ?>
          <img src="<?php echo $thumb; ?>" />
        </figure>
        <dl>
          <dt class="name"><?php the_field( 'staff_name', "user_{$userId}"); ?></dt>
          <dd class="subname"><?php the_field( 'staff_nameroma', "user_{$userId}"); ?></dd>
          <dd class="status"><?php the_field( 'staff_position', "user_{$userId}"); ?></dd>
          <dd class="comment">
            <?php the_field( 'staff_comment', "user_{$userId}"); ?>
          </dd>
        </dl>
      </div><!--//.post__authorblock-->
      <?php endif; ?>

    </div><!--//.postContents-->

    <div class="sideBar">
      <dl>
        <dt>Category</dt>
        <dd>
          <ul>
            <?php wp_list_categories('title_li=&taxonomy=column_category'); ?>
          </ul>
        </dd>
      </dl>
      <dl>
        <dt>Staff</dt>
        <dd>
          <ul>
          <?php
          $users = get_users( array('orderby'=>ID,'order'=>ASC) );
          foreach($users as $user):
            $uid = $user->ID;
            $position = get_field( 'staff_position', "user_{$uid}" );
          ?>
          <li><a href="<?php echo home_url(); ?>/column/author/<?php echo $user->user_nicename ; ?>/"><?php echo $user->display_name ; ?>（<?php echo $position; ?>）</a></li>
          <?php endforeach; ?>
          </ul>
        </dd>
      </dl>
      <dl>
        <dt>Archive</dt>
        <dd>
        	<ul>
            <?php wp_get_archives( 'post_type=column&type=monthly&show_post_count=1' ); ?>
          </ul>
        </dd>
      </dl>
    </div><!--//.sideBar-->

  </section>

</section>

<?php get_footer(); ?>