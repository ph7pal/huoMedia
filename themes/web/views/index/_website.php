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
<div class="table-responsive">
    <table class="table table-hover">
        <thead>
        <tr>
            <?php if($from=='detail'){?>
            <th class="hidden-xs">选择</th>
            <?php }?>
            <?php if(in_array($type,array('meilishuo','mogu'))){?>
            <th>网站</th>
            <th>分类</th>
            <th>昵称</th>
            <th class="hidden-xs">链接</th>
            <th>粉丝</th>
            <?php }elseif($type=='renren'){?>
            <th>昵称</th>
            <th>性别</th>
            <th>地区</th>
            <th class="hidden-xs">链接</th>
            <th>好友</th>
            <th>会员</th>        
            <?php }elseif($type=='douban'){?>
            <th>昵称</th>
            <th>粉丝</th>
            <th class="hidden-xs">链接</th>
            <th>地区</th>
            <?php }?>
            <th>价格（元）</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($posts as $data): ?> 
            <tr>
                <?php if($from=='detail'){?>
                <th class="hidden-xs"><input type="checkbox" name="selected[]" value="<?php echo $data->id;?>"></th>
                <?php }?>
                <?php if(in_array($type,array('meilishuo','mogu'))){?>
                <td><?php echo ServiceWebsites::types($data->type);?></td>    
                <td><?php echo $data->classifyInfo->title;?></td>    
                <td><?php echo $data->nickname;?></td>    
                <td class="hidden-xs"><?php echo $data->url!='' ? CHtml::link(zmf::subStr($data->url),$data->url,array('target'=>'_blank')) : '';?></td>    
                <td><?php echo ServiceWebsites::formatFavors($data->favors);?></td>
                <?php }elseif($type=='renren'){?>
                <td><?php echo $data->nickname;?></td>  
                <td><?php echo Users::userSex($data->sex);?></td>  
                <td><?php echo $data->location;?></td>  
                <td class="hidden-xs"><?php echo $data->url!='' ? CHtml::link(zmf::subStr($data->url),$data->url,array('target'=>'_blank')) : '';?></td>    
                <td><?php echo ServiceWebsites::formatFavors($data->favors);?></td>
                <td><?php echo $data->vipInfo;?></td>  
                <?php }elseif($type=='douban'){?>
                <td><?php echo $data->nickname;?></td>  
                <td><?php echo ServiceWebsites::formatFavors($data->favors);?></td>
                <td class="hidden-xs"><?php echo $data->url!='' ? CHtml::link(zmf::subStr($data->url),$data->url,array('target'=>'_blank')) : '';?></td>
                <td><?php echo $data->location;?></td>  
                <?php }?>
                <td><?php echo $data->price;?></td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
</div>