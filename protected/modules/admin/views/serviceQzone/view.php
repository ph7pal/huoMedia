<?php
/**
 * @filename ServiceQzoneController.php 
 * @Description
 * @author 阿年飞少 <ph7pal@qq.com> 
 * @link http://www.newsoul.cn 
 * @copyright Copyright©2016 阿年飞少 
 * @datetime 2016-03-12 14:52:47 */
 
$this->breadcrumbs=array(
	'Service Qzones'=>array('index'),
	$model->id,
);

$this->menu=array(
    array('label'=>'List ServiceQzone', 'url'=>array('index')),
    array('label'=>'Create ServiceQzone', 'url'=>array('create')),
    array('label'=>'Update ServiceQzone', 'url'=>array('update', 'id'=>$model->id)),
    array('label'=>'Delete ServiceQzone', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
    array('label'=>'Manage ServiceQzone', 'url'=>array('admin')),
);
?>
<?php $this->widget('zii.widgets.CDetailView', array(
    'data'=>$model,
    'attributes'=>array(
		'id',
		'uid',
		'nickname',
		'url',
		'favors',
		'shuoshuo',
		'cTime',
		'status',
    ),
)); ?>