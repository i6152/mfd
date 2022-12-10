<?php
include('_db/index.php');
include('_components/index.php');
include('_defined.php');
include('function.php');

# $_COOKIE['lang']='tr';
setcookie('lang', 'tr', time() + (60 / 5));
#paylaşımlarda get'e link ekle


?>
<!doctype html>
<html lang="en">

<head>
    <title>Title</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <?php
    foreach($embedList['head']['css'] as $headCss){
        ?>
        <link rel="stylesheet" href="<?php echo $headCss ?>">
        <?php
    }
    foreach($embedList['head']['js'] as $headJs){
        ?>
        <script src="<?php echo $headJs ?>"></script>
        <?php
    }
    ?>

</head>
<body>
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

        if(isset($componentList['sayfaDetay']['dosya']) && file_exists($componentList['sayfaDetay']['dosya'])){
            include($componentList['sayfaDetay']['dosya']);
        }
        else{
            sayfa404(false, ['baslik'=>'Aradığınız sayfa hazır değildir.', 'mesaj'=>'aradığınız sayfa menüde tanımlı fakat sayfa içeriği hazır değildir.']);
        }
        ?>
    </main>
    <footer>
        <!-- place footer here -->
    </footer>

    <?php
    foreach($embedList['footer']['js'] as $footJs){
        ?><script src="<?php echo $footJs ?>"></script><?php
    }
    ?>
</body>

</html>