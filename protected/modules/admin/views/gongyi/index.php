<?php
/* @var $this GongyiController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Gongyis',
);

$this->menu=array(
	array('label'=>'Create Gongyi', 'url'=>array('create')),
	array('label'=>'Manage Gongyi', 'url'=>array('admin')),
);
?>

<h1>Gongyis</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
