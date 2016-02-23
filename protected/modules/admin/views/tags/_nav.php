<?php

/**
 * @filename _nav.php 
 * @Description
 * @author 阿年飞少 <ph7pal@qq.com> 
 * @link http://www.newsoul.cn 
 * @copyright Copyright©2015 阿年飞少 
 * @datetime 2016-1-4  14:33:35 
 */
$c = Yii::app()->getController()->id;
$a = Yii::app()->getController()->getAction()->id;
$this->menu['列表'] = array(
    'link' => array('tags/index'),
    'active' => in_array($a, array('index'))
);
$arr = Tags::classify('admin');
foreach ($arr as $_classify => $_label) {
    $this->menu['新增【' . $_label . '】'] = array(
        'link' => array('tags/create','classify'=>$_classify),
        'active' => $_classify==$_GET['classify']
    );
}
