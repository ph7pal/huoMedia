<?php

/**
 * @filename _media.php 
 * @Description
 * @author 阿年飞少 <ph7pal@qq.com> 
 * @link http://www.newsoul.cn 
 * @copyright Copyright©2015 阿年飞少 
 * @datetime 2016-2-25  10:08:39 
 */
?>
<table class="table table-hover">
    <thead>
    <tr>
        <th>序号</th>
        <th>类型</th>
        <th>媒体名称</th>
        <th>案例</th>
        <th>新闻源</th>
        <th>链接情况</th>
        <th>价格</th>
    </tr>
    </thead>
    <tbody>
    <?php foreach ($posts as $data): ?>
        <tr>
            <th><?php echo $data->id;?></th>
            <td><?php echo $data->classifyInfo->title;?></td>
            <td><?php echo $data->title;?></td>    
            <td><?php echo zmf::subStr($data->url);?></td>    
            <td><?php echo ServiceMedias::isSource($data->isSource);?></td>    
            <td><?php echo ServiceMedias::hasLink($data->hasLink);?></td>    
            <td><?php echo $data->price;?></td>
        </tr>
    <?php endforeach; ?>
    </tbody>
</table>