<?php
$condition = array(
	'is_enabled' => 1
);
$order_by = array(
	'create_time' => 1,
	'priority' => 1
);

$footer_news = db_list($db, 'news', $condition, 5, 1, $order_by);
?>
<h3>NEWS</h3>
<aside>
	<ul class='list-unstyled'>
		<?php foreach ($footer_news as $key => $news): ?>
			<li>
				<p>
					<small><?=$news['create_time']?></small>
					<br>
					<a href='<?=SITE_URL?>News/Detail.php?<?=$news["id"]?>'><?=$news['title']?></a>
				</p>
			</li>
		<?php endforeach ?>
	</ul>
</aside>
