<?php
/* @var $this NaodongController */
/* @var $model Naodong */

$this->breadcrumbs=array(
	'Naodongs'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Naodong', 'url'=>array('index')),
	array('label'=>'Manage Naodong', 'url'=>array('admin')),
);
?>

<h1>Create Naodong</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>