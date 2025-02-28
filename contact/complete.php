<?php
  $path = "../";
  $title = "CONTACT"; //ページタイトル
	include($path."inc/setting.php");
?>
<!doctype html>
<html>
<head>
	<meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <?php 
    $disp = "CONTACT";
    include($path."inc/ogp.php");
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
			<div class="wrapper">
				<div class="w-max">
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
					else {exit();}
					if(isset($_GET['id'])) {
						$id = $_GET['id'];
						$id = HtmlSpecialChars($id);
					?>
					<?php if ($id == "error") { ?>
						<h3 class="title--lead tac">ERROR</h3>
						<p class="tac">記入もれがございます。</p>
					<?php } elseif($id == "ok") { ?>
						<h3 class="title--lead tac">THANK YOU</h3>
						<p class="tac">メッセージを送信しました。<br>通常3営業日以内にご連絡いたします。</p>
						<p class="tac small">※お問い合わせ内容によっては、ご返事までにお時間をいただく場合、また返信できかねる場合もございます。</p>
					<?php } ?>
				<?php } ?>
				</div>
			</div>
		</main>
    <?php include($path."inc/footer.html");?>
  </div>
  <?php include($path."inc/footlink.php");?>
</body>
</html>