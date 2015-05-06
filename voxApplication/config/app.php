<?php

$cnf['default_controller'] = 'Index';
$cnf['default_method'] = 'index';
$cnf['displayExceptions'] = true;
$cnf['namespaces']['Controllers'] = '/Applications/XAMPP/htdocs/test/vox/voxApplication/controllers/';

$cnf['session']['autostart'] = true;
$cnf['session']['type'] = 'database'; //original: 'native'
$cnf['session']['name'] = '__sess';
$cnf['session']['lifetime'] = 3600;
$cnf['session']['path'] = '/';
$cnf['session']['domain'] = '';
$cnf['session']['secure'] = false;
$cnf['session']['dbConnection'] = 'session'; // original: remove this line
$cnf['session']['dbTable'] = 'sessions'; // original: remove this line

$cnf['ss'] = 'sssecret';

return $cnf;