<?php get_header(); ?>
<div class="sub_header">
  <h2><span>//</span> NEWS <span>//</span></h2>
</div>
<div id="sb_page">
	<div id="post_archive">
    <div id="news_archive">

    <ul class="news_list">
    <?php $args = array(
        'numberposts' => 10,
        'paged' => $paged,
        'post_type' => 'news'
      );
      $customPosts = get_posts($args);
      if($customPosts) : foreach($customPosts as $post) : setup_postdata( $post );
      ?>
        <li class="news_item">
          <a href="<?php the_permalink( $post ); ?>">
            <div class="news_date">
              <span><?php the_time('Y年n月j日'); ?></span>
            </div>
            <span class="news_title"><?php echo wp_trim_words( get_the_title(), 50, '...' ); ?></span>
          </a>
        </li>
        <?php endforeach; ?>
        <?php
          pagenation($posts_per_page, 'news');
        ?>
        <?php else : ?>
          お知らせはございません。
        <?php endif; wp_reset_postdata(); ?>
      </ul>

    </div>
  </div>
</div>
<?php get_footer(); ?>