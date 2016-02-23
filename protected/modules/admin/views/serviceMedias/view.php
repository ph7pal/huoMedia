<?php
/* @var $this ServiceMediasController */
/* @var $model ServiceMedias */

$this->breadcrumbs=array(
	'Service Mediases'=>array('index'),
	$model->title,
);

$this->menu=array(
	array('label'=>'List ServiceMedias', 'url'=>array('index')),
	array('label'=>'Create ServiceMedias', 'url'=>array('create')),
	array('label'=>'Update ServiceMedias', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete ServiceMedias', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage ServiceMedias', 'url'=>array('admin')),
);
?>

<h1>View ServiceMedias #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'uid',
		'classify',
		'isSource',
		'hasLink',
		'title',
		'url',
		'price',
		'postscript',
		'cTime',
		'status',
	),
)); ?>
