<?php /*print_r($_REQUEST)*/ ?>
<div class="container" style="font-size: .8rem">
    <?php var_dump('sayfa yolu göster :)'); ?>
    <h1>
        Blog sayfası...
    </h1>
    <?php
    if(isset($mevcutSayfa['icerikDetay'])){
        echo '<div style="width:100%;border:1px dashed;padding:10px 30px">';
        echo '<h2> Blog Detayı.... </h2>';
        preYaz($mevcutSayfa['icerikDetay']);
        echo '</div>';
    }
    else if(isset($mevcutSayfa['icerikList'])) preYaz($icerikList, 'border-bottom:1px solid rgba(0,0,0,.5);margin-bottom:50px;max-height:400px');
    

    if ($mevcutSayfa !== null) {
        echo '<pre>';
        print_r($mevcutSayfa);
        echo '<hr>';
        # print_r($arrMenu);
    } else {
        echo 'anasayfa';
    }
    /* 
var_dump('wait');
echo '<pre>';
print_r($_REQUEST);
print_r($arrMenu);
*/
    # echo preYaz(50);
    ?>

</div>