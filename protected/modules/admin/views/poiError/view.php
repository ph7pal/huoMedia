<?php
/* @var $this PoiErrorController */
/* @var $model PoiError */

$this->breadcrumbs=array(
	'Poi Errors'=>array('index'),
	$model->title,
);

$this->menu=array(
	array('label'=>'List PoiError', 'url'=>array('index')),
	array('label'=>'Create PoiError', 'url'=>array('create')),
	array('label'=>'Update PoiError', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete PoiError', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage PoiError', 'url'=>array('admin')),
);
?>

<h1>View PoiError #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'uid',
		'logid',
		'type',
		'title',
		'content',
		'cTime',
		'status',
	),
)); ?>
