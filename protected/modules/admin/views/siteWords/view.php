<?php
/* @var $this SiteWordsController */
/* @var $model SiteWords */

$this->breadcrumbs=array(
	'Site Words'=>array('index'),
	$model->title,
);

$this->menu=array(
	array('label'=>'List SiteWords', 'url'=>array('index')),
	array('label'=>'Create SiteWords', 'url'=>array('create')),
	array('label'=>'Update SiteWords', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete SiteWords', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage SiteWords', 'url'=>array('admin')),
);
?>
<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'title',
		'classify',
	),
)); ?>
