<?php

$arrMenu = [
    [
        'id' => 1,
        'baslik' => 'Anasayfa',
        'link' => '',
        'sub' => null,
        'lang' => 'tr'
    ],
    [
        'id' => 2,
        'baslik' => 'Hakkımızda',
        'link' => 'hakkimizda',
        'sub' => null,
        'lang' => 'tr',
        'template' => [
            'tema' => [
                # _db/temalar.php -> den eşleştir burada sadece id tt
                'id' => 1,
                'dizin' => '',
                'title' => '_db/temalar.php -> den eşleştir burada sadece id tut'
            ],
            'custom'=>[
                //... header, footer, vs özel bir id varsa öncelikli çalışacak...
            ]
        ]
    ],
    [
        'id' => 3,
        'baslik' => 'Blog',
        'link' => 'blog',
        'detay' => 'detayId',
        'sub' => null,
        'lang' => 'tr'
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
