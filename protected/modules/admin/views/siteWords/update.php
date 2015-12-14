<?php
/* @var $this SiteWordsController */
/* @var $model SiteWords */

$this->breadcrumbs=array(
	'Site Words'=>array('index'),
	$model->title=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List SiteWords', 'url'=>array('index')),
	array('label'=>'Create SiteWords', 'url'=>array('create')),
	array('label'=>'View SiteWords', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage SiteWords', 'url'=>array('admin')),
);
?>

<h1>Update SiteWords <?php echo $model->id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>