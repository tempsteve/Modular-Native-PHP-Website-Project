<?php
// 登出功能
session_start();
session_destroy();
header('location: https://localhost/project');
?>
