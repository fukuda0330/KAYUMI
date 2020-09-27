<?php
  // ページアクセス用コントローラー
  require './View/AccessController.php';
  require './Models/Api/Mail/SendMail.php';

  // ページコンテンツ取得
  $pageHtml = GetHtml($pageName);
  // ページタイトル取得
  $pageTitle = GetTitle($pageName);

  if (!$isLogin) {
    // ページコンテンツ取得
    $pageHtml = GetTopView();
    // ページタイトル取得
    $pageTitle = TITLE_TOP;
  }
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

  <script src="https://www.gstatic.com/firebasejs/3.5.0/firebase.js"></script>

  <script type="text/javascript" src="./js/XXXXX.js"></script>
  <script type="text/javascript" src="./js/XXX.js"></script>
  <script type="text/javascript" src="./js/XXXXXXXXXXXXXXXX.js"></script>
  <script type="text/javascript" src="./js/XX.js"></script>
  <script type="text/javascript" src="./js/X.js"></script>

  <script type="text/javascript" src="./js/jquery-3.4.1.min.js"></script>
  <script type="text/javascript" src="./js/bootstrap.min.js"></script>
  <script type="text/javascript" src="./js/Moment.min.js"></script>
  <script type="text/javascript" src="./js/kayumi.js"></script>

  <script type="text/javascript">
    $(function() {
// ログイン処理が行われる場合
<?php if (isset($_POST['loginSend'])) { ?>
<?php   $noticeMessage = ($isLogin) ? 'ログインできました！(^^)' : 'パスワードが違うみたいですm(_ _)m'; ?>
    
      $("#noticeToast").css("z-index", "10");
      $("#noticeToast").toast({autohide:true, delay:5000});
      $("#noticeToast").toast("show");

<?php   if ($isLogin) { ?>

      // 管理者へログインされた事を通知
      $(function(){
        $.post("./Models/Api/LINE/LineNotify.php", {"accessMessage": "KAYUMI にログインがありました。"});
      });

<?php   } ?>

<?php } else { ?>
    
      $("#noticeToast").css("z-index", "-1");

<?php } ?>
    });
  </script>
</head>
<body>

  <!-- 通知ポップアップ -->
  <div id="noticeToast" class="toast">
    <div class="toast-header <?php echo ($isLogin) ? 'successToast' : 'errorToast'; ?>">
      <strong class="mr-auto">ログイン結果</strong>
      <button type="button" class="ml-2 mb-1 close" data-dismiss="toast" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button>
    </div>
    <div class="toast-body">
      <?php echo $noticeMessage; ?>
    </div>
  </div>

  <form method="POST" action="" name="mainForm">

    <div class="container-fluid">
      <div id="headerBox" class="row">
        <div class="col-sm-1 col-4 relativeBox">
          <button type="submit" id="topLogoLink">
            <div id="logo1" class="centerBox"></div>
            <div id="logo2" class="centerBox"></div>
          </button>
        </div>

<?php if ($isLogin) { ?>
        <div class="col-sm-2 d-none d-sm-block"><button type="submit" class="btn btn-gray headLinkTab centerBox" name="worriesTalkRoomLink">悩み語り部屋</button></div>
        <div class="col-sm-2 d-none d-sm-block"><button type="submit" class="btn btn-gray headLinkTab centerBox" disabled>痒み日誌</button></div>
        <div class="col-sm-2 d-none d-sm-block"><button type="submit" class="btn btn-gray headLinkTab centerBox" name="experienceLink">管理者の経験</button></div>
        <div class="col-sm-5 col-6"></div>
<?php } else { ?>
        <div class="col-sm-6 d-none d-sm-block relativeBox"><span class="centerBox">ログイン後に各メニューが表示されます^^</span></div>
        <div class="col-sm-5 col-6"><div id="loginBtn" class="btn btn-light centerBox" data-toggle="modal" data-target="#loginModal">ログイン</div></div>
<?php } ?>

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

<?php if ($isLogin) { ?>
              <button type="submit" class="spMenuLink" name="worriesTalkRoomLinkSp">
                <div class="">悩み語り部屋</div>
              </button>
<?php } else { ?>
              <div class="">ログイン後に各メニューが表示されます^^</div>
<?php } ?>
            </div>
          </div>
          <div class="row spMenuRow">
            <div class="col">

<?php if ($isLogin) { ?>
              <button type="submit" class="spMenuLink" disabled>
                <div class="">痒み日誌</div>
              </button>
<?php } ?>

            </div>
          </div>
          <div class="row spMenuRow">
            <div class="col">

<?php if ($isLogin) { ?>
              <button type="submit" class="spMenuLink" name="experienceLinkSp">
                <div class="">管理者の経験</div>
              </button>
<?php } ?>

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

    <input type="hidden" name="loginHashHidden" value="<?php echo $loginHash; ?>">
    <input type="hidden" id="isWorriesPost" name="isWorriesPost" value="0">
    <input type="hidden" id="isWorriesTalk" name="isWorriesTalk" value="0">
    <input type="hidden" id="replyWorriesTalkHidden" name="replyWorriesTalkHidden" value="">

  </form>

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
                <input type="email" id="txtMailAddress" class="form-control focusScrollPosition" name="txtMailAddress" placeholder="XXXXXX@XXXX.com" required>
              </div>
              <div class="form-row creviceRow">
                <label for="txtInquiryContent">お問合せ内容を入力してください</label>
              </div>
              <div class="form-row">
                <textarea id="txtInquiryContent" class="form-control focusScrollPosition" name="txtInquiryContent" rows="10" placeholder="例：&#13;&#10;・お問合せ目的&#13;&#10;・このサイトをどう利用したいか&#13;&#10;etc..." required></textarea>
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

  <!-- Modal[ログイン] -->
  <div class="modal fade" id="loginModal" tabindex="-1" role="dialog" aria-labelledby="loginModalTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-md" role="document">
      <div id="loginModalContent" class="modal-content">
        <div class="modal-header">
          <span class="fontLL">ログイン</span>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form method="POST" action="">
            <div class="container-fluid">
              <div class="form-row creviceRow">
                <label for="txtLoginPassword">KAYUMIコミュニティへのログインパスワードを入力してください</label>
              </div>
              <div class="form-row">
                <input type="text" id="txtLoginPassword" class="form-control focusScrollPosition" name="txtLoginPassword" required>
              </div>
              <div class="form-row creviceRow alignRight">
                <div class="col-12">
                  <button type="submit" id="loginSend" class="btn btn-light" name="loginSend">ログイン</button>
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