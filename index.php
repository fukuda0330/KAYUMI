<?php
  $actionType = "";

  // ページアクセス用コントローラー
  require './View/AccessController.php';
  require './Models/Api/Mail/SendMail.php';

  // ページコンテンツ取得
  $pageHtml = GetHtml($pageName);
  // ページタイトル取得
  $pageTitle = GetTitle($pageName);
?>

<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <title>
<?php echo $pageTitle; ?>
  </title>

  <meta name="viewport" content="width=device-width,initial-scale=1">

  <!-- アドレスバー等のブラウザのUIを非表示 -->
  <meta name="apple-mobile-web-app-capable" content="yes">
  <!-- default（Safariと同じ） / black（黒） / black-translucent（ステータスバーをコンテンツに含める） -->
  <meta name="apple-mobile-web-app-status-bar-style" content="black">
  <!-- ホーム画面に表示されるアプリ名 -->
  <meta name="apple-mobile-web-app-title" content="KAYUMI">
  <!-- ホーム画面に表示されるアプリアイコン -->
  <link rel="apple-touch-icon" href="./img/kayumi_topimage.JPG">

  <link rel="shortcut icon" href="./img/favicon.ico">

  <link rel="stylesheet" href="./css/all.min.css">
  <link href="https://fonts.googleapis.com/css2?family=Kosugi+Maru&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="./css/bootstrap.min.css">
  <link rel="stylesheet" href="./css/kayumi.css">

  <script src="https://www.gstatic.com/firebasejs/8.2.9/firebase.js"></script>

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
<?php if ($actionType === 'loginSend') { ?>
    
      $("#noticeToast").css("z-index", "10");
      $("#noticeToast").toast({autohide:true, delay:5000});
      $("#noticeToast").toast("show");

<?php } else if ($actionType === 'inquirySend') { ?>
<?php   $noticeMessage = ($isSuccessSendMail) ? 'お問合せが完了しました！' : 'お問合せに失敗しました。'; ?>

      $("#noticeToast").css("z-index", "10");
      $("#noticeToast").toast({autohide:true, delay:5000});
      $("#noticeToast").toast("show");

<?php } else { ?>
    
      $("#noticeToast").css("z-index", "-1");

<?php } ?>
    });
  </script>
</head>
<body>

  <!-- 通知ポップアップ -->
  <div id="noticeToast" class="toast">
    <div class="toast-header <?php echo ($isLogin || $isSuccessSendMail) ? 'successToast' : 'errorToast'; ?>">
      <strong class="mr-auto"><?php if ($actionType === 'loginSend') echo 'ログイン結果'; if ($actionType === 'inquirySend') echo 'お問合せ結果'; ?></strong>
      <button type="button" class="ml-2 mb-1 close" data-dismiss="toast" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button>
    </div>
    <div class="toast-body">
      <?php echo $noticeMessage; ?>
    </div>
  </div>

  <form method="POST" action="" name="mainForm" id="mainForm">

    <div class="container-fluid">
      <div id="headerBox" class="row">
        <div class="col-sm-1 col-4 relativeBox">
          <button type="submit" id="topLogoLink">
            <div id="logo1" class="centerBox"></div>
            <div id="logo2" class="centerBox"></div>
          </button>
        </div>

        <div class="col-sm-2 d-none d-sm-block isLoginElement"><button type="submit" class="btn btn-gray headLinkTab centerBox" name="worriesTalkRoomLink">悩み語り部屋</button></div>
        <div class="col-sm-2 d-none d-sm-block isLoginElement"><button type="submit" class="btn btn-gray headLinkTab centerBox" disabled>痒み日誌</button></div>
        <div class="col-sm-2 d-none d-sm-block isLoginElement"><button type="submit" class="btn btn-gray headLinkTab centerBox" name="experienceLink">管理者の経験</button></div>
        <div class="col-sm-5 col-7 isLoginElement"><div id="logoutBtn" class="btn btn-light centerBox" onClick="SignOut();">ログアウト</div></div>

        <div class="col-sm-6 d-none d-sm-block relativeBox isLogoutElement"><span class="centerBox">ログイン後に各メニューが表示されます^^</span></div>
        <div class="col-sm-5 col-7 isLogoutElement"><div id="loginBtn" class="btn btn-light centerBox" data-toggle="modal" data-target="#loginModal">ログイン</div></div>

        <div id="menuOpenBox" class="col-1 d-block d-sm-none"><span id="menuOpen">&gt;</span></div>
      </div>
      <div id="spMenu">
        <div class="container-fluid">
          <div class="row">
            <div class="col-10">&nbsp;</div>
            <div id="menuCloseBox" class="col-2"><span id="menuClose">&lt;</span></div>
          </div>
          <div class="row spMenuRow">
            <div class="col">
              <button type="submit" class="spMenuLink isLoginElement" name="worriesTalkRoomLinkSp">
                <div class="">悩み語り部屋</div>
              </button>
              <div class="isLogoutElement">ログイン後に各メニューが表示されます^^</div>
            </div>
          </div>
          <div class="row spMenuRow">
            <div class="col">
              <button type="submit" class="spMenuLink isLoginElement" disabled>
                <div class="">痒み日誌</div>
              </button>
            </div>
          </div>
          <div class="row spMenuRow">
            <div class="col">
              <button type="submit" class="spMenuLink isLoginElement" name="experienceLinkSp">
                <div class="">管理者の経験</div>
              </button>
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
      <div class="row creviceRow d-block d-sm-none">
        <img id="mainImage" src="./img/kayumi_topimage.JPG">
      </div>

<?php echo $pageHtml; ?>

      <div id="footerBox" class="row creviceRow">
        <div class="col-8">
          <span id="copyLight" class="centerBox">&copy; Fukuda 2021</span>
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
                <textarea id="txtInquiryContent" class="form-control focusScrollPosition" name="txtInquiryContent" rows="10" placeholder="" required></textarea>
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
              <div class="form-group">
                <input type="email" class="form-control" id="sign-in-address" placeholder="メールアドレス">
              </div>
              <div class="form-group">
                <input type="password" class="form-control" id="sign-in-password" placeholder="パスワード">
              </div>
              <div class="form-group">
                <button type="button" id="sign-up-button" class="btn btn-outline-secondary box-sizing-common" onClick="SignUp($('#sign-in-address').val(), $('#sign-in-password').val());"><i class="far fa-envelope fa-fw"></i>&nbsp;アカウント作成</button>
                <button type="button" id="sign-in-button" class="btn btn-outline-secondary box-sizing-common" onClick="SignIn($('#sign-in-address').val(), $('#sign-in-password').val());"><i class="far fa-envelope fa-fw"></i>&nbsp;ログイン</button>
              </div>
              <!-- <div class="form-group crecive-box-l">
                <button type="button" id="google-sign-in-button" class="btn btn-outline-secondary o-auth-sign-in-button" onClick="SignInGoogle();"><i class="fab fa-google fa-fw"></i>&nbsp;Googleでログイン</button>
              </div> -->
              <!-- <div class="form-group">
                <button type="button" id="twitter-sign-in-button" class="btn btn-outline-secondary o-auth-sign-in-button" onClick="SignInTwitter();"><i class="fab fa-twitter fa-fw"></i>&nbsp;Twitterでログイン</button>
              </div>
              <div class="form-group">
                <button type="button" id="facebook-sign-in-button" class="btn btn-outline-secondary o-auth-sign-in-button" onClick="SignInFacebook();"><i class="fab fa-facebook fa-fw"></i>&nbsp;Facebookでログイン</button>
              </div>
              <div class="form-group">
                <button type="button" id="github-sign-in-button" class="btn btn-outline-secondary o-auth-sign-in-button" onClick="SignInGithub();"><i class="fab fa-github fa-fw"></i>&nbsp;Githubでログイン</button>
              </div> -->
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</body>
</html>