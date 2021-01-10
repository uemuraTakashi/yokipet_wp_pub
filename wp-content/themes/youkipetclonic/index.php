<?php
/**
 * 汎用テンプレート
 */
get_header(); ?>

<section class="globalContainer">

<?php
if( have_posts() ):
while ( have_posts() ) : the_post();
?>

<article>
  <h2><?php the_title(); ?></h2>
  <p><?php the_content(); ?></p>
  <div class="button"><a href="<?php the_permalink(); ?>">続きを見る</a></div>
</article>

<?php endwhile; endif; ?>

</section>

<?php get_footer(); ?>