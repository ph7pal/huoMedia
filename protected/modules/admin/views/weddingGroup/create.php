<?php
/* @var $this WeddingGroupController */
/* @var $model WeddingGroup */

$this->breadcrumbs=array(
	'Wedding Groups'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List WeddingGroup', 'url'=>array('index')),
	array('label'=>'Manage WeddingGroup', 'url'=>array('admin')),
);
?>
<?php $this->renderPartial('_form', array('model'=>$model)); ?>