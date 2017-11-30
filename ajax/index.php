<?php
header('Content-Type: application/json');
require_once(dirname(dirname(__FILE__)) . DIRECTORY_SEPARATOR . 'constant.php');

require_once(ROOT_PATH .'librairy/class.tools.php');# outils divers
require_once(ROOT_PATH .'librairy/class.template.php');# Base de donnees
require_once(ROOT_PATH .'librairy/class.form.php');# Base de donnees

$template = new Template();
$form = new Form($template);

$response = array();

$error = isset($_POST['error']) ? $_POST['error']:false;
if(isset($_POST['message'])){
	if(!empty($_POST['message'])){
		$message = htmlentities($_POST['message'],ENT_QUOTES);
		if($error){
			$response['message'] = $form->AlertMessage(NAME_SITE,$message,Form::ALERT_ALERT);
		}else{
			$response['message'] = $form->AlertMessage(NAME_SITE,$message,Form::ALERT_SUCCESS);
		}
	}
}

echo json_encode($response);
?>