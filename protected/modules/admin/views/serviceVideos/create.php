<?php 
$this->renderPartial('/content/_nav');
if(Yii::app()->user->hasFlash('videoCreateSuccess')){
    echo '<div class="alert alert-danger">'.Yii::app()->user->getFlash('videoCreateSuccess').'</div>';
}
$this->renderPartial('_form', array('model'=>$model)); ?>