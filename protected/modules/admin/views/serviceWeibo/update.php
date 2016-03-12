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
	$model->id=>array('view','id'=>$model->id),
	'更新',
);

$this->menu=array(
    array('label'=>'List ServiceWeibo', 'url'=>array('index')),
    array('label'=>'Create ServiceWeibo', 'url'=>array('create')),
    array('label'=>'View ServiceWeibo', 'url'=>array('view', 'id'=>$model->id)),
    array('label'=>'Manage ServiceWeibo', 'url'=>array('admin')),
);
?>
<?php $this->renderPartial('_form', array('model'=>$model)); ?>