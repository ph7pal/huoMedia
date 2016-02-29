<tr>    
    <th><?php echo $data->id;?></th>    
    <?php if(in_array($type,array('meilishuo','mogu'))){?>
    <td><?php echo ServiceWebsites::types($data->type);?></td>    
    <td><?php echo $data->classifyInfo->title;?></td>    
    <td><?php echo $data->nickname;?></td>    
    <td><?php echo $data->url!='' ? CHtml::link(zmf::subStr($data->url),$data->url,array('target'=>'_blank')) : '';?></td>    
    <td><?php echo ServiceWebsites::formatFavors($data->favors);?></td>
    <?php }elseif($type=='renren'){?>
    <td><?php echo $data->nickname;?></td>  
    <td><?php echo Users::userSex($data->sex);?></td>  
    <td><?php echo $data->location;?></td>  
    <td><?php echo $data->url!='' ? CHtml::link(zmf::subStr($data->url),$data->url,array('target'=>'_blank')) : '';?></td>    
    <td><?php echo ServiceWebsites::formatFavors($data->favors);?></td>
    <td><?php echo $data->vipInfo;?></td>  
    <?php }elseif($type=='douban'){?>
    <td><?php echo $data->nickname;?></td>  
    <td><?php echo ServiceWebsites::formatFavors($data->favors);?></td>
    <td><?php echo $data->url!='' ? CHtml::link(zmf::subStr($data->url),$data->url,array('target'=>'_blank')) : '';?></td>
    <td><?php echo $data->location;?></td>  
    <?php }?>
    <td><?php echo $data->price;?></td>
    <td>
        <?php echo CHtml::link('编辑',array('update','id'=>$data->id));?>
        <?php echo CHtml::link('删除',array('delete','id'=>$data->id));?>
    </td>
</tr>