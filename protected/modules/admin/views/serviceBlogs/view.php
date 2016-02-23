<?php
/* @var $this ServiceBlogsController */
/* @var $model ServiceBlogs */

$this->breadcrumbs=array(
	'Service Blogs'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List ServiceBlogs', 'url'=>array('index')),
	array('label'=>'Create ServiceBlogs', 'url'=>array('create')),
	array('label'=>'Update ServiceBlogs', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete ServiceBlogs', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage ServiceBlogs', 'url'=>array('admin')),
);
?>

<h1>View ServiceBlogs #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'uid',
		'type',
		'classify',
		'level',
		'area',
		'url',
		'hits',
		'price',
		'cTime',
		'status',
	),
)); ?>
