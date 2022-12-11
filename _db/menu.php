<?php
$defaultTemaID=1;

$arrMenu = [
    [
        'id' => 1,
        'baslik' => 'Anasayfa',
        'link' => '',
        'sub' => null,
        'lang' => 'tr',
    ],
    [
        'id' => 2,
        'baslik' => 'Hakkımızda',
        'link' => 'hakkimizda',
        'embedList'=>['css'=>[
                $base_url.'assets/css/hakkimizda.css',
                $base_url.'assets/css/hakkimizda.min.css'
            ], 'js'=>[
                $base_url.'assets/js/hakkimizda.js',
                $base_url.'assets/js/hakkimizda.min.js'
            ]
        ],
        'sub' => null,
        'lang' => 'tr',
        //burada istersen sayfaya özel bir tema id tut ve ona göre istek at...
        'template' => [
            'tema' => ($arrTema[$defaultTemaID] ? $arrTema[$defaultTemaID] : []),
        ]
    ],
    [
        'id' => 3,
        'baslik' => 'Blog',
        'link' => 'blog',
        'detay' => 'detayId',
        //detaySeoTitle, detaySeoDescription => db'den veya diziden gelen elemanlardan hangisini titlede kullanmak istediğini yazmalısın
        'detaySeoTitle'=>'title',
        'detaySeoDescription'=>'body',
        'dbPage'=>'_db/blogListDb.php',
        'dbListFn'=>'blogListCek',
        'dbDetayFn'=>'blogDetayCek',
        'embedList'=>['css'=>[
                $base_url.'assets/css/blog.css',
                $base_url.'assets/css/blog.min.css'
            ], 'js'=>[
                $base_url.'assets/js/blog.js',
                $base_url.'assets/js/blog.min.js'
            ]
        ],
        'sub' => null,
        'lang' => 'tr',
        'template' => [
            'tema' => ($arrTema[$defaultTemaID] ? $arrTema[$defaultTemaID] : []),
        ]
    ],
    [
        'id' => 4,
        'baslik' => 'Haberler',
        'link' => 'haberler',
        'detay' => 'detayId',
        'sub' => null,
        'lang' => 'tr'
    ],
    [
        'id' => 5,
        'baslik' => 'Kurumsal',
        'link' => 'kurumsal',
        'sub' => [
            [
                'id' => 51,
                'baslik' => 'Hakkımızda',
                'link' => 'hakkimizda',
                'sub' => null,
                'lang' => 'tr'
            ],
            [
                'id' => 52,
                'baslik' => 'Biz Kimiz',
                'link' => 'biz-kimiz',
                'sub' => null,
                'lang' => 'tr'
            ],
            [
                'id' => 53,
                'baslik' => 'Neden Biz?',
                'link' => 'neden-biz',
                'sub' => null,
                'lang' => 'tr'
            ]
        ]
    ],
    [
        'id' => 6,
        'baslik' => 'İletişim',
        'link' => 'iletisim',
        'sub' => null,
        'lang' => 'tr'
    ],
];
