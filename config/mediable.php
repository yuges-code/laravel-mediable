<?php

use Yuges\Image\Enums\ImageDriver;

return [
    /*
     * Filesystem disk to use if none is specified
     */
    'disk' => env('MEDIABLE_DISK', 'public'),

    /*
     * FQCN (Fully Qualified Class Name) of the model to use for media
     */
    'models' => [
        'media' => Yuges\Mediable\Models\Media::class,
    ],

    'drivers' => [
        'image' => ImageDriver::Imagick,
    ],

    'queue' => [
        'name' => env('MEDIABLE_QUEUE', ''),
        'connection' => env('QUEUE_CONNECTION', 'sync'),
    ],

    'conversion' => [
        'queue' => [
            'default' => true,
            'commit' => 'after',
        ]
    ],

    /*
     * The maximum file size in bytes for a single uploaded file.
     */
    'max_file_size' => 1024 * 1024 * 10, // 10MB

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
        'resposive' => [
            'default' => Yuges\Mediable\Generators\Placeholder\DefaultPlaceholderGenerator::class,
            'custom' => [
                // generators
            ],
        ],
    ],
];
