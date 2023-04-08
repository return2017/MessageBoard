<!doctype html>
<html lang="zh-cmn-Hans">
<?php include './config.php'; ?>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no"/>
  <meta name="renderer" content="webkit"/>
  <meta name="force-rendering" content="webkit"/>
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"/>
  <link rel="stylesheet" href="https://lf3-cdn-tos.bytecdntp.com/cdn/expire-1-M/mdui/1.0.2/css/mdui.min.css"/>
  <title><?php echo title; ?></title>
  <style>
		body {
			background-color: #f2f2f2;
			font-family: Arial, sans-serif;
			margin: 0;
			padding: 0;
		}
		h1 {
			text-align: center;
			margin-top: 50px;
			color: #333;
		}
		.countdown {
			display: flex;
			flex-wrap: wrap;
			justify-content: center;
			margin-top: 50px;
			font-size: 30px;
			color: #333;
		}
		.countdown div {
			display: flex;
			flex-direction: column;
			align-items: center;
			margin: 10px;
			padding: 10px;
			background-color: #fff;
			border-radius: 5px;
			box-shadow: 0 0 10px rgba(0,0,0,0.2);
		}
		.countdown div span {
			font-size: 60px;
			font-weight: bold;
			color: #f00;
		}
		.countdown div p {
			font-size: 20px;
			margin: 0;
			padding: 0;
			color: #666;
		}
		.comment {
			margin-top: 50px;
			padding: 20px;
			background-color: #fff;
			border-radius: 5px;
			box-shadow: 0 0 10px rgba(0,0,0,0.2);
		}
		.comment h2 {
			margin-top: 0;
			color: #333;
		}
		.comment form {
			display: flex;
			flex-direction: column;
			align-items: center;
			margin-top: 20px;
		}
		.comment input[type="text"], .comment textarea {
			width: 100%;
			padding: 10px;
			margin-bottom: 10px;
			border-radius: 5px;
			border: none;
			box-shadow: 0 0 5px rgba(0,0,0,0.2);
		}
		.comment input			background-color: #f00;
			color: #fff;
			padding: 10px;
			border: none;
			border-radius: 5px;
			cursor: pointer;
			font-size: 16px;
			font-weight: bold;
			transition: all 0.3s ease;
		}
		.comment input[type="submit"]:hover {
			background-color: #fff;
			color: #f00;
			box-shadow: 0 0 5px rgba(255,0,0,0.5);
		}
		.comment textarea {
			height: 100px;
		}
		mdui.snackbar({
  message: 'top',
  position: 'top',
});
	</style>
</head>
<body>
<header class="mdui-appbar">
  <div class="mdui-toolbar mdui-color-theme">
    <div class="mdui-typo-headline"><?php echo title; ?></div>
    <div class="mdui-toolbar-spacer"></div>
    <a class="mdui-btn mdui-btn-icon" id="color"><i class="mdui-icon material-icons">color_lens</i></a>
    
      </svg>
    </a>
  </div>

</header>

<h1 id="hitokoto">思考中...</h1>
<hr>
	<div class="countdown">
		<div>
			<span id="day">LD</span>
			<p>天</p>
		</div>
		<div>
			<span id="hour">LD</span>
			<p>小时</p>
		</div>
		<div>
			<span id="minute">LD</span>
			<p>分钟</p>
		</div>
		<div>
			<span id="second">LD</span>
			<p>秒</p>
		</div>
	</div>
<main class="mdui-container">
  <form action="submit.php" method="post" class="mdui-m-b-2 mdui-col-xs-12">
    <div class="mdui-textfield mdui-textfield-floating-label mdui-col-xs-6 userInfo">
      <i class="mdui-icon material-icons">account_circle</i>
      <label class="mdui-textfield-label">昵称</label>
      <input class="mdui-textfield-input userInfoInput" type="text" name="name" maxlength="15" required/>
      <div class="mdui-textfield-error">昵称不能为空</div>
    </div>
    <div class="mdui-textfield mdui-textfield-floating-label mdui-col-xs-6 userInfo">
      <i class="mdui-icon material-icons">email</i>
      <label class="mdui-textfield-label">邮箱</label>
      <input class="mdui-textfield-input userInfoInput" type="email" name="email" maxlength="30" required/>
      <div class="mdui-textfield-error">邮箱格式错误</div>
    </div>
    <div class="mdui-textfield mdui-col-xs-12">
      <textarea class="mdui-textfield-input" rows="5" placeholder="说点什么~" name="message" maxlength="300"
                required></textarea>
      <div class="mdui-textfield-error">内容不能为空</div>
    </div>
    <div class="mdui-col-xs-12">
      <label class="mdui-checkbox">
        <input type="checkbox" id="isAnonymous" name="isAnonymous"/>
        <i class="mdui-checkbox-icon"></i>
        匿名
      </label>
      <div class="mdui-float-right">
        <button class="mdui-btn mdui-btn-raised mdui-ripple mdui-color-amber mdui-text-color-white-text mdui-m-r-1"
                id="reset" type="reset">
          <i class="mdui-icon mdui-icon-right material-icons">delete_sweep</i>清空
        </button>
        <button class="mdui-btn mdui-btn-raised mdui-ripple mdui-color-theme mdui-float-right" id="submit"
                type="submit">
          <i class="mdui-icon mdui-icon-right material-icons">send</i>留言
        </button>
      </div>
    </div>
  </form>
  <?php
  $conn = new mysqli(db_host, db_username, db_password, db_name, db_port);
  $messages = $conn->query("SELECT date,is_anonymous,name,email,message FROM message ORDER BY id DESC");
  foreach ($messages as $message) {
    if ($message["is_anonymous"]) { ?>
      <div class="mdui-card mdui-col-xs-12 mdui-m-y-2 mdui-color-grey-900 mdui-text-color-white-text">
        <div class="mdui-card-primary">
          <div
            class="mdui-card-primary-subtitle mdui-float-right"><?php echo date_create($message["date"])->format("Y年m月d日 H:i:s"); ?></div>
          <div class="mdui-card-primary-title">匿名</div>
        </div>
        <div class="mdui-card-content mdui-typo"><?php echo htmlspecialchars($message["message"]) ?></div>
      </div>
    <?php } else { ?>
      <div class="mdui-card mdui-hoverable mdui-col-xs-12 mdui-m-y-2">
        <div class="mdui-card-primary">
          <div
            class="mdui-card-primary-subtitle mdui-float-right"><?php echo date_create($message["date"])->format("Y年m月d日 H:i:s"); ?></div>
          <div class="mdui-card-primary-title"><?php echo htmlspecialchars($message["name"]) ?></div>
        </div>
        <div class="mdui-card-content mdui-typo"><?php echo htmlspecialchars($message["message"]) ?></div>
      </div>
    <?php } ?>
  <?php } ?>


</main>
<script src="https://lf3-cdn-tos.bytecdntp.com/cdn/expire-1-M/mdui/1.0.2/js/mdui.min.js"></script>
<script src="https://api.return2017.cn/15/st.js"></script>
<script src="./js/index.js"></script>
<script>
fetch('https://v1.hitokoto.cn')
			.then(function (res) {
			return res.json();
		})
			.then(function (data) {
			var hitokoto = document.getElementById('hitokoto');
			hitokoto.innerText = data.hitokoto;
		})
			.
		catch (function (err) {
			console.error(err);
		})
		console.log("\n %c 航时灯 %c Powered by FANHUI | return2017.cn ", "color:#444;background:#eee;padding:5px 0;", "color:#eee;background:#444;padding:5px 0;");
</script>
<footer id="footer">
						<span class="copyright">hmao &copy; 2020-2023 <a href="/">hmao</a>&ensp;|&ensp;<a href="https://beian.miit.gov.cn/" rel="noopener" target="_blank" class="click">吉ICP备2021006336号</a></span>
					</footer>
</body>
</html>