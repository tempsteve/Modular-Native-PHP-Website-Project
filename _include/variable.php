<?php
include_once('variable/_enum_admin.php');

$enum['is_enabled'] = array(
	1 => '是',
	0 => '否'
);

$enum['priority'] = array(
	0 => '低',
	1 => '中',
	2 => '高'
);

$enum['action'] = array(
	1=>'create',
	2=>'read',
	3=>'update',
	4=>'delete',
	'create'=>1,
	'read'=>2,
	'update'=>3,
	'delete'=>4
);

$enum['table'] = array(
	'admin' => '管理者帳號',
	'config' => '網站相關參數',
	'informations' => '網頁內容',
	'news' => '最新消息',
	'faqs' => 'FAQ',
	'FILE' => '實體檔案'
);
?>
