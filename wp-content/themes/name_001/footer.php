</div>
<footer class="mb1">
  <div class="footer_logo_wrap">
    <a class="form_logo" href="<?php echo esc_url( home_url( '/' ) ); ?>" title=""><img src="<?php echo get_template_directory_uri(); ?>/images/header_logo.svg" alt="会社名" style="width: 110px"></a>
  </div>
  <div class="text_wrap">
    <p>
      会社名<br>
      福岡県福岡市城南区南片江2−1−５<br>
      TEL：092−233−4786<br>
      営業時間：10:00 ~ 21:00
    </p>
    <p>Copyright © <script>document.write(new Date().getFullYear());</script> 会社名  All rights reserved.</p>
  </div>
</footer>
<!-- フッター -->
  <script>
    (function(jQuery) {
      jQuery(document).ready(function() {
        jQuery.slidebars({
          siteClose: true // true or false
        });
      });
    }) (jQuery);
</script>
<script>
(function(jQuery) {
  jQuery(document).ready(function() {
    jQuery.slidebars({
      siteClose: true // true or false
    });
  });
}) (jQuery);
</script>
<script src="<?php echo get_template_directory_uri(); ?>/js/swiper-bundle.min.js"></script>
<script>
  let mySwiper = new Swiper ('.swiper', {
    // 以下にオプションを設定
    loop: true, //最後に達したら先頭に戻る
    autoplay: {
      delay: 3000,
    },
    //ページネーション表示の設定
    pagination: { 
      el: '.swiper-pagination', //ページネーションの要素
      type: 'bullets', //ページネーションの種類
      clickable: true, //クリックに反応させる
    },
  });
  </script>
<?php wp_footer(); ?>
</body>
</html>