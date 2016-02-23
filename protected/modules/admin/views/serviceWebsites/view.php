<?php
/* @var $this ServiceWebsitesController */
/* @var $model ServiceWebsites */

$this->breadcrumbs=array(
	'Service Websites'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List ServiceWebsites', 'url'=>array('index')),
	array('label'=>'Create ServiceWebsites', 'url'=>array('create')),
	array('label'=>'Update ServiceWebsites', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete ServiceWebsites', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage ServiceWebsites', 'url'=>array('admin')),
);
?>

<h1>View ServiceWebsites #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'uid',
		'type',
		'classify',
		'nickname',
		'sex',
		'area',
		'url',
		'favors',
		'vipInfo',
		'price',
		'postscript',
		'cTime',
		'status',
	),
)); ?>
