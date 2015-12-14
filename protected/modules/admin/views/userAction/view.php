<?php
/* @var $this UserActionController */
/* @var $model UserAction */

$this->breadcrumbs=array(
	'User Actions'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List UserAction', 'url'=>array('index')),
	array('label'=>'Create UserAction', 'url'=>array('create')),
	array('label'=>'Update UserAction', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete UserAction', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage UserAction', 'url'=>array('admin')),
);
?>
<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'uid',
		'logid',
		'classify',
		'cTime',
		'ip',
	),
)); ?>
