<?php
	include '../../voxFramework/App.php';

	$app = \Vox\App::getInstance();
	$app->run();

	new \Vox\Test();
?>