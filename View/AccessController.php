<?php

require "./Defined/definePage.php";
require "./Defined/defineTitle.php";
include "./View/top.php";

// デフォルト表示ページ
if (!isset($_GET["Page"])) {
  $_GET["Page"] = PAGE_TOP;
}

// ページタイトル取得
function GetTitle() {
  switch ($_GET["Page"]) {
    case PAGE_TOP:
      return TITLE_TOP;
    break;
  }
}

// ページHTML取得
function GetHtml() {
  switch ($_GET["Page"]) {
    // トップ
    case PAGE_TOP:
      return GetTopView();
    break;
  }
}

?>