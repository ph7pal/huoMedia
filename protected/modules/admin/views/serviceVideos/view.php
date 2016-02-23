<?php
/* @var $this ServiceVideosController */
/* @var $model ServiceVideos */

$this->breadcrumbs=array(
	'Service Videoses'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List ServiceVideos', 'url'=>array('index')),
	array('label'=>'Create ServiceVideos', 'url'=>array('create')),
	array('label'=>'Update ServiceVideos', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete ServiceVideos', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage ServiceVideos', 'url'=>array('admin')),
);
?>

<h1>View ServiceVideos #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'uid',
		'type',
		'classify',
		'position',
		'url',
		'stayTime',
		'price',
		'cTime',
		'status',
	),
)); ?>
