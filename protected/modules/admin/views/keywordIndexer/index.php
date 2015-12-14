<?php
/* @var $this KeywordIndexerController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Keyword Indexers',
);

$this->menu=array(
	array('label'=>'Create KeywordIndexer', 'url'=>array('create')),
	array('label'=>'Manage KeywordIndexer', 'url'=>array('admin')),
);
?>

<h1>Keyword Indexers</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
