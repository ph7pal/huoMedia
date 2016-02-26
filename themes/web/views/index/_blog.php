<?php

/**
 * @filename _blog.php 
 * @Description
 * @author 阿年飞少 <ph7pal@qq.com> 
 * @link http://www.newsoul.cn 
 * @copyright Copyright©2015 阿年飞少 
 * @datetime 2016-2-25  10:04:28 
 */
?>
<table class="table table-hover">
    <thead>
    <tr>
        <?php if($from=='detail'){?>
        <th>选择</th>
        <?php }?>
        <th>博客归属</th>
        <th>主页地址</th>
        <th>昵称</th>
        <th>点击量</th>
        <th>类型</th>
        <th>级别</th>
        <th>地区</th>
        <th>价格</th>
    </tr>
    </thead>
    <tbody>
    <?php foreach ($posts as $data): ?> 
        <tr>
            <?php if($from=='detail'){?>
            <th><input type="checkbox" name="selected[]" value="<?php echo $data->id;?>"></th>
            <?php }?>
            <td><?php echo $data->typeInfo->title;?></td>
            <td><?php echo $data->url!='' ? CHtml::link(zmf::subStr($data->url),$data->url,array('target'=>'_blank')) : '';?></td>
            <td><?php echo $data->nickname;?></td>
            <td><?php echo $data->hits;?></td>    
            <td><?php echo $data->classifyInfo->title;?></td>
            <td><?php echo ServiceBlogs::level($data->level);?></td>    
            <td><?php echo $data->location;?></td>
            <td><?php echo $data->price;?></td>
        </tr>
    <?php endforeach; ?>
    </tbody>
</table>