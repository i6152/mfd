<?php
function demoHeader(){
    global $arrMenu, $base_url;
    ?>
    <header class="header py-1 bg-warning">
        <div class="container">
            <h1 class="text-center">Header Area</h1>
        </div>
    </header>

    <nav class="navbar navbar-expand-sm sticky-top navbar-dark bg-primary">
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
                            <li class="nav-item active">
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