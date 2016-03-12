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
            <th>微信名称</th>
            <th>微信号</th>
            <th>粉丝数</th>
            <th>单图文（元）</th>
            <th>多图文（元）</th>
            <th>认证</th>        
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
                <td><?php echo $data->account;?></td>                
                <td><?php echo ServiceWebsites::formatFavors($data->favors);?></td>
                <td><?php echo $data->danTuwen;?></td>
                <td><?php echo $data->duoTuwen;?></td>
                <td><?php echo $data->renzhen;?></td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
</div>