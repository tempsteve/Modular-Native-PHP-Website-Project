<!DOCTYPE>
<html>
	<head>
		<?php include_once($root.'_partial/home/meta.php'); ?>
		<title><?=($page_title != '') ? $page_title.' - ':'' ?><?=SITE_TITLE?></title>
		<?php require_once($root.'_partial/home/css.php'); ?>
		<?php require_once($root.'_partial/home/script.php'); ?>
	</head>
	<body>
		<?php require_once($root.'_partial/home/nav.php'); ?>
		<div id='pnlMainBody' class='container'>
			<?php require_once($root.'_partial/home/header.php'); ?>
			<section>
				<div class='panel panel-default' id='pnlSection'>