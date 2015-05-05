<?php
	error_reporting(E_ALL ^ E_NOTICE);
	include '../../voxFramework/App.php';

	$app = \Vox\App::getInstance();
	$app->run();


	$app->getSession()->counter2+=1;
	var_dump($app->getSession()->counter2);

	//Native Sessions
	// $app->getSession()->counter+=1;
	// var_dump($app->getSession()->counter);

	//Databse access
	// $db = new \Vox\DB\SimpleDB();
	// $a = $db->prepare('SELECT * FROM boom WHERE id=?')->execute(array(11))->fetchAllAssoc();
	// var_dump($a); 


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
