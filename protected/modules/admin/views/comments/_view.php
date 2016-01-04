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

<div class="media">
    <div class="media-body">
        <p class="media-heading"><?php echo CHtml::link($data['title'],array('posts/view','id'=>$data['logid']));?></p>
        <p><?php echo $data['content'];?></p>
        <p>
            <?php echo zmf::formatTime($data['cTime']);?>
            <span class="pull-right">回复 通过 删除</span>
        </p>
    </div>
</div>
