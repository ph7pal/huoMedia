<?php
$this->menu=array(
	array('label'=>'List Ads', 'url'=>array('index')),
	array('label'=>'Create Ads', 'url'=>array('create')),
	array('label'=>'Update Ads', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete Ads', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Ads', 'url'=>array('admin')),
);
?>
<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'title',
		'url',
		'attachid',
		'width',
		'height',
		'description',
		'hits',
		'start_time',
		'expired_time',
		'position',
		'order',
		'status',
		'cTime',
		'classify',
		'uid',
		'system',
		'code',
	),
)); ?>
