<?php
# ——————————————————————————————————————————————————————————
# Config
# ——————————————————————————————————————————————————————————
$root = '../';
$page_title = '最新消息';
include_once($root.'_include/config.php');
if (isset($_GET)) {
    $_GET = xss_defence_array($_GET);
}

$current_page         = (isset($_GET['page']) && is_numeric($_GET['page'])) ? $_GET['page'] : 1;
$page_size             = PAGE_SIZE * 1.5;
$list_item_counts     = db_count($db, 'news');
$news                 = db_list($db, 'news', null, $page_size, $current_page, array('id' => 1, 'priority' => 2));

include_once($root.'_layout/home/top.php');
?>
    <div class='panel-heading'>
        <h3><img class='img-item' src='<?=SITE_IMG?>item.png'><?=$page_title?></h3>
    </div>
    <div class='panel-body'>
        <?php if (IS_ENABLE == 1 || in_array($_SERVER['REMOTE_ADDR'], $except_ip_list)) : ?>
            <div class='pnlArticles'>
                <ul>
                    <?php foreach ($news as $key => $value) : ?>
                        <li class='items'>
                            <h4>
                                <?=date("Y-m-d", strtotime($value['create_time']))?>
                                <p class='text-primary'><a data-toggle="collapse" href="#pnlArticle<?=$key?>"><?=$value['title']?></a></p>
                                <article class="collapse in" id="pnlArticle<?=$key?>">
                                    <?=str_replace('\\', '', $value['content'])?>
                                </article>
                            </h4>
                        </li>
                    <?php endforeach ?>
                </ul>
            </div>
            <?php include_once($root.'_partial/pagination.php'); ?>
        <?php else : ?>
            <?php include_once($root.'_partial/home/is_preparing.php'); ?>
        <?php endif ?>
    </div>
<?php include_once($root.'_layout/home/bottom.php'); ?>
