<div class="backtop js--pagetop">
  TOPに戻る
</div>

<footer class="globalFooter">
  <h2 class="globalFooter__title">
    <a href="<?php echo home_url(); ?>">
      <span>ようきペットクリニック</span>
    </a>
  </h2>
  <div class="globalFooter__infomation">
    <div class="globalFooter__infomation__innerbox">
      <dl>
        <dt>ADDRESS</dt>
        <dd>
        〒733-0831<br>
        広島県広島市西区扇2-1-1  カインズ広島LECT店2F
        <button onclick="location.href='//goo.gl/maps/76MiK3RfECEqWy4bA'" formtarget="_blank">googlemapを見る</button>
        </dd>
      </dl>
      <div class="map">
        <!--ここにmap-->
      </div>
      <dl>
        <dt>TEL</dt>
        <dd>082-276-5666</dd>
      </dl>
    </div>
    <div class="globalFooter__infomation__innerbox">
      <dl>
        <dt>診療時間</dt>
        <dd>
        <table>
          <thead>
            <tr>
              <th>診療時間</th>
              <th>月</th>
              <th>火</th>
              <th>水</th>
              <th>木</th>
              <th>金</th>
              <th>土</th>
              <th>日</th>
              <th>祝</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <th>09:30 ~ 12:00</th>
              <td>〇</td>
              <td>★</td>
              <td>▲</td>
              <td>★</td>
              <td>〇</td>
              <td>〇</td>
              <td>〇</td>
              <td>〇</td>
            </tr>
            <tr>
              <th>14:00 ~ 17:30</th>
              <td>〇</td>
              <td>★</td>
              <td>▲</td>
              <td>★</td>
              <td>〇</td>
              <td>〇</td>
              <td>〇</td>
              <td>〇</td>
            </tr>
          </tbody>
        </table>
        <ul class="hours__notice">
          <li class="hours__notice__triangle">水曜日は予約診療のみの受付</li>
          <li class="hours__notice__star">第3木曜日は休診日、その週の火曜日は診療日となります。</li>
        </ul>
        </dd>
      </dl>
      <dl>
        <dt>休診日</dt>
        <dd>
          <p class="absence__regular">火曜日・第三木曜日（その週の火曜日は診療日）</p>
          <dl class="absence__extra">
            <?php $closed = get_field('index_closed',2); ?>
            <dt><?php echo $closed['index_closed_month']; ?>月の休診日</dt>
            <dd><?php echo $closed['index_closed_day']; ?></dd>
          </dl>
        </dd>
      </dl>
    </div>
  </div>
  <ul class="globalFooter__link">
    <li><a href="<?php if( is_front_page() ){ }else{ echo home_url(); } ?>#message" class="js--anchorscroll">Message</a></li>
    <li><a href="<?php if( is_front_page() ){ }else{ echo home_url(); } ?>#clinic" class="js--anchorscroll">Clinic</a></li>
    <li><a href="<?php if( is_front_page() ){ }else{ echo home_url(); } ?>#medical" class="js--anchorscroll">Medical</a></li>
    <li><a href="<?php if( is_front_page() ){ }else{ echo home_url(); } ?>#staff" class="js--anchorscroll">Staff</a></li>
    <li><a href="<?php if( is_front_page() ){ }else{ echo home_url(); } ?>#contact" class="js--anchorscroll">Contact</a></li>
    <li class="coloum"><a href="<?php echo home_url(); ?>/column/">Column</a></li>
    <li class="news"><a href="<?php echo home_url(); ?>/news/">News</a></li>
  </ul>
  <dl class="globalFooter__follow">
    <dt>FOLLOW</dt>
    <dd>
      <a href="//www.instagram.com/petclinic_hiroshimalect/" target="_blank">
        <span class="globalFooter__follow__icon"></span>
      </a>
    </dd>
  </dl>
  <p class="globalFooter__copyright">Copyright 2019- yohki-pet-clinic.jp All Rights Reserved</p>
</footer><!--//.globalFooter-->

<section id="loading" class="loading">
  <figure class="loading__img">
    <img src="<?php echo get_template_directory_uri(); ?>/assets/img/common/loading.gif" alt="" />
  </figure>
</section>

<?php wp_footer(); ?>

</body>
</html>
