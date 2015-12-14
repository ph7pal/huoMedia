<ul class="nav nav-tabs">
    <?php foreach(SearchRecords::getTypes('admin') as $k=>$type){?>
    <li role="presentation" <?php echo $selectedType==$k ? 'class="active"' : '';?>>
    <?php echo CHtml::link($type,array('posts/search','type'=>$k,'keyword'=>$keyword));?>
    </li>
    <?php }?>
</ul>
<?php if(!empty($posts)){?>
<table class="table table-hover" style="margin-top: 15px">
<?php foreach($posts as $post){?>
    <?php if($selectedType=='position'){?>
    <tr>
        <td><?php $_title = '';if ($post['title_cn'] != '') {$_title = $post['title_cn'];} elseif ($post['title_en'] != '') {$_title = $post['title_en'];} else {$_title = $post['title_local'];} echo CHtml::link($_title,array('/position/view','id'=>$post['id']),array('target'=>'_blank'));?></td>
        <td>
            <?php echo CHtml::link('详细',array('/position/view','id'=>$post['id']));?>
            <?php echo CHtml::link('编辑',array('position/update','id'=>$post['id']));?>
        </td>
    </tr>
    <?php }elseif($selectedType=='post'){?>
    <tr><td><?php echo CHtml::link($post['title'],array('/posts/index','id'=>$post['id']),array('target'=>'_blank'));?></td></tr>
    <?php }elseif($selectedType=='question'){?>
    <tr><td><?php echo CHtml::link($post['title'],array('/question/view','id'=>$post['id']),array('target'=>'_blank'));?></td></tr>
    <?php }elseif($selectedType=='answer'){?>
    <tr><td><?php $_title= Question::getOne($post['logid'], 'title'); echo CHtml::link($_title,array('/question/view','id'=>$post['logid']),array('target'=>'_blank'));?></td></tr>
    <?php }elseif($selectedType=='poipost'){?>
    <tr><td><?php $_title=  Position::getOne($post['logid'], 'title'); echo CHtml::link($_title,array('/position/view','id'=>$post['logid']),array('target'=>'_blank'));?></td></tr>
    <?php }elseif($selectedType=='poitips'){?>
    <tr><td><?php $_title=  Position::getOne($post['logid'], 'title'); echo CHtml::link($_title,array('/position/view','id'=>$post['logid']),array('target'=>'_blank'));?></td></tr>
    <?php }elseif($selectedType=='comments'){?>
    <tr><td><?php echo $post['content'];?></td></tr>
    <?php }elseif($selectedType=='user'){?>
    <tr><td><?php echo $post['truename'] ? $post['truename'] : $post['username'];?></td></tr>
    <?php }?>
<?php }?>
</table>
<?php }?>
<?php $this->renderPartial('//common/pager', array('pages' => $pages)); ?>