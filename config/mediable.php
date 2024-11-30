<?php

return [
    /*
     * Filesystem disk to use if none is specified
     */
    'disk' => env('MEDIABLE_DISK', 'public'),

    /*
     * FQCN (Fully Qualified Class Name) of the model to use for media
     */
    'model' => Yuges\Mediable\Models\Media::class,

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
    ],
];
