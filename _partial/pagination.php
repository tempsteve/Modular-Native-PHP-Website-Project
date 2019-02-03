<nav class="text-center">
	<ul class="pagination pagination-sm">
		<?php
			$parameter = '';
			unset($_GET['page']);
			$_GET = xss_defence_array($_GET);
			$_GET = remove_empty_item($_GET);
			/*foreach ($_GET as $key => $value)
			{
				$parameter .= '&'.$key.'='.$value;
			}*/
			$parameter = 'page=';

			$total_items 		= $list_item_counts;
			$max_page_number 	= floor($total_items / $page_size) + 1;
			$min_page_number 	= 1;
			$page_number_start 	= $current_page;
			$page_number_end 	= $max_page_number;

			if ($total_items < $page_size)
				$max_page_number = 1;

			if ($total_items % $page_size == 0 && $total_items > 0)
				$max_page_number--;

			if ($current_page - 2 > 0)
				$page_number_start = $current_page - 2;

			if ($max_page_number > $page_number_start + 5)
				$page_number_end = $page_number_start + 5;

			if ($total_items % $page_size == 0)
				$page_number_end--;
		?>
		<?php if ($current_page != $min_page_number): ?>
			<li><a href='?<?=$parameter?><?=$min_page_number?>'>第一頁</a></li>
			<li><a href='?<?=$parameter?><?=$current_page - 1?>'>上一頁</a></li>
		<?php endif ?>
		<?php for ($i = $page_number_start; $i <= $page_number_end; $i++): ?>
			<li <?php if ($i == $current_page) echo "class='active'"; ?>>
				<a href="?<?=$parameter?><?=$i?>"><?=$i?></a>
			</li>
			<?php endfor ?>
		<?php if ($current_page != $max_page_number): ?>
			<li><a href="?<?=$parameter?><?=$current_page + 1?>">下一頁</a></li>
			<li><a href="?<?=$parameter?><?=$max_page_number?>">最後一頁</a></li>
		<?php endif ?>
	</ul>
</nav>
