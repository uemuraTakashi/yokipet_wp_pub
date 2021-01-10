<?php
/**
 * Template Name: お知らせ--詳細
 */
get_header(); ?>

<section class="globalContainer post post--detail page--news">

  <div class="page__titleblock">
    <h2>News</h2>
    <p>ようきペットクリニックからのお知らせ</p>
  </div><!--//.page__titleblock-->

	<section class="pageContensts">

		<?php
		if(have_posts()): while(have_posts()): the_post();
			$terms = get_the_terms( $post->ID, 'news_category' );
			foreach ($terms as $term){
				$termName = $term -> slug;
				$termTitle = $term -> name;
			}
		?>
		<article class="postContentsBlock">
			<header class="postContentsBlock__header category--<?php echo esc_html( $termName ); ?>">
				<h3 class="postContentsBlock__header__title"><?php the_title(); ?></h3>
				<div class="postContentsBlock__header__data">
					<time><?php the_time('Y/m/d'); ?></time>
					<span><?php echo get_the_term_list($post->ID,'news_category'); ?></span>
				</div>
			</header>

			<div class="postContentsBlock__contents">
				<?php the_content(); ?>
			</div>
		</article>
		<?php endwhile; endif; ?>

		<div class="pagenavi">
			<ul class="pagenavi__list">
				<li class="prev"><?php previous_post_link('%link', '前の記事'); ?></li>
				<li><a href="<?php echo home_url(); ?>/news/">一覧へ戻る</a></li>
				<li class="next"><?php next_post_link('%link', '次の記事'); ?></li>
			</ul>
		</div>

		<div class="postContentsNewlist">
			<h4 class="postContentsNewlist__title">最新の記事</h4>
			<?php if (have_posts()) :  $paged = (get_query_var('paged')) ? get_query_var('paged') : 1; ?>
      <?php query_posts($query_string.'&posts_per_page=10&paged='.$paged);?>
			<ul class="postContentsNewlist__list">
				<?php
					while (have_posts()) : the_post();
					$terms = get_the_terms( $post->ID, 'news_category' );
					foreach ($terms as $term){
						$termName = $term -> slug;
						$termTitle = $term -> name;
					}
				?>
				<li>
					<time><?php the_time('Y/m/d');?></time>
					<span><a href="<?php echo home_url(); ?>/news_category/<?php echo esc_html( $termName ); ?>"><?php echo esc_html( $termTitle ); ?></a></span>
					<p><?php if(mb_strlen($post->post_title)>36) { $title= mb_substr($post->post_title,0,36) ; echo $title. … ; } else { echo $post->post_title; } ?></p>
					<a href="<?php the_permalink(); ?>" class="mainlink"></a>
				</li>
				<?php endwhile; ?>
			</ul>
			<?php endif; ?>
      <?php wp_reset_query();?>
		</div>

	</section>

</section>

<?php get_footer(); ?>