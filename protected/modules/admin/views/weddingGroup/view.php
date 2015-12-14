<?php
/* @var $this WeddingGroupController */
/* @var $model WeddingGroup */

$this->breadcrumbs=array(
	'Wedding Groups'=>array('index'),
	$model->title,
);

$this->menu=array(
	array('label'=>'List WeddingGroup', 'url'=>array('index')),
	array('label'=>'Create WeddingGroup', 'url'=>array('create')),
	array('label'=>'Update WeddingGroup', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete WeddingGroup', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage WeddingGroup', 'url'=>array('admin')),
);
?>

<h1>View WeddingGroup #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'uid',
		'title',
		'content',
		'avatar',
		'address',
		'slogan',
		'tagids',
		'phone',
		'createAt',
		'members',
		'cTime',
		'status',
		'creditStatus',
		'areaid',
		'contact',
		'openTime',
		'email',
		'weibo',
		'qq',
		'weixin',
		'website',
	),
)); ?>
