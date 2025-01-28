<?php
	$siteTitle = "テストオフィシャルサイト";
	$siteURL = "サイトURL";
	$siteMail = "mika-horiuchi@bzone.co.jp";
	$keyword = "test";

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
	}
	else {
		exit();
	}

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
		$subjectname = $subjectname." | ". $siteTitle;
	}

	if ($name == "" or $reading == "" or $age == ""  or $pref == "" or $email == "" or $tel == "" or $contactTitle == "" or $message == "" or $secretword != $keyword) {
		$checkurl = "complete.php?id=error";
		$ErrFlg = 1;
	}
	else{
			$checkurl = "complete.php?id=ok";
			$today = date("Y/m/d H:i:s");
			$lines=array("$name","$reading","$pref","$email","$tel","$contactTitle","$message");
			$lines=implode(",",$lines);
			$lines=$lines."\n";
			//言語設定、内部エンコーディングを指定する
			mb_language("japanese");
			mb_internal_encoding("UTF-8");
			//日本語メール送信
			$to = $siteMail;

			$subject = $subjectname;
			$body = "お名前 : ".$name."\nフリガナ : ".$reading."\n年齢 : ".$age."\n都道府県 : ".$pref."\nメールアドレス : ".$email."\n電話番号 : ".$tel."\n問い合わせ内容 : ".$contactTitle."\nメッセージ : ".$message."\n";
			$from = $email;
			//ちゃんと日本語メールが送信できます
			mail($to,$subject,$body,"Content-Type: text/plain; charset=\"UTF-8\"\nFrom: ".$from, "-f$from");

			//自動返信メール
			$to = $email;
			$subject = "【".$siteTitle."】お問い合わせありがとうございます";
			$body = $name."様\n\nこの度は、".$siteTitle."へお問い合わせいただき誠にありがとうございます。\n\n以下の内容のお問い合わせを受け付けました。\n通常、3営業日以内に担当者より折り返しご連絡させていただきます。\n\n尚、お問い合わせ内容によっては、ご返事までにお時間をいただく場合、また返信できかねる場合もございます。\nあらかじめご了承ください。\n\n■問い合わせ内容\nお名前 : ".$name."\nフリガナ : ".$reading."\n年齢 : ".$age."\n都道府県 : ".$pref."\nメールアドレス : ".$email."\n電話番号 : ".$tel."\n問い合わせ内容 : ".$contactTitle."\nメッセージ : ".$message."\n\nサイト：\n".$siteURL."\n\n※このメールは".$siteTitle." よりお問い合わせいただいた方へ自動送信しております。\nお心当たりのない方は、恐れ入りますがその旨をご連絡いただけますと幸いです。";
			$from = $siteMail;
			mail($to,$subject,$body,"Content-Type: text/plain; charset=\"UTF-8\"\nFrom: ".$from, "-f$from");
		};
	header("Location: $checkurl");
	exit();
?>