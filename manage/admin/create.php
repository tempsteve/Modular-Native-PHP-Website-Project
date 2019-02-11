<?php
# ——————————————————————————————————————————————————————————
# Config
# ——————————————————————————————————————————————————————————
$root = '../../';
$page_title = '新增管理者';
include_once($root.'_include/config.php');
include_once($root.'_layout/manage/top.php');

if ($_SESSION[SITE_CODE]['user']['permission'] < ALLOW_ALL) {
    show_message('您的權限不足以操作此功能');
    redirect(SITE_URL.'Manage/');
}

if (strtoupper($_SERVER['REQUEST_METHOD']) == 'POST') {
    if ($_POST['password'] != $_POST['checkpwd']) {
        show_message('密碼與確認密碼不符，請重新確認');
    } else {
        unset($_POST['checkpwd']);
        $_POST['password'] = md5($_POST['password']);
        $data = xss_defence_array($_POST);
        $data['create_time'] = date('Y-m-d H:i:s');
        db_create($db, 'admins', $data, $_SESSION[SITE_CODE]['user']['acc']);
        redirect(SITE_URL.'Manage/Admin/');
    }
}
?>
<div class='panel panel-default'>
    <div class='panel-heading'>
        <h3><?=$page_title?></h3>
    </div>
    <div class='panel-body'>
        <form class='form-horizontal' method='post'>
            <?php set_token(); ?>
            <div class='form-group'>
                <label class='control-label col-md-2'>帳號</label>
                <div class='col-md-5'>
                    <input class='form-control' name='account' required placeholder='必填'>
                </div>
            </div>
            <div class='form-group'>
                <label class='control-label col-md-2'>密碼</label>
                <div class='col-md-5'>
                    <input class='form-control' name='password' type='password' required placeholder='必填'>
                </div>
            </div>
            <div class='form-group'>
                <label class='control-label col-md-2'>確認密碼</label>
                <div class='col-md-5'>
                    <input class='form-control' name='checkpwd' type='password' required placeholder='必填'>
                </div>
            </div>
            <div class='form-group'>
                <label class='control-label col-md-2'>姓名</label>
                <div class='col-md-5'>
                    <input class='form-control' name='name' required placeholder='必填'>
                </div>
            </div>
            <div class='form-group'>
                <label class='control-label col-md-2'>權限</label>
                <div class='col-md-5'>
                    <select class='form-control' name='permission' required>
                        <?php foreach ($enum['admin']['permission'] as $key => $value) : ?>
                            <option value='<?=$key?>'><?=$value?></option>
                        <?php endforeach ?>
                    </select>
                </div>
            </div>
            <div class='form-group'>
                <div class='col-md-10 col-md-offset-2'>
                    <button class='btn btn-default'>送出</button>
                </div>
            </div>
        </form>
    </div>
    <div class='panel-footer'>

    </div>
</div>
<?php include_once($root.'_layout/manage/bottom.php'); ?>
