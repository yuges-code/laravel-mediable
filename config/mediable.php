<?php

// Config for yuges/mediable

return [
    /*
     * Filesystem disk to use if none is specified
     */
    'disk' => env('MEDIABLE_DISK', 'public'),

    /*
     * FQCN (Fully Qualified Class Name) of the model to use for media
     */
    'models' => [
        'media' => [
            'key' => Yuges\Package\Enums\KeyType::BigInteger,
            'table' => 'media',
            'class' => Yuges\Mediable\Models\Media::class,
            'observer' => Yuges\Mediable\Observers\MediaObserver::class,
        ],
        'mediable' => [
            'key' => Yuges\Package\Enums\KeyType::BigInteger,
            'default' => [
                'class' => \App\Models\User::class,
            ],
            'allowed' => [
                'classes' => [
                    \App\Models\User::class,
                ],
            ],
            'relation' => [
                'name' => 'mediable',
            ],
            'observer' => Yuges\Mediable\Observers\MediableObserver::class,
        ],
    ],

    'drivers' => [
        'image' => Yuges\Image\Enums\ImageDriver::Imagick,
    ],

    'queue' => [
        'name' => env('MEDIABLE_QUEUE', ''),
        'connection' => env('QUEUE_CONNECTION', 'sync'),
    ],

    'conversion' => [
        'job' => Yuges\Mediable\Jobs\GenerateConversionJob::class,
        'queue' => [
            'default' => true,
            'commit' => 'after',
        ]
    ],
    'placeholder' => [
        'job' => Yuges\Mediable\Jobs\GeneratePlaceholderJob::class,
        'queue' => [
            'default' => true,
            'commit' => 'after',
        ],
        'generate' => false,
    ],
    'responsive' => [
        'job' => Yuges\Mediable\Jobs\GenerateResponsiveJob::class,
        'queue' => [
            'default' => true,
            'commit' => 'after',
        ],
        'generate' => false,
        'calculator' => [
            'coefficient' => 0.5,
        ]
    ],

    'file' => [
        'size' => [
            'min' => 0, // 0MB
            'max' => 1024 * 1024 * 10, // 10MB
        ],
    ],

    /*
     * Generators.
     */
    'generators' => [
        'url' => [
            'default' => Yuges\Mediable\Generators\Url\DefaultUrlGenerator::class,
            'custom' => [
                // generators
            ],
        ],
        'path' => [
            'default' => Yuges\Mediable\Generators\Path\DefaultPathGenerator::class,
            'custom' => [
                // generators
            ],
        ],
        'name' => [
            'default' => Yuges\Mediable\Generators\Name\DefaultNameGenerator::class,
            'custom' => [
                // generators
            ],
        ],
        'conversion' => [
            'default' => Yuges\Mediable\Generators\Conversion\DefaultConversionGenerator::class,
            'custom' => [
                // generators
            ],
        ],
        'placeholder' => [
            'default' => Yuges\Mediable\Generators\Placeholder\DefaultPlaceholderGenerator::class,
            'custom' => [
                // generators
            ],
        ],
        'responsive' => [
            'default' => Yuges\Mediable\Generators\Responsive\DefaultResponsiveGenerator::class,
            'custom' => [
                // generators
            ],
            'calculator' => [
                'default' => Yuges\Mediable\Generators\Responsive\Calculator\DefaultWidthCalculator::class,
                'custom' => [
                    // generators
                ],
            ]
        ],
    ],
];
