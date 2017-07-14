<?php
/**
 * Created by PhpStorm.
 * User: Xiongzai
 * Date: 2017/7/14
 * Time: 10:21
 * Email:devenv@sina.cn
 */

ini_set("memory_limit", "1024M");
require dirname(__FILE__).'/../core/init.php';

/* Do NOT delete this comment */
/* 不要删除这段注释 */

$configs = array(
    'name' => 'nvshens.com 女生写真',
    //'log_show' => true,
    'tasknum' => 30,
    'log_show' => false,
    //'save_running_state' => true,
    'domains' => array(
        'nvshens.com',
        'www.nvshens.com'
    ),
    'scan_urls' => array(
        'https://www.nvshens.com/gallery/'
    ),
    'list_url_regexes' => array(
        "/gallery/\w+/"
    ),
    'content_url_regexes' => array(
        "/g/\d+/",
    ),
    'max_try' => 3,

    'export' => array(
        'type'  => 'sql',
        'file'  => PATH_DATA.'/av.cvs',
        'table' => 'content',
    ),
//    'export' => array(
//        'type' => 'db',
//        'conf' => array(
//            'host'  => '192.168.147.1',
//            'port'  => 3306,
//            'user'  => 'root',
//            'pass'  => '',
//            'name'  => 'huoguo',
//        ),
//        'table' => 'content',
//    ),

    'fields' => [
        [
            'name'=>'title',
            'selector'=>"//*[@class='albumTitle']//h1"
        ],
        [
            'name'=>'desc',
            'selector'=>"//*[@class='albumTitle']//div[@id='ddesc']"
        ],
        [
            'name'=>"tags",
            //'selector'=>"//*[@class='album_tags']",
            'selector'=>"//*[@class='album_tags']//ul//li/a",
            'repeated' => true,
        ],
        [
            'name'=>'content',
            'selector'=>"//*[@class='photos']//div[@class='gallery_wrapper']//img",
            'repeated' => true,
        ],
        [
            //<span style="color: #DB0909">35张照片</span>
            'name'=>'img_num',
            'selector'=>'@>(.\d+?)张照片@',
            'selector_type' => 'regex',
        ],
        [
            'name'=>'view',
            'selector'=>"@被浏览了(.*?)次@",
            'selector_type' => 'regex',
        ],
        [
            'name'=>'create_time',
            'selector'=>"//*[@faclass='photos']",//这里我是乱写的 不要问我为什么
        ],
        [
            'name'=>'url',
            'selector'=>"//*[@sldaj='fasasa']",
        ]
    ],
);

$spider = new phpspider($configs);

//$spider->on_handle_img = function($fieldname, $img)
//{
//    $regex = '/src="(https?:\/\/.*?)"/i';
//    preg_match($regex, $img, $rs);
//    if (!$rs)
//    {
//        return $img;
//    }
//
//    $url = $rs[1];
//    $img = $url;
//
//    //$pathinfo = pathinfo($url);
//    //$fileext = $pathinfo['extension'];
//    //if (strtolower($fileext) == 'jpeg')
//    //{
//        //$fileext = 'jpg';
//    //}
//    //// 以纳秒为单位生成随机数
//    //$filename = uniqid().".".$fileext;
//    //// 在data目录下生成图片
//    //$filepath = PATH_ROOT."/images/{$filename}";
//    //// 用系统自带的下载器wget下载
//    //exec("wget -q {$url} -O {$filepath}");
//
//    //// 替换成真是图片url
//    //$img = str_replace($url, $filename, $img);
//    return $img;
//};
//


$spider->on_extract_field = function($fieldname, $data, $page)
{

    if ($fieldname == 'tags')
    {
        if(is_array($data)) $data = implode(',',$data);
    }
    elseif ($fieldname == 'content')
    {
        $data = implode(',',$data);
    }elseif($fieldname == 'create_time'){
        $data = time();
    }elseif($fieldname == 'url'){
        $data = $page['url'];
    }
    return $data;
};

$spider->on_download_page = function($page, $phpspider)
{
    //print_r($page['raw']);exit;
};
$spider->start();











