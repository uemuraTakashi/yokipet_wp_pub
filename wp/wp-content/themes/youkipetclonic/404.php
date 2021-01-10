<?php
get_header(); ?>

<section class="globalContainer page page--404">

  <div class="page__titleblock">
    <h2>404</h2>
    <p>お探しのページが見つかりませんでした</p>
  </div><!--//.page__titleblock-->

	<section class="pageContensts columns--one">

		<p>
			お探しのページは一時的にアクセスできない状況にあるか、<br>
			移動もしくは削除された可能性があります。<br>
			メニューあるいはトップページよりページをお探しください。
		</p>

		<div class="button button--topPage">
			<a href="<?php echo home_url(); ?>">トップページへ戻る</a>
		</div>

	</section>

</section>

<?php get_footer(); ?>
