<?php

//类型
$type = ['id'=>'ID','name'=>'类型名称']; //只有一级大分类 不同类型可能结构完全不一样 例如文章 段子 图片 结构可能有很大的差异 不同的展示模板等
//订阅号
$subcription = ['id'=>'ID','type_id'=>'类型ID','title'=>'标题','title_img'=>'标题小图片','desc'=>'简短描述','type'=>'类型'];


//具体数据表 根据订阅号 冗余类型到具体信息中
$article        = ['id'=>'ID','type_id'=>'类型ID','subcription_id'=>'订阅号编号','title'=>'标题','template'=>'展示模板','token'=>'唯一标识符','content'=>'内容','desc'=>'简短描述'];
$pictureArticle = ['id'=>'ID','type_id'=>'类型ID','subcription_id'=>'订阅号编号','title'=>'标题','template'=>'展示模板','token'=>'唯一标识符','picture_num'=>'图片数量','pictures'=>'序列化后的图片','picture_desc'=>'序列化图片描述'];
$duanzi         = ['id'=>'ID','type_id'=>'类型ID','subcription_id'=>'订阅号编号','title'=>'标题','template'=>'展示模板','token'=>'唯一标识符','content'=>'内容','digg_num'=>'点赞人数','bury_num'=>'点踩人数'];
$video          = ['id'=>'ID','type_id'=>'类型ID','subcription_id'=>'订阅号编号','title'=>'标题','template'=>'展示模板','token'=>'唯一标识符','content'=>'内容','digg_num'=>'点赞人数','bury_num'=>'点踩人数','video_pach'=>'视屏地址'];

//关联标签 即搜索词 用户用户行为分析
$tag  = ['id'=>'ID','name'=>'标签名字','status'=>'状态'];  //有些标签可能会禁用  每个标签关联500条最新最热的数据

//搜索相关

/*
 *标题和内容集体分词 优先标题分词 在内容分词 直接根据标签搜索
 * step 1：输入关键词 -> 分词 =》假设分5分词-》确定5个标签的热度
 * step 2：直接5个关键词关联数据去并运算 一个标签500数据 一共最多2500条数据去重
 * step 3：最多2500条数据 取出2500个标题 根据热度和匹配度（标题包含的关键词）排序 （一万个汉字23K左右）
 * step 4：取出排序后最前面的1000条数据的ID
           缓存数据
                1、包含缓存搜索词（zset）保存5000个 用于做相关搜索
                2、 和 搜索词对应数据（zset）根据热度和时间排序 保存1000个结果集即可    
 *
 */

