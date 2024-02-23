<?php
session_start(); // セッションを使用するのでスタートさせます
if($_SESSION['token'] === $_POST['token']){  // #1
  if(isset($_SESSION['name'])){  // #2
    $name  = $_SESSION['name'];
    $email = str_replace(array("\r","\n"),'',$_SESSION['email']);
    $title = $_SESSION['checkbox'];
    $body  = $_SESSION['body'];
  }  // #2
  // echo "正常なアクセスです";
  // メール送信処理
  // 自分に送るお問い合わせ内容メールを構築
  $to = "ayas.ayagak@gmail.com";
  $mailtitle = "{$name}様よりお問い合わせが届きました。";
  $contents = <<<EOD

  ◆種別
  {$checkbox}

  ◆お名前
  {$name}

  ◆メールアドレス
  {$email}

  ◆内容
  {$body}

  EOD;
  $from = 'From: '.$email ; //送信元メールアドレス   
  // 自分に送るお問い合わせ内容メールを構築

  // 相手に送る送信完了メールを構築
  $to2 = $email;
  $mailtitle2 = "【自動送信】受付を完了いたしました。";
  $contents2 = <<<EOD
        お問い合わせありがとうございます。
        以下の内容を送信いたしました。
        必ず返信いたしますのでしばらくお待ちください。
        ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
          
        {$contents}
  
        ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
        E-mail: email@email.com
        サイト運営者：あめ
  
        EOD;
          $from2 = "Return-Path:" . $to . "\r\n";
          $from2 =  $from2 . 'From: ' . $to;
        // 相手に送る送信完了メールを構築

  // メールを送るときのおまじない
  mb_language("Japanese");
  mb_internal_encoding("UTF-8");

  $param = "-f" . $to;
  //  mb_send_mail(送信先,タイトル,本文,追加ヘッダ,追加コマンドラインパラメータ)
  if (mb_send_mail($to2, $mailtitle2, $contents2, $from2, $param)) { // 相手に送信 // #3

    $message = '<p class="question-text">『' . $email . '』宛に確認メールを送信しました<br>お問い合わせありがとうございます。</p>';

  if (mb_send_mail($to,$mailtitle,$contents,$from,$param)) { // 自分に送信 // #4

    // 終了処理開始 セッションの破棄
    $_SESSION = [];
    if (isset($_COOKIE[session_name()])) {  // #5
      $params = session_get_cookie_params();
      setcookie(session_name(), '', time() - 42000, $params["path"], $params["domain"], $params["secure"], $params['httponly']);
    }
    session_destroy();
    // セッションの破棄
  } else { // #4
    $message = '<p class="question-text error">何らかの理由で送信エラーが発生しました<br>しばらく待ってから再度送信してください</p>';
  } // #4
} else { // #3
  $message = '<p class="question-text error">『' . $email . '』宛に確認メールを送信できませんでした。<br>正しいメールアドレスで再度ご連絡をお願いいたします。</p>';
} // #3

} else {  // #1

  // 直接send.phpにアクセスしようとしたら強制的にリダイレクト
  header('Location:https://'.$_SERVER['HTTP_HOST'].dirname($_SERVER['PHP_SELF']).'/contactform.php'); 
}  // #1
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
      <?php 
        if($message !== ""){
          echo $message;
        }
      ?>
      <a href="form.php">TOPに戻る</a>

    </main>
    <footer>
      <p>All Rights Reserved 2024 ©︎ Saya Kagaya</p>
    </footer>
  </body>
  <script src="js/main.js"></script>
</html>
