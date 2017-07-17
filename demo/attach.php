<?php
/**
 * Created by PhpStorm.
 * User: Xiongzai
 * Date: 2017/7/14
 * Time: 14:32
 */


ini_set("memory_limit", "1024M");
//require dirname(__FILE__).'/../core/init.php';
///* Do NOT delete this comment */
///* 不要删除这段注释 */
//$spider = new phpspider();
//$spider->on_attachment_file = function($url, $filetype, $phpspider)
//{
//    // 输出文件URL地址和文件类型
//    //var_dump($url, $filetype);
//    if ($filetype == 'jpg')
//    {
//        // 以纳秒为单位生成随机数
//        $filename = uniqid();
//        // 在data目录下生成图片
//        $filepath = PATH_DATA."/{$filename}.jpg";
//
//        // 用系统自带的下载器wget下载
//        exec("wget {$url} -O {$filepath}");
//        // 用PHP函数下载，容易耗尽内存，慎用
//        //$data = file_get_contents($attachment_url);
//        //file_put_contents($filepath, $attachment_url);
//    }
//};
function http($url, $params, $method = 'GET', $header = array(), $multi = false){
    $opts = array(
        CURLOPT_TIMEOUT        => 30,
        CURLOPT_RETURNTRANSFER => 1,
        CURLOPT_SSL_VERIFYPEER => false,
        CURLOPT_SSL_VERIFYHOST => false,
        CURLOPT_HTTPHEADER     => $header
    );

    /* 根据请求类型设置特定参数 */
    switch(strtoupper($method)){
        case 'GET':
            $opts[CURLOPT_URL] = $url . '?' . http_build_query($params);
            break;
        default:
            throw new Exception('不支持的请求方式！');
    }

    /* 初始化并执行curl请求 */
    $ch = curl_init();
    curl_setopt_array($ch, $opts);
    $data  = curl_exec($ch);
    $error = curl_error($ch);
    curl_close($ch);
    if($error) throw new Exception('请求发生错误：' . $error);
    return  $data;
}

define('CORE', dirname(__FILE__));
define('PATH_DATA', CORE."/../data");

$url = "http://imgs.jushuo.com/dimg/2017-07-14/5968903ae377c.jpg";
$url = "https://t1.onvshen.com:85/gallery/16232/21771/s/003.jpg";
$url = "http://imgs.jushuo.com/editor/2017-07-13/5967382f5b0a9.jpg";
$url = "http://app.jushuo.com/static/attachment/dimg/2017-07-13/5967375d60ef7.jpg";
$url = "http://imgs.jushuo.com/album/2017-07-14/59681ecf1b5bb.com/large/2ecb00039b0be6de723a";
$url = "https://pic2.zhimg.com/v2-30dbeb6d1e5370fd204ae078302e6f8d_b.jpg";
$url = "https://img.onvshen.com:85/article/10507/01.jpg";
$url = "http://csdnimg.cn/www/images/csdn_logo_blue.gif";
$filename = uniqid();
$filepath = PATH_DATA."/{$filename}.jpg";

$header['Accept'] = 'text/html,application/xhtml+xml,application/xml;q=0.9,image/webp,*/*;q=0.8';
$header['Accept-Encoding'] = 'gzip, deflate, sdch, br';
$header['Accept-Language'] = 'zh-CN,zh;q=0.8';
$header['Cache-Control']  = 'no-cache';
$header['Connection'] = 'keep-alive';
$header['Host'] = 't1.onvshen.com:85';
$header['Pragma'] = 'no-cache';
$header['Referer'] = 'https://www.nvshens.com/g/22495/';
$header['Upgrade-Insecure-Requests'] = 1;
$header['User-Agent'] = 'Mozilla/5.0 (Windows NT 10.0; WOW64; Trident/7.0; rv:11.0) like Gecko';

$data = http($url,[],'GET',$header);
file_put_contents($filepath,$data);





echo 'ok';
