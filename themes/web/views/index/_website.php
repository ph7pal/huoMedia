<?php

/**
 * @filename _website.php 
 * @Description
 * @author 阿年飞少 <ph7pal@qq.com> 
 * @link http://www.newsoul.cn 
 * @copyright Copyright©2015 阿年飞少 
 * @datetime 2016-2-25  10:09:05 
 */
?>
<table class="table table-hover">
    <thead>
    <tr>
        <th>序号</th>
        <th>网站</th>
        <th>分类</th>
        <th>昵称</th>
        <th>链接</th>
        <th>粉丝/万</th>
        <th>价格</th>
    </tr>
    </thead>
    <tbody>
    <?php foreach ($posts as $data): ?> 
        <tr>
            <th><?php echo $data->id;?></th>
            <td><?php echo ServiceWebsites::types($data->type);?></td>    
            <td><?php echo $data->classifyInfo->title;?></td>    
            <td><?php echo $data->nickname;?></td>    
            <td><?php echo zmf::subStr($data->url);?></td>    
            <td><?php echo $data->favors;?></td>
            <td><?php echo $data->price;?></td>
        </tr>
    <?php endforeach; ?>
    </tbody>
</table>