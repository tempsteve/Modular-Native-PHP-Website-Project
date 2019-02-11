<?php
# ——————————————————————————————————————————————————————————
# Config
# ——————————————————————————————————————————————————————————
$root = '';
$page_title = '';
include_once($root.'_include/config.php');

//未指定檔案編號之處理
if (!isset($_GET['id']) || !strlen($_GET['id'])) {
    exit;
}
if (isset($_GET)) {
    $_GET = xss_defence_array($_GET);
}

//取得檔案內容
$stmt = $db->prepare('SELECT * FROM `file` WHERE `id` = :id');
$stmt->bindParam(':id', $_GET['id']);
$stmt->execute();

$row_content01 = $stmt->fetch(PDO::FETCH_ASSOC);
$totalRows_content01 = $stmt->rowCount();

// 找不到指定檔案之處理
if (!$totalRows_content01) {
    exit;
}

// 取出檔案內容並解碼
$this_file = $row_content01['name'].'('.$row_content01['version'].').'.$row_content01['type'];
$content = $row_content01['content'];

header("Content-Disposition: attachment; filename=".$this_file);
ob_clean();
flush();
echo $content;
