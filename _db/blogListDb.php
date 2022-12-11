<?php

function blogListCek($bas=0,$bit=0){
    $res= json_decode(file_get_contents('https://jsonplaceholder.typicode.com/posts', false, stream_context_create(['http' => ['ignore_errors' => true]])), true);

    if($bit>0)
        $res=['top'=>count($res), 'baslangic'=>$bas, 'bitis'=>$bit, 'list'=>array_slice($res, $bas, $bit)];

    return $res;
}

function blogDetayCek($id){
    $fgc=@file_get_contents('https://jsonplaceholder.typicode.com/posts/'.$id, false, stream_context_create(['http' => ['ignore_errors' => true]]));
    if(!strpos($http_response_header[0], '200 OK')){
        return null;
    }

    return json_decode($fgc, true);
}
