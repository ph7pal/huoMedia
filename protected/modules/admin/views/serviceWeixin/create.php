<?php
/**
 * @filename ServiceWeixinController.php 
 * @Description
 * @author 阿年飞少 <ph7pal@qq.com> 
 * @link http://www.newsoul.cn 
 * @copyright Copyright©2016 阿年飞少 
 * @datetime 2016-03-12 14:53:11 */
$this->renderPartial('/content/_nav');
if(Yii::app()->user->hasFlash('weixinCreateSuccess')){
    echo '<div class="alert alert-danger">'.Yii::app()->user->getFlash('weixinCreateSuccess').'</div>';
}
$this->renderPartial('_form', array('model'=>$model)); ?>