<?php
	error_reporting(E_ALL ^ E_NOTICE);
	include '../../voxFramework/App.php';

	$app = \Vox\App::getInstance();
	$app->run();

	//register Namespaces
	//before run
	//\Vox\Loader::registerNamespace(' Test\Models', '/Applications/XAMPP/htdocs/test/vox/voxApplication/models');
	//after run
	//new \Test\Models\User();


	//use constants
	//before/after run
	//echo $config->db['username'];

	//set custom config directory
	// $config = \Vox\Config::getInstance();
	// $config->setConfigFolder('../config');
	//using the default path
	//echo $app->getConfig()->app['key'];
?>
