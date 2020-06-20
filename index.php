<?php
  // ページアクセス用コントローラー
  require './View/AccessController.php';
  require './Models/Api/Mail/SendMail.php';

  // ページコンテンツ取得
  $pageHtml = GetHtml();
  // ページタイトル取得
  $pageTitle = GetTitle();
?>

<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <title>
<?php echo $pageTitle; ?>
  </title>

  <meta name="viewport" content="width=device-width,initial-scale=1">
  <link rel="shortcut icon" href="./img/favicon.ico">
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
      <div class="col-sm-1 col-4 relativeBox">
        <a href=".?Page=<?php echo PAGE_TOP; ?>">
          <div id="logo1" class="centerBox"></div>
          <div id="logo2" class="centerBox"></div>
        </a>
      </div>
      <div class="col-sm-2 d-none d-sm-block"><a href="#"><div class="headLinkTab centerBox">悩み語り部屋</div></a></div>
      <div class="col-sm-2 d-none d-sm-block"><a href="#"><div class="headLinkTab centerBox">痒み日誌</div></a></div>
      <div class="col-sm-2 d-none d-sm-block"><a href="#"><div class="headLinkTab centerBox">管理者の経験</div></a></div>
      <div class="col-sm-5 col-6"><div id="loginBtn" class="btn btn-light centerBox">ログイン</div></div>
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

<?php echo $pageHtml; ?>

    <div id="footerBox" class="row creviceRow">
      <div class="col-8">
        <span id="copyLight" class="centerBox">&copy; Fukuda 2020</span>
      </div>
      <div class="col-4">
        <div id="inquiryBtn" class="btn btn-light centerBox" data-toggle='modal' data-target='#inquiryModal'>お問合せ</div>
      </div>
    </div>
  </div>

  <!-- Modal[お問合せ] -->
  <div class="modal fade" id="inquiryModal" tabindex="-1" role="dialog" aria-labelledby="inquiryModalTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-md" role="document">
      <div id="inquiryModalContent" class="modal-content">
        <div class="modal-header">
          <span class="fontLL">お問合せ</span>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form method="POST" action="">
            <div class="container-fluid">
              <div class="form-row">
                <div class="custom-control custom-radio custom-control-inline">
                  <input type="radio" id="rdoIWantToKnowPassword" class="custom-control-input" name="inquiryContentType" value="パスワードが知りたい" checked required>
                  <label class="custom-control-label" for="rdoIWantToKnowPassword">パスワードが知りたい</label>
                </div>
                <div class="custom-control custom-radio custom-control-inline">
                  <input type="radio" id="rdoOther" class="custom-control-input" name="inquiryContentType" value="その他" required>
                  <label class="custom-control-label" for="rdoOther">その他</label>
                </div>
              </div>
              <div class="form-row creviceRow">
                <label for="txtMailAddress">返信が欲しいメールアドレスを入力してください</label>
              </div>
              <div class="form-row">
                <input type="email" id="txtMailAddress" class="form-control" name="txtMailAddress" required>
              </div>
              <div class="form-row creviceRow">
                <label for="txtInquiryContent">お問合せ内容を入力してください</label>
              </div>
              <div class="form-row">
                <textarea id="txtInquiryContent" class="form-control" name="txtInquiryContent" rows="10" required></textarea>
              </div>
              <div class="form-row creviceRow alignRight">
                <div class="col-12">
                  <button type="submit" id="inquirySend" class="btn btn-light" name="inquirySend">送信</button>
                </div>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</body>
</html>