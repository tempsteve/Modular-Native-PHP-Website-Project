<?php
# ——————————————————————————————————————————————————————————
# Config
# ——————————————————————————————————————————————————————————
$root = '../';
$page_title = '請開啟瀏覽器執行Javascript功能';
include_once($root.'_include/config.php');
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset='utf-8'>
        <meta name='viewport' content='width=device-width'>
        <link rel='shortcut icon' href='<?=SITE_URL?>favicon.ico'>
        <?php include_once(SITE_URL.'_partial/home/script.php'); ?>
        <?php include_once(SITE_URL.'_partial/home/css.php'); ?>
        <title><?=$page_title?> - <?=SITE_TITLE?></title>
    </head>
    <body>
        <?php include_once(SITE_URL.'_partial/home/header.php'); ?>
        <?php include_once(SITE_URL.'_partial/home/nav.php'); ?>
        <div id='pnlMainBody' class='container'>
            <div class='panel text-center' style='margin:7.5%;'>
                <div style='margin:5%;'>
                    <p><font color='red'><span class='glyphicon glyphicon-alert' style='font-size:96px;'></span></font></p>
                    <h3>
                        您的瀏覽器已關閉Javascript
                        <br>
                        請開啟Javascript
                    </h3>
                </div>
                <p style='margin:5%;'><a target="_blank" href="https://support.google.com/adsense/answer/12654?hl=zh-Hant">Chrome開啟Javascript的設定步驟</a></p>
                <h3 style='margin:5%;'>若確認已開啟Javascript<br>請回到<a href='<?=SITE_URL?>'>首頁</a>繼續完成報名相關手續</h3>
            </div>
        </div>
        <?php include_once(SITE_URL.'_partial/home/footer.php'); ?>
    </body>
</html>
