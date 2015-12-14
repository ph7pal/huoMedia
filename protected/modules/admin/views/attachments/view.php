<?php
/* @var $this AttachmentsController */
/* @var $model Attachments */

$this->breadcrumbs=array(
	'Attachments'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List Attachments', 'url'=>array('index')),
	array('label'=>'Create Attachments', 'url'=>array('create')),
	array('label'=>'Update Attachments', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete Attachments', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Attachments', 'url'=>array('admin')),
);
?>
<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'uid',
		'logid',
		'filePath',
		'fileDesc',
		'classify',
		'width',
		'height',
		'size',
		'covered',
		'hits',
		'cTime',
		'status',
		'favor',
	),
)); ?>
