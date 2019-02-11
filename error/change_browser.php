<?php
# ——————————————————————————————————————————————————————————
# Config
# ——————————————————————————————————————————————————————————
$root = '../';
$page_title = '請更新您的瀏覽器';
include_once($root.'_include/config.php');

if (!preg_match('/(?i)msie [5-8]/', $_SERVER['HTTP_USER_AGENT'])) {
    redirect(SITE_URL);
}
?>
<!DOCTYPE html>
<html>
    <head>
        <?php include_once($root.'_partial/home/meta.php'); ?>
        <title><?=$page_title?> - <?=SITE_TITLE?></title>
        <style>
            .header{
                margin: 2.5%;
            }
            .body{
                margin: 1.5%;
            }
            .footer{
                margin: 1.5%;
            }
            img{
                border:0;
            }
        </style>
    </head>
    <body>
        <center>
            <div class='header'>
                <h1><?=SITE_TITLE?></h1>
                <h2><font color='red'>您的瀏覽器版本過舊</font></h2>
                <h3>為了安全的報名參加<?=SITE_TITLE?><br>請您安裝版本較新的瀏覽器，並使用新的瀏覽器瀏覽本站</h3>
                <p>建議瀏覽器如下（點擊後將重新導向至下載頁面）</p>
            </div>
            <hr>
            <div class='body'>
                <table>
                    <tr>
                        <td>
                            <a target='_blank' href="https://www.google.com.tw/chrome/browser/desktop/index.html">
                                <img src='<?=SITE_IMG?>icon/browser_google_chrome.png'>
                            </a>
                        </td>
                        <td>
                            <a target='_blank' href="https://www.google.com.tw/chrome/browser/desktop/index.html">
                                <h2>Google Chrome</h2>
                            </a>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <a target='_blank' href="http://mozilla.com.tw/firefox/new/">
                                <img src='<?=SITE_IMG?>icon/browser_firefox.png'>
                            </a>
                        </td>
                        <td>
                            <a target='_blank' href="http://mozilla.com.tw/firefox/new/">
                                <h2>Firefox</h2>
                            </a>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <a target='_blank' href="http://windows.microsoft.com/zh-tw/internet-explorer/download-ie">
                                <img src='<?=SITE_IMG?>icon/browser_ie11.png'>
                            </a>
                        </td>
                        <td>
                            <a target='_blank' href="http://windows.microsoft.com/zh-tw/internet-explorer/download-ie">
                                <h2>IE11</h2>
                            </a>
                        </td>
                    </tr>
                </table>
                <p>
                    （IE11適用於Windows 7以上用戶，若您為Windows XP使用者，請選擇Google Chrom或Firefox）<br>
                    （若您已是IE11用戶，<a target='_blank' href='http://windows.microsoft.com/zh-tw/internet-explorer/use-compatibility-view#ie=ie-11'>請將本站從相容性檢視清單中移除</a>）
                </p>
            </div>
            <hr>
            <div class='footer'></div>
        </center>
    </body>
</html>
