<?php

// Config for yuges/subscribable

return [
    /*
     * FQCN (Fully Qualified Class Name) of the models to use for subscriptions
     */
    'models' => [
        'plan' => [
            'key' => Yuges\Package\Enums\KeyType::BigInteger,
            'class' => Yuges\Subscribable\Models\Plan::class,
        ],
        'feature' => [
            'key' => Yuges\Package\Enums\KeyType::BigInteger,
            'class' => Yuges\Subscribable\Models\Feature::class,
        ],
        'subscriber' => [
            'key' => Yuges\Package\Enums\KeyType::BigInteger,
            'default' => [
                'class' => \App\Models\User::class,
            ],
            'allowed' => [
                'classes' => [
                    \App\Models\User::class,
                ]
            ],
        ],
        'subscribable' => [
            'key' => Yuges\Package\Enums\KeyType::BigInteger,
            'default' => [
                'class' => \App\Models\User::class,
            ],
            'allowed' => [
                'classes' => [
                    \App\Models\User::class,
                ],
            ],
        ],
        'subscription' => [
            'key' => Yuges\Package\Enums\KeyType::BigInteger,
            'class' => Yuges\Subscribable\Models\Subscription::class,
        ],
    ],

    'permissions' => [],

    'actions' => [
        'create' => Yuges\Subscribable\Actions\CreateSubscriptionAction::class,
        'delete' => Yuges\Subscribable\Actions\DeleteSubscriptionAction::class,
        'toggle' => Yuges\Subscribable\Actions\ToggleSubscriptionAction::class,
    ],
];
