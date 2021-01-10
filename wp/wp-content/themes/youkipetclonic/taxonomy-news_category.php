<?php
/**
 * Template Name: お知らせ--一覧[カテゴリー]
 */
get_header(); ?>

<section class="globalContainer post post--list page--news">

  <div class="page__titleblock">
    <h2>News</h2>
    <p>ようきペットクリニックからのお知らせ</p>
  </div><!--//.page__titleblock-->

  <section class="pageContensts">

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
        $terms = get_the_terms( $post->ID, 'news_category' );
        foreach ($terms as $term){
          $termName = $term -> slug;
          $termTitle = $term -> name;
        }
        ?>
          <li class="category--<?php echo esc_html( $termName ); ?>">
            <time><?php the_time('Y/m/d');?></time>
            <span><a href="<?php echo home_url(); ?>/news_category/<?php echo esc_html( $termName ); ?>"><?php echo esc_html( $termTitle ); ?></a></span>
            <p><?php if(mb_strlen($post->post_title)>36) { $title= mb_substr($post->post_title,0,36) ; echo $title. … ; } else { echo $post->post_title; } ?></p>
            <a href="<?php the_permalink(); ?>" class="mainlink"></a>
          </li>
          <?php endwhile; ?>
        </ul>
        <?php get_template_part('pagenavi');?>
        <?php endif; ?>
        <?php wp_reset_query();?>
      </article><!--//.newslist-->
    </div>

  </section>

</section>

<?php get_footer(); ?>