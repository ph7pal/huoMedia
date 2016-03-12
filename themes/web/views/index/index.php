<div class="container">
    <?php if(!empty($forums)){?>
    <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title">社区<span class="pull-right small"><?php echo CHtml::link('查看更多 <i class="fa fa-arrow-circle-right"></i>',array('index/more','table'=>'forum'));?></span></h3>
        </div>
        <?php $this->renderPartial('/index/_forum', array('posts' => $forums)); ?>    
    </div>
    <?php }if(!empty($blogs)){?>
    <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title">博客<span class="pull-right small"><?php echo CHtml::link('查看更多 <i class="fa fa-arrow-circle-right"></i>',array('index/more','table'=>'blog'));?></span></h3>
        </div>
        <?php $this->renderPartial('/index/_blog', array('posts' => $blogs)); ?>    
    </div>
    <?php }if(!empty($weibos)){?>
    <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title">微博<span class="pull-right small"><?php echo CHtml::link('查看更多 <i class="fa fa-arrow-circle-right"></i>',array('index/more','table'=>'weibo'));?></span></h3>
        </div>
        <?php $this->renderPartial('/index/_weibo', array('posts' => $weibos)); ?>    
    </div>
    <?php }if(!empty($weixins)){?>
    <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title">微信<span class="pull-right small"><?php echo CHtml::link('查看更多 <i class="fa fa-arrow-circle-right"></i>',array('index/more','table'=>'weixin'));?></span></h3>
        </div>
        <?php $this->renderPartial('/index/_weixin', array('posts' => $weixins)); ?>    
    </div>
    <?php }if(!empty($qzones)){?>
    <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title">QQ空间<span class="pull-right small"><?php echo CHtml::link('查看更多 <i class="fa fa-arrow-circle-right"></i>',array('index/more','table'=>'qzone'));?></span></h3>
        </div>
        <?php $this->renderPartial('/index/_qzone', array('posts' => $qzones)); ?>    
    </div>
    <?php }if(!empty($medias)){?>
    <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title">媒体<span class="pull-right small"><?php echo CHtml::link('查看更多 <i class="fa fa-arrow-circle-right"></i>',array('index/more','table'=>'media'));?></span></h3>
        </div>
        <?php $this->renderPartial('/index/_media', array('posts' => $medias)); ?>    
    </div>
    <?php }if(!empty($meilis)){?>
    <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title">美丽说<span class="pull-right small"><?php echo CHtml::link('查看更多 <i class="fa fa-arrow-circle-right"></i>',array('index/more','table'=>'site','type'=>'meilishuo'));?></span></h3>
        </div>
        <?php $this->renderPartial('/index/_website', array('posts' => $meilis,'type'=>'meilishuo')); ?>    
    </div>
    <?php }if(!empty($mogus)){?>
    <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title">蘑菇街<span class="pull-right small"><?php echo CHtml::link('查看更多 <i class="fa fa-arrow-circle-right"></i>',array('index/more','table'=>'site','type'=>'mogu'));?></span></h3>
        </div>
        <?php $this->renderPartial('/index/_website', array('posts' => $mogus,'type'=>'mogu')); ?>    
    </div>
    <?php }if(!empty($videos)){?>
    <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title">视频<span class="pull-right small"><?php echo CHtml::link('查看更多 <i class="fa fa-arrow-circle-right"></i>',array('index/more','table'=>'video'));?></span></h3>
        </div>
        <?php $this->renderPartial('/index/_video', array('posts' => $videos)); ?>    
    </div>
    <?php }if(!empty($renrens)){?>
    <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title">人人<span class="pull-right small"><?php echo CHtml::link('查看更多 <i class="fa fa-arrow-circle-right"></i>',array('index/more','table'=>'site','type'=>'renren'));?></span></h3>
        </div>
        <?php $this->renderPartial('/index/_website', array('posts' => $renrens,'type'=>'renren')); ?>    
    </div>
    <?php }if(!empty($doubans)){?>
    <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title">豆瓣<span class="pull-right small"><?php echo CHtml::link('查看更多 <i class="fa fa-arrow-circle-right"></i>',array('index/more','table'=>'site','type'=>'douban'));?></span></h3>
        </div>
        <?php $this->renderPartial('/index/_website', array('posts' => $doubans,'type'=>'douban')); ?>    
    </div>
    <?php }?>
</div>