<?php
  error_reporting(0);
  $path = "../";

  //CONTACT 修正の値
	$name = $_POST["name"];
	$reading = $_POST["reading"];
	$age = $_POST["age"];
	$pref = $_POST["pref"];
	$email = $_POST["email"];
	$tel = $_POST["tel"];
	$contactTitle = $_POST["title"];
	$message = $_POST["message"];
	$subjectname = $_POST["subjectname"];
	$secretword = $_POST["secretword"];

  include($path."inc/setting.php");
?>
<!doctype html>
<html>
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <?php 
    $disp = "CONTACT";
  ?>
  <script src="https://www.google.com/recaptcha/api.js"></script>
  <title><?php echo $title; ?></title>
  <?php include($path."inc/head.php");?>
</head>
<body id="contact">
  <?php // include($path."inc/loading.html");?>
  <div id="wrapper">
    <?php include($path."inc/header.html");?>
    <main class="section">
      <h2 class="title--page tac"><?php echo $disp; ?></h2>
      <div class="wrapper">
        <?php
          //フォームからのデータを受け取る
          if ($_SERVER["REQUEST_METHOD"] == "GET") {
            foreach($_GET as $k => $v){
              //php.ini「magic_quotes_gpc=On」のときはエスケープ解除
              if (get_magic_quotes_gpc()) {
                  $v = stripslashes($v);
              }
              $v = htmlspecialchars($v);
              $v = str_replace(",","，",$v);
              //$v = str_replace(array("\r\n","\n","\r"),"<br />",$v);
              //$$k = $v;
              $_GET[$k] = $v;
            }
          }
          else {
            // exit();
          }
        ?>
        <p class="desc tac">項目はすべてご記入ください。</p>
        <form class="form" action="confirm.php" method="post">
          <input type="hidden" name="subjectname" value="CONTACT">
          <input type="hidden" name="secretword" value="madein">

          <?php include($path."form-parts.php");?>

          <div class="form__item">
            <label class="form__title" for="name">お名前</label>
            <input id="name" type="text" name="name" class="form__content textbox" value="<?=$name?>" required>
          </div>
          <div class="form__item">
            <label class="form__title" for="reading">フリガナ</label>
            <input id="reading" type="text" name="reading" class="form__content textbox" value="<?=$reading?>" required>
          </div>
          <div class="form__item">
            <label for="age" class="form__title">年齢</label>
            <div class="form__content">
              <input id="age" type="text" name="age" maxlength="2" class="textbox short" value="<?=$age?>" required> 歳
            </div>
          </div>
          <div class="form__item">
            <label for="pref" class="form__title">都道府県</label>
            <div class="selectbox">
              <select name="pref" class="form__content" value="<?=$pref?>" required>
                <option value="">選択してください</option>
                <option value="北海道">北海道</option>
                <option value="青森県">青森県</option>
                <option value="岩手県">岩手県</option>
                <option value="宮城県">宮城県</option>
                <option value="秋田県">秋田県</option>
                <option value="山形県">山形県</option>
                <option value="福島県">福島県</option>
                <option value="茨城県">茨城県</option>
                <option value="栃木県">栃木県</option>
                <option value="群馬県">群馬県</option>
                <option value="埼玉県">埼玉県</option>
                <option value="千葉県">千葉県</option>
                <option value="東京都" selected>東京都</option>
                <option value="神奈川県">神奈川県</option>
                <option value="新潟県">新潟県</option>
                <option value="富山県">富山県</option>
                <option value="石川県">石川県</option>
                <option value="福井県">福井県</option>
                <option value="山梨県">山梨県</option>
                <option value="長野県">長野県</option>
                <option value="岐阜県">岐阜県</option>
                <option value="静岡県">静岡県</option>
                <option value="愛知県">愛知県</option>
                <option value="三重県">三重県</option>
                <option value="滋賀県">滋賀県</option>
                <option value="京都府">京都府</option>
                <option value="大阪府">大阪府</option>
                <option value="兵庫県">兵庫県</option>
                <option value="奈良県">奈良県</option>
                <option value="和歌山県">和歌山県</option>
                <option value="鳥取県">鳥取県</option>
                <option value="島根県">島根県</option>
                <option value="岡山県">岡山県</option>
                <option value="広島県">広島県</option>
                <option value="山口県">山口県</option>
                <option value="徳島県">徳島県</option>
                <option value="香川県">香川県</option>
                <option value="愛媛県">愛媛県</option>
                <option value="高知県">高知県</option>
                <option value="福岡県">福岡県</option>
                <option value="佐賀県">佐賀県</option>
                <option value="長崎県">長崎県</option>
                <option value="熊本県">熊本県</option>
                <option value="大分県">大分県</option>
                <option value="宮崎県">宮崎県</option>
                <option value="鹿児島県">鹿児島県</option>
                <option value="沖縄県">沖縄県</option>
              </select>
            </div>
          </div>
          <div class="form__item">
            <label class="form__title" for="email">メールアドレス</label>
            <input id="email" type="email" name="email" class="form__content textbox" value="<?=$email?>" required>
          </div>
          <div class="form__item">
            <label class="form__title" for="tel">電話番号</label>
            <input id="tel" type="tel" name="tel" class="form__content textbox" value="<?=$tel?>" required>
          </div>
          <div class="form__item">
            <label class="form__title" for="title">お問い合わせ内容</label></dt>
            <div class="content short selectbox">
              <select name="title" class="formtxt" required>
                <option value="" selected>お選びください</option>
                <option value="メッセージ">メッセージ</option>
                <option value="質問">質問</option>
                <option value="お仕事">お仕事</option>
              </select>
            </div>
          </div>
          <div class="form__item">
            <label class="form__title" for="message">メッセージ</label>
            <textarea id="message" name="message" class="form__content textarea" required><?=$message?></textarea>
          </div>
          <div class="tac">
            <div class="g-recaptcha mt-10" data-callback="clearcall" data-sitekey="6LdDDb0qAAAAALOnjG1Tg_2E6vvLhUNLHGN2KvU2"></div>
          </div>
          <p class="tac mt-10"><button class="btn--more" type="submit" name="confirm" value="確認" disabled>確認</button></p>
        </form>
      </div>
    </main>
    <?php include($path."inc/footer.html");?>
  </div>
  <?php include($path."inc/footlink.php");?>
  <script type="text/javascript">
    function clearcall(code) {
      if(code !== ""){
        $(':submit[name=confirm]').removeAttr("disabled");
      }
    }
  </script>
</body>
</html>
