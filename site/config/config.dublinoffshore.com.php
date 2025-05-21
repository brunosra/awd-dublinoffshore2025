<?php

use tobimori\DreamForm\Support\Menu;

return [    
  'debug'  => false,

  	'cache' => [
		'pages' => [
		'active' => true,
		'ignore' => function ($page) {
			return $page->title()->value() === 'Contact';
		  }
		  ]
	  ],

  'tobimori.seo.canonicalBase' => 'https://dublinoffshore.com',
  'tobimori.seo.lang' => 'en_US',

  'tobimori.dreamform' => [
    'guards' => [
      'available' => ['csrf', 'honeypot', 'turnstile', 'ratelimit', /* other guards here */ ],
      // 'turnstile' => [
      //   'siteKey' => fn () => env('0x4AAAAAAAbm4RTSOnv_Bgob'),
      //   'secretKey' =>  fn () => env('0x4AAAAAAAbm4ZoYA1-4Ks2-omRwusYJZlY')
      // ],
      'ratelimit' => [
        'limit' => 10,
        'interval' => 3
      ]
    ],
  ],

  'email' => [
    'transport' => [
      'type' => 'smtp',
      'host' => 'smtp-mail.outlook.com',
      'port' => 587,
      'security' => true,
      'auth' => true,
      'username' => 'sayhello@dublinoffshore.ie',
      'password' => 'e2ytxEXw!kK7GYy'
    ]
  ],
];


