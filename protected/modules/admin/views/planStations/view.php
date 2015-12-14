<?php
/* @var $this PlanStationsController */
/* @var $model PlanStations */

$this->breadcrumbs=array(
	'Plan Stations'=>array('index'),
	$model->title,
);

$this->menu=array(
	array('label'=>'List PlanStations', 'url'=>array('index')),
	array('label'=>'Create PlanStations', 'url'=>array('create')),
	array('label'=>'Update PlanStations', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete PlanStations', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage PlanStations', 'url'=>array('admin')),
);
?>

<h1>View PlanStations #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'uid',
		'pid',
		'postid',
		'title',
		'content',
		'sTime',
		'money',
		'vehicle',
		'long',
		'lat',
		'visited',
		'status',
		'cTime',
	),
)); ?>
