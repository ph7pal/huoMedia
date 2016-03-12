<?php
/**
 * @filename ServiceWeiboController.php 
 * @Description
 * @author 阿年飞少 <ph7pal@qq.com> 
 * @link http://www.newsoul.cn 
 * @copyright Copyright©2016 阿年飞少 
 * @datetime 2016-03-12 14:53:02 */
 
$this->breadcrumbs=array(
	'Service Weibos'=>array('index'),
	$model->id,
);

$this->menu=array(
    array('label'=>'List ServiceWeibo', 'url'=>array('index')),
    array('label'=>'Create ServiceWeibo', 'url'=>array('create')),
    array('label'=>'Update ServiceWeibo', 'url'=>array('update', 'id'=>$model->id)),
    array('label'=>'Delete ServiceWeibo', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
    array('label'=>'Manage ServiceWeibo', 'url'=>array('admin')),
);
?>
<?php $this->widget('zii.widgets.CDetailView', array(
    'data'=>$model,
    'attributes'=>array(
		'id',
		'uid',
		'classify',
		'nickname',
		'url',
		'favors',
		'shenfen',
		'area',
		'location',
		'sex',
		'ptzhuanfa',
		'ptzhifa',
		'ygzhuanfa',
		'ygzhifa',
		'desc',
		'postscript',
		'cTime',
		'status',
    ),
)); ?>