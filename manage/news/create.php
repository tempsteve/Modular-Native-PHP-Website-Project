<?php
$root = '../../';
$page_title = '新增最新消息';
include_once($root.'_include/config.php');
include_once($root.'_layout/manage/top.php');

if ($_SESSION[SITE_CODE]['user']['permission'] < ALLOW_CREATE) {
	show_message('您的權限不足以操作此功能');
	redirect(SITE_URL.'Manage/News/');
}

if (isset($_POST['btnSend'])) {
	$errors = array();

	if ($_POST['is_enabled'] == '')
		array_push($errors, '請選擇是否公開');
	if ($_POST['priority'] == '')
		array_push($errors, '請選擇優先權');
	if ($_POST['title'] == '')
		array_push($errors, '請輸入標題');

	if (count($errors) == 0) {
		unset($_POST['btnSend']);
		$data = xss_defence_array($_POST);
		$data['content'] 		= str_replace('\\"', "'", $_POST['content']);
		$data['create_time'] 	= date('Y-m-d H:i:s');
		db_create($db, 'news', $data, $_SESSION[SITE_CODE]['user']['acc']);
		redirect(SITE_URL.'Manage/News/');
	}
}
?>
<script src='<?=SITE_JS?>plugin/ckeditor/ckeditor.js'></script>
<div class='row'>
	<div class='col-md-12'>
		<div class='panel panel-default'>
			<div class='panel-heading'>
				<h3><?=$page_title?></h3>
			</div>
			<div class='panel-body'>
				<?php create_back_to_btn('Manage/News', '回到列表'); ?>
				<?php include_once($root.'_partial/manage/error_message.php'); ?>
				<form class='form-horizontal' method='post'>
					<?php set_token(); ?>
					<div class='form-group'>
						<label class='col-md-2 control-label' for='is_enabled'>公開</label>
						<div class='col-md-4'>
							<select class='form-control' name='is_enabled' reqired>
								<?php foreach ($enum['is_enabled'] as $key => $value): ?>
									<option value='<?=$key?>'><?=$value?></option>
								<?php endforeach ?>
							</select>
						</div>
						<label class='col-md-2 control-label' for='priority'>優先權</label>
						<div class='col-md-4'>
							<select class='form-control' name='priority' reqired>
								<?php foreach ($enum['priority'] as $key => $value): ?>
									<option value='<?=$key?>'><?=$value?></option>
								<?php endforeach ?>
							</select>
						</div>
					</div>
					<div class='form-group'>
						<label class='col-md-2 control-label' for='title'>標題</label>
						<div class='col-md-10'>
							<input class='form-control' name='title' required placeholder='請輸入標題'>
						</div>
					</div>
					<div class='form-group'>
						<label class='col-md-2 control-label' for='content'>內文</label>
						<div class='col-md-10'>
							<textarea class='ckeditor' name='content'></textarea>
						</div>
					</div>
					<div class='form-group'>
						<div class='col-md-offset-2 col-md-10'>
							<button class='btn btn-default' name='btnSend'>新增</button>
						</div>
					</div>
				</form>
			</div>
			<div class='panel-footer'>
			</div>
		</div>
	</div>
</div>
<script>
	$('button[name="btnDelete"]').click(function(){
		var filename = $(this).parent('form').children('input[name="filename"]').val();
		if(!confirm('確定要刪除「' + filename + '」？'))
			return false;
	});
</script>
<?php
	include_once($root.'_layout/manage/bottom.php');
?>
