<?php
	define('SITE_URL', $root);
	define('SITE_SRC', SITE_URL.'src/');
	define('SITE_CSS', SITE_SRC.'css/');
	define('SITE_IMG', SITE_SRC.'img/');
	define('SITE_JS', SITE_SRC.'js/');
	define('SITE_UPLOAD', SITE_SRC.'upload/');
	define('PAGE_SIZE', 10); // 分頁大小

	$sql = 'SELECT * FROM config WHERE id = "'.SITE_CODE.'"';
	$sth = $db->prepare($sql);
	$sth->execute();
	$config = $sth->fetch(PDO::FETCH_ASSOC);



	if (!isset($_SESSION[SITE_CODE]['user'])) {
		$_SESSION[SITE_CODE]['user']['id'] = 'UNKNOW';
		$_SESSION[SITE_CODE]['user']['acc'] = 'UNKNOW';
		$_SESSION[SITE_CODE]['user']['name'] = 'UNKNOW';
		$_SESSION[SITE_CODE]['user']['type'] = 'UNKNOW';
		$_SESSION[SITE_CODE]['user']['permission'] = -1;
	}

	define('DB_CREATE', $enum['action']['create']);
	define('DB_UPDATE', $enum['action']['update']);
	define('DB_DELETE', $enum['action']['delete']);
	define('DB_READ', $enum['action']['read']);

	define('ALLOW_READ', 1);
	define('ALLOW_CREATE', 2);
	define('ALLOW_UPDATE', 3);
	define('ALLOW_DELETE', 4);
	define('ALLOW_ALL', 5);

	# ——————————————————————————————————————————————————————————
	# 以下開放業務單位自行調整
	# ——————————————————————————————————————————————————————————
	define('SITE_TITLE', $config['activity_name']); // 網站名稱
	define('ACTIVITY_YEAR', $config['activity_year']); // 活動年度
	define('ACTIVITY_START', $config['activity_start']); // 報名期間(開始)
	define('ACTIVITY_END', $config['activity_end']); // 報名期間(結束)
	define('IS_ENABLE', $config['is_enable']); // 是否開放網站
?>
