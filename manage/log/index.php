<?php
# ——————————————————————————————————————————————————————————
# Config
# ——————————————————————————————————————————————————————————
$root = '../../';
$page_title = 'Log';
include_once($root.'_include/config.php');

if ($_SESSION[SITE_CODE]['user']['permission'] < ALLOW_ALL) {
    show_message('您的權限不足以操作此功能');
    redirect(SITE_URL);
}

$current_page = (isset($_GET['page']) && is_numeric($_GET['page'])) ? $_GET['page'] : 1;
$page_size = PAGE_SIZE * 1.5;
$list_item_counts = db_count($db, 'log', $_GET);
$logs = db_list($db, 'log', $_GET, $page_size, $current_page, array('action_time' => 1));

include_once($root.'_layout/manage/top.php');
?>
<div class='panel panel-default'>
    <div class='panel-heading'>
        <h3><?=$page_title?></h3>
    </div>
    <div class='panel-body'>
        <?php
            $_search_target = 'log';
            include_once($root.'_partial/manage/search.php');
        ?>
        <div class='table-responsive'>
            <table class='table'>
                <thead>
                    <tr class='active'>
                        <th>IP</th>
                        <th>User</th>
                        <th>Action</th>
                        <th>Table</th>
                        <th>Time</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($logs as $key => $log) : ?>
                        <tr>
                            <td><?=$log['ip']?></td>
                            <td><?=$log['user']?></td>
                            <td><?=$enum['action'][$log['action']]?></td>
                            <td><?=$log['table_name']?></td>
                            <td><?=$log['action_time']?></td>
                            <td>
                                <a class='btn btn-xs btn-info' href='Detail.php?<?=$log["id"]?>'>
                                    <span class='glyphicon glyphicon-search'></span> Detail
                                </a>
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
