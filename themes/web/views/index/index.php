<div class="container">
    <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title">社区<span class="pull-right small"><?php echo CHtml::link('查看更多 <i class="fa fa-arrow-circle-right"></i>',array('index/more','table'=>'forum'));?></span></h3>
        </div>
        <?php $this->renderPartial('/index/_forum', array('posts' => $forums)); ?>    
    </div>

    <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title">博客<span class="pull-right small"><?php echo CHtml::link('查看更多 <i class="fa fa-arrow-circle-right"></i>',array('index/more','table'=>'blog'));?></span></h3>
        </div>
        <?php $this->renderPartial('/index/_blog', array('posts' => $blogs)); ?>    
    </div>

    <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title">媒体<span class="pull-right small"><?php echo CHtml::link('查看更多 <i class="fa fa-arrow-circle-right"></i>',array('index/more','table'=>'media'));?></span></h3>
        </div>
        <?php $this->renderPartial('/index/_media', array('posts' => $medias)); ?>    
    </div>

    <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title">美丽说<span class="pull-right small"><?php echo CHtml::link('查看更多 <i class="fa fa-arrow-circle-right"></i>',array('index/more','table'=>'site','type'=>'meilishuo'));?></span></h3>
        </div>
        <?php $this->renderPartial('/index/_website', array('posts' => $meilis)); ?>    
    </div>

    <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title">蘑菇街<span class="pull-right small"><?php echo CHtml::link('查看更多 <i class="fa fa-arrow-circle-right"></i>',array('index/more','table'=>'site','type'=>'mogu'));?></span></h3>
        </div>
        <?php $this->renderPartial('/index/_website', array('posts' => $mogus)); ?>    
    </div>

    <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title">视频<span class="pull-right small"><?php echo CHtml::link('查看更多 <i class="fa fa-arrow-circle-right"></i>',array('index/more','table'=>'video'));?></span></h3>
        </div>
        <?php $this->renderPartial('/index/_video', array('posts' => $videos)); ?>    
    </div>

    <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title">人人<span class="pull-right small"><?php echo CHtml::link('查看更多 <i class="fa fa-arrow-circle-right"></i>',array('index/more','table'=>'site','type'=>'renren'));?></span></h3>
        </div>
        <?php $this->renderPartial('/index/_website', array('posts' => $renrens)); ?>    
    </div>

    <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title">豆瓣<span class="pull-right small"><?php echo CHtml::link('查看更多 <i class="fa fa-arrow-circle-right"></i>',array('index/more','table'=>'site','type'=>'douban'));?></span></h3>
        </div>
        <?php $this->renderPartial('/index/_website', array('posts' => $doubans)); ?>    
    </div>
</div>