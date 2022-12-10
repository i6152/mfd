<div class="container" style="font-size: .8rem">
    <h1>
        Hakkımızda sayfası...
    </h1>
    <?php
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