<?php
/**
 * @filename ServiceWeiboController.php 
 * @Description
 * @author 阿年飞少 <ph7pal@qq.com> 
 * @link http://www.newsoul.cn 
 * @copyright Copyright©2016 阿年飞少 
 * @datetime 2016-03-12 14:53:02 */
$this->renderPartial('/content/_nav');
if(Yii::app()->user->hasFlash('weiboCreateSuccess')){
    echo '<div class="alert alert-danger">'.Yii::app()->user->getFlash('weiboCreateSuccess').'</div>';
}
$this->renderPartial('_form', array('model'=>$model)); ?>