<?php
// ファイルの1番上に⇩を記述
session_start();   // SESSIONを使うときは最初にスタートさせる

// 送信ボタンが押されたかどうか
if(isset($_POST['submit'])){ // #1
  // POSTされたデータをエスケープ処理して変数に格納
  function e(string $str,string $charset = 'UTF-8'):string{
    return htmlspecialchars($str,ENT_QUOTES | ENT_HTML5,$charset);
  }
  $name = e($_POST['name']);
  $email = e($_POST['email']);
  $checkbox = e($_POST['checkbox']);
  $body = e($_POST['body']);

  // $name = htmlspecialchars($_POST['name'],ENT_QUOTES | ENT_HTML5);
  // $email  = htmlspecialchars($_POST['email'],ENT_QUOTES | ENT_HTML5);
  // $checkbox = htmlspecialchars($_POST['checkbox'],ENT_QUOTES | ENT_HTML5);
  // $body = htmlspecialchars($_POST['body'],ENT_QUOTES | ENT_HTML5);

  $errors = []; //エラー格納用配列
  //trim(文字列)→文字列内の空白を除去 →値がなくなればエラーにする
  if(trim($name) === '' || trim($name) === "　"){
    $errors['name'] = "名前を入力してください";
  }
  // エラー配列がなければ異常なし
  if(count($errors) === 0){ // #2
    echo "入力値に異常はありませんでした";
    // 保守性を高めURLを自動で生成するパターン
    header('Location:https://'.$_SERVER['HTTP_HOST'].dirname($_SERVER['PHP_SELF']).'/confirm.php'); 
  }else{
    // エラー配列があればエラーを表示
    echo $errors['name'];
  } // #2
} // #1

// confirm.phpから戻ってきたときに値を保持
if (isset($_GET) && isset($_GET['action']) && $_GET['action'] === 'edit') {
  $name  = $_SESSION['name'];
  $email = $_SESSION['email'];
  $title = $_SESSION['checkbox'];
  $body  = $_SESSION['body'];
}

?>


<!DOCTYPE html>
<html lang="ja">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="https://unpkg.com/ress/dist/ress.min.css" />
    <link rel="stylesheet" href="css/common.css" />
    <link rel="stylesheet" href="css/style-contact.css" />
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Caveat:wght@500&display=swap"
      rel="stylesheet"
    />
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Zen+Maru+Gothic:wght@400;500;700&display=swap"
      rel="stylesheet"
    />
    <script
      src="https://kit.fontawesome.com/be9648ab57.js"
      crossorigin="anonymous"
    ></script>
    <link rel="icon" href="img/favicon.png" />

    <title>Saya Kagaya Portfolio</title>
  </head>
  <body>
    <header class="header" id="js-header">
      <div class="header_container">
        <h1>
          <a href="index.html">
            <img src="img/top_logo.png" alt="logo" class="logo" />
          </a>
        </h1>
        <nav class="header_nav" id="js-nav">
          <ul class="nav_list">
            <li class="nav_item">
              <a href="index.html#about">ABOUT</a>
            </li>
            <li class="nav_item">
              <a href="works.html">WORKS</a>
            </li>
            <li class="nav_item">
              <a href="index.html#service">SERVICE</a>
            </li>
            <li class="nav_item">
              <div class="hd_contact_area">
                <a href="contact.html" class="hd_contact_btn">
                  <span>COTNTACT</span>
                  <span class="mail_icon">
                    <i class="fas fa-envelope"></i> </span
                ></a>
              </div>
            </li>
          </ul>
        </nav>

        <!-- ハンバーガーメニュー -->
        <div class="humberger">
          <span></span>
          <span>Menu</span>
          <span></span>
        </div>
      </div>

      <div class="sidebar">
        <ul class="sidebar_links">
          <li>
            <a href="index.html">
              <img src="img/favicon.png" alt="" />
            </a>
          </li>

          <li>
            <a href="index.html#about" class="link">ABOUT</a>
          </li>
          <li>
            <a href="works.html" class="link">WORKS</a>
          </li>
          <li>
            <a href="index.html#service" class="link">SERVICE</a>
          </li>
          <li>
            <div class="sidebar_contact_area">
              <a href="contact.html">
                <span>COTNTACT</span>
                <span class="mail_icon"> <i class="fas fa-envelope"></i> </span
              ></a>
            </div>
          </li>
        </ul>
      </div>
    </header>
    <main>
      <div class="contact">
        <h2>
          <span class="en_title">Contact</span>
          <span class="jp_title">お問い合わせ</span>
        </h2>
        <p>
          ホームページ・Web制作に関するお問い合わせやお見積もりのご依頼は以下のフォームをご利用ください。<br />
          デザインのみ、コーディングのみのご依頼も対応可能です。まずはお気軽にお問い合わせください。
        </p>

        <form
          action="contactform.php"
          method="post"
          id="submitForm"
          name="form"
        >
          <table class="contact_table">
            <tr>
              <th class="contact_item">
                名前 <span class="required">必須</span>
              </th>
              <td class="contact_body">
                <input type="text" name="name" class="form_text" value="<?php if(isset($name)){echo $name;} ?>" required />
              </td>
            </tr>
            <tr>
              <th class="contact_item">
                メールアドレス <span class="required">必須</span>
              </th>
              <td class="contact_body">
                <input type="email" name="email" value="<?php if(isset($email)){echo $email;} ?>" required/>
              </td>
            </tr>
            <tr>
              <th class="contact_item">
                お問い合わせの種類 <span class="required">必須</span>
              </th>
              <td class="contact_body">
                <label class="contact_type">
                  <input type="checkbox" name="問い合わせ種別" value="Webサイト制作" <?php if(isset($checkbox)&&$checkbox==="Webサイト制作"){echo "checked";}else{echo "checked";}?>/>
                  <span class="contact_type_txt">Webサイト制作</span>
                </label>
                <label class="contact_type">
                  <input type="checkbox" name="問い合わせ種別" value="更新・運営サポート" <?php if(isset($checkbox)&&$checkbox==="更新・運営サポート"){echo "checked";}else{echo "checked";}?>/>
                  <span class="contact_type_txt">更新・運営サポート</span>
                </label>
                <label class="contact_type">
                  <input type="checkbox" name="問い合わせ種別" value="バナー・広告制作" <?php if(isset($checkbox)&&$checkbox==="バナー・広告制作"){echo "checked";}else{echo "checked";}?>/>
                  <span class="contact_type_txt">バナー・広告制作</span>
                </label>
                <label class="contact_type">
                  <input type="checkbox" name="問い合わせ種別"  value="その他" <?php if(isset($checkbox)&&$checkbox==="その他"){echo "checked";}else{echo "checked";}?>/>
                  <span class="contact_type_txt">その他</span>
                </label>
              </td>
            </tr>
            <tr>
              <th class="contact_item">お問い合わせ内容</th>
              <td class="contact_body">
                <textarea name="body" class="form_textarea"><?php  if(isset($body)){echo $body;}?></textarea>
              </td>
            </tr>
          </table>
          <input class="contact_submit" type="submit" value="確認" />
        </form>
      </div>
    </main>
    <footer>
      <p>All Rights Reserved 2024 ©︎ Saya Kagaya</p>
    </footer>
  </body>
  <script src="js/main.js"></script>
</html>
