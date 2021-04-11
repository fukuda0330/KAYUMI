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
  <link rel="shortcut icon" href="./img/favicon.ico">
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
    $(async function() {

// ログイン処理が行われる場合
<?php if ($actionType === 'loginSend') { ?>

      // ログイン処理を行う
      isLogin = await SignIn('<?php echo $_POST['txtLoginMailAddress']; ?>', '<?php echo $_POST['txtLoginPassword']; ?>')
      if (isLogin === true) {
        // ログイン成功
        ShowSuccessToast('ログインできました！(^^)', 'ログイン結果');
      } else {
        // ログイン失敗
        ShowErrorToast('メールアドレス、またはパスワードが違うみたいですm(_ _)m', 'ログイン結果');
      }

      if (isLogin === true) {

        // 管理者へログインされた事を通知
        $(function(){
          $.post("./Models/Api/LINE/LineNotify.php", {"accessMessage": "KAYUMI にログインがありました。"});
        });

      }

<?php } else if ($actionType === 'signUp') { ?>

      // サインアップ処理を行う
      isLogin = await SignUp('<?php echo $_POST['txtLoginMailAddress']; ?>', '<?php echo $_POST['txtLoginPassword']; ?>')
      if (isLogin === true) {
        // サインアップ成功
        ShowSuccessToast('アカウントを作成できました！(^^)', 'アカウント作成結果');
      } else {
        // サインアップ失敗
        ShowErrorToast('アカウント作成時に何らかのエラーが発生しましたm(_ _)m お問い合わせにてお知らせください。', 'アカウント作成結果');
      }

      if (isLogin === true) {

        // 管理者へサインアップされた事を通知
        $(function(){
          $.post("./Models/Api/LINE/LineNotify.php", {"accessMessage": "KAYUMI にサインアップがありました。"});
        });

      }

<?php } else if ($actionType === 'inquirySend') { ?>

<?php   if ($isSuccessSendMail) { ?>
      ShowSuccessToast('お問合せが完了しました！', 'お問合せ結果');
<?php   } else { ?>
      ShowErrorToast('お問合せに失敗しました。', 'お問合せ結果');
<?php   } ?>

<?php } else { ?>
    
      $("#noticeToast").css("z-index", "-1");

      isLogin = await IsLoginClient();

<?php } ?>

      SwitchLoginContent();
    });
  </script>
</head>
<body onLoad="">

  <!-- 通知ポップアップ -->
  <div id="noticeToast" class="toast">
    <div class="toast-header">
      <strong class="mr-auto"></strong>
      <button type="button" class="ml-2 mb-1 close" data-dismiss="toast" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button>
    </div>
    <div class="toast-body"></div>
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

        <div class="col-sm-2 d-none d-sm-block showIsLogin"><button type="submit" class="btn btn-gray headLinkTab centerBox" name="worriesTalkRoomLink">悩み語り部屋</button></div>
        <div class="col-sm-2 d-none d-sm-block showIsLogin"><button type="submit" class="btn btn-gray headLinkTab centerBox" disabled>痒み日誌</button></div>
        <div class="col-sm-2 d-none d-sm-block showIsLogin"><button type="submit" class="btn btn-gray headLinkTab centerBox" name="experienceLink">管理者の経験</button></div>
        <div class="col-sm-5 col-6 showIsLogin"></div>
        <div class="col-sm-6 d-none d-sm-block relativeBox showNoLogin"><span class="centerBox">ログイン後に各メニューが表示されます^^</span></div>
        <div class="col-sm-5 col-6 showNoLogin"><div id="loginBtn" class="btn btn-light centerBox" data-toggle="modal" data-target="#loginModal">ログイン</div></div>

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
              <button type="submit" class="spMenuLink showIsLogin" name="worriesTalkRoomLinkSp">
                <div class="">悩み語り部屋</div>
              </button>
              <div class="showNoLogin">ログイン後に各メニューが表示されます^^</div>
            </div>
          </div>
          <div class="row spMenuRow">
            <div class="col">
              <button type="submit" class="spMenuLink showIsLogin" disabled>
                <div class="">痒み日誌</div>
              </button>
            </div>
          </div>
          <div class="row spMenuRow">
            <div class="col">
              <button type="submit" class="spMenuLink showIsLogin" name="experienceLinkSp">
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
                <textarea id="txtInquiryContent" class="form-control focusScrollPosition" name="txtInquiryContent" rows="10" placeholder="お問合せ内容は任意入力です"></textarea>
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
                <label for="txtLoginMailAddress">メールアドレスを入力してください</label>
              </div>
              <div class="form-row">
                <input type="mail" id="txtLoginMailAddress" class="form-control focusScrollPosition" name="txtLoginMailAddress" required>
              </div>
              <div class="form-row creviceRow">
                <label for="txtLoginPassword">ログインパスワードを入力してください</label>
              </div>
              <div class="form-row">
                <input type="password" id="txtLoginPassword" class="form-control" name="txtLoginPassword" required>
              </div>
              <div class="form-row creviceRow alignRight">
                <div class="col-6">
                  <button type="submit" id="loginSend" class="btn btn-light" name="loginSend">ログイン</button>
                </div>
                <div class="col-6">
                  <button type="submit" id="signUp" class="btn btn-light" name="signUp">アカウント作成</button>
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