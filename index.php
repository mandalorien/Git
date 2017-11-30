<?php
require_once('constant.php');

require_once(ROOT_PATH .'librairy/class.template.php');# Outil de gestion templating
require_once(ROOT_PATH .'librairy/class.form.php');# Outil d'affichage 

$template = new Template();
$form = new Form($template);

$parse = array();
$parse['SCRIPT'] = SCRIPT;
$form->display($template->displaytemplate('git_body', $parse));
?>