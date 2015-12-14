<div style="clear:both">
<ul class="nav nav-tabs" role="tablist">
    <li class="<?php echo ($_GET['type']=='all')?'active':'';?>"><?php echo CHtml::link('所有',array('reports/index','type'=>'all'));?></li>
    <li class="<?php echo ($_GET['type']=='posts')?'active':'';?>"><?php echo CHtml::link('文章',array('reports/index','type'=>'posts'));?></li>
    <li class="<?php echo ($_GET['type']=='poipost')?'active':'';?>"><?php echo CHtml::link('点评',array('reports/index','type'=>'poipost'));?></li>
    <li class="<?php echo ($_GET['type']=='question')?'active':'';?>"><?php echo CHtml::link('问题',array('reports/index','type'=>'question'));?></li>
    <li class="<?php echo ($_GET['type']=='answer')?'active':'';?>"><?php echo CHtml::link('回答',array('reports/index','type'=>'answer'));?></li>
    <li class="<?php echo ($_GET['type']=='comments')?'active':'';?>"><?php echo CHtml::link('评论',array('reports/index','type'=>'comments'));?></li>
    <li class="<?php echo ($_GET['type']=='img')?'active':'';?>"><?php echo CHtml::link('图片',array('reports/index','type'=>'img'));?></li> 
    <li class="<?php echo ($_GET['type']=='read')?'active':'';?>"><?php echo CHtml::link('所有已处理',array('reports/index','type'=>'read'));?></li>
</ul>
</div>
<?php if(empty($posts)){?>
<div class='flash-error'> 
    暂无内容。
</div>
<?php }else{?>
<?php foreach($posts as $row):?> 
<?php $this->renderPartial('detailInfo',array('row'=>$row,'manageArr'=>$manageArr));?>
 <?php endforeach;?>
<?php $this->renderPartial('//common/pager',array('pages'=>$pages));?>
<?php }?>