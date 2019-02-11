<?php
$root = '../../';
$page_title = '預覽最新消息';
include_once($root.'_include/config.php');
include_once($root.'_layout/manage/top.php');

if ($_SESSION[SITE_CODE]['user']['permission'] < ALLOW_READ) {
    show_message('您的權限不足以操作此功能');
    redirect(SITE_URL);
}

$news = db_read($db, 'news', $_SERVER['QUERY_STRING']);

if (!$news) {
    redirect(SITE_URL.'Manage/News/');
}
?>
<div class='panel panel-default'>
    <div class='panel-heading'>
        <h3><?=$page_title?></h3>
    </div>
    <div class='panel-body'>
        <?php create_back_to_btn('Manage/News', '回到列表'); ?>
        <div>
            <h3><?=$news['title']?></h3>
            <br>
            <div class='pnl-margin-left'>
                <?=str_replace('\\', '', $news['content'])?>
            </div>
            <hr>
            <small>公告時間：<?=$news['create_time']?></small>
            <?php if ($news['update_time'] != null) : ?>
                <br>
                <small>修改時間：<?=$news['update_time']?></small>
            <?php endif ?>
        </div>
    </div>
    <div class='panel-footer'>
    </div>
</div>
<?php
    include_once($root.'_layout/manage/bottom.php');
?>
