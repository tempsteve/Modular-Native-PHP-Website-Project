<?php
$root = '../../';
include_once($root.'_include/config.php');
$page_title = 'Log detail';

if ($_SESSION[SITE_CODE]['user']['permission'] < ALLOW_ALL) {
	show_message('您的權限不足以操作此功能');
	redirect(SITE_URL);
}

$log = db_read($db, 'log', $_SERVER['QUERY_STRING']);
if (!$log) {
	redirect(SITE_URL.'Manage/Log');
}
include_once($root.'_layout/manage/top.php');
?>
<div class='panel panel-default'>
	<div class='panel-heading'>
		<h3><?=$page_title?></h3>
	</div>
	<div class='panel-body'>
		<?php create_back_to_btn('Manage/Log', 'Back to list'); ?>
		<div class='table-responsive'>
			<table class='table'>
				<thead>
					<tr class='active'>
						<th class='text-right'>ITEM</th>
						<th>DATA</th>
					</tr>
				</thead>
				<tbody>
					<?php foreach ($log as $key => $value): ?>
						<tr>
							<td class='text-right'><b><?=$key?></b></td>
							<?php if($key == 'action'): ?>
								<td><?=$enum['action'][$value]?></td>
							<?php elseif($key == 'data'): ?>
								<td>
									<?php $items = explode('#####', $value); ?>
									<?php foreach ($items as $key => $item): ?>
										<?=htmlentities($item)?><br>
									<?php endforeach ?>
								</td>
							<?php else:  ?>
								<td><?=$value?></td>
							<?php endif ?>
						</tr>
					<?php endforeach ?>
				</tbody>
			</table>
		</div>
	</div>
	<div class='panel-footer'>

	</div>
</div>
<?php include_once($root.'_layout/manage/bottom.php'); ?>
