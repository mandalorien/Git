<?php
require_once('constant.php');

require_once(ROOT_PATH .'librairy/class.template.php');# Outil de gestion templating
require_once(ROOT_PATH .'librairy/class.form.php');# Outil d'affichage 

$template = new Template();
$form = new Form($template);

$titre = 'Extensions';
if (!extension_loaded('zip')) {

	$mess = 'L\'extension Zip n\' est pas active .';
	$type = Form::MESS_WARNING;
}else{
	$mess = 'L\'extension Zip est active .';
	$type = Form::MESS_NORMALE;
}

$parse = array();
$parse['extensions'] = $form->Message($titre,$mess,$type);
$parse['SCRIPT'] = SCRIPT;
$form->display($template->displaytemplate('git_body', $parse));
?>