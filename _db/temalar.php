<?php

//temaların listesi
$arrTema=[
    1=>[
        'id'=>1,
        'description'=>'demo başlıklı içeriklerin teması 2,2,2,2 ile çalışıyor....',
        'tema_dizin'=>'_tema/tema1/',
        'dark_mode'=>0,
        'header'=>2,
        'breadCrumb'=>2,
        'subMenu'=>2,
        'footer'=>2
    ]
];

/**
 * header için ->
 * _components/index.php
 * içinde tanımlama dizisine içerik ekle
 * 
 * 1=>[
 *  'id'=>1,
 *  'dosya' => '_components/header/ornek.php',
 *  'function' => 'ornekHeader',
 * ],
 */

 /**
  * footer, submenu, breadcrumbs aynı mantıkta çalışıyor..
  */