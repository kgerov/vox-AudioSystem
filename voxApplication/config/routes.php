<?php
$cnf['admin']['namespace'] = 'Controllers/Admin1';
$cnf['administration']['namespace'] = 'Controllers/Admin2';
$cnf['administration']['controllers']['index'] = 'test';
$cnf['administration']['controllers']['new'] = 'create';
$cnf['*']['namespace'] = 'Controllers';

return $cnf;

//$cnf['admin/users']['namespace'] = 'Controllers/Admin1';