<?php

$cnf['default_controller'] = 'Index';
$cnf['default_method'] = 'index';
$cnf['displayExceptions'] = true;
$cnf['documentRoot'] = '';
$cnf['namespaces']['Controllers'] = '/Applications/XAMPP/htdocs/vox/voxApplication/controllers/';
$cnf['namespaces']['Models'] = '/Applications/XAMPP/htdocs/vox/voxApplication/models/';

$cnf['session']['autostart'] = true;
$cnf['session']['type'] = 'native'; //original: 'native'
$cnf['session']['name'] = '__sess';
$cnf['session']['lifetime'] = 3600;
$cnf['session']['path'] = '/';
$cnf['session']['domain'] = '';
$cnf['session']['secure'] = false;
// $cnf['session']['dbConnection'] = 'session'; // original: remove this line
// $cnf['session']['dbTable'] = 'sessions'; // original: remove this line

$cnf['ss'] = 'sssecret';

return $cnf;