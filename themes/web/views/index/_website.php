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
        <?php if($from=='detail'){?>
        <th>选择</th>
        <?php }?>
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
            <?php if($from=='detail'){?>
            <th><input type="checkbox" name="selected[]" value="<?php echo $data->id;?>"></th>
            <?php }?>
            <td><?php echo ServiceWebsites::types($data->type);?></td>    
            <td><?php echo $data->classifyInfo->title;?></td>    
            <td><?php echo $data->nickname;?></td>    
            <td><?php echo $data->url!='' ? CHtml::link(zmf::subStr($data->url),$data->url,array('target'=>'_blank')) : '';?></td>    
            <td><?php echo $data->favors;?></td>
            <td><?php echo $data->price;?></td>
        </tr>
    <?php endforeach; ?>
    </tbody>
</table>