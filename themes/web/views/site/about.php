<?php

/**
 * @filename about.php 
 * @Description
 * @author 阿年飞少 <ph7pal@qq.com> 
 * @link http://www.newsoul.cn 
 * @copyright Copyright©2015 阿年飞少 
 * @datetime 2016-1-5  15:04:55 
 */
?>
<div class="main-part">
    <div class="module">
        <?php echo zmf::text(array(), $info['content']); ?>
    </div>
    <?php if(!empty($allInfos)){?>
    <div class="module">
        <div class="list-group">
            <?php foreach ($allInfos as $val){?>
            <?php echo CHtml::link($val['title'],array('site/info','code'=>$val['code']));?>
            <?php }?>
        </div>
    </div>
    <?php }?>
</div>