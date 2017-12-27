<?php
require_once('constant.php');

require_once(ROOT_PATH .'librairy/class.template.php');# Outil de gestion templating
require_once(ROOT_PATH .'librairy/class.form.php');# Outil d'affichage 

$template = new Template();
$form = new Form($template);

$list = null;
$CHANGELOG = array();
$CHANGELOG['0.0.0'] = Form::Changelog(Form::LABEL_SUCCESS,'New','Initial commit');
$CHANGELOG['0.0.1'] = Form::Changelog(Form::LABEL_SUCCESS,'New','inialisation du projet');
$CHANGELOG['0.0.2'] = Form::Changelog(Form::LABEL_WARNING,'Warning','fix some french errors in comments');
$CHANGELOG['0.0.3'] = Form::Changelog(Form::LABEL_WARNING,'Warning','fix readme');
$CHANGELOG['0.0.4'] = Form::Changelog(Form::LABEL_ALERT,'Delete','delete template');
$CHANGELOG['0.0.5'] = Form::Changelog(Form::LABEL_NORMALE,'Update','update constant NAME_SITE');
$CHANGELOG['0.0.6'] = Form::Changelog(Form::LABEL_NORMALE,'Update','update script git');
$CHANGELOG['0.0.7'] = Form::Changelog(Form::LABEL_WARNING,'warning','fix some french errors in comments');
$CHANGELOG['0.0.8'] = Form::Changelog(Form::LABEL_NORMALE,'Update','update git.js ');

foreach($CHANGELOG as $VERSION=>$DESCRIPTION){
	
	$parse['version_number'] = $VERSION;
	$parse['description'] = $DESCRIPTION;

	$list .= $template->displaytemplate('changelog_table', $parse);
}

$parse['SCRIPT'] = SCRIPT;
$parse['body'] = $list;
$form->display($template->displaytemplate('changelog_body', $parse));
?>