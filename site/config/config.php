<?php

use tobimori\DreamForm\Support\Menu;

return [
    'debug' => true,
    'yaml.handler' => 'symfony',

    'panel.menu' => fn () => [
        'site' => Menu::site(),
        'forms' => Menu::forms(),
        'users',
        'system',
    ],

    'auth' => [
			'methods' => ['password', 'password-reset']
	],

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

   'routes' => [
    [
      'pattern' => 'sitemap.xml',
      'action'  => function() {
          $pages = site()->pages()->index();

          // fetch the pages to ignore from the config settings,
          // if nothing is set, we ignore the error page
          $ignore = kirby()->option('sitemap.ignore', ['error']);

          $content = snippet('sitemap', compact('pages', 'ignore'), true);

          // return response with correct header type
          return new Kirby\Cms\Response($content, 'application/xml');
      }
    ],
    [
      'pattern' => 'get-pdf',
      'method' => 'POST',
      'action' => function() {
        global $sys_path;
        $sys_path = str_replace("/site/config", "", str_replace("\\", "/", __DIR__));
        include "{$sys_path}/pdf/pdf.php";
        return new Kirby\Cms\Response(json_encode(prepare_and_save()), 'application/json');
      }
    ],
    [
      'pattern' => 'sitemap',
      'action'  => function() {
        return go('sitemap.xml', 301);
      }
    ]
  ],
  'sitemap.ignore' => ['error'],

  'cache' => [
    'pages' => false 
	],
];
