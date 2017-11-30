<?php
require_once('constant.php');

require_once(ROOT_PATH .'librairy/class.template.php');# Outil de gestion templating
require_once(ROOT_PATH .'librairy/class.form.php');# Outil d'affichage 

$template = new Template();
$form = new Form($template);

$list = null;
$CHANGELOG = array();
$CHANGELOG['0.0.0'] = '<span class="label label-success">New</span> <strong>Initial commit</strong>';
$CHANGELOG['0.0.1'] = '<span class="label label-success">New</span> <strong>inialisation du projet</strong>';
$CHANGELOG['0.0.2'] = '<span class="label label-warning">New</span> <strong>fix some french errors in comments</strong>';
$CHANGELOG['0.0.3'] = '<span class="label label-warning">New</span> <strong>fix readme</strong>';
$CHANGELOG['0.0.4'] = '<span class="label label-danger">New</span> <strong>delete template</strong>';
$CHANGELOG['0.0.5'] = '<span class="label label-warning">New</span> <strong>update constant NAME_SITE</strong>';
$CHANGELOG['0.0.6'] = '<span class="label label-warning">New</span> <strong>update script git</strong>';
$CHANGELOG['0.0.7'] = '<span class="label label-warning">New</span> <strong>fix some french errors in comments</strong>';
$CHANGELOG['0.0.8'] = '<span class="label label-warning">New</span> <strong>update git.js </strong>';

foreach($CHANGELOG as $VERSION=>$DESCRIPTION){
	
	$parse['version_number'] = $VERSION;
	$parse['description'] = $DESCRIPTION;

	$list .= $template->displaytemplate('changelog_table', $parse);
}

$parse['SCRIPT'] = SCRIPT;
$parse['body'] = $list;
$form->display($template->displaytemplate('changelog_body', $parse));
?>