$(function () {
  const pageTop = $("#page-top");
  pageTop.hide();
  $(window).scroll(function () {
    if ($(this).scrollTop() > 100) { // 100pxスクロールしたら表示
      pageTop.fadeIn(); // 100px以上スクロールしたらボタンをフェードイン
    } else {
      pageTop.fadeOut(); // 100px以下になったらボタンをフェードアウト
    }
  });
  pageTop.click(function () {
    $("body,html").animate(
      {
        scrollTop: 0,
      },
      500 // 500ミリ秒かけてページトップに戻る
    );
    return false;
  });
});
