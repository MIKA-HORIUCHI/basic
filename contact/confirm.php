<?php
  $path = "../";
  $title = "CONTACT"; //ページタイトル
	include($path."inc/setting.php");

	//フォームからのデータを受け取る
	if ($_SERVER["REQUEST_METHOD"] == "POST") {
		foreach($_POST as $k => $v){
			//php.ini「magic_quotes_gpc=On」のときはエスケープ解除
			if (get_magic_quotes_gpc()) {
					$v = stripslashes($v);
			}
			$v = htmlspecialchars($v);
			$v = str_replace(",","，",$v);
			$_POST[$k] = $v;
		}
	} else {
		exit();
	}

	// ここで入力された値を変数に入れる
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

	if($subject !==""){
		$subjectname = $subjectname."| MADEIN";
	}

	//reCAPTYA
	$recaptcha = htmlspecialchars($_POST["g-recaptcha-response"],ENT_QUOTES,'UTF-8');
	if(isset($recaptcha)){
		$captcha = $recaptcha;
	}else{
		$captcha = "";
		echo "captchaエラー";
		exit;
	}

	$secretKey = "6LdDDb0qAAAAANu2zVAX4JcsQMMobIQUgrGSCx4O";
	$resp = @file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret={$secretKey}&response={$captcha}");
	$resp_result = json_decode($resp,true);

	if(intval($resp_result["success"]) !== 1) {
		//認証失敗時の処理をここに書く
		echo "<p>ERROR<br />";
		echo "認証できませんでした。お手数ですが、再度ご入力をお願いいたします。<br /><br /><br />";
		echo "<a href=\"index.php\">戻る</a>";
		echo "</p>";
		exit();
	}
	else {
		//認証成功時の処理をここに書く
		$ErrFlg = 0; // <-この変数が何に使ってるのかわかんないけど、とりあえず残しておく
		if ($name == "" or $reading == "" or $age == "" or $pref == "" or $email == "" or $tel == "" or $message == "" or $secretword != "madein") {
			// 入力値が不足している場合はこっちに入る
			$checkurl = "index.php?id=error";
			$ErrFlg = 1; // <-この変数が何に使ってるのかわかんないけど、とりあえず残しておく
			header("Location: $checkurl");
			exit();
		}
	}
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<?php 
    $disp = "CONTACT";
    include($path."inc/ogp.php");
    //$config["title"] = "";    // title
    //$config["type"] = "";     // type
    //$config["image"] = ""; // image
    //$config["url"] = "";      // url
    $config["description"] = $disp; // description
    fb_meta($config);

    $config_tw["card"] = "summary";      // url
    //$config_tw["image"] = ""; // image
    //$config_tw["site"] = "@"; // description
    tw_meta($config_tw);
  ?>
	<title><?php echo $title; ?></title>
	<?php include($path."inc/headlink.php");?>
</head>
<body class="level">
  <?php // include($path."inc/loading.html");?>
  <div id="wrapper">
    <?php include($path."inc/header.html");?>
    <main id="contact" class="section contentwrap">
      <h2 class="title--page tac"><?php echo $disp; ?></h2>
			<div class="wrapper confirm">
				<div class="form  w-max">
					<!-- 送信 -->
					<form id="send" action="check.php" method="post">

						<input type="hidden" name="subjectname" value="CONTACT">
						<input type="hidden" name="secretword" value="madein">

						<div class="form__lists">
							<label class="form__title" for="name">お名前</label>
							<input id="name" type="text" name="name" class="form__content" value="<?=$name?>" readonly>
						</div>
						<div class="form__lists">
							<label class="form__title" for="reading">フリガナ</label>
							<input id="reading" type="text" name="reading" class="form__content" value="<?=$reading?>" readonly>
						</div>
						<div class="form__lists">
							<label class="form__title" for="age">年齢</label>
							<input id="age" type="text" name="age" class="form__content" value="<?=$age?>" readonly>
						</div>
						<div class="form__lists">
							<label class="form__title" for="pref">都道府県</label>
							<input type="text" name="pref" class="form__content" value="<?=$pref?>" readonly >
						</div>
						<div class="form__lists">
							<label class="form__title" for="email">メールアドレス</label>
							<input id="email" type="email" name="email" class="form__content" value="<?=$email?>" readonly>
						</div>
						<div class="form__lists">
							<label class="form__title" for="tel">電話番号</label>
							<input id="tel" type="tel" name="tel" class="form__content" value="<?=$tel?>" readonly>
						</div>
						<div class="form__lists">
							<label class="form__title" for="title">問い合わせ内容</label>
							<input id="title" class="form__content" name="title" value="<?=$contactTitle?>" readonly>
						</div>
						<div class="form__lists">
							<label class="form__title" for="message">メッセージ</label>
							<textarea id="message" class="form__content" name="message" readonly><?=$message?></textarea>
						</div>
					</form>
					<!-- 修正 -->
					<form id="modify" action="index.php" method="post">
						<input type="hidden" name="subjectname" value="CONTACT">
						<input type="hidden" name="secretword" value="key">
						<input type="hidden" name="name" value="<?=$name?>">
						<input type="hidden" name="reading" value="<?=$reading?>">
						<input type="hidden" name="age" value="<?=$age?>">
						<input type="hidden" name="pref" value="<?=$pref?>">
						<input type="hidden" name="email" value="<?=$email?>">
						<input type="hidden" name="tel" value="<?=$tel?>">
						<input type="hidden" name="title" value="<?=$contactTitle?>">
						<input type="hidden" name="message" value="<?=$message?>">
						
					</form>
					<div class="tac mt-10">
						<button form="modify" class="btn--text mr-20" type="submit" value="修正" >修正</button>
						<button form="send" class="btn--more" type="submit" value="送信">送信</button>
					</div>
				</div>
			</div>
		</main>
		<?php include($path."inc/footer.html");?>
  </div>
  <?php include($path."inc/footlink.php");?>
</body>
</html>