<?php
function preYaz($m, $style='')
{
    echo '<pre style="'.$style.'">';
    print_r($m);
    echo '</pre>';
}

function loremYaz($metin = null, $kelime = null)
{
    $str = "What is Lorem Ipsum? Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.
        Why do we use it? It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using 'Content here, content here', making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for 'lorem ipsum' will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).
        Where does it come from? Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock, a Latin professor at Hampden-Sydney College in Virginia, looked up one of the more obscure Latin words, consectetur, from a Lorem Ipsum passage, and going through the cites of the word in classical literature, discovered the undoubtable source. Lorem Ipsum comes from sections 1.10.32 and 1.10.33 of 'de Finibus Bonorum et Malorum' (The Extremes of Good and Evil) by Cicero, written in 45 BC. This book is a treatise on the theory of ethics, very popular during the Renaissance. The first line of Lorem Ipsum, 'Lorem ipsum dolor sit amet..', comes from a line in section 1.10.32.
        Where can I get some? There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which don't look even slightly believable. If you are going to use a passage of Lorem Ipsum, you need to be sure there isn't anything embarrassing hidden in the middle of text. All the Lorem Ipsum generators on the Internet tend to repeat predefined chunks as necessary, making this the first true generator on the Internet. It uses a dictionary of over 200 Latin words, combined with a handful of model sentence structures, to generate Lorem Ipsum which looks reasonable. The generated Lorem Ipsum is therefore always free from repetition, injected humour, or non-characteristic words etc.";

    $str = str_replace(['(', ')', ',', '.', "'"], [], $str);
    $cevap = '';
    if ($metin > 0) $cevap = substr($str, rand(0, strlen($str) - $metin), $metin);
    else if ($kelime > 0) {
        $str2 = explode(' ', $str);
        if ($kelime > count($str2)) $kelime = count($str2);

        $r = rand(0, count($str2) - $kelime);
        for ($i = 0; $i <= $kelime; $i++) {
            $cevap .= $str2[$r + $i] . ' ';
        }
        $cevap = substr($cevap, 0, -1);
    }
    return $cevap;
}

function getParcala($baslangic = "?", $uri = null)
{
    $getArr = array();
    $getVeri = "";

    if ($uri != null) {
        if (count(explode($baslangic, $uri)) == 2) {
            $getVeri = explode("?", $uri)[1];

            foreach (explode("&", $getVeri) as $vrVeri) {
                $a = explode("=", $vrVeri);

                $getArr[$a[0]] = (isset($a[1])) ? $a[1] : null;
            }
        }
    } else if (count(explode($baslangic, $_SERVER["REQUEST_URI"])) == 2) {
        $getVeri = explode("?", $_SERVER["REQUEST_URI"])[1];

        foreach (explode("&", $getVeri) as $vrVeri) {
            $a = explode("=", $vrVeri);

            $getArr[$a[0]] = (isset($a[1])) ? $a[1] : null;
        }
    } else {
        $getArr = null;
    }
    return $getArr;
}

class sureSayac{ 
    function __construct(){ 
        global $pageSpeedBaslangic; 
        $msure = microtime (); 
        $msure = explode (' ', $msure ); 
        $msure = $msure[1] + $msure[0]; 
        $pageSpeedBaslangic = $msure; 
    } 
	
    function bitir($kusuratLimit=5){ 
        global $pageSpeedBaslangic; 
        $msure = microtime (); 
        $msure = explode (' ', $msure); 
        $msure = $msure[1] + $msure[0]; 
        $pageSpeedBitis = $msure; 
        $fark=$pageSpeedBitis - $pageSpeedBaslangic;
        $toplam=number_format($fark, $kusuratLimit, ',', '.');
        // $toplam = round(($pageSpeedBitis - $pageSpeedBaslangic), $kusuratLimit); 
		
        return $toplam; 
    } 
	
    function bitirAlert(){ 
        global $pageSpeedBaslangic; 
        $msure = microtime (); 
        $msure = explode (' ', $msure); 
        $msure = $msure[1] + $msure[0]; 
        $pageSpeedBitis = $msure; 
        $toplam = round (($pageSpeedBitis - $pageSpeedBaslangic), 5);
		?>
		<script type="text/javascript">alert('<?php echo $toplam; ?>');</script>
		<?php
    } 
} 
