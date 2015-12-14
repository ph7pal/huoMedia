<?php
/* @var $this WeddingGroupController */
/* @var $model WeddingGroup */

$this->breadcrumbs=array(
	'Wedding Groups'=>array('index'),
	$model->title=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List WeddingGroup', 'url'=>array('index')),
	array('label'=>'Create WeddingGroup', 'url'=>array('create')),
	array('label'=>'View WeddingGroup', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage WeddingGroup', 'url'=>array('admin')),
);
?>
<?php $this->renderPartial('_form', array('model'=>$model)); ?>