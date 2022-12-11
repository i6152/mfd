<?php
/* base url li taşı .... */
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

include('function.php');
$sureSayac=new sureSayac();
include('_db/index.php');
include('_components/index.php');
include('_defined.php');

# $_COOKIE['lang']='tr';
#paylaşımlarda get'e link ekle

$score=$sureSayac->bitir(5);

?>
<!doctype html>
<html lang="<?php echo $dilEkle ?>" class="h-100">

<head>
    <title><?php echo (isset($mevcutSayfa['seo']['title'])?$mevcutSayfa['seo']['title']:'NoTitle') ?></title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <?php
    foreach($embedList['head']['css'] as $headCss){
        ?><link rel="stylesheet" href="<?php echo $headCss ?>"><?php
    }
    ?> 
    <?php
    foreach($embedList['head']['js'] as $headJs){
        ?><script src="<?php echo $headJs ?>"></script><?php
    }
    ?>

</head>
<body class="d-flex flex-column h-100">
    <?php
    if(isset($componentList['header']['dosya']) && file_exists($componentList['header']['dosya'])){
        include($componentList['header']['dosya']);
        if(function_exists($componentList['header']['function'])){
            $componentList['header']['function']();
        }
    } 
    ?>
    <main>
        <?php
        if(isset($componentList['breadCrumb']['dosya']) && file_exists($componentList['breadCrumb']['dosya'])){
            include($componentList['breadCrumb']['dosya']);

            if(function_exists($componentList['breadCrumb']['function'])){
                $componentList['breadCrumb']['function']();
            }
        }

        /**
         * burası 
         * _db/sayfaIcerigi.php
         * altındaki diziden çalışıyor
         */
        if(isset($componentList['sayfaDetay']['dosya']) && file_exists($componentList['sayfaDetay']['dosya'])){
            include($componentList['sayfaDetay']['dosya']);
        }
        else{
            var_dump('sayfa yolu göster :)');
            sayfa404(false, ['baslik'=>'Aradığınız sayfa hazır değildir.', 'mesaj'=>'aradığınız sayfa menüde tanımlı fakat sayfa içeriği hazır değildir.']);
        }
        ?>
    </main>
    <?php
    
    /**
     * burayı sonradan newsletter çevirdim
     */
    if(isset($componentList['subMenu']['dosya']) && file_exists($componentList['subMenu']['dosya'])){
        include($componentList['subMenu']['dosya']);

        if(function_exists($componentList['subMenu']['function'])){
            $componentList['subMenu']['function']();
        }
    }

    if(isset($componentList['footer']['dosya']) && file_exists($componentList['footer']['dosya'])){
        include($componentList['footer']['dosya']);

        if(function_exists($componentList['footer']['function'])){
            $componentList['footer']['function']();
        }
    }

    ?>

    <?php
    foreach($embedList['footer']['js'] as $footJs){
        ?><script src="<?php echo $footJs ?>"></script><?php
    }
    ?>
</body>

</html>