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


$list = [
    2 => [
        'header'=>null,
        'breadCrumb'=>null,
        'subMenu'=>null,
        'footer'=>null,
        'dosya' => '_pages/hakkimizda.php',
        'class' => null,
        'function' => null
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