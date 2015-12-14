<?php
/* @var $this KeywordIndexerController */
/* @var $model KeywordIndexer */

$this->breadcrumbs=array(
	'Keyword Indexers'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List KeywordIndexer', 'url'=>array('index')),
	array('label'=>'Manage KeywordIndexer', 'url'=>array('admin')),
);
?>

<h1>Create KeywordIndexer</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>