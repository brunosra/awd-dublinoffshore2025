<?php

return [
    'debug' => true,
    'yaml.handler' => 'symfony', // already makes use of the more modern Symfony YAML parser: https://getkirby.com/docs/reference/system/options/yaml (will become the default in a future Kirby version)

    'auth' => [
			'methods' => ['password', 'password-reset']
	],

    'timnarr.imagex' => [
        'cache' => true,
        'customLazyloading' => false,
        'formats' => ['avif', 'webp'],
        'includeInitialFormat' => false,
        'noSrcsetInImg' => false,
        'relativeUrls' => false,
    ],

    'thumbs' => [
        'srcsets' => [
            'my-srcset' => [ 
            '400w'  => ['width' =>  400, 'crop' => true, 'quality' => 80],
            '800w'  => ['width' =>  800, 'crop' => true, 'quality' => 80],
            '1200w' => ['width' => 1200, 'crop' => true, 'quality' => 80],
            ],
            'my-srcset-webp' => [
            '400w'  => ['width' =>  400, 'crop' => true, 'quality' => 75, 'format' => 'webp', 'sharpen' => 10],
            '800w'  => ['width' =>  800, 'crop' => true, 'quality' => 75, 'format' => 'webp', 'sharpen' => 10],
            '1200w' => ['width' => 1200, 'crop' => true, 'quality' => 75, 'format' => 'webp', 'sharpen' => 10],
            ],
            'my-srcset-avif' => [ 
            '400w'  => ['width' =>  400, 'crop' => true, 'quality' => 65, 'format' => 'avif', 'sharpen' => 25],
            '800w'  => ['width' =>  800, 'crop' => true, 'quality' => 65, 'format' => 'avif', 'sharpen' => 25],
            '1200w' => ['width' => 1200, 'crop' => true, 'quality' => 65, 'format' => 'avif', 'sharpen' => 25],
            ],
        ]
    ],

    'cache' => [
    'pages' => false 
	]


];
