<?php 
$this->renderPartial('/tags/_nav');
echo '<h4>新增【'.$classifyLabel.'】分类</h4><hr/>';
if(Yii::app()->user->hasFlash('tagCreateSuccess')){
    echo '<div class="alert alert-danger">'.Yii::app()->user->getFlash('tagCreateSuccess').'</div>';
}
$this->renderPartial('_form', array('model'=>$model,'belongTags'=>$belongTags)); 