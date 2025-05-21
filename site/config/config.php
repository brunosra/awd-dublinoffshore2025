<?php

return [
    'debug' => true,
    'yaml.handler' => 'symfony', // already makes use of the more modern Symfony YAML parser: https://getkirby.com/docs/reference/system/options/yaml (will become the default in a future Kirby version)

    'auth' => [
			'methods' => ['password', 'password-reset']
	],

    // 'timnarr.imagex' => [
    //     'cache' => true,
    //     'customLazyloading' => false,
    //     'formats' => ['avif', 'webp'],
    //     'includeInitialFormat' => false,
    //     'noSrcsetInImg' => false,
    //     'relativeUrls' => false,
    // ],

    'thumbs' => [
        'srcsets' => [
            'default' => [
                '300w'  => ['width' => 300],
                '600w'  => ['width' => 600],
                '900w'  => ['width' => 900],
                '1200w' => ['width' => 1200],
                '1800w' => ['width' => 1800]
            ],
            'avif' => [
                '300w'  => ['width' => 300, 'format' => 'avif'],
                '600w'  => ['width' => 600, 'format' => 'avif'],
                '900w'  => ['width' => 900, 'format' => 'avif'],
                '1200w' => ['width' => 1200, 'format' => 'avif'],
                '1800w' => ['width' => 1800, 'format' => 'avif']
            ],
            'webp' => [
                '300w'  => ['width' => 300, 'quality' => 80,  'sharpen' => 10, 'format' => 'webp'],
                '600w'  => ['width' => 600, 'quality' => 80,  'sharpen' => 10, 'format' => 'webp'],
                '900w'  => ['width' => 900, 'quality' => 80,  'sharpen' => 10, 'format' => 'webp'],
                '1200w' => ['width' => 1200, 'quality' => 80,  'sharpen' => 10, 'format' => 'webp'],
                '1800w' => ['width' => 1800, 'quality' => 80,  'sharpen' => 10, 'format' => 'webp']
            ],
        ]
    ],

    'cache' => [
    'pages' => false 
	]


];
