<?php
use Mxs\Services\Pdo\PdoConfig;

return [
    'postgre' => PdoConfig::postgre(
        env('PGSQL_DB', 'creages'),
        env('PGSQL_HOST', 'localhost'),
    ),
];