<?php 
$this->renderPartial('/content/_nav');
if(Yii::app()->user->hasFlash('forumCreateSuccess')){
    echo '<div class="alert alert-danger">'.Yii::app()->user->getFlash('forumCreateSuccess').'</div>';
}
$this->renderPartial('_form', array('model'=>$model)); ?>