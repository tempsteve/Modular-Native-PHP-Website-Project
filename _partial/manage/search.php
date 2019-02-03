<button
	class='btn btn-xs btn-default'
	data-toggle='collapse'
	data-target='#pnlSearch'
	aria-expanded='false'
	aria-controls='pnlSearch'>設定搜尋條件</button>
<a class='btn btn-xs btn-default' href='<?=str_replace("index.php", "", $_SERVER["PHP_SELF"])?>'>移除搜尋條件</a>
<hr>
<div class='collapse' id='pnlSearch'>
	<form class='form-horizontal'>
		<?php include_once($root.'_partial/manage/search/'.$_search_target.'.php'); ?>
	</form>
	<hr>
</div>
