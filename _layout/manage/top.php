<?php
if (preg_match('/(?i)msie [5-8]/', $_SERVER['HTTP_USER_AGENT']) &&
    preg_match('/(?i)windows nt 5.1/', $_SERVER['HTTP_USER_AGENT'])) {
    redirect(SITE_URL.'error/change_browser.php');
}
authentication('admin');
?>
<!DOCTYPE>
<html>
    <head>
        <?php include_once($root.'_partial/manage/meta.php'); ?>
        <title><?=($page_title != '') ? $page_title.' - ':'' ?><?=SITE_TITLE?>::管理系統</title>
        <?php require_once($root.'_partial/manage/css.php'); ?>
        <?php require_once($root.'_partial/manage/script.php'); ?>
    </head>
    <body>
        <?php require_once($root.'_partial/manage/nav.php'); ?>
        <?php
        if (isset($subnavbar)) {
            include_once($root.'_partial/manage/navbar/'.$subnavbar.'.php');
        }
        ?>
        <div id='pnlMainBody' class='container-fluid'>
