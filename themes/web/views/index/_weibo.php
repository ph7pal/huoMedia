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
<div class="table-responsive">
    <table class="table table-hover">
        <thead>
        <tr>
            <?php if($from=='detail'){?>
            <th class="hidden-xs">选择</th>
            <?php }?>
            <th>类别</th>
            <th>微博号</th>
            <th>链接</th>
            <th>粉丝</th>
            <th>身份</th>
            <th>普通转发（元）</th>
            <th>普通直发（元）</th>
            <th>硬广转发（元）</th>
            <th>硬广直发（元）</th>            
        </tr>
        </thead>
        <tbody>
        <?php foreach ($posts as $data): ?> 
            <tr>
                <?php if($from=='detail'){?>
                <th class="hidden-xs"><input type="checkbox" name="selected[]" value="<?php echo $data->id;?>"></th>
                <?php }?>
                <td><?php echo $data->classifyInfo->title;?></td>
                <td><?php echo $data->nickname;?></td>
                <td><?php echo $data->url!='' ? CHtml::link(zmf::subStr($data->url),$data->url,array('target'=>'_blank')) : '';?></td>
                <td><?php echo ServiceWebsites::formatFavors($data->favors);?></td>
                <td><?php echo $data->shenfen;?></td>
                <td><?php echo $data->ptzhuanfa;?></td>
                <td><?php echo $data->ptzhifa;?></td>
                <td><?php echo $data->ygzhuanfa;?></td>
                <td><?php echo $data->ygzhifa;?></td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
</div>