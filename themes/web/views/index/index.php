<style>
    body{
        font-family: 'Microsoft YaHei','SimSun';
    }
    .panel{
        border-radius: 0
    }
    .panel-default>.panel-heading {
        color: #3299FE;
        background-color: #DBDFEA;
        border-radius: 0;
    }
    .panel-title{
        font-weight: 700
    }
    .panel-default thead{
        background-color: #F2F3F8;
        color: #9AA6C5
    }
</style>
<nav class="navbar navbar-default">
    <div class="container-fluid">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="#">Brand</a>
        </div>
        
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav">
                <li class="active"><a href="#">Link <span class="sr-only">(current)</span></a></li>
                <li><a href="#">Link</a></li>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Dropdown <span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <li><a href="#">Action</a></li>
                        <li><a href="#">Another action</a></li>
                        <li><a href="#">Something else here</a></li>
                        <li role="separator" class="divider"></li>
                        <li><a href="#">Separated link</a></li>
                        <li role="separator" class="divider"></li>
                        <li><a href="#">One more separated link</a></li>
                    </ul>
                </li>
            </ul>
            <ul class="nav navbar-nav navbar-right">
                <li><a href="#">Link</a></li>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Dropdown <span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <li><a href="#">Action</a></li>
                        <li><a href="#">Another action</a></li>
                        <li><a href="#">Something else here</a></li>
                        <li role="separator" class="divider"></li>
                        <li><a href="#">Separated link</a></li>
                    </ul>
                </li>
            </ul>
        </div><!-- /.navbar-collapse -->
    </div><!-- /.container-fluid -->
</nav>

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
        <h3 class="panel-title">视频<span class="pull-right small"><?php echo CHtml::link('查看更多 <i class="fa fa-arrow-circle-right"></i>',array('index/more','table'=>'site','type'=>'video'));?></span></h3>
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