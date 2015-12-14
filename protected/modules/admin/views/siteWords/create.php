<?php
/* @var $this SiteWordsController */
/* @var $model SiteWords */

$this->breadcrumbs=array(
	'Site Words'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List SiteWords', 'url'=>array('index')),
	array('label'=>'Manage SiteWords', 'url'=>array('admin')),
);
?>

<h1>Create SiteWords</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>