<?php
/* @var $this WeddingGroupController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Wedding Groups',
);

$this->menu=array(
	array('label'=>'Create WeddingGroup', 'url'=>array('create')),
	array('label'=>'Manage WeddingGroup', 'url'=>array('admin')),
);
?>
<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
