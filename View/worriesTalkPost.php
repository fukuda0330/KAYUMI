<?php

function GetWorriesTalkPostView() {
  $html = '
  <div class="row alignRight fontLL creviceRow"><div class="col"><span id="worriesTalkPostClose">×</span></div></div>
  <div id="worriesRow" class="row creviceRow">
    <div id="worriesTalkFormBox" class="col-12">
      <div class="container-fluid">
        <div class="row"><div class="col"><div class="container-fluid"><div id="replyBox" class="row">' . $_POST['replyWorriesTalkHidden'] . '</div></div></div></div>
        <div id="togglePostRow" class="row alignRight creviceRow"><div class="col"><div id="btnTogglePost" class="btn btn-light">新たに投稿したい</div></div></div>
        <div class="form-row creviceRowL">
          <textarea id="txtWorriesContent" class="form-control focusScrollPosition" name="txtWorriesContent" rows="10" placeholder="内容入力"></textarea>
        </div>
        <div class="form-row creviceRow alignRight">
          <div class="col-9">
            <input type="text" id="worriesSendName" class="form-control" name="worriesSendName" placeholder="名前入力">
          </div>
          <div class="col-3">
            <div id="worriesSendSp" class="btn btn-light" name="worriesSendSp">投稿</div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <script>
    $(function() {
      $("#replyBox").find(".worriesTalkChild").each(function(index, element) {
        $(element).fadeIn(1);
      });';

  if (strlen($_POST['replyWorriesTalkHidden']) > 0) {
        $html .= '$("#worriesSendSp").text("返信");';
  }

  $html .= '
    });
  </script>
  ';

  return $html;
}

?>