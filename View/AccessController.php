<?php

require './Defined/definePage.php';
require './Defined/defineTitle.php';
include './View/top.php';
include './View/worriesTalkRoom.php';
include './View/worriesTalkPost.php';
include './View/experience.php';

// デフォルト表示ページ
$pageName = PAGE_TOP;

// ページ判定
if (isset($_POST['worriesTalkRoomLink']) || isset($_POST['worriesTalkRoomLinkSp']) || (isset($_POST['isWorriesTalk']) && $_POST['isWorriesTalk'] === "1")) {
  $pageName = PAGE_WORRIES_TALK_ROOM;
}
else if (isset($_POST['isWorriesPost']) && $_POST['isWorriesPost'] == "1") {
  $pageName = PAGE_WORRIES_TALK_POST;
}
else if (isset($_POST['experienceLink']) || isset($_POST['experienceLinkSp'])) {
  $pageName = PAGE_EXPERIENCE;
}

// ページタイトル取得
function GetTitle($pageName) {
  switch ($pageName) {
    case PAGE_TOP:
      return TITLE_TOP;
    break;
    case PAGE_WORRIES_TALK_ROOM:
      return TITLE_WORRIES_TALK_ROOM;
    break;
    case PAGE_WORRIES_TALK_POST:
      return TITLE_WORRIES_TALK_POST;
    break;
    case PAGE_EXPERIENCE:
      return TITLE_EXPERIENCE;
    break;
  }
}

// ページHTML取得
function GetHtml($pageName) {
  switch ($pageName) {
    // トップ
    case PAGE_TOP:
      return GetTopView();
    break;
    // 悩み語り部屋
    case PAGE_WORRIES_TALK_ROOM:
      return GetWorriesTalkRoomView();
    break;
    // 悩み語り投稿
    case PAGE_WORRIES_TALK_POST:
      return GetWorriesTalkPostView();
    break;
    // 管理者の経験
    case PAGE_EXPERIENCE:
      return GetExperienceView();
    break;
  }
}



// ログイン処理
$loginHash = '';
$isLogin = false;
if (isset($_POST['loginSend'])) {
  $__Login = new Login();
  
  if ($__Login->CheckPassword($_POST['txtLoginPassword'])) {
    $loginHash = $__Login::HASH;
    $isLogin = true;
  }
}
else if (!empty($_POST['loginHashHidden'])) {
  $__Login = new Login();
  
  if ($__Login->CheckHash($_POST['loginHashHidden'])) {
    $loginHash = $__Login::HASH;
    $isLogin = true;
  }
}

class Login {
  public const HASH = '$2y$10$lIGG1QPJLUHjCDe14k..He90QeO7PPUKTcSte0dkvpuv.yRnrcS/a';

  function __construct() {
  }

  public function CheckPassword($loginPassword) {
    // パスワードチェック開始
    return password_verify($loginPassword, self::HASH);
  }

  public function CheckHash($hash) {
    // ハッシュ値チェック開始
    return $hash === self::HASH;
  }
}

?>