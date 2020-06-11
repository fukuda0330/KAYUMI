<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <title></title>

  <meta name="viewport" content="width=device-width,initial-scale=1">
  <link href="https://fonts.googleapis.com/css2?family=Kosugi+Maru&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="./css/bootstrap.min.css">
  <link rel="stylesheet" href="./css/kayumi.css">
  <script type="text/javascript" src="./js/jquery-3.4.1.min.js"></script>
  <script type="text/javascript" src="./js/bootstrap.min.js"></script>
  <script type="text/javascript" src="./js/kayumi.js"></script>
</head>
<body>
  <div class="container-fluid">
    <!-- todo:ヘッダーは共通化したい -->
    <div id="headerBox" class="row">
      <div class="col-sm-1 col-4"><div id=""></div></div>
      <div class="col-sm-2 d-none d-sm-block"><a href="#"><div class="headLinkTab">悩み語り部屋</div></a></div>
      <div class="col-sm-2 d-none d-sm-block"><a href="#"><div class="headLinkTab">痒み日誌</div></a></div>
      <div class="col-sm-2 d-none d-sm-block"><a href="#"><div class="headLinkTab">管理者の経験</div></a></div>
      <div class="col-sm-5 col-6"><div id="btnLogin" class="btn btn-light">ログイン</div></div>
      <div id="menuOpenBox" class="col-2 d-block d-sm-none"><span id="menuOpen">&gt;</span></div>
    </div>
    <div id="spMenu">
      <div class="container-fluid">
        <div class="row">
          <div class="col-10">&nbsp;</div>
          <div id="menuCloseBox" class="col-2"><span id="menuClose">&lt;</span></div>
        </div>
        <div class="row spMenuRow">
          <div class="col">
            <a href="#">
              <div class="spMenuLink">悩み語り部屋</div>
            </a>
          </div>
        </div>
        <div class="row spMenuRow">
          <div class="col">
            <a href="#">
              <div class="">痒み日誌</div>
            </a>
          </div>
        </div>
        <div class="row spMenuRow">
          <div class="col">
            <a href="#">
              <div class="">管理者の経験</div>
            </a>
          </div>
        </div>
        <div id="profileImgBox" class="row creviceRowL fontS">
          <div class="col-8">
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
          <div class="col-4">
            <a href="https://yururito.gradation.jp/pgmemo/index.html" target="_blank">
              <img id="profileImg" src="./img/profile.JPG">
            </a>
          </div>
        </div>
      </div>
    </div>
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
          このサイトでは、皮膚炎によって悩んでいる方同士で悩みを共有したり、アドバイスをしたりしながら、少しでも症状を改善していこうという事を目的としています。
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
      <div class="col-sm-6 col-8 fontS">
        <!-- <p>
          少し自己紹介させていただきます。<br>
          <br>
          年齢は２０代で、男性。<br>
          現在はプログラマとして日々仕事をしています。<br>
          <br>
          自己紹介サイト<br>
          <a href="https://yururito.gradation.jp/pgmemo/index.html" target="_blank">
            https://yururito.gradation.jp/pgmemo/index.html
          </a>
        </p> -->
      </div>
      <!-- <div id="profileImgBox" class="col-sm-2 col-4">
        <img id="profileImg" src="./img/profile.JPG">
      </div> -->
      <div class="col-sm-2 d-none d-sm-block">&nbsp;</div>
    </div>
  </div>
</body>
</html>