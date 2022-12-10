<?php
#region Base URL İşlemleri
$local = 'localhost';
$localIp = [
    '192.168.0.1',
    '192.168.0.2'
];
$domain = 'mfd';

//SERVER_NAME, HTTP_HOST
$serverBilgisi = (isset($_SERVER['HTTP_HOST'])) ? 'HTTP_HOST' : 'SERVER_NAME';
if ($_SERVER[$serverBilgisi] == $local || in_array($_SERVER[$serverBilgisi], $localIp)) {
    $base_urls = 'http://' . $_SERVER[$serverBilgisi] . '/' . $domain;
    $base_url = $base_urls . '/';
} else {
    $base_urls = ((!$_SERVER['SERVER_PORT'] != 443) ? 'http' : 'https') . '://' . $_SERVER[$serverBilgisi] . '/' . $domain;
    $base_url = $base_urls . '/';
}
#endregion Base URL İşlemleri

#region Sayfa Bulma
$mevcutSayfa = null;
if (isset($_REQUEST['sayfa'])) {
    foreach ($arrMenu as $vrMenu) {
        if ($_REQUEST['sayfa'] == $vrMenu['link']) {
            # if(isset($vrMenu['detay']))
            if (isset($vrMenu['sub']) && $_REQUEST['altSayfa']) {
                foreach ($vrMenu['sub'] as $vrAltS => $vrMenuAlt) {
                    if ($_REQUEST['altSayfa'] == $vrMenuAlt['link']) {
                        $vrMenu['sub'] = $vrMenu['sub'][$vrAltS];
                        break;
                    } else {
                        unset($vrMenu['sub'][$vrAltS]);
                    }
                }

                if (count($vrMenu['sub']) == 0) {
                    sayfa404(true, ['baslik' => 'soft 404', 'mesaj' => 'Uygunsuz Sub Menu, soft 404']);
                }
            } else {
                unset($vrMenu['sub']);
            }

            if (isset($vrMenu['sub'])) {
                unset($vrMenu['sub']['sub']);
                $mevcutSayfa = $vrMenu['sub'];
                unset($vrMenu['sub']);
                $mevcutSayfa['topPage'] = $vrMenu;
            } else $mevcutSayfa = $vrMenu;

            break;
        }
    }


    if ($mevcutSayfa == null) {
        echo '<pre>';
        print_r($_REQUEST);
        # print_r($arrMenu);
        sayfa404(true, ['baslik' => 'soft 404', 'mesaj' => 'aradık, taradık, çok ama çok uğraştık, ama aradığınız linki veritabanımızdan eşleştiremedik :D']);
    }
    //die();
}

#endregion Sayfa Bulma

#region SEO İşlemleri
//buraya gelmeden önce bir sayfa kontrolü yapılıp custom meta kullanabilir ve özel bir custom meta oluşturabilirsin..

$customMeta = [
    'title' => 'Hakkımızda Title',
    'keywords' => 'keywords, vs, code',
    'description' => 'description',
    'og' => [
        'title' => 'og title',
        'description' => 'og description',
        'image' => 'https://via.placeholder.com/350x150',
        'image:type' => 'image/png',
        'image:alt' => 'image alt'
    ],
    'canonical' => '/hakkimizda'
];

if ($mevcutSayfa != null) {
    if (isset($arrSeo[$mevcutSayfa['id']])) {
        $mevcutSayfa['seo'] = $arrSeo[$mevcutSayfa['id']];

        /**
         * ilgili kontroller yapılıp hatalı bir içerik varmı diye detay eklenebilir...
         * 
         * foreach ile $mevcutSayfa[seo] döngüye alınıp tek tek atama yapmak daha sağlıklı bir sonuç döndürecektir..
         */

        $customMeta = $mevcutSayfa['seo'];
    }
}
#endregion

#region BreadCrumb Oluştur
$breadCrumb = [];
if($mevcutSayfa!=null){
    $breadCrumb[] = ['sayfa' => 'Anasayfa', 'link' => ''];
    if (isset($mevcutSayfa['topPage'])) {
        $breadCrumb[] = ['sayfa' => $mevcutSayfa['topPage']['baslik'], 'link' => $mevcutSayfa['topPage']['link']];
        $breadCrumb[] = ['sayfa' => $mevcutSayfa['baslik'], 'link' => $mevcutSayfa['topPage']['link'] . '/' . $mevcutSayfa['link']];
    } else if (false) {
        //detaylı sayfaları çalıştır burada
    } else if (isset($mevcutSayfa['baslik'])) {
        $breadCrumb[] = ['sayfa' => $mevcutSayfa['baslik'], 'link' => $mevcutSayfa['link']];
    }
}
#endregion BreadCrumb Oluştur

#region Component Listesi
$componentList = [
    'header' => (isset($headerList[1]))?$headerList[1]:[],
    'breadCrumb' => (isset($breadCrumbList[1]))?$breadCrumbList[1]:[],
    'subMenu' => [
        'dosya' => null,
        'function' => null,
    ],
    'footer' => [
        'dosya' => null,
        'function' => null,
    ],
    'sayfaDetay'=>$list['hakkimizda']
];
#endregion Component Listesi

#region Css Jss List
$embedList = [
    'head' => [
        'css' => [
            'https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css'
        ],
        'js' => [
            'https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.1/jquery.min.js'
        ]
    ],
    'footer' => [
        'js' => [
            'https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js',
            'https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.min.js'
        ]
    ]
];
#region Css Jss List