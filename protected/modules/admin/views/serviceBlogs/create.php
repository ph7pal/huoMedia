<?php 
$this->renderPartial('/content/_nav');
if(Yii::app()->user->hasFlash('blogCreateSuccess')){
    echo '<div class="alert alert-danger">'.Yii::app()->user->getFlash('blogCreateSuccess').'</div>';
}
$this->renderPartial('_form', array('model'=>$model)); ?>