<?php

/**
 * @filename ContentController.php 
 * @Description
 * @author 阿年飞少 <ph7pal@qq.com> 
 * @link http://www.newsoul.cn 
 * @copyright Copyright©2015 阿年飞少 
 * @datetime 2016-2-23  18:58:11 
 */
class ContentController extends Admin {
    public function actionIndex(){
        $this->render('index');
    }
}