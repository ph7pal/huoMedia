<div class="main-part">
    <?php if(!empty($tagInfo)){?>
    <div class="module">
        <p>已选标签：<b><?php echo $tagInfo['title'];?></b> <?php echo CHtml::link('<i class="fa fa-times-circle"></i>',array('index/index'),array('title'=>'取消选择'));?></p>
    </div>
    <?php }?>
    <?php if(!empty($posts)){?>
    <?php foreach($posts as $post){?>
    <?php $this->renderPartial('/posts/_item',array('data'=>$post));?>
    <?php }?>
    <?php }?>
    <?php $this->renderPartial('/common/pager',array('pages'=>$pages));?>
</div>