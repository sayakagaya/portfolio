<?php
session_start();   //SESSIONを使うときは最初にスタートさせる
if(isset($_SESSION['name'])){
  $name  = $_SESSION['name'];
  $email = $_SESSION['email'];
  $checkbox = $_SESSION['checkbox'];
  $body = $_SESSION['body'];
}
//13文字のランダムな文字列を自動生成※
$token = sha1(uniqid(mt_rand(),true));
$_SESSION['token'] = $token;
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
          action=""
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
                <?php echo $name ;?>
              </td>
            </tr>
            <tr>
              <th class="contact_item">
                メールアドレス <span class="required">必須</span>
              </th>
              <td class="contact_body">
                <?php echo $email ;?>
              </td>
            </tr>
            <tr>
              <th class="contact_item">
                お問い合わせの種類 <span class="required">必須</span>
              </th>
              <td class="contact_body">
                  <?php echo $checkbox ;?>
              </td>
            </tr>
            <tr>
              <th class="contact_item">お問い合わせ内容</th>
              <td class="contact_body">
                <!-- nl2br関数は文字列内の改行コード(\nなど)をHTMLでの改行コード(<br>)に変換してくれる関数 -->
                <?php echo nl2br($body);?>
              </td>
            </tr>
          </table>
          <p>こちらの内容で送信してもよろしいですか？</p>
          <!-- POSTの送信先はsend.phpであることに注意してください -->
          <form method="post" action="send.php">
            <input type="hidden" name="token" value="<?php echo $token ?>">
            <button type="submit" value="送信">送信</button>
            <a href="contactform.php?action=edit">戻る</a>
          </form>
        </form>
      </div>
    </main>
    <footer>
      <p>All Rights Reserved 2024 ©︎ Saya Kagaya</p>
    </footer>
  </body>
  <script src="js/main.js"></script>
</html>
