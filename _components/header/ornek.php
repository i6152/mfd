<?php
function ornekHeader(){
    global $score;
    global $arrMenu, $base_url;
    global $mevcutSayfa;
    global $dilEkle, $dilDestek;
    ?>
    <style>
        li.nav-item.active a{
            color: rgba(255, 255, 255, .9);
            font-weight: 600;
        }
        li.nav-item:hover a{
            color: rgba(255, 255, 255, .9);
            font-weight: 600;
        }
    </style>
    <header class="header py-1 bg-danger">
        <div class="container d-flex justify-content-between">

                <div class="my-3">
                    Score: <b><?php echo $score; ?></b>
                </div>
                <h3 class="m-2" style="font-size:1.6rem">Sayfa: <small style="font-size:1.3rem"><?php echo @$mevcutSayfa['baslik'] ?></small>, ID: <small style="font-size:1.3rem"><?php echo @$mevcutSayfa['id'] ?></small></h3>
                <div class="">
                    Mevcut Dil: <b><?php echo $dilEkle; ?></b>
                    <?php
                    foreach($dilDestek as $vrDil){
                        $dilUrl='dil='.strtolower($vrDil);
                        $dilUrl=(strpos($_SERVER["REQUEST_URI"], '?'))?'?'.explode('?', $_SERVER["REQUEST_URI"])[1].'&'.$dilUrl:'?'.$dilUrl;
                        
                        ?><a class="btn btn-primary text-white font-bold m-2 <?php if($dilEkle==$vrDil) echo 'disabled' ?>" href="<?php echo $dilUrl ?>"><?php echo strtoupper($vrDil) ?></a><?php
                    }
                    ?>
                </div>
        </div>
    </header>

    <nav class="navbar navbar-expand-sm sticky-top navbar-dark bg-dark">
        <div class="container">
            <a class="navbar-brand" href="https://www.ismetozdemir.com.tr" target="_blank">w/ io.com.tr</a>

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#myList" aria-controls="myList" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="myList">
                <ul class="navbar-nav">
                    <?php
                    foreach($arrMenu as $vrMenu){
                        if(isset($vrMenu['sub']) && is_array($vrMenu['sub']) && count($vrMenu['sub'])>0){
                            ?>
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" id="navbarDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false" href="<?php 
                                    echo $base_url.$vrMenu['link'] ?>">
                                    <?php echo $vrMenu['baslik'] ?>
                                </a>
                                <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                                    <?php
                                    foreach($vrMenu['sub'] as $vrMenuSub){
                                        ?>
                                        <li><a class="dropdown-item" href="<?php echo $base_url.$vrMenu['link'].'/'.$vrMenuSub['link'] ?>"><?php echo $vrMenuSub['baslik'] ?></a></li>
                                        <?php
                                    }
                                    ?>
                                </ul>
                            </li>
                            <?php
                        }
                        else{
                            ?>
                            <li class="nav-item <?php echo (isset($mevcutSayfa['id']) && $mevcutSayfa['id']==$vrMenu['id'])?'active':'' ?>">
                                <a class="nav-link" href="<?php echo $base_url.$vrMenu['link'] ?>"><?php echo $vrMenu['baslik'] ?></a>
                            </li>
                            <?php
                        }
                    }
                    ?>
                </ul>
            </div>
        </div>
    </nav>
    <?php
}