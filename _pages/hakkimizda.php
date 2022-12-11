<div class="container" style="font-size: .8rem">
    <h1>
        Hakkımızda sayfası...
    </h1>
    <?php
    if ($mevcutSayfa !== null) {
        if(isset($mevcutSayfa['component']['sayfaDetay']['content']) && is_array($mevcutSayfa['component']['sayfaDetay']['content'])){
            foreach($mevcutSayfa['component']['sayfaDetay']['content'] as $vrContent){
                if($vrContent['page']!=null && file_exists($vrContent['page'])){
                    @include($vrContent['page']);
                }

                if($vrContent['function']!=null && function_exists($vrContent['function'])){
                    if(!isset($vrContent['aktif']) || $vrContent['aktif'])
                    $vrContent['function']($vrContent);
                }
            }
        }
        echo '<hr>';
        echo '<pre>';
        print_r($mevcutSayfa);
        echo '<hr>';
        # print_r($arrMenu);

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

<?php

function hakkimizdaSliderCek($vrContent=null){
    ?>
    <div class="container mt-4 p-3 card bg-success text-white" style="border-bottom: 1px dashed rgba(0,0,0,.3)">
        <b>fn: hakkimizdaSliderCek</b>
        <br>burada bir slider olacak...
        <div><?php print_r($vrContent) ?></div>
    </div>
    <?php
}

function hakkimizdaAciklamaCek($vrContent=null){
    global $dilEkle;
    ?>
    <div class="container mt-4 p-3 card bg-info text-white" style="border-bottom: 1px dashed rgba(0,0,0,.3)">
        <b>fn: hakkimizdaAciklamaCek</b>
        <h2 class="text-center"><small>[<?php echo $dilEkle.'_' ?>]</small> Açıklama Başlık</h2>
        <h6><small>[<?php echo $dilEkle.'_' ?>]</small>&nbsp;&nbsp;<?php echo loremYaz(750) ?></h6>
        <h2 class="text-center"><small>[<?php echo $dilEkle.'_' ?>]</small> Açıklama Başlık</h2>
        <h6><small>[<?php echo $dilEkle.'_' ?>]</small>&nbsp;&nbsp;<?php echo loremYaz(750) ?></h6>
        <div><?php print_r($vrContent) ?></div>
    </div>
    <?php
}

function hakkimizdaAltYaziCek($vrContent=null){
    global $dilEkle;
    ?>
    <div class="container mt-4 p-3 card bg-primary text-white" style="border-bottom: 1px dashed rgba(0,0,0,.3)">
        <b>fn: hakkimizdaAltYaziCek</b>
        
        <h2 class="text-center"><small>[<?php echo $dilEkle.'_' ?>]</small> Alt Yazı Başlık</h2>
        <h6><small>[<?php echo $dilEkle.'_' ?>]</small>&nbsp;&nbsp;<?php echo loremYaz(444) ?></h6>

        <div><?php print_r($vrContent) ?></div>
    </div>
    <?php
}

function hakkimizdaRakamlarCek($vrContent=null){
    global $dilEkle;
    ?>
    <div class="container mt-4 p-3 card bg-danger text-white" style="border-bottom: 1px dashed rgba(0,0,0,.3)">
        <b>fn: hakkimizdaRakamlarCek</b>
        <div class="container d-flex justify-content-between my-3">
            <div><span style="font-size:1.2rem;"> [<?php echo $dilEkle.'_' ?>] Müşteri <br></span> <span class="btn btn-info py-3 px-4"> [<?php echo $dilEkle.'_' ?>] <?php echo rand(100,9999) ?></span></div>
            <div><span style="font-size:1.2rem;"> [<?php echo $dilEkle.'_' ?>] Memnuniyet <br></span> <span class="btn btn-success py-3 px-4"> [<?php echo $dilEkle.'_' ?>] <?php echo rand(100,9999) ?></span></div>
            <div><span style="font-size:1.2rem;"> [<?php echo $dilEkle.'_' ?>] Satış <br></span> <span class="btn btn-info py-3 px-4"> [<?php echo $dilEkle.'_' ?>] <?php echo rand(100,9999) ?></span></div>
            <div><span style="font-size:1.2rem;"> [<?php echo $dilEkle.'_' ?>] Pazarlama vs. <br></span> <span class="btn btn-success py-3 px-4"> [<?php echo $dilEkle.'_' ?>] <?php echo rand(100,9999) ?></span></div>
            <div><span style="font-size:1.2rem;"> [<?php echo $dilEkle.'_' ?>] İhracat <br></span> <span class="btn btn-info py-3 px-4"> [<?php echo $dilEkle.'_' ?>] <?php echo rand(100,9999) ?></span></div>
            <div><span style="font-size:1.2rem;"> [<?php echo $dilEkle.'_' ?>] İhtalat <br></span> <span class="btn btn-success py-3 px-4"> [<?php echo $dilEkle.'_' ?>] <?php echo rand(100,9999) ?></span></div>
        </div>
        <div><?php print_r($vrContent) ?></div>
    </div>
    <?php
}