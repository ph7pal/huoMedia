<?php $this->renderPartial('/content/_nav');?>
<h4><?php echo $model->id ? '更新' : '新增';?>【<?php echo $typeLabel;?>】主页</h4>
<hr/>
<?php 
if(Yii::app()->user->hasFlash('websiteCreateSuccess')){
    echo '<div class="alert alert-danger">'.Yii::app()->user->getFlash('websiteCreateSuccess').'</div>';
}
$this->renderPartial('_form', array('model'=>$model)); ?>