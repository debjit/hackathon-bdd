<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Default Filesystem Disk
    |--------------------------------------------------------------------------
    |
    | Here you may specify the default filesystem disk that should be used
    | by the framework. The "local" disk, as well as a variety of cloud
    | based disks are available to your application. Just store away!
    |
    */

    'default' => env('FILESYSTEM_DISK', 'local'),

    /*
    |--------------------------------------------------------------------------
    | Filesystem Disks
    |--------------------------------------------------------------------------
    |
    | Here you may configure as many filesystem "disks" as you wish, and you
    | may even configure multiple disks of the same driver. Defaults have
    | been set up for each driver as an example of the required values.
    |
    | Supported Drivers: "local", "ftp", "sftp", "s3"
    |
    */

    'disks' => [

        'local' => [
            'driver' => 'local',
            'root' => storage_path('app'),
            'throw' => false,
        ],

        'public' => [
            'driver' => 'local',
            'root' => storage_path('app/public'),
            'url' => env('APP_URL').'/storage',
            'visibility' => 'public',
            'throw' => false,
        ],

        's3' => [
            'driver' => 's3',
            'key' => env('AWS_ACCESS_KEY_ID'),
            'secret' => env('AWS_SECRET_ACCESS_KEY'),
            'region' => env('AWS_DEFAULT_REGION'),
            'bucket' => env('AWS_BUCKET'),
            'url' => env('AWS_URL'),
            'endpoint' => env('AWS_ENDPOINT'),
            'use_path_style_endpoint' => env('AWS_USE_PATH_STYLE_ENDPOINT', false),
            'throw' => true,
        ],
        // tebi.io hosting site.
        'tebi' => [
            'driver' => 's3',
            'key' => env('TEBI_ACCESS_KEY_ID'),
            'secret' => env('TEBI_SECRET_ACCESS_KEY'),
            'region' => env('TEBI_DEFAULT_REGION'),
            'bucket' => env('TEBI_BUCKET'),
            'url' => env('TEBI_URL'),
            'endpoint' => env('TEBI_ENDPOINT'),
            'use_path_style_endpoint' => env('TEBI_USE_PATH_STYLE_ENDPOINT', false),
            'throw' => true,
        ],
        // BlackBlaze B2 file system
        'bb2' => [
            'driver' => 's3',
            'key' => env('BB2_ACCESS_KEY_ID'),
            'secret' => env('BB2_SECRET_ACCESS_KEY'),
            'region' => env('BB2_DEFAULT_REGION'),
            'bucket' => env('BB2_BUCKET'),
            'url' => env('BB2_URL'),
            'endpoint' => env('BB2_ENDPOINT'),
            'use_path_style_endpoint' => env('BB2_USE_PATH_STYLE_ENDPOINT', false),
            'throw' => true,
        ],

    ],

    /*
    |--------------------------------------------------------------------------
    | Symbolic Links
    |--------------------------------------------------------------------------
    |
    | Here you may configure the symbolic links that will be created when the
    | `storage:link` Artisan command is executed. The array keys should be
    | the locations of the links and the values should be their targets.
    |
    */

    'links' => [
        public_path('storage') => storage_path('app/public'),
    ],

];
