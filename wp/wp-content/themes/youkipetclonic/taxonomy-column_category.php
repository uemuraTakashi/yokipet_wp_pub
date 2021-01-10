<?php
/**
 * Template Name: コラム--一覧[カテゴリー]
 */
get_header(); ?>

<section class="globalContainer post post--list page--column">

  <div class="page__titleblock">
    <h2>Column</h2>
    <p>ようきペットクリニックのスタッフブログです</p>
  </div><!--//.page__titleblock-->

  <section class="pageContensts columns--two">

    <div class="postContents">
      <div class="post__titleblock">
        <h3><?php single_term_title(); ?></h3>
        <p><?php echo strip_tags(term_description()); ?></p>
      </div>

      <article class="articlePost">
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
        <?php endif; ?>
        <?php wp_reset_query();?>
      </article><!--//.articlePost-->
    </div>

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