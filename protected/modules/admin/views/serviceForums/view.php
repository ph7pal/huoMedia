<?php
/* @var $this ServiceForumsController */
/* @var $model ServiceForums */

$this->breadcrumbs=array(
	'Service Forums'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List ServiceForums', 'url'=>array('index')),
	array('label'=>'Create ServiceForums', 'url'=>array('create')),
	array('label'=>'Update ServiceForums', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete ServiceForums', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage ServiceForums', 'url'=>array('admin')),
);
?>

<h1>View ServiceForums #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'uid',
		'classify',
		'forum',
		'type',
		'url',
		'forDigest',
		'forDay',
		'forWeek',
		'forTwoWeek',
		'forMonth',
		'forQuarter',
		'forHalfYear',
		'forYear',
		'cTime',
		'status',
	),
)); ?>
