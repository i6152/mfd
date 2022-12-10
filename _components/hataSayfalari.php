<?php

$arrHata=['404page', '402page', '401page', '500page', 'vserror'];

if(isset($_GET['hata']) && in_array($_GET['hata'], $arrHata)){
    if($_GET['hata']=='404page'){
        sayfa404();
        die();
    }
    else if($_GET['hata']=='500page'){
        sayfa500();
        die();
    }
}

function sayfa404($htmlYukle=false, $header=['baslik'=>null, 'mesaj'=>null]){
    http_response_code(404);

    echo '<div class="container">';
    
    var_dump('404 sayfasi');
    echo '<pre>';

    print_r([
        'request'=>$_REQUEST,
        'ishtml'=>$htmlYukle,
        'header'=>$header,
        'cookie'=>$_COOKIE,
        'session'=>@$_SESSION
    ]);
    echo '</div>';
    if($htmlYukle) die();
}

function sayfa500(){
    http_response_code(500);
    var_dump('500 sayfasi');

    die();
}