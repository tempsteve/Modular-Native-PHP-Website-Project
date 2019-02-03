<?php
# ——————————————————————————————————————————————————————————
# Config
# ——————————————————————————————————————————————————————————
$root = '../../';
$page_title = '管理者列表';
include_once($root.'_include/config.php');

if ($_SESSION[SITE_CODE]['user']['permission'] < ALLOW_ALL) {
	show_message('您的權限不足以操作此功能');
	redirect(SITE_URL);
}

$current_page = (isset($_GET['page']) && is_numeric($_GET['page'])) ? $_GET['page'] : 1;
$page_size = PAGE_SIZE * 1.5;
$list_item_counts = db_count($db, 'admins', $_GET);
$admins = db_list($db, 'admins', $_GET, $page_size, $current_page);

include_once($root.'_layout/manage/top.php');
?>
<div class='panel panel-default'>
	<div class='panel-heading'>
		<h3><?=$page_title?></h3>
	</div>
	<div class='panel-body'>
		<?php create_btn('create');?>
		<div class='table-responsive'>
			<table class='table'>
				<thead>
					<tr class='active'>
						<th>帳號</th>
						<th>使用者</th>
						<th>權限</th>
						<th>建立時間</th>
						<th></th>
					</tr>
				</thead>
				<tbody>
					<?php foreach ($admins as $key => $admin): ?>
						<tr>
							<td><?=$admin['account']?></td>
							<td><?=$admin['name']?></td>
							<td><?=$enum['admin']['permission'][$admin['permission']]?></td>
							<td><?=$admin['create_time']?></td>
							<td class='text-right'>
								<?php create_btn('update', $admin['id']); ?>
								<?php create_btn('delete', $admin['id']); ?>
							</td>
						</tr>
					<?php endforeach ?>
				</tbody>
			</table>
		</div>
	</div>
	<div class='panel-footer'>
		<?php include_once($root.'_partial/pagination.php'); ?>
	</div>
</div>
<script>
	$('.btn-danger').click(function(){
		if(!confirm('確定要刪除？'))
			return false;
	});
</script>
<?php include_once($root.'_layout/manage/bottom.php'); ?>
