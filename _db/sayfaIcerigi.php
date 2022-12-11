<?php
/**
 * istersen buradan özel bir header, footer vs. yollayıp
 * 
 * _defined.php içerisinde ki
 * #region Component Listesi
 *  $componentList = [
 * içeriğinde kontrollerini sağlayıp custom bir header yollatabilirsin.
 * 
 * mesela blog sayfasının headerı tema header'ından farklı olabilir... 
 * veya haberler sayfasının footer'ı sayfa temasından farklı olabilir...
 * 
 * 
 * Not: buradaki list[***] ilgili sayfanın id'si olması gerekiyor...
 */

/**
 * content
 * sıralama fonksiyonu yazılmadı 
 * diziye eklenme sırasına göre çekiyor
 * content:aktif -> eğer yok ise veya true - 1 ise gösterir false ise göstermez...
 */
$list = [
    2 => [
        'header'=>null,
        'breadCrumb'=>null,
        'subMenu'=>null,
        'footer'=>null,
        'dosya' => '_pages/hakkimizda.php',
        'class' => null,
        'function' => null,
        'content'=>[
            1=>[
                'id'=>1,
                'sira'=>1,
                'adi'=>'slider',
                'description'=>'hakkimizda slider',
                'page'=>null,
                'function'=>'hakkimizdaSliderCek',
                'aktif'=>1
            ],
            2=>[
                'id'=>2,
                'sira'=>2,
                'adi'=>'hakkimizda açıklama',
                'description'=>'hakkımızda açıklama',
                'page'=>null,
                'function'=>'hakkimizdaAciklamaCek',
                'aktif'=>1
            ],
            3=>[
                'id'=>3,
                'sira'=>3,
                'adi'=>'alt yazı',
                'description'=>'alt yazı',
                'page'=>null,
                'function'=>'hakkimizdaAltYaziCek',
                'aktif'=>1
            ],
            4=>[
                'id'=>4,
                'sira'=>4,
                'adi'=>'hakkımızda rakamlar',
                'description'=>'hakkimizda rakamlar',
                'page'=>null,
                'function'=>'hakkimizdaRakamlarCek',
                'aktif'=>1
            ],
        ]
    ],
    3 => [
        'header'=>null,
        'breadCrumb'=>null,
        'subMenu'=>null,
        'footer'=>null,
        'dosya' => '_pages/blog.php',
        'class' => null,
        'function' => null
    ],
];