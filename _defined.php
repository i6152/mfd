<?php
$getParca=getParcala();

#region Dil Ayarları
    $dilDestek=['tr', 'en', 'de'];
    $dilDefault='tr';
    if(isset($getParca['dil']) && in_array($getParca['dil'], $dilDestek)){
        setcookie('lang', $getParca['dil'], time() + (60*60*24*365));

        $uri=str_replace(['dil='.$getParca['dil']], [], $_SERVER["REQUEST_URI"]);

        if(in_array(substr($uri,-1), ['?', '&'])) $uri=substr($uri, 0, -1);
        if(in_array(substr($uri,-1), ['?', '&'])) $uri=substr($uri, 0, -1);
      
        header('Location:'.$uri, true, 302);
    }

    $dilEkle=(isset($_COOKIE['lang']) && in_array($_COOKIE['lang'], $dilDestek))?$_COOKIE['lang']:$dilDefault;
#endregion Dil Ayarları

#region Sayfa Bulma
    $mevcutSayfa = null;
    /**
     * 
     * İçerik Listelerinde Sayfalama için
     * $baslangic=0;
     * $bitis=5;
     */
    $baslangic=0;
    $bitis=5;

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

                #region Detay Sayfa Bulma ve İçerikleri Çekme 
                    /**
                     * 
                     * burada fn ve özel dosya yapısı kullanıldı 
                     * 
                     * ister curl, fgc isteği
                     * ister db bağlantısı ile response dön
                     * istersende düz bir diziden cevap dön...
                     * 
                     */
                    $icerikDetay=null;
                    if(isset($vrMenu['dbPage']) && file_exists($vrMenu['dbPage'])){
                        include($vrMenu['dbPage']);
                    }
                    if(isset($vrMenu['detay']) && isset($_REQUEST[$vrMenu['detay']])){
                        // die($_REQUEST[$vrMenu['detay']]);

                            if(isset($vrMenu['dbDetayFn']) && function_exists($vrMenu['dbDetayFn'])){
                                $icerikDetay=$vrMenu['dbDetayFn']($_REQUEST[$vrMenu['detay']]);
                                
                                if(is_array($icerikDetay)){
                                    $mevcutSayfaEkle['icerikDetay']=$icerikDetay;
                                }
                            }
                    }

                    if($icerikDetay==null && isset($vrMenu['dbListFn']) && function_exists($vrMenu['dbListFn'])){
                        $icerikList=$vrMenu['dbListFn']($baslangic, $bitis);
                        if($icerikList!=null && count($icerikList)>0){
                            $mevcutSayfaEkle['icerikList']=$icerikList;
                        }
                    }
                #endregion
                // var_dump($vrMenu);
                // die();

                if (isset($vrMenu['sub'])) {
                    unset($vrMenu['sub']['sub']);
                    $mevcutSayfa = $vrMenu['sub'];
                    unset($vrMenu['sub']);
                    $mevcutSayfa['topPage'] = $vrMenu;
                } else $mevcutSayfa = $vrMenu;

                if(isset($mevcutSayfaEkle)){
                    foreach($mevcutSayfaEkle as $vrS => $vrD){
                        $mevcutSayfa[$vrS]=$vrD;
                    }
                }

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

            
            if($icerikDetay!=null){
                if(isset($icerikDetay[$mevcutSayfa['detaySeoTitle']]) && $icerikDetay[$mevcutSayfa['detaySeoTitle']]!=''){
                    $mevcutSayfa['seo']['title']=$icerikDetay[$mevcutSayfa['detaySeoTitle']];
                }
            }
            /**
             * ilgili kontroller yapılıp hatalı bir içerik varmı diye detay eklenebilir...
             * 
             * foreach ile $mevcutSayfa[seo] döngüye alınıp tek tek atama yapmak daha sağlıklı bir sonuç döndürecektir..
             */

            $customMeta = $mevcutSayfa['seo'];
        }
        
        if($icerikDetay!=null){
            if(isset($icerikDetay[$mevcutSayfa['detaySeoTitle']]) && $icerikDetay[$mevcutSayfa['detaySeoTitle']]!=''){
                $mevcutSayfa['seo']['title']=$icerikDetay[$mevcutSayfa['detaySeoTitle']];
                $customMeta['title']=$icerikDetay[$mevcutSayfa['detaySeoTitle']];
            }
            if(isset($icerikDetay[$mevcutSayfa['detaySeoDescription']]) && $icerikDetay[$mevcutSayfa['detaySeoDescription']]!=''){
                $mevcutSayfa['seo']['description']=$icerikDetay[$mevcutSayfa['detaySeoDescription']];
                $customMeta['description']=$icerikDetay[$mevcutSayfa['detaySeoDescription']];
            }
        }
    }
#endregion

#region BreadCrumb Oluştur
    $breadCrumb = [];
    if ($mevcutSayfa != null) {
        $breadCrumb[] = ['sayfa' => 'Anasayfa', 'link' => ''];
        if (isset($mevcutSayfa['topPage'])) {
            $breadCrumb[] = ['sayfa' => $mevcutSayfa['topPage']['baslik'], 'link' => $mevcutSayfa['topPage']['link']];
            $breadCrumb[] = ['sayfa' => $mevcutSayfa['baslik'], 'link' => $mevcutSayfa['topPage']['link'] . '/' . $mevcutSayfa['link']];
        } else if (isset($mevcutSayfa['icerikDetay']) && isset($mevcutSayfa['detaySeoTitle'])) {
            $breadCrumb[] = ['sayfa' => $mevcutSayfa['baslik'], 'link' => $mevcutSayfa['link']];
            $breadCrumb[] = ['sayfa'=> $mevcutSayfa['icerikDetay'][$mevcutSayfa['detaySeoTitle']], 'link'=>null];
        } else if (false) {
            //detaylı sayfaları çalıştır burada
        } else if (isset($mevcutSayfa['baslik'])) {
            $breadCrumb[] = ['sayfa' => $mevcutSayfa['baslik'], 'link' => $mevcutSayfa['link']];
        }
    }
#endregion BreadCrumb Oluştur

// var_dump($mevcutSayfa['template']['tema']['header']);

#region Component Listesi
    /*
    ($list[$mevcutSayfa['id']]) => 
    'header' => int 1
    'breadCrumb' => int 1
    'footer' => null
    'dosya' => string '_pages/hakkimizda.php' (length=21)
    'class' => null
    'function' => null
    */
    $componentList = [
        'header' => (isset($mevcutSayfa['template']['tema']['header']) && isset($headerList[$mevcutSayfa['template']['tema']['header']])) ? $headerList[$mevcutSayfa['template']['tema']['header']]: $headerList[1],
        'breadCrumb' => (isset($mevcutSayfa['template']['tema']['breadCrumb']) && isset($breadCrumbList[$mevcutSayfa['template']['tema']['breadCrumb']])) ? $breadCrumbList[$mevcutSayfa['template']['tema']['breadCrumb']]:$breadCrumbList[1],
        'subMenu' => (isset($mevcutSayfa['template']['tema']['subMenu']) && isset($subMenuList[$mevcutSayfa['template']['tema']['subMenu']])) ? $subMenuList[$mevcutSayfa['template']['tema']['subMenu']]:$subMenuList[1],
        'footer' => (isset($mevcutSayfa['template']['tema']['footer']) && isset($footerList[$mevcutSayfa['template']['tema']['footer']])) ? $footerList[$mevcutSayfa['template']['tema']['footer']]:$footerList[1],
        'sayfaDetay' => ($mevcutSayfa != null && isset($list[$mevcutSayfa['id']]) ? $list[$mevcutSayfa['id']] : ['error' => 'sayfa detay ayarlanmamış.'])
    ];

    $mevcutSayfa['component'] = $componentList;
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
    if(isset($mevcutSayfa['embedList'])){
        if(isset($mevcutSayfa['embedList']['css']) && is_array($mevcutSayfa['embedList']['css'])){
            foreach($mevcutSayfa['embedList']['css'] as $vrCss){
                $embedList['head']['css'][]=$vrCss;
            }
        }
        if(isset($mevcutSayfa['embedList']['js']) && is_array($mevcutSayfa['embedList']['js'])){
            foreach($mevcutSayfa['embedList']['js'] as $vrJs){
                $embedList['footer']['js'][]=$vrJs;
            }
        }
        
        /**
         * aşağıyı istersen kaldırmayabilirsin.....
         * 
         * ben $mevcutSayfa fazla şişkin gözükmesin diye kaldırdım...
         */
        unset($mevcutSayfa['embedList']);
    }
    $mevcutSayfa['embed'] = $embedList;
#endregion Css Jss List
