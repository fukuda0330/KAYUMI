<?php

function GetTopView() {
  $html = '
  <!-- <div class="row creviceRow">
    <div class="col">
      総訪問してくれた数：[ <span id="visitCount"><span id="visitCountDot_1" class="visitCountDot">.</span><span id="visitCountDot_2" class="visitCountDot">.</span><span id="visitCountDot_3" class="visitCountDot">.</span></span> ]名様
    </div>
  </div> -->
  <div class="row creviceRow">
    <div class="col-sm-2 d-none d-sm-block">&nbsp;</div>
    <div class="col-sm-8 col-12 contentBox">
      <p>
        こんにちは！このサイトを運営しているFukudaという者です^^<br>
        まず、サイトを訪問して頂きありがとうございます。<br>
        <br>
        このサイトに来て頂いたということは、きっとアレルギー性の皮膚炎によって日々苦しんでいる方、または家族にいる方、友人・恋人にいる方だと思います。<br>
        <br>
        私もそうですが、日々悩みながら、人の目線にも不安を抱きながら過ごされている事、お察し致します。<br>
        <br>
        このサイトでは、皮膚炎によって悩んでいる方同士で悩みを共有したり、アドバイスをしたりしながら、少しでも症状を改善していこうという事を目的としています。<br>
        <br>
        安心して悩みを共有してみてください^^
      </p>
    </div>
    <div class="col-sm-2 d-none d-sm-block fontS">
      <div class="container-fluid">
        <div id="profileImgBox" class="row">
          <div class="col"><img id="profileImg" src="./img/profile.JPG"></div>
        </div>
        <div class="row creviceRow">
          <div class="col">
            <p>
              少し自己紹介させていただきます。<br>
              <br>
              年齢は２０代で、男性。<br>
              現在はプログラマとして日々仕事をしています。<br>
              <br>
              <a href="https://yururito.gradation.jp/pgmemo/index.html" target="_blank">
                自己紹介サイト
              </a>
            </p>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="row creviceRow">
    <div class="col-sm-2 d-none d-sm-block">&nbsp;</div>
    <div class="col-sm-8 col-12 contentBoxWhite">
      <p class="alignCenter">
        <span class="fontLL">お知らせ</span>
        <div class="container-fluid">
          <div class="row">
            <div class="col-12 alignCenter"></div>
          </div>
        </div>
      </p>
    </div>
    <div class="col-sm-2 d-none d-sm-block">&nbsp;</div>
  </div>';

  return $html;
}

?>