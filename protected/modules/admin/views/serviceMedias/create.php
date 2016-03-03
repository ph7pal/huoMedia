<?php 
$this->renderPartial('/content/_nav');
if(Yii::app()->user->hasFlash('mediaCreateSuccess')){
    echo '<div class="alert alert-danger">'.Yii::app()->user->getFlash('mediaCreateSuccess').'</div>';
}
$this->renderPartial('_form', array('model'=>$model)); ?>