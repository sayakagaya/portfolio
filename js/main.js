//ハンバーガーメニュー
const sidebar = document.querySelector(".sidebar");
document.querySelector(".humberger").addEventListener("click", function () {
  this.classList.toggle("active");
  sidebar.classList.toggle("active");
});

// フェードイン
//スクロール時のイベント
window.addEventListener("scroll", function () {
  //すべての.fadeを取得
  const fade = document.querySelectorAll(".fade");

  // //すべての.itemを取得
  // const item = document.querySelectorAll(".gallery-item");

  for (let i = 0; i < fade.length; i++) {
    //fadeの高さ取得
    var targetTop = fade[i].offsetTop;

    //画面のスクロール量 + 300px > .fadeのoffsetの高さ
    if (window.scrollY + 300 > targetTop) {
      fade[i].classList.add("is-scrollIn");
    }
  }
});

// Serviceフェードイン
var slideConts = document.querySelectorAll(".slideConts"); // スライドで表示させる要素の取得
var slideContsRect = []; // 要素の位置を入れるための配列
var slideContsTop = []; // 要素の位置を入れるための配列
var windowY = window.pageYOffset; // ウィンドウのスクロール位置を取得
var windowH = window.innerHeight; // ウィンドウの高さを取得
var remainder = 100; // ちょっとはみ出させる部分

// 要素の位置を取得
for (var i = 0; i < slideConts.length; i++) {
  slideContsRect.push(slideConts[i].getBoundingClientRect());
}
for (var i = 0; i < slideContsRect.length; i++) {
  slideContsTop.push(slideContsRect[i].top + windowY);
}

// ウィンドウがリサイズされたら、ウィンドウの高さを再取得
window.addEventListener("resize", function () {
  windowH = window.innerHeight;
});

// スクロールされたら
window.addEventListener("scroll", function () {
  // スクロール位置を取得
  windowY = window.pageYOffset;

  for (var i = 0; i < slideConts.length; i++) {
    // 要素が画面の下端にかかったら
    if (windowY > slideContsTop[i] - windowH + remainder) {
      // .showを付与
      slideConts[i].classList.add("show");
    } else {
      // 逆に.showを削除
      slideConts[i].classList.remove("show");
    }
  }
});

// PageTopボタンの動作
// スクロールした際の動きを関数でまとめる
function pageTopAnime() {
  var scroll = window.scrollY || document.documentElement.scrollTop; // スクロール値を取得

  if (scroll >= 200) {
    // 200pxスクロールしたら
    document.getElementById("page-top").classList.remove("DownMove"); // DownMoveというクラス名を除去して
    document.getElementById("page-top").classList.add("UpMove"); // UpMoveというクラス名を追加して出現
  } else {
    // それ以外は
    if (document.getElementById("page-top").classList.contains("UpMove")) {
      // UpMoveというクラス名が既に付与されていたら
      document.getElementById("page-top").classList.remove("UpMove"); // UpMoveというクラス名を除去し
      document.getElementById("page-top").classList.add("DownMove"); // DownMoveというクラス名を追加して非表示
    }
  }

  var wH = window.innerHeight; // 画面の高さを取得
  var footerPos = document.getElementById("footer").getBoundingClientRect().top; // footerの位置を取得

  if (scroll + wH >= footerPos + 10) {
    var pos = scroll + wH - footerPos + 10; // スクロールの値＋画面の高さからfooterの位置＋10pxを引いた場所を取得し
    document.getElementById("page-top").style.bottom = pos + "px"; // #page-topに上記の値をCSSのbottomに直接指定してフッター手前で止まるようにする
  } else {
    // それ以外は
    if (document.getElementById("page-top").classList.contains("UpMove")) {
      // UpMoveというクラス名がついていたら
      document.getElementById("page-top").style.bottom = "10px"; // 下から10pxの位置にページリンクを指定
    }
  }
}

// 画面をスクロールをしたら動かしたい場合の記述
window.addEventListener("scroll", function () {
  pageTopAnime(); /* スクロールした際の動きの関数を呼ぶ */
});

// ページが読み込まれたらすぐに動かしたい場合の記述
window.addEventListener("load", function () {
  pageTopAnime(); /* スクロールした際の動きの関数を呼ぶ */
});

// #page-topをクリックした際の設定
document.getElementById("page-top").addEventListener("click", function () {
  var scrollOptions = {
    top: 0, // ページトップまでスクロール
    behavior: "smooth", // ページトップスクロールのアニメーション
  };

  // 兼容性のためにブラウザによってはwindow.scrollToを使用
  if ("scrollBehavior" in document.documentElement.style) {
    window.scrollTo(scrollOptions);
  } else {
    window.scrollTo(scrollOptions.top, scrollOptions.top);
  }

  return false; // リンク自体の無効化
});

//スムーススクロール
//すべてのaタグのhrefに#がついているもの
const anchors = document.querySelectorAll('a[href^="#"]');
// headerの高さを取得
const headerHeight = document.querySelector("header").offsetHeight;
//URLのアンカーを取得
const urlHash = location.href;

for (let i = 0; i < anchors.length; i++) {
  //各アンカーにクリックイベント
  anchors[i].addEventListener("click", function (event) {
    //デフォルトのクリックイベントを無効化
    event.preventDefault();

    //各anchorのhref属性の値を取得
    const href = anchors[i].getAttribute("href");

    //topに戻る以外のアンカー
    if (href !== "#top") {
      //スクロール先の要素を取得
      //アンカーのリンク先#を取り除いた名前と一致するIDの取得
      const target = document.getElementById(href.replace("#", ""));

      //スクロール先の要素の位置を取得
      //headerの高さをマイナス
      const position =
        window.pageYOffset + target.getBoundingClientRect().top - headerHeight;

      //スクロールアニメーション
      window.scroll({
        //スクロール先の要素の上までスクロール
        top: position,

        //スクロールアニメーション
        behavior: "smooth",
      });

      //topに戻る
    } else {
      window.scroll({
        top: 0,
        behavior: "smooth",
      });
    }
  });
}
