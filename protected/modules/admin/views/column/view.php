<?php
/* @var $this ColumnController */
/* @var $model Column */

$this->breadcrumbs=array(
	'Columns'=>array('index'),
	$model->name,
);

$this->menu=array(
	array('label'=>'List Column', 'url'=>array('index')),
	array('label'=>'Create Column', 'url'=>array('create')),
	array('label'=>'Update Column', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete Column', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Column', 'url'=>array('admin')),
);
?>
<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'belongid',
		'title',
		'name',
		'hot',
		'bold',
		'queue',
		'classify',
	),
)); ?>
