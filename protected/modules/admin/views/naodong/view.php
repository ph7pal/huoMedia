<?php
/* @var $this NaodongController */
/* @var $model Naodong */

$this->breadcrumbs=array(
	'Naodongs'=>array('index'),
	$model->title,
);

$this->menu=array(
	array('label'=>'List Naodong', 'url'=>array('index')),
	array('label'=>'Create Naodong', 'url'=>array('create')),
	array('label'=>'Update Naodong', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete Naodong', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Naodong', 'url'=>array('admin')),
);
?>

<h1>View Naodong #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'uid',
		'title',
		'classify',
		'content',
		'source',
		'sourceurl',
		'attachid',
		'status',
		'top',
		'hits',
		'comments',
		'favors',
		'cTime',
	),
)); ?>
