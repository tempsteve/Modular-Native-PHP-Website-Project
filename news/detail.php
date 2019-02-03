<?php
# ——————————————————————————————————————————————————————————
# Config
# ——————————————————————————————————————————————————————————
$root = '../';
include_once($root.'_include/config.php');

$news = db_read($db, 'news', $_SERVER['QUERY_STRING']);

if (!$news)
	redirect(SITE_URL);

$page_title = $news['title'];

include_once($root.'_layout/home/top.php');
?>
<div class='panel-heading'>
	<h3><img class='img-item' src='<?=SITE_IMG?>item.png'><?=$page_title?></h3>
</div>
<div class='panel-body'>
	<?php if (IS_ENABLE == 1 || in_array($_SERVER['REMOTE_ADDR'], $except_ip_list)): ?>
		<?=str_replace('\\', '', $news['content'])?>
		<hr>
		公告時間：<?=date("Y-m-d", strtotime($news['create_time']))?>
		<?php if ($news['update_time'] != null): ?>
			<br>
			更新時間：<?=date("Y-m-d", strtotime($news['update_time']))?>
		<?php endif ?>
		<br>
		<div class="text-center">
			<a href="<?=SITE_URL?>" class="btn btn-primary">回首頁</a>
		</div>
	<?php else: ?>
		<?php include_once($root.'_partial/home/is_preparing.php'); ?>
	<?php endif ?>
</div>
<?php include_once($root.'_layout/home/bottom.php'); ?>
