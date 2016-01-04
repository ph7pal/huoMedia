<?php

/**
 * @filename index.php 
 * @Description
 * @author 阿年飞少 <ph7pal@qq.com> 
 * @link http://www.newsoul.cn 
 * @copyright Copyright©2015 阿年飞少 
 * @datetime 2016-1-4  12:55:36 
 */
$this->renderPartial('/tags/_nav');
?>
<table class="table table-hover table-condensed table-striped">
    <tr>
        <th>名称</th>
        <th>操作</th>
    </tr>
    <?php foreach ($posts as $tag){?>
    <tr>
        <td><?php echo $tag['title'];?></td>
        <td>编辑 删除</td>
    </tr>
    <?php }?>
</table>
<?php $this->renderPartial('/common/pager',array('pages'=>$pages));?>