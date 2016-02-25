<?php

/**
 * @filename _video.php 
 * @Description
 * @author 阿年飞少 <ph7pal@qq.com> 
 * @link http://www.newsoul.cn 
 * @copyright Copyright©2015 阿年飞少 
 * @datetime 2016-2-25  10:09:17 
 */
?>
<table class="table table-hover">
    <thead>
    <tr>
        <th>序号</th>
        <th>视频网站</th>
        <th>类别</th>
        <th>所在位置</th>
        <th>网站地址链接</th>
        <th>保持时间</th>
        <th>价格</th>
    </tr>
    </thead>
    <tbody>
    <?php foreach ($posts as $data): ?> 
        <tr>
            <th><?php echo $data->id;?></th>
            <td><?php echo $data->typeInfo->title;?></td>
            <td><?php echo $data->classifyInfo->title;?></td>
            <td><?php echo $data->positionInfo->title;?></td>    
            <td><?php echo zmf::subStr($data->url);?></td>    
            <td><?php echo $data->stayTime;?></td>
            <td><?php echo $data->price;?></td>
        </tr>
    <?php endforeach; ?>
    </tbody>
</table>