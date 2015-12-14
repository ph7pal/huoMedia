<?php
/* @var $this CommentsController */
/* @var $model Comments */

$this->breadcrumbs=array(
	'Comments'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List Comments', 'url'=>array('index')),
	array('label'=>'Create Comments', 'url'=>array('create')),
	array('label'=>'Update Comments', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete Comments', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Comments', 'url'=>array('admin')),
);
?>
<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'uid',
		'touid',
		'logid',
		'commentid',
		'tocommentid',
		'content',
		'platform',
		'classify',
		'status',
		'cTime',
	),
)); ?>
