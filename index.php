<?php
	
	$user  = 'pi';
	$pass  = '716a40762068d9d2bd8cc84827897918';
	$login = 0;

	if(!empty($_COOKIE["user"]) && !empty($_COOKIE["passwd"]))
	{
		if($_COOKIE["user"] == $user && $_COOKIE["passwd"] == $pass)
		{
			$login = 1;
		}
	}
	else
	{
		$userName = $_POST['u'];
		$passwd   = $_POST['p'];		

		if($userName == $user && md5($passwd) == $pass)
		{
			$login = 1;
			setcookie("user", "pi", time() + 3600);
			setcookie("passwd", md5($passwd), time() + 3600);
		}
		else
		{
			$login = 0;
		}
	}
	

?>
<!doctype html>
<html lang="zh_CN">
<head>
	<meta charset="UTF-8">
	<title>Raspiberry Pi 控制中心</title>

	<link rel="stylesheet" href="style.css">
</head>
<body>
	
	<div id="wrap">

	<?php if(!$login) { ?>
	
		<article class="login">

			<header>
				<h1 class="login-logo">Raspiberry Pi 控制中心</h1>
			</header>

			<form action="" method="post">
				<div class="username">
					<span>用户名</span>
					<input type="text" name="u">
				</div>
				<div class="passwd">
					<span>密  码</span>
					<input type="password" name="p">
				</div>
				<input type="submit" class="submit" value="登陆">
			</form>

		</article>
		
	<?php } else { ?>

		<div class="logined">

			<header>
				<h1 class="logined-logo">Raspiberry Pi 控制中心</h1>
			</header>

			<nav class="menu">
				<ul>
					<li><a href="#">状态</a></li>
					<li><a href="#">控制</a></li>
				</ul>
			</nav>

			<div class="content">
				
			</div>
		</div>

	<?php } ?>

	</div>

</body>
</html>