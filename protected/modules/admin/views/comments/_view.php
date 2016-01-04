<?php

/**
 * @filename _view.php 
 * @Description
 * @author 阿年飞少 <ph7pal@qq.com> 
 * @link http://www.newsoul.cn 
 * @copyright Copyright©2015 阿年飞少 
 * @datetime 2016-1-4  11:52:24 
 */
?>

<div class="media" id="comment-<?php echo $data['id'];?>">
    <div class="media-body">
        <p class="media-heading"><?php echo CHtml::link($data['title'],array('posts/view','id'=>$data['logid']));?></p>
        <p><?php echo $data['content'];?></p>
        <p>
            <?php echo zmf::formatTime($data['cTime']);?>
            <span class="pull-right">回复 
             <?php echo $data['status']==Posts::STATUS_STAYCHECK ? CHtml::link('通过','javascript:;',array('onclick'=>"setStatus('".$data['id']."','comments','passed')")) : '';?>
             <?php echo CHtml::link('删除','javascript:;',array('action'=>'del-content','action-type'=>'comment','action-data'=>  $data['id'],'action-confirm'=>1,'action-target'=>'comment-'.$data['id']));?>
            </span>
        </p>
    </div>
</div>
