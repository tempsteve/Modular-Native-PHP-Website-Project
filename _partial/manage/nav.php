<nav class='navbar navbar-default navbar-static-top'>
	<div class='container-fluid'>
		<div class='navbar-header'>
			<button type='button' class='navbar-toggle collapsed' data-toggle='collapse' data-target='#pnlMainNavbar' aria-expanded='false'>
				<span class='icon-bar'></span>
				<span class='icon-bar'></span>
				<span class='icon-bar'></span>
			</button>
			<a class='navbar-brand' href='<?=SITE_URL?>Manage'>管理系統</a>
		</div>

		<div class='collapse navbar-collapse' id='pnlMainNavbar'>
			<ul class='nav navbar-nav'>
				<li><a href='<?=SITE_URL?>Manage/News'>最新消息</a></li>
				<?php if ($_SESSION[SITE_CODE]['user']['permission'] == ALLOW_ALL): ?>
					<li class='dropdown'>
						<a href='#' class='dropdown-toggle' data-toggle='dropdown'>進階管理 <span class='caret'></span></a>
						<ul class='dropdown-menu'>
							<li><a href='<?=SITE_URL?>Manage/Config.php'>網站設定</a></li>
							<li><a href='<?=SITE_URL?>Manage/Admin/'>管理者帳號</a></li>
							<li><a href='<?=SITE_URL?>Manage/Log/'>Log</a></li>
						</ul>
					</li>
				<?php endif ?>
			</ul>

			<ul class='nav navbar-nav navbar-right'>
				<li><a href='#'>管理者：<?=$_SESSION[SITE_CODE]['user']['name']?></a></li>
				<li><a href='<?=SITE_URL?>'>前往前台</a></li>
				<li><a href='<?=SITE_URL?>Logout.php'>登出</a></li>
			</ul>
		</div>
	</div>
</nav>
