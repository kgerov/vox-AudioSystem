<?php
$cnf['admin']['namespace'] = 'Controllers\Admin1';

$cnf['administration']['namespace'] = 'Controllers\Admin';
$cnf['administration']['controllers']['index']['to'] = 'Index';
$cnf['administration']['controllers']['index']['methods']['new'] = '_new';

$cnf['administration']['controllers']['new']['to'] = 'create';

$cnf['*']['namespace'] = 'Controllers';

return $cnf;

//$cnf['admin/users']['namespace'] = 'Controllers/Admin1';