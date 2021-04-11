// Firebase オプション設定
var firebaseConfig = {
  apiKey: "AIzaSy" + XXXXXXXXXXXXXXXXXXX + "yAooK" + XXXXXXXXXXXX + "8nohpsI",
  authDomain: "n" + XX + "aseapp.com",
  databaseURL: "ht" + XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX + "o.com",
  projectId: "non" + XXXX + "7",
  storageBucket: "non" + XXXXXX + "pot.com",
  messagingSenderId: "988" + XXXXXXXXXXX + "8",
  appId: "1:9887" + X + "6d7aafa66cb"
};

// firebase 初期化
firebase.initializeApp(firebaseConfig);

// DB処理格納
let database = firebase.database();

// リロード判定
let reloaded = false;

// デバイスの種類を格納
let device = "";

// 訪問者数カウントドッドループ切断
let isVisitCountDotLoop = true;

let isLogin = false;

// メイン処理
$(async function() {
  // 初期化処理
  Initialize();

  // スマホ用ハンバーガーメニュー開閉
  EventOpenSpMenu();

  // 悩み語りトーク表示切替
  EventShowWorriesTalk();

  // 悩み語り返信
  EventReplyWorriesTalk();

  // 投稿
  EventSendWorriesTalk();

  // 悩み語り投稿画面閉じる
  EventCloseWorriesTalkPost();

  // 総訪問してくれた数表示
  await ShowVisitCount();

  // 訪問カウントアップ
  AddVisitCount();
});

// 初期化処理
function Initialize() {
  // リロードチェックを行う
  ChkReload();

  // デバイス種別を判定する
  SetDeviceKind();
}

// スマホ用ハンバーガーメニュー開閉イベント定義
function EventOpenSpMenu() {
  $("#menuOpen").click(function() {
    $("#spMenu").animate({opacity:1, left:0}, 700);
  });
  $("#menuClose").click(function() {
    $("#spMenu").animate({opacity:0, left:"-100%"}, 700);
  });
}

// 悩み語りトーク表示切替イベント定義
function EventShowWorriesTalk() {
  $("#worriesTalkingBox").on("click", ".btnWorriesTalkChildShow", function() {
    let groupNo = $(this).attr("id").split("-")[1];
    let isOpen = ($(this).text() == "閉じる");
    
    $("#worriesTalkGroup-" + groupNo).children(".worriesTalkChild").each(function(index, element) {
      if (isOpen)
        $(element).fadeOut(500);
      else
        $(element).fadeIn(500);
    });
    
    $(this).text((isOpen) ? "開く" : "閉じる");
  });
}

// 悩み語り返信イベント定義
function EventReplyWorriesTalk() {
  $("#worriesTalkingBox").on("click", ".btnWorriesTalkReply", function() {
    let groupNo = $(this).attr("id").split("-")[1];
    
    $("#replyBox").html($("#worriesTalkGroup-" + groupNo).parent().parent().html()
      .replace("worriesTalkGroup", "worriesTalkReplyGroup")
      .replace("worriesTalkButtons", "worriesTalkReplyButtons"));
    
    $("#replyBox").find(".worriesTalkChild").each(function(index, element) {
      $(element).fadeIn(1);
    });
    
    $("#worriesTalkReplyButtons-" + groupNo).fadeOut(1);

    $("#worriesSend").text("返信");

    // 投稿切替ボタンを表示する
    $("#togglePostRow").css("display", "block");
  });

  $("#worriesTalkingBox").on("click", ".btnWorriesTalkReplySp", function() {
    let groupNo = $(this).attr("id").split("-")[1];

    // 返信用のテキストを設定する
    $("#replyWorriesTalkHidden").val($("#worriesTalkGroup-" + groupNo).parent().parent().html()
      .replace("worriesTalkGroup", "worriesTalkReplyGroup")
      .replace(/worriesTalkButtons/gi, "worriesTalkButtonsOfPostPage"));

    // 投稿用送信判定にする
    $("#isWorriesPost").val("1");
    document.mainForm.submit();
  });

  $("#togglePostRow").on("click", "#btnTogglePost", function() {
    // 初期化
    InitializeForm();

    // 投稿切替ボタンを非表示にする
    $("#togglePostRow").css("display", "none");
  });
}

// 投稿イベント定義
function EventSendWorriesTalk() {
  $("#worriesSend").on("click", async function() {
    // 投稿 or 返信判定
    let isReply = ($(this).text() == "返信");

    // 入力チェック
    if ($("#txtWorriesContent").val().length === 0) {
      ShowErrorToast($(this).text() + "内容を入力してください。", "投稿エラー");
      $("#txtWorriesContent").focus();
      return;
    }
    if ($("#worriesSendName").val().length === 0) {
      ShowErrorToast($(this).text() + "する際の名前を入力してください。", "投稿エラー");
      $("#worriesSendName").focus();
      return;
    }

    // 悩み語り内容を登録する
    await RegistWorriesTalk(isReply);

    // 悩み語り部屋へ遷移する
    $("#isWorriesTalk").val("1");
    document.mainForm.submit();
  });

  $("#worriesSendForSp").on("click", function() {
    // 投稿用送信判定にする
    $("#isWorriesPost").val("1");
    document.mainForm.submit();
  });

  $("#worriesSendSp").on("click", async function() {
    // 投稿 or 返信判定
    let isReply = ($(this).text() == "返信");

    // 入力チェック
    if ($("#txtWorriesContent").val().length === 0) {
      ShowErrorToast($(this).text() + "内容を入力してください。", "投稿エラー");
      $("#txtWorriesContent").focus();
      return;
    }
    if ($("#worriesSendName").val().length === 0) {
      ShowErrorToast($(this).text() + "する際の名前を入力してください。", "投稿エラー");
      $("#worriesSendName").focus();
      return;
    }

    // 悩み語り内容を登録する
    await RegistWorriesTalk(isReply);

    // 悩み語り部屋へ遷移する
    $("#isWorriesTalk").val("1");
    document.mainForm.submit();
  });
}

// 悩み語り投稿画面閉じるイベント定義
function EventCloseWorriesTalkPost() {
  $("#worriesTalkPostClose").on("click", function() {
    // 悩み語り部屋へ遷移する
    $("#isWorriesTalk").val("1");
    document.mainForm.submit();
  });
}

// 悩み語り内容登録
async function RegistWorriesTalk(isReply) {
  return new Promise(async resolve => {
    let worriesNo = 0;
    let talkNo = 0;

    if (isReply) {
      worriesNo = $($($("#replyBox").children(".col")[0]).children(".container-fluid")[0])
                    .attr("id").split("-")[1];
      talkNo = await GetMaxTalkNo(worriesNo) + 1;
    } else {
      worriesNo = await GetMaxWorriesNo() + 1;
    }

    database.ref("WorriesTalkGroup/Worries-" + worriesNo + "/Talk-" + talkNo).set(
      {
        Text: $("#txtWorriesContent").val(),
        Name: $("#worriesSendName").val(),
        Date: moment().format("YYYY/MM/DD HH:mm:ss"),
      }
    );

    // 管理者へ投稿された内容を通知
    $(function(){
      $.post("./Models/Api/LINE/LineNotify.php", {"notifyMessage": $("#worriesSendName").val() + "さんが悩みを投稿しました。 [" + $("#txtWorriesContent").val() + "]"});
    });

    // 初期化
    // InitializeForm();

    resolve();
  });
}

// フォームを初期化する
function InitializeForm() {
  // 初期化
  $("#replyBox").html("");
  $("#txtWorriesContent").val("");
  $("#worriesSendName").val("");
  $("#worriesSend").text("投稿");
  $("#togglePostRow").css("display", "none");
}

// 正常処理用通知を表示する
function ShowSuccessToast(successMessage, toastContent) {
  // エラーメッセージを表示する
  $($("#noticeToast").children(".toast-body")[0]).text(successMessage);
  $($("#noticeToast").children(".toast-header")[0]).addClass("successToast");
  $($($("#noticeToast").children(".toast-header")[0]).children(".mr-auto")[0]).text(toastContent);

  $("#noticeToast").css("z-index", "10");
  $("#noticeToast").toast({autohide:true, delay:5000});
  $("#noticeToast").toast("show");
}

// エラー用通知を表示する
function ShowErrorToast(errorMessage, toastContent) {
  // エラーメッセージを表示する
  $($("#noticeToast").children(".toast-body")[0]).text(errorMessage);
  $($("#noticeToast").children(".toast-header")[0]).addClass("errorToast");
  $($($("#noticeToast").children(".toast-header")[0]).children(".mr-auto")[0]).text(toastContent);

  $("#noticeToast").css("z-index", "10");
  $("#noticeToast").toast({autohide:true, delay:5000});
  $("#noticeToast").toast("show");
}

function SwitchLoginContent() {
  $(".showIsLogin").css({"cssText":"display: " + ((isLogin === true) ? "inline" : "none") + " !important"});
  $(".showNoLogin").css({"cssText":"display: " + ((isLogin === false) ? "inline" : "none") + " !important"});
}

function SignIn(mailAddress, password) {
  return new Promise(function(resolve) {
    firebase.auth().signInWithEmailAndPassword(mailAddress, password)
    .then((user) => {
      resolve(true);
    })
    .catch((error) => {
      resolve(false);
    });
  });
}

function SignUp(mailAddress, password) {
  return new Promise(function(resolve) {
    firebase.auth().createUserWithEmailAndPassword(mailAddress, password)
    .then((user) => {
      resolve(true);
    })
    .catch((error) => {
      resolve(false);
    });
  });
}

function IsLoginClient() {
  return new Promise(function(resolve) {
    firebase.auth().onAuthStateChanged(function(user) {
      if (user && firebase.auth().currentUser) {
        resolve(true);
        
      } else {
        // let regexpTopUrl1 = /.*\/KAYUMI\/index.php$/ig;
        // let regexpTopUrl2 = /.*\/KAYUMI\/$/ig;
        // if (String(window.location).match(regexpTopUrl1) === null && String(window.location).match(regexpTopUrl2) === null) {
        //   window.location = "/KAYUMI/index.php";
        // }
        
        resolve(false);
      }
    });
  });
}

// 最大No取得
function GetMaxNo(val) {
  let maxNo = 0;
  Object.keys(val).forEach(function(key) {
    maxNo = Math.max(maxNo, key.split("-")[1]);
  });
  return maxNo;
}
// 最大WorriesNo取得
function GetMaxWorriesNo() {
  return new Promise(resolve => {
    database.ref("WorriesTalkGroup").on("value", function(worries) {
      let worriesVal = worries.val();
      let maxWorriesNo = GetMaxNo(worriesVal);

      resolve(maxWorriesNo);
    });
  });
}
// 最大TalkNo取得
function GetMaxTalkNo(worriesNo) {
  return new Promise(resolve => {
    database.ref("WorriesTalkGroup/Worries-" + worriesNo).on("value", function(talks) {
      let talksVal = talks.val();
      let maxTalkNo = GetMaxNo(talksVal);

      resolve(maxTalkNo);
    });
  });
}

// 悩み語り部屋で語った内容を表示する
function ShowWorriesTalkList() {
  return new Promise(async resolve => {
    // リロードアイコン表示
    await ShowReloadIcon();

    database.ref("WorriesTalkGroup").once("value", async function(worriesTalk) {
      // 悩み語りボックスに入れるHTML
      let worriesHtml = '<div class="container-fluid">';
      // 悩み全体の値リスト
      let worriesTalkVal = worriesTalk.val();

      // 返信開閉ボタン表示有無
      let isBtnWorriesTalkChildShow;
      
      let replyCountList = [];
      Object.keys(worriesTalkVal)
      .sort((worriesKeyCurrent, worriesKeyNext) => parseInt(worriesKeyNext.split("-")[1]) - parseInt(worriesKeyCurrent.split("-")[1]))
      .forEach(function(worriesKey) {

        let worriesNo = worriesKey.split("-")[1];
        if (worriesNo != "0") {
          
          // 返信開閉ボタン表示無
          isBtnWorriesTalkChildShow = false;

          worriesHtml += '<div class="row"><div class="col"><div id="worriesTalkGroup-' + worriesNo + '" class="container-fluid">';

          let replyCount = 0;
          let talkList = worriesTalkVal[worriesKey];
          Object.keys(talkList).forEach(function(talkKey) {
            let talkNo = talkKey.split("-")[1];

            if (talkNo == "0") {
              // 悩み語り（親）
              worriesHtml += CreateWorriesParentHtml(talkList[talkKey], worriesNo);
            } else {
              // 悩み語り（子）
              worriesHtml += CreateWorriesChildHtml(talkList[talkKey]);
              isBtnWorriesTalkChildShow = true;
              replyCount++;
            }
          });

          // 返信数リストを作成する
          replyCountList[worriesNo] = JSON.parse('{"#replyCount-' + worriesNo + '" : "' + replyCount + '"}');
        
          // 返信開閉ボタン
          worriesHtml += CreateWorriesButtonHtml(isBtnWorriesTalkChildShow, worriesNo);

          worriesHtml += '</div></div></div>';
        }

      });

      // ロードアイコン非表示
      await HiddenReloadIcon();

      // 悩み語りボックスに入れる
      worriesHtml += '<div class="row"><div class="col">&nbsp;</div></div></div>';
      $("#worriesTalkingBox").html(worriesHtml);
    
      $(".worriesTalkChild").fadeOut(1);

      // 返信数をそれぞれ表示する
      let worriesNoTmp = 0;
      let replyCountId = "";
      replyCountList.forEach(function(replyCountInfo) {
        worriesNoTmp++;
        replyCountId = "#replyCount-" + worriesNoTmp;

        $(replyCountId).text(replyCountInfo[replyCountId]);
      });

      resolve();
    });
  });
}

// 悩み語り（親）のHTMLを作成する
function CreateWorriesParentHtml(talkInfo, worriesNo) {
  return '<div class="row worriesTalkParent creviceRow">' +
            '<div class="col worriesTalkContent shadow">' +
              '<p>' + ReplaceBR(EscapeScript(talkInfo.Text)) + '</p>' +
              '<div class="sendInfo alignRight">' + talkInfo.Name + ' ' + talkInfo.Date + ' ' + '返信(<span id="replyCount-' + worriesNo + '"></span>)</div>' +
            '</div>' +
          '</div>';
}

// 悩み語り（子）のHTMLを作成する
function CreateWorriesChildHtml(talkInfo) {
  return '<div class="row worriesTalkChild">' +
            '<div class="col-1 col-sm-2"></div>' +
            '<div class="col worriesTalkContent shadow">' +
              '<p>' + ReplaceBR(EscapeScript(talkInfo.Text)) + '</p>' +
              '<div class="sendInfo alignRight">' + talkInfo.Name + ' ' + talkInfo.Date + '</div>' +
            '</div>' +
          '</div>';
}

// 返信開閉ボタンHTMLを作成する
function CreateWorriesButtonHtml(isBtnWorriesTalkChildShow, worriesNo) {
  
  let btnWorriesTalkChildShow = (isBtnWorriesTalkChildShow) ? '<div id="btnWorriesTalkChildShow-' + worriesNo + '" class="btn btn-light btnWorriesTalkChildShow">開く</div>' : '';

  return '<div id="worriesTalkButtons-' + worriesNo + '" class="row creviceRow worriesTalkButtons">' +
            '<div class="col-2 col-sm-8">&nbsp;</div>' +
            '<div class="col-5 col-sm-2 alignRight">' +
               btnWorriesTalkChildShow +
            '</div>' +
            '<div class="col-sm-2 d-none d-sm-block alignRight"><div id="btnWorriesTalkReply-' + worriesNo + '" class="btn btn-light btnWorriesTalkReply">返信する</div></div>' +
            '<div class="col-5 d-block d-sm-none alignRight"><div id="btnWorriesTalkReplySp-' + worriesNo + '" class="btn btn-light btnWorriesTalkReplySp">返信する</div></div>' +
          '</div>';
}

// 総訪問してくれた数表示
function ShowVisitCount() {
  return new Promise(resolve => {
    // 訪問者数カウントドッドアニメーション
    AnimationVisitCountDot();

    database.ref("WorriesVisitCount").on("value", function(visitCount) {
      $("#visitCount").text(visitCount.val());

      // 訪問者数カウントドッド非表示
      HiddenVisitCountDot();
      isVisitCountDotLoop = false;

      resolve();
    });
  });
}
// 総訪問してくれた数カウントアップ
function AddVisitCount() {
  return new Promise(resolve => {
    // 遷移前情報参照
    let ref = window.document.referrer;

    // 遷移前画面が本サイト以外だった場合、処理実行
    if ((!Isset(ref) || (
            // 除外するホスト名
            ref.indexOf("ide.c9.io") == -1 &&
            ref.indexOf("preview.c9users.io") == -1 &&
            ref.indexOf("yururito.gradation.jp") == -1 &&
            ref.indexOf("localhost") == -1
          )) &&
        !reloaded) {

      // 開発環境の場合は、以降の処理を行わない
      if (window.location.hostname.indexOf("localhost") !== -1)
        return;
      
      // 訪問数カウントアップ
      database.ref("WorriesVisitCount").set(parseInt($("#visitCount").text()) + 1);

      // 管理者へアクセスされた事を通知
      $(function(){
        $.post("./Models/Api/LINE/LineNotify.php", {"accessMessage": device + "で KAYUMI にアクセスがありました。"});
      });

    }

    resolve();
  });
}

// リロードアイコン表示(非同期待ち)
function ShowReloadIcon() {
  return new Promise(resolve => {
    $("#worriesTalkLoading").fadeIn(100, function() {
       resolve();
    });
  });
}
// リロードアイコン非表示(非同期待ち)
function HiddenReloadIcon() {
  return new Promise(resolve => {
    $("#worriesTalkLoading").fadeOut(100, function() {
       resolve(); 
    });
  });
}

// 訪問者数カウントドッドアニメーション
function AnimationVisitCountDot() {
  let dotCount = 1;
  setTimeout(async function() {
    while (true) {
      await ShowVisitCountDot(dotCount);
      dotCount++;

      if (dotCount > 3) {
        HiddenVisitCountDot();
        dotCount = 1;
      }

      if (!isVisitCountDotLoop)
        break;
    }
  }, 1);
}
// 訪問者数カウントドッド表示
function ShowVisitCountDot(dotCount) {
  return new Promise(resolve => {
    $("#visitCountDot_" + dotCount).fadeIn(100, function() {
      resolve();
    });
  });
}
// 訪問者数カウントドッド非表示
function HiddenVisitCountDot() {
  $("#visitCountDot_1").fadeOut(100);
  $("#visitCountDot_2").fadeOut(100);
  $("#visitCountDot_3").fadeOut(100);
}

// 改行コードをHTML用の改行に変換する
function ReplaceBR(text) {
  return text.replace(/(\r|\n|\r\n)/gi, "<br>");
}

// XSS対策のスクリプト変換
function EscapeScript(text) {
  return text.replace(/</gi, "&lt;").replace(/>/gi, "&gt;");
}

// 値設定チェック
function Isset(value) {
  return (value !== null && value !== "" && value !== undefined);
}

// リロードチェック
function ChkReload() {
  if (Isset(window.sessionStorage.getItem("href")) && window.sessionStorage.getItem("href") == window.location.href) {
    reloaded = true;
  }
  window.sessionStorage.setItem("href", window.location.href);
};

// デバイスの種別を判定
function SetDeviceKind() {
  // ユーザーエージェントを取得
  let ua = window.navigator.userAgent;

  if (ua.indexOf("iPhone") != -1 ||
      ua.indexOf("iPod") != -1 ||
      (ua.indexOf("Android") != -1 && ua.indexOf("Mobile") != -1) ||
      ua.indexOf("iPad") != -1 ||
      ua.indexOf("Android") != -1) {
      device = "sp";
  }
  else {
      device = "pc";
  }
}