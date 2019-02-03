<?php
# ——————————————————————————————————————————————————————————
# Config
# ——————————————————————————————————————————————————————————
$root = '';
$page_title = 'Page 1';
include_once($root.'_include/config.php');

$sql = 'SELECT `page1` FROM `informations` WHERE `id` = "project"';
$sth = $db->prepare($sql);
$sth->execute();
$information = $sth->fetch(PDO::FETCH_ASSOC);

include_once($root.'_layout/home/top.php');
?>
<div class='panel-heading'>
	<h3><img class='img-item' src='<?=SITE_IMG?>item.png'><?=$page_title?></h3>
</div>
<div class='panel-body'>
	<?php if (IS_ENABLE == 1 || in_array($_SERVER['REMOTE_ADDR'], $except_ip_list)): ?>
		<?=str_replace('\\"', '', $information['page1'])?>
	<?php else: ?>
		<?php include_once($root.'_partial/home/is_preparing.php'); ?>
	<?php endif ?>
</div>
<?php include_once($root.'_layout/home/bottom.php'); ?>
