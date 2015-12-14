<?php
/* @var $this KeywordIndexerController */
/* @var $model KeywordIndexer */

$this->breadcrumbs=array(
	'Keyword Indexers'=>array('index'),
	$model->title=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List KeywordIndexer', 'url'=>array('index')),
	array('label'=>'Create KeywordIndexer', 'url'=>array('create')),
	array('label'=>'View KeywordIndexer', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage KeywordIndexer', 'url'=>array('admin')),
);
?>

<h1>Update KeywordIndexer <?php echo $model->id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>