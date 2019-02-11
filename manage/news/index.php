<?php
$root = '../../';
$page_title = '最新消息列表';
include_once($root.'_include/config.php');
include_once($root.'_layout/manage/top.php');

if ($_SESSION[SITE_CODE]['user']['permission'] < ALLOW_READ) {
    show_message('您的權限不足以操作此功能');
    redirect(SITE_URL);
}

$current_page         = (isset($_GET['page']) && is_numeric($_GET['page'])) ? $_GET['page'] : 1;
$page_size             = PAGE_SIZE * 1.5;
$list_item_counts     = db_count($db, 'news', $_GET);
$news                 = db_list($db, 'news', $_GET, $page_size, $current_page);
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
                        <th>是否公開</th>
                        <th>優先權</th>
                        <th>標題</th>
                        <th>建立時間</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($news as $key => $value) : ?>
                        <tr>
                            <td><?=$enum['is_enabled'][$value['is_enabled']]?></td>
                            <td><?=$enum['priority'][$value['priority']]?></td>
                            <td><a href='Detail.php?<?=$value["id"]?>'><?=$value['title']?></a></td>
                            <td><?=$value['create_time']?></td>
                            <td class='text-right'>
                                <?php create_btn('update', $value['id']); ?>
                                <?php create_btn('delete', $value['id']); ?>
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
<?php
    include_once($root.'_layout/manage/bottom.php');
?>
