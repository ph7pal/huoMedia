<?php
/**
 * @filename ServiceQzoneController.php 
 * @Description
 * @author 阿年飞少 <ph7pal@qq.com> 
 * @link http://www.newsoul.cn 
 * @copyright Copyright©2016 阿年飞少 
 * @datetime 2016-03-12 14:52:47 */
$this->renderPartial('/content/_nav');
if(Yii::app()->user->hasFlash('qzoneCreateSuccess')){
    echo '<div class="alert alert-danger">'.Yii::app()->user->getFlash('qzoneCreateSuccess').'</div>';
}
$this->renderPartial('_form', array('model'=>$model)); ?>