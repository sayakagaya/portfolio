//ハンバーガーメニュー
const sidebar = document.querySelector(".sidebar");
document.querySelector(".humberger").addEventListener("click", function () {
  this.classList.toggle("active");
  sidebar.classList.toggle("active");
});

//ヘッダーの動作
document.addEventListener("DOMContentLoaded", function () {
  const header = document.querySelector("#js-header");

  window.addEventListener("scroll", function () {
    //スクロール位置が0以上の時は背景色をつけ、高さを変更する
    if (0 < window.scrollY) {
      header.classList.add("active");
    } else {
      header.classList.remove("active");
    }
  });
});

// フェードイン
//スクロール時のイベント
window.addEventListener("scroll", function () {
  //すべての.fadeを取得
  const fade = document.querySelectorAll(".fade");
  for (let i = 0; i < fade.length; i++) {
    //fadeの高さ取得
    var targetTop = fade[i].offsetTop;

    //画面のスクロール量 + 500px > .fadeのoffsetの高さ
    if (window.scrollY + 500 > targetTop) {
      fade[i].classList.add("is-scrollIn");
    }
  }
});

// ウィンドウの高さを取得する
var window_h = window.innerHeight;

// スクロールイベント
window.addEventListener("scroll", function () {
  // スクロールの位置を取得する
  var scroll_top = window.scrollY;

  // 各box要素に対して処理を行う
  var sItems = document.querySelectorAll(".service_item");
  sItems.forEach(function (sItem) {
    // 各box要素のtopの位置を取得する
    var elem_pos = sItem.getBoundingClientRect().top + scroll_top;

    // どのタイミングでフェードインさせるか
    if (scroll_top >= elem_pos - window_h + 200) {
      sItem.classList.add("fadein"); // 特定の位置を超えたらクラスを追加
    }
  });
});

//制作実績カテゴリー分け
document.addEventListener("DOMContentLoaded", function () {
  // 要素を取得
  var filterList = document.querySelector(".filter_list"),
    filterItems = document.querySelectorAll(".filter_list [data-filter]"),
    itemItems = document.querySelectorAll(".filter_item [data-item]");

  // カテゴリをクリックしたら
  filterList.addEventListener("click", function (e) {
    // デフォルトの動作をキャンセル
    e.preventDefault();

    var target = e.target;

    // クリックした要素またはその親要素が[data-filter]属性を持つ場合のみ処理を続行
    while (target && !target.hasAttribute("data-filter")) {
      target = target.parentElement;
    }

    if (target && target.hasAttribute("data-filter")) {
      // クリックしたカテゴリにクラスを付与
      filterItems.forEach(function (item) {
        item.classList.remove("is-active");
      });
      target.classList.add("is-active");

      // クリックした要素のdata属性を取得
      var filterItem = target.getAttribute("data-filter");

      // データ属性が all なら全ての要素を表示
      if (filterItem == "all") {
        itemItems.forEach(function (item) {
          item.classList.remove("is-active");
          item.style.display = "none";
        });
        itemItems.forEach(function (item) {
          item.classList.add("is-active");
          item.style.display = "block";
        });
      } else {
        itemItems.forEach(function (item) {
          item.classList.remove("is-active");
          item.style.display = "none";
        });

        // クリックした要素のdata属性の値と一致する要素を表示
        var filteredItems = document.querySelectorAll(
          '[data-item="' + filterItem + '"]'
        );
        filteredItems.forEach(function (item) {
          item.classList.add("is-active");
          item.style.display = "block";
        });
      }
    }
  });
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
