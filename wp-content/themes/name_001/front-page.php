<?php get_header(); ?>
<!-- スライダーのメインコンテナ -->
<div class="swiper mb10">
  <!-- スライド -->
  <div class="swiper-wrapper">
      <!-- それぞれのスライド -->
      <div class="swiper-slide"><img src="<?php echo get_template_directory_uri(); ?>/images/main01.jpg" alt=""></div>
      <div class="swiper-slide"><img src="<?php echo get_template_directory_uri(); ?>/images/main02.jpg" alt=""></div>
      <div class="swiper-slide"><img src="<?php echo get_template_directory_uri(); ?>/images/main03.jpg" alt=""></div>
  </div>
  <!-- ページネーションの div 要素（省略可能） -->
  <div class="swiper-pagination"></div>
</div>
<div id="top_page">
  <!-- cnt01 -->
  <div class="introduction_wrap mb10">
    <div id="cnt01" class="mb8">
      <div class="cnt_inner">
        <div class="cnt_about cnt_about01">
        </div>
      </div>
    </div>
  </div>
<?php echo do_shortcode( '[instagram-feed feed=1]' ) ?>
</div>
<?php get_footer(); ?>