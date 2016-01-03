<div class="post-item">
    <?php if($data['faceimg']){?>
    <img src="<?php echo $data['faceimg'];?>" class="img-responsive"/>
    <?php }?>
    <div class="module">
        <p><?php echo CHtml::link($data['title'], array('posts/view', 'id' => $data['id'])); ?></p>
        <p><?php echo zmf::subStr($data['content'],140);?></p>
        <?php if(!empty($data['tagids'])){?>
        <p class="post-list-tags"><i class="fa fa-tags"></i><?php foreach($data['tagids'] as $_tag){echo CHtml::link($_tag['title'],array('index/index','tagid'=>$_tag['id']));}?></p>
        <?php }?>
        <div class="post-item-footer">
            <div class="left-actions">
                <span><i class="fa fa-heart-o"></i> <?php echo $data['comments'];?></span>
                <span><i class="fa fa-comment-o"></i> <?php echo $data['favors'];?></span>
            </div>
            <div class="dropdown right-actions">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true"><i class="fa fa-ellipsis-h"></i></a>  
                <ul class="dropdown-menu">
                  <li><a href="#">分享</a></li>
                  <li><a href="#">评论</a></li>
                  <li role="separator" class="divider"></li>
                  <li><a href="#">编辑</a></li>
                  <li><a href="#">删除</a></li>
                </ul>
              </div>
        </div>
    </div>
</div>