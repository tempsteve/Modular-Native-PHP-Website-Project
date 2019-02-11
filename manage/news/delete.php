<?php
#-------------------------------------------------
# 頁面設定
#-------------------------------------------------
$root = '../../';
include_once($root.'_include/config.php');

#-------------------------------------------------
# 權限判斷
#-------------------------------------------------
if ($_SESSION[SITE_CODE]['user']['permission'] < ALLOW_DELETE) {
    show_message('您的權限不足以操作此功能');
    redirect(SITE_URL.'Manage/News/');
} else {
    db_delete($db, 'news', $_SERVER['QUERY_STRING'], $_SESSION[SITE_CODE]['user']['acc']);
    redirect(SITE_URL.'Manage/News/');
}
