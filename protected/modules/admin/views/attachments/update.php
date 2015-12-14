<?php
/* @var $this AttachmentsController */
/* @var $model Attachments */

$this->breadcrumbs=array(
	'Attachments'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List Attachments', 'url'=>array('index')),
	array('label'=>'Create Attachments', 'url'=>array('create')),
	array('label'=>'View Attachments', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage Attachments', 'url'=>array('admin')),
);
?>
<?php $this->renderPartial('_form', array('model'=>$model)); ?>