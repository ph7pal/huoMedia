<?php

/**
 * @filename sidebar.php 
 * @Description
 * @author 阿年飞少 <ph7pal@qq.com> 
 * @link http://www.newsoul.cn 
 * @copyright Copyright©2015 阿年飞少 
 * @datetime 2016-2-23  19:07:09 
 */
$c = Yii::app()->getController()->id;
$a = Yii::app()->getController()->getAction()->id;
$arr=array(
    'serviceForums'=>array('label'=>'社区'),
    'serviceBlogs'=>array('label'=>'博客'),
    'serviceMedias'=>array('label'=>'媒体'),
    'serviceWebsites'=>array('label'=>'网站'),
    'serviceVideos'=>array('label'=>'视频网站'),
);
foreach($arr as $k=>$v){
    $this->menu[$v['label']]=array(
        'link'=>array($k.'/index'),
        'active'=>$c==$k
    );
}