<?php

namespace App\Http\Kernel;

use Laravel\Sanctum\Http\Middleware\EnsureFrontendRequestsAreStateful;

protected $middlewareGroups = [
    'api' => [EnsureFrontendRequestsAreStateful::class,
        'throttle:api',
        \Illuminate\Routing\Middleware\SubstituteBindings::class],
];
