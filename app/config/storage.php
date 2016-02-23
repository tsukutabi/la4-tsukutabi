<?php

return array(

    /*
    |--------------------------------------------------------------------------
    | Default Connection
    |--------------------------------------------------------------------------
    |
    | The default file system connection to use.
    |
    | A non-default connection can also be specified by using \Storage::connection('name')->put(...)
    |
    */

    'default' => 'local',

    /*
    |--------------------------------------------------------------------------
    | Connections
    |--------------------------------------------------------------------------
    |
    | The various connection configs.
    |
    */

    'connections' => array(
        'local' => array(
            'adapter' => 'local',
            'root_path' => storage_path(),
            'public_url_base' => '[[http://a.public.url.to.your.service/storage]]',
        ),

        'rackspace' => array(
            'adapter' => 'rackspace',
            'store' => 'cloudFiles',
            'region' => 'LON',
            'container' => '[[insert your cdn container name]]',
        ),

        'gcloud' => array(
            'adapter' => 'gcloud',
            'bucket' => '[[insert your bucket name]]',
        ),
    ),

);