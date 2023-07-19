<?php

return [
    'default' => [
        'enabled'                   => env('MFA_ENABLED', true),
        'template'                  => 'laravel-mfa::mfa.form',
        'mfa_expires_in_hours'      => env('MFA_EXPIRES', 24), // Instance: now()->add(hours($value)) - PHP Carbon instance
        'code_expire_after_minutes' => 10,
        'login_route'               => 'login',  // Route name
        /* Route after successfully verified.
           Uncomment if you want to define,
           otherwise app.url will be used. */
        // 'verified_route' => 'homepage',
        'auth_user_closure' => function () {
            return \Illuminate\Support\Facades\Auth::user();
        },
        'email' => [
            'queue'    => false, // If your app has a queue:work daemon, you can change it to true.
            'template' => 'laravel-mfa::emails.authentication-code',
            'subject'  => 'Login authentication code',
        ],
    ],

    'group' => [ // Example of override default configs
        'admin' => [ // Middleware: 'mfa:admin'
            'login_route'       => 'admin.login',
            'auth_user_closure' => function () {
                return \Encore\Admin\Facades\Admin::user();
            },
        ],
    ],
];
