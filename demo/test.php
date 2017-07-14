<?php
/**
 * Created by PhpStorm.
 * User: Xiongzai
 * Date: 2017/7/14
 * Time: 11:47
 */
ini_set("memory_limit", "1024M");
require dirname(__FILE__).'/../core/init.php';

$url = "https://www.nvshens.com/girl/23688/";
$html = requests::get($url);

$selector = "//*[@class='infodiv']//table//td";
// 提取结果
$result = selector::select($html, $selector);
print_r($result);exit;