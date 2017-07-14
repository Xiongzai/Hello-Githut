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
    'name' => 'nvshens.com 女神详细信息',
    //'log_show' => true,
    'tasknum' => 10,
    'log_show' => false,
    //'save_running_state' => true,
    'domains' => array(
        'nvshens.com',
        'www.nvshens.com'
    ),
    'scan_urls' => array(
        'https://www.nvshens.com/tag/'
    ),
    'list_url_regexes' => array(
        "/tag/\w+/"
    ),
    'content_url_regexes' => array(
        "/girl/\d+/$",
    ),
    'max_try' => 3,

    'export' => array(
        'type'  => 'sql',
        'file'  => PATH_DATA.'/gtw_star_info.cvs',
        'table' => 'gtw_star_info',
    ),

    'fields' => [
        [
            'name'=>'name',
            'selector'=>"//*[@class='div_h1']//h1"
        ],
        [
            'name'=>'header',
            'selector'=>"//*[@class='infoleft_imgdiv']//a[@class='imglink']//img"
        ],
        [
            'name'=>"info",
            'selector'=>"//*[@class='infodiv']//table//td",
            'repeated' => true,
        ],
        [
            'name'=>'desc',
            'selector'=>"//*[@class='infocontent']",
        ],
        [
            'name'=>'url',
            'selector'=>"//*[@sldaj='fasasa']",
        ]
    ],
);

$spider = new phpspider($configs);
$spider->on_extract_field = function($fieldname, $data, $page)
{

    if ($fieldname == 'info')
    {
        if(is_array($data)) $data = implode(',',$data);
    }elseif($fieldname == 'url'){
        $data = $page['url'];
    }elseif($fieldname == 'desc'){
        $data =  strip_tags($data);
    }elseif($fieldname == 'header'){
        $newFileName = uniqid();
        $newFilePath = PATH_DATA."/images/{$newFileName}.jpg";
        exec("wget {$fieldname} -O {$newFilePath}");
    }
    return $data;
};

$spider->on_download_page = function($page, $phpspider)
{
    //print_r($page['raw']);exit;
};
$spider->start();











