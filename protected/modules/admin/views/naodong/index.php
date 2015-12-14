<?php
/* @var $this NaodongController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Naodongs',
);

$this->menu=array(
	array('label'=>'Create Naodong', 'url'=>array('create')),
	array('label'=>'Manage Naodong', 'url'=>array('admin')),
);
?>

<h1>Naodongs</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
