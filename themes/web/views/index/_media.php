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
        <?php if($from=='detail'){?>
        <th class="hidden-xs">选择</th>
        <?php }?>
        <th>类型</th>
        <th>媒体名称</th>
        <th class="hidden-xs">案例</th>
        <th>新闻源</th>
        <th>链接情况</th>
        <th>价格（元）</th>
    </tr>
    </thead>
    <tbody>
    <?php foreach ($posts as $data): ?>
        <tr>
            <?php if($from=='detail'){?>
            <th class="hidden-xs"><input type="checkbox" name="selected[]" value="<?php echo $data->id;?>"></th>
            <?php }?>
            <td><?php echo $data->classifyInfo->title;?></td>
            <td><?php echo $data->title;?></td>    
            <td class="hidden-xs"><?php echo $data->url!='' ? CHtml::link(zmf::subStr($data->url),$data->url,array('target'=>'_blank')) : '';?></td>   
            <td><?php echo ServiceMedias::isSource($data->isSource);?></td>    
            <td><?php echo ServiceMedias::hasLink($data->hasLink);?></td>    
            <td><?php echo $data->price;?></td>
        </tr>
    <?php endforeach; ?>
    </tbody>
</table>