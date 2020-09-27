<?php

function GetWorriesTalkRoomView() {
  $html = '
  <div class="row creviceRow alignRight d-block d-sm-none"><div class="col"><div id="worriesSendForSp" class="btn btn-light">投稿</div></div></div>
  <div id="worriesRow" class="row creviceRow">
    <div class="col-12 col-sm-8 relativeBox">
      <div class="container-fluid"><div class="row"><div class="col">悩みを共有してみてください^^</div></div></div>
      <div id="worriesTalkingBox"></div>
      <div id="worriesTalkLoading" class="spinner-border text-danger" role="status">
        <span class="sr-only">Loading...</span>
      </div>
    </div>
    <div id="worriesTalkFormBox" class="col-sm-4 d-none d-sm-block">
      <div class="container-fluid">
        <div class="row"><div class="col"><div class="container-fluid"><div id="replyBox" class="row"></div></div></div></div>
        <div id="togglePostRow" class="row alignRight creviceRow"><div class="col"><div id="btnTogglePost" class="btn btn-light">新たに投稿したい</div></div></div>
        <div class="form-row creviceRowL">
          <textarea id="txtWorriesContent" class="form-control focusScrollPosition" name="txtWorriesContent" rows="10" placeholder="内容入力"></textarea>
        </div>
        <div class="form-row creviceRow alignRight">
          <div class="col-9">
            <input type="text" id="worriesSendName" class="form-control" name="worriesSendName" placeholder="名前入力">
          </div>
          <div class="col-3">
            <div id="worriesSend" class="btn btn-light" name="worriesSend">投稿</div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <script>
    $(async function() {
      // 悩み語りトークリスト表示
      await ShowWorriesTalkList();
    });
  </script>
  ';

  return $html;
}

?>