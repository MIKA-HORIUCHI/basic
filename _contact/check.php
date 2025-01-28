<?php
	if ($_SERVER["REQUEST_METHOD"] == "POST") {
			foreach($_POST as $k => $v){
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
	$mail = $_POST["mail"];
	$title = $_POST["title"];
	$message = $_POST["message"];
	$subjectname = $_POST["subjectname"];
	$secretword = $_POST["secretword"];

	$ErrFlg = 0;

	if ($name == "" or $mail == "" or $title == "" or $message == "" or $secretword != "key") {
		$checkurl = "index.html?id=error";
		$ErrFlg = 1;
	}else{
		$checkurl = "index.html?id=ok";
		$name = str_replace(array("\r\n","\n","\r"),"<br />",$name);
		$today = date("Y/m/d H:i:s");
		$lines = array("$name","$mail","$title","$message");
		$lines = implode(",",$lines);
		$lines = $lines."\n";
		mb_language("japanese");
		mb_internal_encoding("UTF-8");
		$to = "contact@test.com";
		$subject = "件名";
		$body = "Name: ".$name."\nMail: ".$mail."\nTitle:".$title."\n".$message."\n";
		$from = "no-reply@test.com";
		mail($to,$subject,$body,"Content-Type: text/plain; charset=\"UTF-8\"\nFrom: ".$from, "-f$from");
	}
	header("Location: $checkurl");
	exit();
?>