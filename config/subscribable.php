<?php

// Config for yuges/subscribable
return [
    /*
     * FQCN (Fully Qualified Class Name) of the models to use for comments
     */
    'models' => [
        'plan' => [
            'key' => 'ulid',
            'class' => Yuges\Subscribable\Models\Plan::class,
        ],
        'feature' => [
            'key' => 'ulid',
            'class' => Yuges\Subscribable\Models\Feature::class,
        ],
        'subscriber' => [
            'key' => 'ulid',
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
            'key' => 'ulid',
            'allowed' => [
                'classes' => [
                    \App\Models\User::class,
                ],
            ],
        ],
        'subscription' => [
            'key' => 'ulid',
            'class' => Yuges\Reactable\Models\Reaction::class,
        ],
    ],

    'permissions' => [
        'anonymous' => false,
        'duplicate' => false,
    ],

    'actions' => [
        'create' => Yuges\Reactable\Actions\CreateReactionAction::class,
        'toggle' => Yuges\Reactable\Actions\ToggleReactionAction::class,
    ],
];
