<?php

return [
    /* ------------------------------------------------------------------------------------------------
     |  Databas Settings
     | ------------------------------------------------------------------------------------------------
     */
    'connection' => 'mysql',

    'prefix'     => 'geo_',

    'table'      => [
        'nations'   => 'nations',
        'countries' => 'countries',
    ],

    'dump'       => app_path() . '/database/geo-db.sql'
];
