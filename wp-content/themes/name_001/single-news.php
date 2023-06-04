<?php get_header(); ?>
<div class="sub_header">
  <h2><span>//</span> NEWS <span>//</span></h2>
</div>
<div id="sb_page">
	<div id="post_page">
		<div id="news_single">
			<?php if(have_posts()): while(have_posts()):the_post(); ?>
			<div class="news_title">
				<time><?php the_time('Y/m/d') ?><time> 
				<h3><?php the_title(); ?></h3>
			</div>
			<?php the_content() ?>
			
			<?php endwhile; endif; ?>
			
			<div class="pre_next_link">
				<?php previous_post_link('%link','＜＜　前の記事へ'); ?>
				<?php next_post_link('%link','次の記事へ　＞＞'); ?>
			</div>
		</div>
	</div>
</div>
<?php get_footer(); ?>