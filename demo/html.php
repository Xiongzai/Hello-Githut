<?php
/**
 * Created by PhpStorm.
 * User: Xiongzai
 * Date: 2017/7/17
 * Time: 11:35
 */


$url = 'https://www.nvshens.com/g/23328/';
$html = file_get_contents($url);



$regex = [
              "/onclick\s*=\s*\"?[\.\w]+\('([^']+)'/",
            "/javascript:[\w]+\('([^']+)'/",
            "/'(https?://[^']+)'/",
            "/'(https?://[^']+)'/",
            "/(?:\?|=)(https?://[^'\"&]+)/"
        ];
foreach ($regex as $re){
    preg_match($re,$html,$matches,PREG_OFFSET_CAPTURE);
    echo $re;
    print_r($matches);
    echo "\n\n";
}
