<?php
	error_reporting(E_ALL ^ E_NOTICE);
	include '../../voxFramework/App.php';

	$app = \Vox\App::getInstance();

	$config = \Vox\Config::getInstance();
	$config->setConfigFolder('../config');
	//\Vox\Loader::registerNamespace(' Test\Models', '/Applications/XAMPP/htdocs/test/vox/voxApplication/models');
	echo $config->db['username'];
	$app->run();

	//new \Test\Models\User();
?>