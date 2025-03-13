<?php

// Config for yuges/subscribable

use Yuges\Package\Enums\KeyType;

return [
    /*
     * FQCN (Fully Qualified Class Name) of the models to use for subscriptions
     */
    'models' => [
        'plan' => [
            'key' => KeyType::Ulid,
            'class' => Yuges\Subscribable\Models\Plan::class,
        ],
        'feature' => [
            'key' => KeyType::Ulid,
            'class' => Yuges\Subscribable\Models\Feature::class,
        ],
        'subscriber' => [
            'key' => KeyType::Ulid,
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
            'key' => KeyType::Ulid,
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
            'key' => KeyType::Ulid,
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
