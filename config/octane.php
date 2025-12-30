<?php

use Laravel\Octane\Contracts\OperationTerminated;
use Laravel\Octane\Events\RequestHandled;
use Laravel\Octane\Events\RequestReceived;
use Laravel\Octane\Events\RequestTerminated;
use Laravel\Octane\Events\TaskReceived;
use Laravel\Octane\Events\TaskTerminated;
use Laravel\Octane\Events\TickReceived;
use Laravel\Octane\Events\TickTerminated;
use Laravel\Octane\Events\WorkerErrorOccurred;
use Laravel\Octane\Events\WorkerStarting;
use Laravel\Octane\Events\WorkerStopping;

return [

    /*
    |--------------------------------------------------------------------------
    | Octane Server
    |--------------------------------------------------------------------------
    |
    | This value determines the default "server" that will be used by Octane
    | when starting, restarting, or reloading your application servers.
    |
    */

    'server' => env('OCTANE_SERVER', 'swoole'),

    /*
    |--------------------------------------------------------------------------
    | Force HTTPS
    |--------------------------------------------------------------------------
    |
    | When this configuration value is set to "true", Octane will inform the
    | framework that all absolute links must be generated using the HTTPS
    | protocol. Otherwise your links may be generated using plain HTTP.
    |
    */

    'https' => env('OCTANE_HTTPS', false),

    /*
    |--------------------------------------------------------------------------
    | Octane Listeners
    |--------------------------------------------------------------------------
    |
    | All of the event listeners for Octane's internal events should be done
    | here. Or, you may specify the fully qualified class name of the
    | listener if you do not want to use a closure for the listener.
    |
    */

    'listeners' => [
        WorkerStarting::class => [
            'EnsureUserIsAuthenticated',
        ],

        RequestReceived::class => [
            //
        ],

        RequestHandled::class => [
            //
        ],

        RequestTerminated::class => [
            //
        ],

        TaskReceived::class => [
            //
        ],

        TaskTerminated::class => [
            //
        ],

        TickReceived::class => [
            //
        ],

        TickTerminated::class => [
            //
        ],

        WorkerErrorOccurred::class => [
            //
        ],

        WorkerStopping::class => [
            //
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Warm / Flush Bindings
    |--------------------------------------------------------------------------
    |
    | The bindings listed below will either be pre-warmed when a worker boots
    | or flushed before every new request. Flushing a binding will force
    | the container to resolve that binding again when asked.
    |
    */

    'warm' => [
        ...Laravel\Octane\Octane::defaultServicesToWarm(),
    ],

    'flush' => [
        //
    ],

    /*
    |--------------------------------------------------------------------------
    | Octane Cache Driver
    |--------------------------------------------------------------------------
    |
    | When using Octane, you may use the "octane" cache driver to allow for
    | high-speed access to cache values. This driver handles the caching
    | of values in shared memory, making them instantly accessible.
    |
    */

    'cache' => [
        'rows' => 1000,
        'bytes' => 10000,
    ],

    /*
    |--------------------------------------------------------------------------
    | Octane Tables
    |--------------------------------------------------------------------------
    |
    | While using Swoole, you may define "tables" here. Tables allow sharing
    | data between the workers of your server. This can be used to cache
    | data found in your database configuration/migrations for example.
    |
    */

    'tables' => [
        'example:1000' => [
            'name' => 'string:1000',
            'votes' => 'int',
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | File Watching
    |--------------------------------------------------------------------------
    |
    | The following list of files and directories will be watched when using
    | the --watch option offered by Octane. If any of the files change,
    | Octane will automatically reload your application workers.
    |
    */

    'watch' => [
        'app',
        'bootstrap',
        'config',
        'database',
        'public/**/*.php',
        'resources/**/*.php',
        'routes',
        'composer.lock',
        '.env',
    ],

    /*
    |--------------------------------------------------------------------------
    | Garbage Collection Threshold
    |--------------------------------------------------------------------------
    |
    | When using Swoole, this value tells Octane how many requests must be
    | handled before the garbage collector is called. You may adjust this
    | value based on the memory constraints and needs of your app.
    |
    */

    'garbage' => 50,

    /*
    |--------------------------------------------------------------------------
    | Max Execution Time
    |--------------------------------------------------------------------------
    |
    | The following setting configures the maximum execution time for requests
    | handled by Octane. You may adjust this value based on the needs of
    | your application. This value is measured in seconds.
    |
    */

    'max_execution_time' => 30,

];
