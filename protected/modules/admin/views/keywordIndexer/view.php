<?php
/* @var $this KeywordIndexerController */
/* @var $model KeywordIndexer */

$this->breadcrumbs=array(
	'Keyword Indexers'=>array('index'),
	$model->title,
);

$this->menu=array(
	array('label'=>'List KeywordIndexer', 'url'=>array('index')),
	array('label'=>'Create KeywordIndexer', 'url'=>array('create')),
	array('label'=>'Update KeywordIndexer', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete KeywordIndexer', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage KeywordIndexer', 'url'=>array('admin')),
);
?>

<h1>View KeywordIndexer #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'logid',
		'origin',
		'title',
		'len',
		'url',
		'classify',
		'columnid',
		'times',
		'hash',
		'status',
	),
)); ?>
