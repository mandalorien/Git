<?php
require_once('constant.php');

require_once(ROOT_PATH .'librairy/class.template.php');# Base de donnees
require_once(ROOT_PATH .'librairy/class.form.php');# Base de donnees

$template = new Template();
$form = new Form($template);

$parse = array();
$parse['SCRIPT'] = SCRIPT;
$form->display($template->displaytemplate('git_body', $parse));
?>