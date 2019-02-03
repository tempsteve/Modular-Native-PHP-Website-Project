<?php
date_default_timezone_set("Asia/Taipei");
ini_set('memory_limit', '-1');
session_start();

$except_ip_list = array(
	"111.222.333.444"
);

if (!isset($_SESSION['token'])) {
	$_SESSION['token'] = md5(uniqid());
}

define('TOKEN',	$_SESSION['token']);
define('SITE_CODE', 'project');
define('SITE_DOMAIN_NAME', 'https://localhost/'.SITE_CODE.'/');	// 主要是ckeditor上傳圖片功能使用

include_once("database.php");
include_once("variable.php");
include_once("constant.php");

function allow_visit($bool) {
	if (!$bool)	{
		show_message('目前不開放瀏覽此頁面，按下確定後將回到首頁');
		redirect(SITE_URL.'index.php');
	}
}

function authentication($type) {
	switch ($type) {
		case 'admin':
			if ($_SESSION['project']['user']['type'] != 'admin') {
				redirect(SITE_URL.'Manage/Login.php');
			}
			break;
	}
}

function create_back_to_btn($url, $text) {
	$current_url = "https://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";

	if (isset($_SERVER['HTTP_REFERER']) && strpos($_SERVER['HTTP_REFERER'], $url) !== false && $current_url != $_SERVER['HTTP_REFERER'])
		$url = $_SERVER['HTTP_REFERER'];
	else
		$url = SITE_URL.$url;
	echo '<p>';
	echo 	'<a class="btn btn-xs btn-info" href="'.$url.'">';
	echo 		'<span class="glyphicon glyphicon-arrow-left"></span> '.$text;
	echo 	'</a>';
	echo '</p>';
}

function create_btn($type, $id = null) {
	switch ($type) {
		case 'create':
			if ($_SESSION['project']['user']['permission'] >= ALLOW_CREATE) {
				echo '<p>';
				echo 	'<a class="btn btn-xs btn-primary" href="Create.php">';
				echo 		'<span class="glyphicon glyphicon-plus"></span> 新增';
				echo 	'</a>';
				echo '</p>';
			}
			break;

		case 'update':
			if ($_SESSION['project']['user']['permission'] >= ALLOW_UPDATE) {
				echo 	'<a class="btn btn-xs btn-success" href="Edit.php?'.$id.'">';
				echo 		'<span class="glyphicon glyphicon-pencil"></span> 修改';
				echo 	'</a>';
			}
			break;

		case 'delete':
			if ($_SESSION['project']['user']['permission'] >= ALLOW_DELETE) {
				echo 	'<a class="btn btn-xs btn-danger" href="Delete.php?'.$id.'">';
				echo 		'<span class="glyphicon glyphicon-trash"></span> 刪除';
				echo 	'</a>';
			}
			break;
	}
}

function check_token($data) {
	if ($data['token'] != TOKEN) {
		show_message('禁止跨域請求');
		return false;
	} else
		return true;
}

function close_and_reload() {
	echo '<script>window.opener.location.reload();</script>';
	echo '<script>window.close();</script>';
	exit(0);
}

// 將陣列或物件組合成字串
function combine_to_string($data) {
	$result = '';
	foreach ($data as $key => $value) {
		if (is_array($value) || is_object($value))
			combine_to_string($data);
		else
			$result .= '[KEY == '.$key.' && '.'VALUE == '.$value.']#####';
	}
	return (strlen($result) > 5) ?substr($result, 0, -5) :'';
}

// 轉出成console.log
function console_log($data) {
	$msg = '';
	if (is_array($data) || is_object($data)) {
		foreach ($data as $key => $value) {
			$msg .= '<script>console.log("'.$key.'","'.$value.'")</script>';
		}
	} else {
		$msg = '<script>console.log("'.$data.'");</script>';
	}
	echo $msg;
}

function db_list($db, $table, $condition = null, $page_size = null, $current_page = null, $order_by = null) {
	if ($condition != null)	{
		unset($condition['page']);
	}

	if ($page_size != null && $current_page != null) {
		if (count($condition) > 0) {
			$query_string = '';
			foreach ($condition as $key => $value) {
				$query_string .= $key.' LIKE :'.$key.' AND ';
			}
			$query_string = substr($query_string, 0, -5);

			$sql = 'SELECT * FROM '.$table;
			$sql .= ' WHERE '.$query_string;
			if ($order_by != null) {
				$sql .= ' ORDER BY ';
				foreach ($order_by as $key => $value) {
					if ($value == 0)
						$sql .= $key.',';
					else
						$sql .= $key.' DESC,';
				}
				$sql = substr($sql, 0, -1);
			}
			$sql .= ' LIMIT :start, :offset';
			$sth = $db->prepare($sql);
			foreach ($condition as $key => $value) {
				$sth->bindValue(':'.$key, '%'.$value.'%');
			}
		} else {
			$sql = 'SELECT * FROM '.$table;
			if ($order_by != null) {
				$sql .= ' ORDER BY ';
				foreach ($order_by as $key => $value) {
					if ($value == 0)
						$sql .= $key.',';
					else
						$sql .= $key.' DESC,';
				}
				$sql = substr($sql, 0, -1);
			}
			$sql .=' LIMIT :start, :offset';
			$sth = $db->prepare($sql);
		}
		$sth->bindValue(':start', ($current_page - 1) * $page_size, PDO::PARAM_INT);
		$sth->bindValue(':offset', $page_size, PDO::PARAM_INT);
	} else {
		if (count($condition) > 0) {
			$query_string = '';
			foreach ($condition as $key => $value) {
				$query_string .= $key.' LIKE :'.$key.' AND ';
			}
			$query_string = substr($query_string, 0, -5);

			$sql = 'SELECT * FROM '.$table;
			$sql .= ' WHERE '.$query_string;
			if ($order_by != null) {
				$sql .= ' ORDER BY ';
				foreach ($order_by as $key => $value) {
					if ($value == 0)
						$sql .= $key.',';
					else
						$sql .= $key.' DESC,';
				}
				$sql = substr($sql, 0, -1);
			}
			$sth = $db->prepare($sql);
			foreach ($condition as $key => $value) {
				$sth->bindValue(':'.$key, '%'.$value.'%');
			}
		} else {
			$sql = 'SELECT * FROM '.$table;
			if ($order_by != null) {
				$sql .= ' ORDER BY ';
				foreach ($order_by as $key => $value) {
					if ($value == 0)
						$sql .= $key.',';
					else
						$sql .= $key.' DESC,';
				}
				$sql = substr($sql, 0, -1);
			}
			$sth = $db->prepare($sql);
		}
	}
	$sth->execute();
	return $sth->fetchAll(PDO::FETCH_ASSOC);
}

function db_count($db, $table, $condition = null) {
	if ($condition != null && count($condition) > 1) {
		unset($condition['page']);
		$query_string = '';
		foreach ($condition as $key => $value) {
			$query_string .= $key.' LIKE :'.$key.' AND ';
		}
		$query_string = substr($query_string, 0, -5);

		$sql = 'SELECT count(*) AS total FROM '.$table.' WHERE '.$query_string;
		$sth = $db->prepare($sql);
		foreach ($condition as $key => $value) {
			$sth->bindValue(':'.$key, '%'.$value.'%');
		}
	} else {
		$sql = 'SELECT count(*) AS total FROM '.$table;
		$sth = $db->prepare($sql);
	}
	$sth->execute();
	$result = $sth->fetch(PDO::FETCH_ASSOC);
	return $result['total'];
}

function db_create($db, $table, $data, $user, $allow_cross_site = false, $show_message = true) {
	if (check_token($data) || $allow_cross_site) {
		unset($data['token']);

		$column = '';
		$values = '';
		foreach ($data as $key => $value) {
			$column .= $key.',';
			$values .= ':'.$key.',';
		}
		$column = substr($column, 0, -1);
		$values = substr($values, 0, -1);

		$sql = 'INSERT INTO '.$table.'('.$column.') VALUES('.$values.')';
		$sth = $db->prepare($sql);
		foreach ($data as $key => $value) {
			$sth->bindValue(':'.$key, $value);
		}
		if ($sth->execute()) {
			write_log($db, DB_CREATE, $table, $data, $user);
			if ($show_message)
				show_message('新增成功');
			return true;
		} else {
			if ($show_message)
				show_message('新增失敗');
			return false;
		}
	} else
		return false;
}

function db_read($db, $table, $id) {
	$sql = 'SELECT * FROM '.$table.' WHERE id = :id';
	$sth = $db->prepare($sql);
	$sth->bindValue(':id', $id);
	$sth->execute();

	return $sth->fetch(PDO::FETCH_ASSOC);
}

function db_update($db, $table, $data, $user, $allow_cross_site = false, $show_message = true) {
	if (check_token($data) || $allow_cross_site) {
		$id = $data['id'];
		unset($data['id']);
		unset($data['token']);

		$sql_cmd = '';
		foreach ($data as $key => $value) {
			$sql_cmd .= $key.'=:'.$key.',';
		}
		$sql_cmd = substr($sql_cmd, 0, -1);

		$sql = 'UPDATE '.$table.' SET '.$sql_cmd.' WHERE id=:id';
		$sth = $db->prepare($sql);
		$sth->bindValue(':id', $id);
		foreach ($data as $key => $value) {
			$sth->bindValue(':'.$key, $value);
		}
		if ($sth->execute()) {
			write_log($db, DB_UPDATE, $table, $data, $user);
			if ($show_message)
				show_message('修改成功');
			return true;
		} else {
			if ($show_message)
				show_message('修改失敗');
			return false;
		}
	} else
		return false;
}

function db_delete($db, $table, $id, $user) {
	$sql = 'SELECT * FROM '.$table.' WHERE id = :id';
	$sth = $db->prepare($sql);
	$sth->bindValue(':id', $id);
	$sth->execute();
	$data = $sth->fetch(PDO::FETCH_ASSOC);

	if ($data) {
		$sql = 'DELETE FROM '.$table.' WHERE id = :id';
		$sth = $db->prepare($sql);
		$sth->bindValue(':id', $id);
		if ($sth->execute()) {
			write_log($db, DB_DELETE, $table, $data, $user);
			show_message('刪除成功');
			return true;
		} else {
			show_message('刪除失敗');
			return false;
		}
	} else
		return false;
}

// 取得使用者環境資訊
function get_agent() {
	$user_agent = isset($_SERVER['HTTP_USER_AGENT']) ? $_SERVER['HTTP_USER_AGENT'] : '';
	$browser_name = 'Unknown';
	$platform = 'Unknown';
	$version = $ub = "";

	//First get the platform?
	if (preg_match('/linux/i', $user_agent)) {
		$platform = 'linux';
	} elseif (preg_match('/macintosh|mac os x/i', $user_agent)) {
		$platform = 'mac';
	} elseif (preg_match('/windows|win32/i', $user_agent)) {
		$platform = 'windows';
	}

	// Next get the name of the useragent yes seperately and for good reason
	if (preg_match('/MSIE/i', $user_agent) && !preg_match('/Opera/i', $user_agent))	{
		$browser_name = 'Internet Explorer';
		$ub = "MSIE";
	} elseif (preg_match('/Firefox/i',$user_agent))	{
		$browser_name = 'Mozilla Firefox';
		$ub = "Firefox";
	} elseif (preg_match('/Trident/i',$user_agent)) {
		$browser_name = 'Internet Explorer 11';
		$ub = "MSIE11";
	} elseif (preg_match('/Chrome/i',$user_agent)) {
		$browser_name = 'Google Chrome';
		$ub = "Chrome";
	} elseif (preg_match('/Safari/i',$user_agent)) {
		$browser_name = 'Apple Safari';
		$ub = "Safari";
	} elseif (preg_match('/Opera/i',$user_agent)) {
		$browser_name = 'Opera';
		$ub = "Opera";
	} elseif (preg_match('/Netscape/i',$user_agent)) {
		$browser_name = 'Netscape';
		$ub = "Netscape";
	}

	// finally get the correct version number
	$known = array('Version', $ub, 'other');
	$pattern = '#(?<browser>'.join('|', $known).')[/ ]+(?<version>[0-9.|a-zA-Z.]*)#';
	if (!preg_match_all($pattern, $user_agent, $matches)) {
		// we have no matching number just continue
	}

	// see how many we have
	$i = count($matches['browser']);
	if ($i != 1) {
		//we will have two since we are not using 'other' argument yet
		//see if version is before or after the name
		if (strripos($user_agent,"Version") < strripos($user_agent,$ub)) {
			$version = $matches['version'][0];
		} else {
			$version = isset($matches['version'][1]) ? $matches['version'][1] : '';
		}
	} else {
		$version = $matches['version'][0];
	}

	// check if we have a number
	if ($version == null || $version == "")	{
		$version = "Unknown";
	}

	return array(
		'name'		=> $browser_name,
		'version'	=> $version,
		'platform'	=> $platform,
		'detail'	=> $user_agent
	);
}

// 取得使用者IP
function get_ip() {
	if (isset($_SERVER['HTTP_CLIENT_IP']))
		return filter_var($_SERVER['HTTP_CLIENT_IP'], FILTER_SANITIZE_STRING);
	elseif (isset($_SERVER['HTTP_X_FORWARDED_FOR']))
		return filter_var($_SERVER['HTTP_X_FORWARDED_FOR'], FILTER_SANITIZE_STRING);
	elseif (isset($_SERVER['HTTP_X_FORWARDED']))
		return filter_var($_SERVER['HTTP_X_FORWARDED'], FILTER_SANITIZE_STRING);
	elseif (isset($_SERVER['HTTP_FORWARDED_FOR']))
		return filter_var($_SERVER['HTTP_FORWARDED_FOR'], FILTER_SANITIZE_STRING);
	elseif (isset($_SERVER['HTTP_FORWARDED']))
		return filter_var($_SERVER['HTTP_FORWARDED'], FILTER_SANITIZE_STRING);
	elseif (isset($_SERVER['REMOTE_ADDR']))
		return filter_var($_SERVER['REMOTE_ADDR'], FILTER_SANITIZE_STRING);
	else
		return 'Unknown';
}

// 取得使用者所有代理設定
function get_ip_detail() {
	$ipaddress = "";
	if (isset($_SERVER['HTTP_CLIENT_IP']))
		$ipaddress .= "[HTTP_CLIENT_IP = ".$_SERVER['HTTP_CLIENT_IP']."]#####";
	if (isset($_SERVER['HTTP_X_FORWARDED_FOR']))
		$ipaddress .= "[HTTP_X_FORWARDED_FOR = ".$_SERVER['HTTP_X_FORWARDED_FOR']."]#####";
	if (isset($_SERVER['HTTP_X_FORWARDED']))
		$ipaddress .= "[HTTP_X_FORWARDED = ".$_SERVER['HTTP_X_FORWARDED']."]#####";
	if (isset($_SERVER['HTTP_FORWARDED_FOR']))
		$ipaddress .= "[HTTP_FORWARDED_FOR = ".$_SERVER['HTTP_FORWARDED_FOR']."]#####";
	if (isset($_SERVER['HTTP_FORWARDED']))
		$ipaddress .= "[HTTP_FORWARDED = ".$_SERVER['HTTP_FORWARDED']."]#####";
	if (isset($_SERVER['REMOTE_ADDR']))
		$ipaddress .= "[REMOTE_ADDR = ".$_SERVER['REMOTE_ADDR']."]#####";

	return substr(filter_var($ipaddress, FILTER_SANITIZE_STRING), 0, -5);
}

function is_checked($var1, $var2) {
	if ($var1 == $var2)
		echo ' checked';
}

function is_selected($var1, $var2) {
	if ($var1 == $var2)
		echo ' selected';
}

function permission($permission) {
	if ($_SESSION['project']['user']['permission'] < $permission) {
		show_message('您的權限不足以操作此功能');
		redirect(SITE_URL.'Manage/');
	}
}

function post_to($data, $url) {
	echo '<form id="formRedirect" method="post" action="'.$url.'">';
	if (is_array($data) || is_object($data)) {
		foreach ($data as $key => $value) {
			echo '<input type="hidden" name="'.$key.'" value="'.$value.'">';
		}
	} else {
		echo '<input type="hidden" name="id" value="'.$data.'">';
	}
	echo '</form>';
	echo '<script>document.getElementById("formRedirect").submit();</script>';
	exit(0);
}

function remove_empty_item($array) {
	unset($array['page']);
	foreach ($array as $key => $value) {
		if ($value == '')
			unset($array[$key]);
	}
	return $array;
}

function redirect($url) {
	echo '<script>window.location="'.$url.'";</script>';
	exit(0);
}

function set_token() {
	echo '<input type="hidden" name="token" value="'.TOKEN.'">';
}

function show_message($msg) {
	echo '<meta http-equiv="Content-Type" content="text/html; charset=utf-8">';
	echo '<script>alert("'.$msg.'");</script>';
}

// 寫紀錄檔
function write_log($db, $action, $table, $data, $user) {
	$agent = get_agent();

	$sql = 'INSERT INTO log(user, ip, ip_detail, os, browser, browser_detail, action, table_name, data, action_time)
				VALUES(:user, :ip, :ip_detail, :os, :browser, :browser_detail, :action, :table_name, :data, :action_time)';
	$sth = $db->prepare($sql);

	$sth->bindValue(':user', $user);
	$sth->bindValue(':ip', get_ip());
	$sth->bindValue(':ip_detail', get_ip_detail());
	$sth->bindValue(':os', $agent['platform']);
	$sth->bindValue(':browser', $agent['name']);
	$sth->bindValue(':browser_detail', $agent['detail']);
	$sth->bindValue(':action', $action);
	$sth->bindValue(':table_name', $table);
	$sth->bindValue(':data', combine_to_string($data));
	$sth->bindValue(':action_time', date('Y-m-d H:i:s'));
	$sth->execute();
}

// XSS防禦
function xss_defence($data) {
	return filter_var($data, FILTER_SANITIZE_STRING);
}

function xss_defence_array($data) {
	foreach ($data as $key => $value) {
		if (is_array($value))
			xss_defence_array($value);
		else
			$data[$key] = filter_var($value, FILTER_SANITIZE_STRING);
	}
	return $data;
}
?>
