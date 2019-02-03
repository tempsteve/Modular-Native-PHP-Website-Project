<?php
# ——————————————————————————————————————————————————————————
# Config
# ——————————————————————————————————————————————————————————
$root = '../';
$page_title = '使用者登入';
include_once($root.'_include/config.php');

if (strtoupper($_SERVER['REQUEST_METHOD']) == 'POST') {
	$_POST = xss_defence_array($_POST);
	if ($_POST['token'] == TOKEN) {
		$sql = 'SELECT * FROM admins WHERE account = :account AND password = :password';
		$sth = $db->prepare($sql);
		$sth->bindValue(':account', 	$_POST['account']);
		$sth->bindValue(':password', 	md5($_POST['password']));
		$sth->execute();
		$admin = $sth->fetch(PDO::FETCH_ASSOC);
		if ($sth->rowCount() > 0) {
			$_SESSION[SITE_CODE]['user']['id'] 			= $admin['id'];
			$_SESSION[SITE_CODE]['user']['acc'] 		= $admin['account'];
			$_SESSION[SITE_CODE]['user']['name'] 		= $admin['name'];
			$_SESSION[SITE_CODE]['user']['permission'] 	= $admin['permission'];
			if ($admin['permission'] == 5) {
				$_SESSION[SITE_CODE]['user']['type'] = 'admin';
				redirect(SITE_URL.'Manage/');
			}
		} else {
			show_message('身分驗證失敗，請重新輸入帳號密碼');
		}
	}
}
include_once($root.'_layout/home/top.php');
?>
<div class='panel-heading'>
	<h3><img class='img-item' src='<?=SITE_IMG?>item.png'><?=$page_title?></h3>
</div>
<div class='panel-body'>
	<form class='form-horizontal' method='post'>
		<?php set_token(); ?>
		<div class='form-group'>
			<label class='col-md-2 control-label'>帳號</label>
			<div class='col-md-8'>
				<input class='form-control' type='text' name='account'>
			</div>
		</div>
		<div class='form-group'>
			<label class='col-md-2 control-label'>密碼</label>
			<div class='col-md-8'>
				<input class='form-control' type='password' name='password' autocomplete='off'>
			</div>
		</div>
		<div class='form-group'>
			<div class='col-md-8 col-md-offset-2'>
				<button class='btn btn-default'>登入</button>
			</div>
		</div>
	</form>
</div>
<?php include_once($root.'_layout/home/bottom.php'); ?>
